<?php

/**
 * AdminUser.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os usuários no Admin do sistema!
 * 
 * @copyright (c) Jefferson Androcles
 */
class AdminUser {

    private $Data;
    private $nameUser;
    private $User;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'tb_usuarios';

    /**
     * <b>Cadastrar Usuário:</b> Envelope os dados de um usuário em um array atribuitivo e execute esse método
     * para cadastrar o mesmo no sistema. Validações serão feitas!
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        $this->setData();
        $this->checkData();
//        echo "<pre>";
//        var_dump($this->Data);
//        echo "</pre>";
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
    public function ExeUpdate($UserId, array $Data) {
        $this->User = (int) $UserId;
        $this->Data = $Data;

        if (!$this->Data['SenhaUsuario']):
            unset($this->Data['SenhaUsuario']);
        endif;
        $this->setData();
        $this->checkData();

        if ($this->Result):
            $this->Update();
        endif;
    }

    public function ExeProfile($UserId, array $Data) {
        $this->User = (int) $UserId;
        $this->Data = $Data;


        if (!$this->Data['SenhaUsuario']):
            unset($this->Data['SenhaUsuario']);
        endif;

        $Cover = $this->Data['FotoUsuario'];
        unset($this->Data['FotoUsuario']);

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['FotoUsuario'] = $Cover;
        $this->checkData();

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE IdUsuario = :post", "post={$this->User}");
        if (is_array($this->Data['FotoUsuario'])):
            $capa = '../../uploads/' . $read->getResult()[0]['FotoUsuario'];
            if (file_exists($capa) && !is_dir($capa)):
                unlink($capa);
            endif;

            $uploadCapa = new Upload('../../uploads/');
            $uploadCapa->Image($this->Data['FotoUsuario'], Check::Name($this->Data['NomeUsuario']));
        endif;


        if (isset($uploadCapa) && $uploadCapa->getResult()):
            $this->Data['FotoUsuario'] = $uploadCapa->getResult();
            $this->Update();
        else:
            unset($this->Data['FotoUsuario']);
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
    public function ExeDelete($UserId) {
        $this->User = (int) $UserId;

        $readUser = new Read;
        $readUser->ExeRead(self::Entity, "WHERE IdUsuario = :id", "id={$this->User}");

        if (!$readUser->getResult()):
            $this->Error = ['Oppsss, você tentou remover um usuário que não existe no sistema!', 'red', 'lnr lnr-warning', 4000];
            $this->Result = false;
        elseif ($this->User == $_SESSION['userlogin']['IdUsuario']):
            $this->Error = ['Oppsss, você tentou remover seu usuário. Essa ação não é permitida!!!', 'red', 'lnr lnr-warning', 4000];
            $this->Result = false;
        else:
            if ($readUser->getResult()[0]['nivel_user'] == 3):

                $readAdmin = $readUser;
                $readAdmin->ExeRead(self::Entity, "WHERE IdUsuario != :id AND nivel_user = :lv", "id={$this->User}&lv=4");

                if (!$readAdmin->getRowCount()):
                    $this->Error = ['Oppsss, você está tentando remover o único ADMIN do sistema. Para remover cadastre outro antes!!!', 'red', 'lnr lnr-warning', 3000];
                    $this->Result = false;
                else:
                    $this->Delete();
                endif;
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

    private function setData() {

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['NomeUsuario'] = strtolower($this->Data['NomeUsuario']);
        $this->Data['NomeUsuario'] = Check::NamePerson($this->Data['NomeUsuario']);
        $this->Data['EmailUsuario'] = strtolower($this->Data['EmailUsuario']);

        if (isset($this->Data['nivel_user']) && $this->Data['nivel_user'] == '1'):
            $this->Data['NivelUsuario'] = "PADRAO";
        elseif (isset($this->Data['nivel_user']) && $this->Data['nivel_user'] == '2'):
            $this->Data['NivelUsuario'] = "DIRETOR";
            $this->Data['dep_id_user'] = Check::DepByName($this->Data['IdEmpresaUsuario']);
        elseif (isset($this->Data['nivel_user']) && $this->Data['nivel_user'] == '6'):
            $this->Data['NivelUsuario'] = "COORDENADOR";
            $this->Data['dep_id_user'] = Check::DepByName($this->Data['IdEmpresaUsuario']);
        else:
            $this->Data['NivelUsuario'] = "ADM";
            $this->Data['IdEmpresaUsuario'] = "1";
        endif;
    }

    //Verifica os dados digitados no formulário
    private function checkData() {
        if (in_array('', $this->Data)):
            $this->Error = ["Existem campos em branco. Favor preencha todos os campos!", 'blue', 'lnr lnr-warning', 5000];
            $this->Result = false;
        elseif (!Check::Email($this->Data['EmailUsuario'])):
            $this->Error = ["O e-email informado não parece ter um formato válido!", 'blue', 'lnr lnr-warning', 5000];
            $this->Result = false;
        elseif (isset($this->Data['SenhaUsuario']) && (strlen($this->Data['SenhaUsuario']) < 5 || strlen($this->Data['SenhaUsuario']) > 12)):
            $this->Error = ["A senha deve ter entre 5 e 12 caracteres!", 'blue', 'lnr lnr-warning', 4000];
            $this->Result = false;
        else:
            $this->checkEmail();
        endif;
    }

    //Verifica usuário pelo e-mail, Impede cadastro duplicado!
    private function checkEmail() {
        $Where = (isset($this->User) ? "IdUsuario != {$this->User} AND" : '');

        $readUser = new Read;
        $readUser->ExeRead(self::Entity, "WHERE {$Where} EmailUsuario = :email", "email={$this->Data['EmailUsuario']}");

        if ($readUser->getRowCount()):
            $this->Error = ["O email informado já existe no sistema! Informe outro email!", 'blue', 'lnr lnr-warning', 7000];
            $this->Result = false;
        else:
            $this->Result = true;
        endif;
    }

    //Verifica usuário, Impede cadastro duplicado!
    private function checkRemove() {
        $readUser = new Read;
        $v = 'R';
        $readUser->ExeRead(self::Entity, "WHERE status_user = :v AND id_user = :id", "v={$v}&id={$this->User}");

        if ($readUser->getRowCount()):
            $this->Error = ["O usuário {$this->nameUser} já foi removido!", 'red', 'lnr lnr-warning', 7000];
            $this->Result = false;
        else:
            $this->createReport();
        endif;
    }

    //Cadasrtra Relatorio!
    private function createReport() {
        $Arr = array();
        $Arr['id_user_relat'] = $_SESSION['userlogin']['id_user'];
        $Arr['id_excluido_relat'] = $this->User;
        $Arr['tipo_relat'] = 'REMOCAO';
        $Arr['desc_relat'] = "O Adminsitrador {$_SESSION['userlogin']['usuario_user']} removeu o usuário de nome {$this->nameUser}";
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

    // Cadasrtra Usuário!
    private function Create() {
        $Create = new Create;
        $this->Data['SenhaUsuario'] = md5($this->Data['SenhaUsuario']);

        $Create->ExeCreate(self::Entity, $this->Data);

        if ($Create->getResult()):
            $this->Error = ["O usuário <b>{$this->Data['NomeUsuario']}</b> foi cadastrado com sucesso no sistema!", 'green', 'lnr lnr-smile', 4000];
            $this->Result = $Create->getResult();
        endif;
    }

//Atualiza Usuário!
    private function Update() {
        $Update = new Update;
        if (isset($this->Data['SenhaUsuario'])):
            $this->Data['SenhaUsuario'] = md5($this->Data['SenhaUsuario']);
        endif;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE IdUsuario = :id", "id={$this->User}");
        if ($Update->getResult()):
            $this->Error = ["O usuário <b>{$this->Data['NomeUsuario']}</b> foi atualizado com sucesso!", 'green', 'lnr lnr-smile', 4000];
            $this->Result = true;
        endif;
    }

    //Verifica usuário pelo e-mail, Impede cadastro duplicado!
//    private function CheckReports() {
//        $readUser = new Read;
//        $readUser->ExeRead(self::Entity, "WHERE {$Where} EmailUsuario = :email", "email={$this->Data['EmailUsuario']}");
//
//        if ($readUser->getRowCount()):
//            $this->Error = ["O email informado já existe no sistema! Informe outro email!", 'blue', 'lnr lnr-warning', 7000];
//            $this->Result = false;
//        else:
//            $this->Result = true;
//        endif;
//    }
    //Remove Usuário
    private function Delete() {
//        if ($this->CheckReports()) :
//
//        endif;
        $Delete = new Delete;
        $Delete->ExeDelete(self::Entity, "WHERE IdUsuario = :id", "id={$this->User}");
        if ($Delete->getResult()):
            $this->Error = ["Usuário removido do sistema!", 'green', 'lnr lnr-smile', 4000];
            $this->Result = true;
        endif;
    }

}
