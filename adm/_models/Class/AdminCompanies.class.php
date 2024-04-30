<?php

/**
 * AdminCtb.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os contribuintes no Admin do sistema!
 * 
 * @copyright (c) Jefferson Androcles
 */
class AdminCompanies {

    private $Data;
    private $Empresa;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'tb_empresas';

    /**
     * <b>Cadastrar Usuário:</b> Envelope os dados de um usuário em um array atribuitivo e execute esse método
     * para cadastrar o mesmo no sistema. Validações serão feitas!
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        $this->setData();
        $this->checkData();

        if ($this->Result):
            $this->Create();
        endif;
    }

    /**
     * <b>Atualizar Usuário:</b> Envelope os dados em uma array atribuitivo e informe o id de um
     * usuário para atualiza-lo no sistema!
     * @param INT $UserId = Id do usuário
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($Id, array $Data) {
        $this->Empresa = (int) $Id;
        $this->Data = $Data;

        $this->Data['NomeEmpresa'] = mb_strtoupper($this->Data['NomeEmpresa'], 'UTF-8');
        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->checkData();

        if ($this->Result):
            $this->Update();
        endif;
    }

    public function ExeRemove($UserId, array $Data) {
        $this->User = (int) $UserId;
        $this->Data = $Data;
        $this->nameUser = $this->Data['usuario_user'];
        unset($this->Data['usuario_user']);
        $this->checkRemove();
        if ($this->Result):
            $this->Update();
        endif;
    }

    /**
     * <b>Remover Usuário:</b> Informe o ID do usuário que deseja remover. Este método não permite deletar
     * o próprio perfil ou ainda remover todos os ADMIN'S do sistema!
     * @param INT $UserId = Id do usuário
     */
    public function ExeDelete($Id) {
        $this->Empresa = (int) $Id;

        $readEmpresa = new Read;
        $readEmpresa->ExeRead(self::Entity, "WHERE IdEmpresa = :id", "id={$this->Empresa}");

        if (!$readEmpresa->getResult()):
            $this->Error = ['Oppsss, você tentou remover uma empresa que não existe no sistema!', 'red', 'lnr lnr-warning', 4000];
            $this->Result = false;
        else:
            $this->Delete();
        endif;
    }

    /**
     * <b>Verificar Cadastro:</b> Retorna TRUE se o cadastro ou update for efetuado ou FALSE se não.
     * Para verificar erros execute um getError();
     * @return BOOL $Var = True or False
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * <b>Obter Erro:</b> Retorna um array associativo com um erro e um tipo.
     * @return ARRAY $Error = Array associatico com o erro
     */
    public function getError() {
        return $this->Error;
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */

    //Valida e cria os dados para realizar o cadastro
    private function setData() {
        $this->Data['NomeEmpresa'] = mb_strtoupper($this->Data['NomeEmpresa'], 'UTF-8');

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
    }

    //Verifica os dados digitados no formulário
    private function checkData() {
        if (empty($this->Data['NomeEmpresa']) 
                || empty($this->Data['ContatoEmpresa']) 
                || empty($this->Data['CnpjEmpresa']) 
                || empty($this->Data['NomeUsuario']) 
                || empty($this->Data['EmailUsuario']) 
                || empty($this->Data['SenhaUsuario']) 
                || empty($this->Data['CepEndereco'])):
            $this->Error = ["Existem campos em branco. Favor preencha todos os campos!", 'blue', 'lnr lnr-warning', 5000];
            $this->Result = false;
        elseif (isset($this->Data['EmailUsuario']) && !Check::Email($this->Data['EmailUsuario'])):
            $this->Error = ["O e-email informado não parece ter um formato válido!", 'blue', 'lnr lnr-warning', 5000];
            $this->Result = false;
        else:
            $this->checkCnpj();
        endif;
    }

    private function checkCnpj() {
        $Where = (isset($this->Empresa) ? "WHERE IdEmpresa != {$this->Empresa} AND" : "INNER JOIN tb_usuarios WHERE EmailUsuario = '{$this->Data['EmailUsuario']}' OR");
        $Read = new Read;
        $Read->FullRead("SELECT * FROM tb_empresas {$Where} CnpjEmpresa = :cnpj", "cnpj={$this->Data['CnpjEmpresa']}");
        if ($Read->getRowCount()):
            $this->Error = ["O cnpj <b>{$this->Data['CnpjEmpresa']}</b> ou email de usuário já está cadastrado, tente outro!", 'blue', 'lnr lnr-warning', 5000];
            $this->Result = false;
        else:
            $this->Result = true;
        endif;
    }

    private function Create() {
        $Create = new Create;
        $Address = array(
            "CepEndereco" => $this->Data['CepEndereco'],
            "UfEndereco" => $this->Data['UfEndereco'],
            "CidadeEndereco" => $this->Data['CidadeEndereco'],
            "BairroEndereco" => $this->Data['BairroEndereco'],
            "RuaEndereco" => $this->Data['RuaEndereco'],
            "NumEndereco" => $this->Data['NumEndereco'],
            "ComEndereco" => $this->Data['ComEndereco']
        );
        $Phone = array(
            "Telefone" => $this->Data['Telefone']
        );
        $Department = array(
            "dep_title" => "DIRETORIA",
            "dep_description" => "Diretor Executivo"
        );
        $User = array(
            "NomeUsuario" => $this->Data['NomeUsuario'],
            "EmailUsuario" => $this->Data['EmailUsuario'],
            "SenhaUsuario" => md5($this->Data['SenhaUsuario']),
            "NivelUsuario" => "DIRETOR",
            "user_registration" => date("Y-m-d H:i:s"),
            "nivel_user" => 2
        );
        unset($this->Data['CepEndereco'], $this->Data['UfEndereco'], $this->Data['CidadeEndereco'], $this->Data['BairroEndereco'], $this->Data['RuaEndereco'], $this->Data['NumEndereco'], $this->Data['ComEndereco'], $this->Data['Telefone'], $this->Data['NomeUsuario'], $this->Data['EmailUsuario'], $this->Data['SenhaUsuario']);
        $Create->ExeCreate(self::Entity, $this->Data);
        $Address["IdEmpresaEndereco"] = $Create->getResult();
        $Phone["IdEmpresaTelefone"] = $Create->getResult();
        $Department["dep_id_companies"] = $Create->getResult();
        $User["IdEmpresaUsuario"] = $Create->getResult();

        $Create->ExeCreate("tb_enderecos", $Address);
        $Create->ExeCreate("tb_telefones", $Phone);
        $Create->ExeCreate("tb_department", $Department);
        $User["dep_id_user"] = $Create->getResult();
        if ($Create->getResult()):
            $Create->ExeCreate("tb_usuarios", $User);
            $this->Error = ["A empresa <b>{$this->Data['NomeEmpresa']}</b> foi cadastrada!", 'green', 'lnr lnr-smile', 4000];
            $this->Result = true;
        endif;
    }

    private function Update() {
        $Update = new Update;
        $Address = array(
            "CepEndereco" => $this->Data['CepEndereco'],
            "UfEndereco" => $this->Data['UfEndereco'],
            "CidadeEndereco" => $this->Data['CidadeEndereco'],
            "BairroEndereco" => $this->Data['BairroEndereco'],
            "RuaEndereco" => $this->Data['RuaEndereco'],
            "NumEndereco" => $this->Data['NumEndereco'],
            "ComEndereco" => $this->Data['ComEndereco']
        );
        $Phone = array(
            "Telefone" => $this->Data['Telefone']
        );
        unset($this->Data['CepEndereco'], $this->Data['UfEndereco'], $this->Data['CidadeEndereco'], $this->Data['BairroEndereco'], $this->Data['RuaEndereco'], $this->Data['NumEndereco'], $this->Data['ComEndereco'], $this->Data['Telefone']);
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE IdEmpresa = :id", "id={$this->Empresa}");
        if ($Update->getResult()):
            $Update->ExeUpdate("tb_enderecos", $Address, "WHERE IdEmpresaEndereco = :id", "id={$this->Empresa}");
            $Update->ExeUpdate("tb_telefones", $Phone, "WHERE IdEmpresaTelefone = :id", "id={$this->Empresa}");
            $this->Error = ["Os dados da empresa <b>{$this->Data['NomeEmpresa']}</b> foram atualizados!", 'green', 'lnr lnr-smile', 4000];
            $this->Result = true;
        endif;
    }

    //Remove Usuário
    private function Delete() {
        $Remove = new Delete;
        $Remove->ExeDelete("tb_enderecos", "WHERE IdEmpresaEndereco = :id", "id={$this->Empresa}");
        $Remove->ExeDelete("tb_relatorios", "WHERE IdEmpresaRelatorio = :id", "id={$this->Empresa}");
        $Remove->ExeDelete("tb_telefones", "WHERE IdEmpresaTelefone = :id", "id={$this->Empresa}");
        $Remove->ExeDelete("tb_tickets", "WHERE idempresatickets = :id", "id={$this->Empresa}");
        $Remove->ExeDelete("tb_uploads", "WHERE IdEmpresaUp = :id", "id={$this->Empresa}");
        $Remove->ExeDelete("tb_department", "WHERE dep_id_companies = :id", "id={$this->Empresa}");
        $Remove->ExeDelete("tb_usuarios", "WHERE IdEmpresaUsuario = :id", "id={$this->Empresa}");
        if ($Remove->getResult()):
            $Remove->ExeDelete(self::Entity, "WHERE IdEmpresa = :id", "id={$this->Empresa}");
            $this->Error = ["Empresa removida do sistema!", 'green', 'lnr lnr-smile', 4000];
            $this->Result = true;
        endif;
    }

}
