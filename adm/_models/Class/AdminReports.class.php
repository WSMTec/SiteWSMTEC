<?php

/**
 * AdminCtb.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os contribuintes no Admin do sistema!
 * 
 * @copyright (c) Jefferson Androcles
 */
class AdminReports {

    private $Data;
    private $Relatorio;
    private $Usuarios;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'tb_relatorios';

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
            $this->Data['OSRelatorio'] = $this->getCod();
            $this->Data['CodigoRelatorio'] = $this->Data['OSRelatorio'];
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
        $this->Relatorio = (int) $Id;
        $this->Data = $Data;
        $this->setData();
        $this->checkData();

        if ($this->Result):
            $this->Update();
        endif;
    }

    public function ExeDeleteTrain($UserId) {
        $this->Usuarios = (int) $UserId;

        $readUser = new Read;
        $readUser->ExeRead("tb_testemunhas", "WHERE IdTes = :id", "id={$this->Usuarios}");

        if (!$readUser->getResult()):
            $this->Error = ['Oppsss, você tentou remover um cliente que não existe no sistema!', 'red', 'lnr lnr-warning', 4000];
            $this->Result = false;
        else:
            $Delete = new Delete;
            $Delete->ExeDelete("tb_testemunhas", "WHERE IdTes = :id", "id={$this->Usuarios}");
            $this->Error = ['Usuário removido do relatório.', 'green', 'lnr lnr-smile', 4000];
            $this->Result = true;
        endif;
    }

    /**
     * <b>Remover Usuário:</b> Informe o ID do usuário que deseja remover. Este método não permite deletar
     * o próprio perfil ou ainda remover todos os ADMIN'S do sistema!
     * @param INT $UserId = Id do usuário
     */
    public function ExeDelete($UserId) {
        $this->Relatorio = (int) $UserId;

        $readUser = new Read;
        $readUser->ExeRead(self::Entity, "WHERE IdRelatorio = :id", "id={$this->Relatorio}");

        if (!$readUser->getResult()):
            $this->Error = ['Oppsss, você tentou remover um relatório que não existe no sistema!', 'red', 'lnr lnr-warning', 4000];
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
        $Obs = $this->Data['ObsClienteRelatorio'];
        $Desc = $this->Data['DescServicoRelatorio'];
        unset($this->Data['ObsClienteRelatorio'], $this->Data['DescServicoRelatorio']);

        if (isset($this->Data['NomeTes'])):
            $this->Usuarios['NomeTes'] = $this->Data['NomeTes'];
            unset($this->Data['NomeTes']);
        endif;

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
        $this->Data['ObsClienteRelatorio'] = $Obs;
        $this->Data['DescServicoRelatorio'] = $Desc;
    }

    private function getCod() {
        $Read = new Read;
        $Read->ExeRead("tb_codigos");
        $Codigo = $Read->getResult()[0]['Codigo'] . "/" . date("Y");
        $Update = new Update;
        $Update->ExeUpdate("tb_codigos", array("Codigo" => ($Read->getResult()[0]['Codigo'] + 1)), "WHERE IdCodigo = :id", "id={$Read->getResult()[0]['IdCodigo']}");
        if ($Update->getResult()):
            return $Codigo;
        endif;
    }

    private function setUsers($Id) {
        $UserTes = array();
        $UserCount = count($this->Usuarios['NomeTes']);
        $UserKeys = array_keys($this->Usuarios);

        for ($User = 0; $User < $UserCount; $User++):
            foreach ($UserKeys as $Keys):
                $UserTes[$User][$Keys] = $this->Usuarios[$Keys][$User];
                $UserTes[$User]["IdRelatorio"] = $Id;
            endforeach;
        endfor;

        $Create = new Create;
        foreach ($UserTes as $users):
            $Create->ExeCreate("tb_testemunhas", $users);
        endforeach;
    }

    //Verifica os dados digitados no formulário
    private function checkData() {
        if (in_array('', $this->Data)):
            $this->Error = ["Existem campos em branco. Favor preencha todos os campos!", 'blue', 'lnr lnr-warning', 5000];
            $this->Result = false;
        elseif (isset($this->Usuarios) && in_array('', $this->Usuarios['NomeTes'])):
            $this->Error = ["Exisetem campos em branco. Favor preencha todos os campos!", 'blue', 'lnr lnr-warning', 5000];
            $this->Result = false;
        else:
            $this->Data['HTotalRelatorio'] = Check::Hours($this->Data['HInicioRelatorio'], $this->Data['HFimRelatorio']);
            $this->Result = true;
        endif;
    }

    //Verifica os dados digitados no formulário
    private function checkTraining() {
        if (in_array('', $this->Data)):
            $this->Error = ["Existem campos em branco. Favor preencha todos os campos!", 'blue', 'lnr lnr-warning', 5000];
            $this->Result = false;
        elseif (isset($this->Usuarios)):
            if (in_array('', $this->Usuarios['NomeTes'])):
                $this->Error = ["Existem campos em branco. Favor preencha todos os campos!", 'blue', 'lnr lnr-warning', 5000];
                $this->Result = false;
            else:

            endif;
        else:
            $this->Data['HTotalRelatorio'] = Check::Hours($this->Data['HInicioRelatorio'], $this->Data['HFimRelatorio']);
            $this->Result = true;
        endif;
    }

    private function checkCnpj() {
        $Where = (isset($this->Relatorio) ? "IdRelatorio != {$this->Relatorio} AND" : '');
        $Read = new Read;
        $Read->FullRead("SELECT * FROM tb_empresas WHERE {$Where} CnpjRelatorio = :cnpj", "cnpj={$this->Data['CnpjRelatorio']}");
        if ($Read->getRowCount()):
            $this->Error = ["O cnpj <b>{$this->Data['CnpjRelatorio']}</b> já está cadastrado, tente outro!", 'blue', 'lnr lnr-warning', 5000];
            $this->Result = false;
        else:
            $this->Result = true;
        endif;
    }

    private function Create() {
        $this->Data['DataRelatorio'] = date("Y-m-d");
        $Create = new Create;
        $Create->ExeCreate(self::Entity, $this->Data);
        if ($Create->getResult()):
            if ($this->Usuarios):
                $this->setUsers($Create->getResult());
            endif;

            $this->Error = ["A relatório <b>{$this->Data['FasesModulosRelatorio']}</b> foi cadastrado!", 'green', 'lnr lnr-smile', 4000];
            $this->Result = true;
        endif;
    }

    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE IdRelatorio = :id", "id={$this->Relatorio}");
        if ($Update->getResult()):
            if ($this->Usuarios):
                $this->setUsers($this->Relatorio);
            endif;
            $this->Error = ["O relatório <b>{$this->Data['FasesModulosRelatorio']}</b> foi atualizado!", 'green', 'lnr lnr-smile', 4000];
            $this->Result = true;
        endif;
    }

    //Remove Usuário
    private function Delete() {
        $Delete = new Delete;
        $Delete->ExeDelete(self::Entity, "WHERE IdRelatorio = :id", "id={$this->Relatorio}");
        if ($Delete->getResult()):
            $Delete->ExeDelete("tb_testemunhas", "WHERE IdRelatorio = :id", "id={$this->Relatorio}");
            $this->Error = ["O Relatório foi removido do sistema!", 'green', 'lnr lnr-smile', 4000];
            $this->Result = true;
        endif;
    }

}
