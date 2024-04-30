<?php

/**
 * AdminPost.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os clientes no Admin do site!
 * 
 * @copyright (c) Jefferson Androcles
 */
class AdminClient {

    private $Data;
    private $Post;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'tb_client';

    /**
     * <b>Cadastrar o Post:</b> Envelope os dados do cliente em um array atribuitivo e execute esse método
     * para cadastrar o cliente. Envia a capa automaticamente!
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Erro ao cadastrar: Para criar um cliente, favor preencha todos os campos!", "blue", "lnr lnr-warning", 4000];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();

            if ($this->Data['client_cover']):
                $uplaod = new Upload('../../uploads/');
                $uplaod->Image($this->Data['client_cover'], $this->Data['client_name'], null, '');
            endif;

            if (isset($uplaod) && $uplaod->getResult()):
                $this->Data['client_cover'] = $uplaod->getResult();
                $this->Create();
            else:
                $this->Data['client_cover'] = null;
                $this->Create();
            endif;
        endif;
    }

    /**
     * <b>Atualizar Post:</b> Envelope os dados em uma array atribuitivo e informe o id de um 
     * cliente para atualiza-lo na tabela!
     * @param INT $PostId = Id do cliente
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($PostId, array $Data) {
        $this->Post = (int) $PostId;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Para atualizar este cliente, preencha todos os campos ( Capa não precisa ser enviada! )", "blue", "lnr lnr-warning", 4000];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();

            $read = new Read;
            $read->ExeRead(self::Entity, "WHERE client_id = :cliente", "cliente={$this->Post}");
            if (is_array($this->Data['client_cover'])):
                $capa = '../../uploads/' . $read->getResult()[0]['client_cover'];
                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $uploadCapa = new Upload('../../uploads/');
                $uploadCapa->Image($this->Data['client_cover'], $this->Data['client_name']);
            endif;


            if (isset($uploadCapa) && $uploadCapa->getResult()):
                $this->Data['client_cover'] = $uploadCapa->getResult();
                $this->Update();
            else:
                unset($this->Data['client_cover']);
                $this->Update();
            endif;
        endif;
    }

    /**
     * <b>Deleta Post:</b> Informe o ID do cliente a ser removido para que esse método realize uma checagem de
     * pastas e galerias excluinto todos os dados nessesários!
     * @param INT $PostId = Id do cliente
     */
    public function ExeDelete($PostId) {
        $this->Post = (int) $PostId;

        $ReadPost = new Read;
        $ReadPost->ExeRead(self::Entity, "WHERE client_id = :cliente", "cliente={$this->Post}");

        if (!$ReadPost->getResult()):
            $this->Error = ["O cliente que você tentou deletar não existe no site!", "red", "lnr lnr-warning", 4000];
            $this->Result = false;
        else:
            $PostDelete = $ReadPost->getResult()[0];
            if (file_exists('../../uploads/' . $PostDelete['client_cover']) && !is_dir('../../uploads/' . $PostDelete['client_cover'])):
                unlink('../../uploads/' . $PostDelete['client_cover']);
            endif;



            $deleta = new Delete;
            $deleta->ExeDelete(self::Entity, "WHERE client_id = :clienteid", "clienteid={$this->Post}");

            $this->Error = ["O cliente <b>{$PostDelete['client_title']}</b> foi removido com sucesso do site!", "green", "lnr lnr-smile", 4000];
            $this->Result = true;

        endif;
    }

    /**
     * <b>Verificar Cadastro:</b> Retorna ID do registro se o cadastro for efetuado ou FALSE se não.
     * Para verificar erros execute um getError();
     * @return BOOL $Var = InsertID or False
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * <b>Obter Erro:</b> Retorna um array associativo com uma mensagem e o tipo de erro.
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
        $Cover = $this->Data['client_cover'];
        unset($this->Data['client_cover']);

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['client_name'] = Check::Name($this->Data['client_title']);
        $this->Data['client_cover'] = $Cover;
    }

    //Verifica o NAME cliente. Se existir adiciona um pós-fix -Count
    private function setName() {
        $Where = (isset($this->Post) ? "client_id != {$this->Post} AND" : '');
        $readName = new Read;
        $readName->ExeRead(self::Entity, "WHERE {$Where} client_title = :t", "t={$this->Data['client_title']}");
        if ($readName->getResult()):
            $this->Data['client_name'] = $this->Data['client_name'] . '-' . $readName->getRowCount();
        endif;
    }

    //Cadastra o cliente no banco!
    private function Create() {
        $cadastra = new Create;
        $cadastra->ExeCreate(self::Entity, $this->Data);
        if ($cadastra->getResult()):
            $this->Error = ["O cliente {$this->Data['client_title']} foi cadastrado com sucesso no site!", "green", "lnr lnr-smile", 4000];
            $this->Result = $cadastra->getResult();
        endif;
    }

    //Atualiza o cliente no banco!
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE client_id = :id", "id={$this->Post}");
        if ($Update->getResult()):
            $this->Error = ["O cliente <b>{$this->Data['client_title']}</b> foi atualizado com sucesso no site!", "green", "lnr lnr-smile", 4000];
            $this->Result = true;
        endif;
    }

}
