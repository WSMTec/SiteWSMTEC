<?php

/**
 * AdminNotify.class [ MODEL ADMIN ]
 * Respnsável por gerenciar as notificações no Admin do sistema!
 * 
 * @copyright (c) Jefferson Androcles
 */
class AdminNotify {

    private $Id;
    private $Data;
    private $Type;
    private $Error;
    private $Result;

    const Entity = 'n_notificacoes';

    public function ExeCreate($Id, $Type) {
        $this->Id = (int) $Id;
        $this->Data = array();
        $this->Type = $Type;

        if ($Type === 1):
            $this->Data['type_num_not'] = 1;
            $this->setData();
            $this->Create();
        elseif ($Type === 2):
            $this->Data['type_num_not'] = 2;
            $this->setData();
            $this->Create();
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
        $this->Data['id_dup_not'] = $this->Id;
        $this->Data['type_not'] = $this->getType();
        $this->Data['status_dup_not'] = "B";
        $this->Data['status_not'] = "NL";
        $this->Data['date_not'] = date("Y-m-d H:i:s");
        $this->Data['id_user_not'] = $_SESSION['userlogin']['id_user'];
    }

    private function getType() {
        switch ($this->Type):
            case 1:
                $this->Data['destiny_name'] = "ADM";
                return "Telefone possivelmente duplicado por {$_SESSION['userlogin']['usuario_user']}";
                break;
            case 2:
                $this->Data['destiny_name'] = "ADM";
                return "Endereço possivelmente duplicado por {$_SESSION['userlogin']['usuario_user']}";
                break;
        endswitch;
    }

    //Cadasrtra Usuário!
    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::Entity, $this->Data);
        if ($Create->getResult()):
            $this->Result = true;
        endif;
    }

    //Verifica os dados digitados no formulário
//    private function checkPhone() {
//        $Read = new Read;
//        $u = 0;
//        $Arr = array();
//        foreach ($this->Data as $v):
//            $Read->FullRead("SELECT n_contribuintes_tel.*, n_contribuintes.nome_cont, n_contribuintes.dta_cad_cont, n_usuarios.usuario_user FROM n_contribuintes_tel "
//                    . "INNER JOIN n_contribuintes ON id_cont = id_cont_tel "
//                    . "INNER JOIN n_usuarios ON n_usuarios.id_user = n_contribuintes.id_user_cont "
//                    . "WHERE dd_tel = :ddd AND fone_tel = :fone", "ddd={$v['dd_tel']}&fone={$v['fone_tel']}");
//            if ($Read->getRowCount()):
//                $this->Data[$u]['titulo_not'] = "Telefone Duplicado - " . $_SESSION['userlogin']['usuario_user'];
//                $this->Data[$u]['notificacao_not'] = $this->MsgPhone($Read->getResult()[0], $v['fone_tel'], $v['ramal_tel']);
//                $this->Data[$u]['status_not'] = "Telefone Duplicado";
//                $this->Data[$u]['data_not'] = date("Y-m-d H:i:s");
//                unset($this->Data[$u]['tipo_tel'], $this->Data[$u]['id_cont_tel'], $this->Data[$u]['dd_tel'], $this->Data[$u]['fone_tel'], $this->Data[$u]['ramal_tel']);
//                if (!isset($this->Data[$u])):
//                    var_dump($this->Data);
//                endif;
//            else:
//                $this->Result = false;
//            endif;
//
//            $u++;
//        endforeach;
//    }
}
