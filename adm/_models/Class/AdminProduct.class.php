<?php

/**
 * AdminPost.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os posts no Admin do sistema!
 * 
 * @copyright (c) Jefferson Androcles
 */
class AdminProduct {

    private $Data;
    private $Post;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'tb_product';

    /**
     * <b>Cadastrar o Post:</b> Envelope os dados do post em um array atribuitivo e execute esse método
     * para cadastrar o post. Envia a capa automaticamente!
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Para cadastrar um produto, favor preencha todos os campos!", "blue", "lnr lnr-warning", 4000];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();

            if ($this->Data['prod_img']):
                $uplaod = new Upload('../../uploads/');
                $uplaod->Image($this->Data['prod_img'], $this->Data['prod_name'], null, 'produtos');
            endif;

            if (isset($uplaod) && $uplaod->getResult()):
                $this->Data['prod_img'] = $uplaod->getResult();
                $this->Create();
            else:
                $this->Data['prod_img'] = null;
                $this->Create();
            endif;
        endif;
    }

    /**
     * <b>Atualizar Post:</b> Envelope os dados em uma array atribuitivo e informe o id de um 
     * post para atualiza-lo na tabela!
     * @param INT $PostId = Id do post
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($PostId, array $Data) {
        $this->Post = (int) $PostId;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Para atualizar este produto, preencha todos os campos ( Capa não precisa ser enviada! )", "blue", "lnr lnr-warning", 4000];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();

            if (is_array($this->Data['prod_img'])):
                $readCapa = new Read;
                $readCapa->ExeRead(self::Entity, "WHERE prod_id = :post", "post={$this->Post}");
                $capa = '../../uploads/' . $readCapa->getResult()[0]['prod_img'];
                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $uploadCapa = new Upload('../../uploads/');
                $uploadCapa->Image($this->Data['prod_img'], $this->Data['prod_name'], null, 'produtos');
            endif;

            if (isset($uploadCapa) && $uploadCapa->getResult()):
                $this->Data['prod_img'] = $uploadCapa->getResult();
                $this->Update();
            else:
                unset($this->Data['prod_img']);
                $this->Update();
            endif;
        endif;
    }

    /**
     * <b>Deleta Post:</b> Informe o ID do post a ser removido para que esse método realize uma checagem de
     * pastas e galerias excluinto todos os dados nessesários!
     * @param INT $PostId = Id do post
     */
    public function ExeDelete($PostId) {
        $this->Post = (int) $PostId;

        $ReadPost = new Read;
        $ReadPost->ExeRead(self::Entity, "WHERE prod_id = :post", "post={$this->Post}");

        if (!$ReadPost->getResult()):
            $this->Error = ["O produto que você tentou deletar não existe no sistema!", "red", "lnr lnr-warning", 4000];
            $this->Result = false;
        else:
            $PostDelete = $ReadPost->getResult()[0];
            if (file_exists('../../uploads/' . $PostDelete['prod_img']) && !is_dir('../../uploads/' . $PostDelete['prod_img'])):
                unlink('../../uploads/' . $PostDelete['prod_img']);
            endif;


            $deleta = new Delete;
            $deleta->ExeDelete(self::Entity, "WHERE prod_id = :postid", "postid={$this->Post}");

            $this->Error = ["O produto <b>{$PostDelete['prod_title']}</b> foi removido com sucesso do sistema!", "green", "lnr lnr-smile", 4000];
            $this->Result = true;

        endif;
    }

    /**
     * <b>Ativa/Inativa Post:</b> Informe o ID do post e o status e um status sendo 1 para ativo e 0 para
     * rascunho. Esse méto ativa e inativa os posts!
     * @param INT $PostId = Id do post
     * @param STRING $PostStatus = 1 para ativo, 0 para inativo
     */
    public function ExeStatus($PostId, $PostStatus) {
        $this->Post = (int) $PostId;
        $this->Data['prod_status'] = (string) $PostStatus;
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE prod_id = :id", "id={$this->Post}");
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
        $Cover = $this->Data['prod_img'];
        $Content = $this->Data['prod_content'];
        $Description = $this->Data['prod_description'];
        unset($this->Data['prod_img'], $this->Data['prod_content'], $this->Data['prod_description']);

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['prod_name'] = Check::Name($this->Data['prod_title']);
        $this->Data['prod_img'] = $Cover;
        $this->Data['prod_content'] = $Content;
        $this->Data['prod_description'] = $Description;
    }

    //Verifica o NAME post. Se existir adiciona um pós-fix -Count
    private function setName() {
        $Where = (isset($this->Post) ? "prod_id != {$this->Post} AND" : '');
        $readName = new Read;
        $readName->ExeRead(self::Entity, "WHERE {$Where} prod_title = :t", "t={$this->Data['prod_title']}");
        if ($readName->getResult()):
            $this->Data['prod_name'] = $this->Data['prod_name'] . '-' . $readName->getRowCount();
        endif;
    }

    //Cadastra o post no banco!
    private function Create() {
        $cadastra = new Create;
        $cadastra->ExeCreate(self::Entity, $this->Data);
        if ($cadastra->getResult()):
            $this->Error = ["O produto <b>{$this->Data['prod_title']}</b> foi cadastrado com sucesso no sistema!", "green", "lnr lnr-smile", 4000];
            $this->Result = $cadastra->getResult();
        endif;
    }

    //Atualiza o post no banco!
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE prod_id = :id", "id={$this->Post}");
        if ($Update->getResult()):
            $this->Error = ["O produto <b>{$this->Data['prod_title']}</b> foi atualizado com sucesso no sistema!", "green", "lnr lnr-smile", 4000];
            $this->Result = true;
        endif;
    }

}
