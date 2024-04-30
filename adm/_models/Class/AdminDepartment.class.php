<?php

/**
 * AdminUser.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os Departamentoss no Admin do sistema!
 * 
 * @copyright (c) Jefferson Androcles
 */
class AdminDepartment {

    private $Data;
    private $Department;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'tb_department';

    /**
     * <b>Cadastrar Departamentos:</b> Envelope os dados de um Departamentos em um array atribuitivo e execute esse método
     * para cadastrar o mesmo no sistema. Validações serão feitas!
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
        $this->Data['dep_title'] = mb_strtoupper($this->Data['dep_title'], 'UTF-8');

        $this->checkData();

        if ($this->Result):
            $this->Create();
        endif;
    }

    /**
     * <b>Atualizar Departamentos:</b> Envelope os dados em uma array atribuitivo e informe o id de um
     * Departamentos para atualiza-lo no sistema!
     * @param INT $DepartmentId = Id do Departamentos
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($DepartmentId, array $Data) {
        $this->Department = (int) $DepartmentId;
        $this->Data = $Data;
        $this->Data['dep_title'] = mb_strtoupper($this->Data['dep_title'], 'UTF-8');

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->checkData();

        if ($this->Result):
            $this->Update();
        endif;
    }

    /**
     * <b>Remover Departamentos:</b> Informe o ID do Departamentos que deseja remover. Este método não permite deletar
     * o próprio perfil ou ainda remover todos os ADMIN'S do sistema!
     * @param INT $DepartmentId = Id do Departamentos
     */
    public function ExeDelete($DepartmentId) {
        $this->Department = (int) $DepartmentId;

        $readDepartment = new Read;
        $readDepartment->ExeRead(self::Entity, "WHERE dep_id = :id", "id={$this->Department}");

        if (!$readDepartment->getResult()):
            $this->Error = ['Oppsss, você tentou remover um departamentos que não existe no sistema!', 'red', 'lnr lnr-warning', 4000];
            $this->Result = false;
        else:
            $readDepartment = new Read;
            $readDepartment->ExeRead("tb_usuarios", "WHERE dep_id_user = :id", "id={$this->Department}");
            if ($readDepartment->getResult()):
                $this->Error = ['Oppsss, o departamentos possui funcionários cadastrados!', 'red', 'lnr lnr-warning', 4000];
                $this->Result = false;
            else:
                $this->Delete();
            endif;
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

    //Verifica os dados digitados no formulário
    private function checkData() {
        if (in_array('', $this->Data)):
            $this->Error = ["Existem campos em branco. Favor preencha todos os campos!", 'blue', 'lnr lnr-warning', 5000];
            $this->Result = false;
        else:
            $this->checkName();
        endif;
    }

    //Verifica Departamentos pelo e-mail, Impede cadastro duplicado!
    private function checkName() {
        $Where = (isset($this->Department) ? "dep_id != '{$this->Department}' AND dep_id_companies = '{$this->Data['dep_id_companies']}' AND" : "dep_id_companies = '{$this->Data['dep_id_companies']}' AND");
        $readDepartment = new Read;
        $readDepartment->ExeRead(self::Entity, "WHERE {$Where} dep_title = :nome", "nome={$this->Data['dep_title']}");

        if ($readDepartment->getRowCount()):
            $this->Error = ["O departamento informado foi cadastrado no sistema por outro usuário! Informe outro departamento!", 'blue', 'lnr lnr-warning', 7000];
            $this->Result = false;
        else:
            $this->Result = true;
        endif;
    }

    //Verifica Departamentos, Impede cadastro duplicado!
    private function checkRemove() {
        $readDepartment = new Read;
        $v = 'R';
        $readDepartment->ExeRead(self::Entity, "WHERE status_user = :v AND dep_id = :id", "v={$v}&id={$this->Department}");

        if ($readDepartment->getRowCount()):
            $this->Error = ["O Departamentos {$this->nameUser} já foi removido!", 'red', 'lnr lnr-warning', 7000];
            $this->Result = false;
        else:
            $this->createReport();
        endif;
    }

    //Cadasrtra Relatorio!
    private function createReport() {
        $Arr = array();
        $Arr['dep_id_relat'] = $_SESSION['userlogin']['dep_id'];
        $Arr['id_excluido_relat'] = $this->Department;
        $Arr['tipo_relat'] = 'REMOCAO';
        $Arr['desc_relat'] = "O Adminsitrador {$_SESSION['userlogin']['usuario_user']} removeu o Departamentos de nome {$this->nameUser}";
        $Arr['data_relat'] = date("Y-m-d H:i:s");
        $Arr['ip_relat'] = $_SERVER['REMOTE_ADDR'];
        $Arr['nome_relat'] = $_SESSION['userlogin']['usuario_user'];
        $arrReport = $Arr;
        $Create = new Create;
        $Create->ExeCreate("n_relatorios", $arrReport);
        if ($Create->getResult()):
            $this->Result = true;
        endif;
    }

    //Cadasrtra Departamentos!
    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::Entity, $this->Data);

        if ($Create->getResult()):
            $this->Error = ["O departamentos <b>{$this->Data['dep_title']}</b> foi cadastrado com sucesso no sistema!", 'green', 'lnr lnr-smile', 4000];
            $this->Result = $Create->getResult();
        endif;
    }

    //Atualiza Departamentos!
    private function Update() {
        $Update = new Update;

        unset($this->Data['dep_id_companies']);
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE dep_id = :id", "id={$this->Department}");
        if ($Update->getResult()):
            $this->Error = ["O departamento <b>{$this->Data['dep_title']}</b> foi atualizado com sucesso!", 'green', 'lnr lnr-smile', 4000];
            $this->Result = true;
        endif;
    }

    //Remove Departamentos
    private function Delete() {
        $Delete = new Delete;
        $Delete->ExeDelete(self::Entity, "WHERE dep_id = :id", "id={$this->Department}");
        if ($Delete->getResult()):
            $this->Error = ["Departamento removido do sistema!", 'green', 'lnr lnr-smile', 4000];
            $this->Result = true;
        endif;
    }

}
