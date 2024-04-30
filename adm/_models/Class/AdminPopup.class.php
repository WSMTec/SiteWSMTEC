<?php

/**
 * AdminPost.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os posts no Admin do sistema!
 * 
 * @copyright (c) Jefferson Androcles
 */
class AdminPopup {

    private $Data;
    private $Post;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'tb_ebook';

    /**
     * <b>Cadastrar o Post:</b> Envelope os dados do post em um array atribuitivo e execute esse método
     * para cadastrar o post. Envia a capa automaticamente!
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        if (in_array('', $this->Data)):
            $this->Error = ["Erro ao cadastrar: Para criar um popup, favor preencha todos os campos!", "blue", "lnr lnr-warning", 4000];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();

            if ($this->Data['ebook_popup']):
                $uplaod = new Upload('../../uploads/');
                $uplaod->Image($this->Data['ebook_popup'], $this->Data['ebook_name'], null, 'popup');
            endif;

            if ($this->Data['ebook_cover']):
                $uplaodC = new Upload('../../uploads/');
                $uplaodC->Image($this->Data['ebook_cover'], $this->Data['ebook_name'], null, 'ebook');
            endif;


            if (isset($uplaod) && $uplaod->getResult() || isset($uplaodC) && $uplaodC->getResult() || isset($uplaodP) && $uplaodP->getResult()):
                $this->Data['ebook_popup'] = $uplaod->getResult();
                $this->Data['ebook_cover'] = $uplaodC->getResult();
                
                $this->Create();
            else:
                $this->Data['ebook_popup'] = null;
                $this->Data['ebook_cover'] = null;
                $this->Data['ebook_pdf'] = null;
                $this->Create();
            endif;
        endif;
    }

    public function ExeCreateS(array $Data) {
        $this->Data = $Data;

        if (empty($this->Data['ebook_popup']) || empty($this->Data['ebook_service']) || empty($this->Data['ebook_status'])):
            $this->Error = ["Erro ao cadastrar: Para criar um popup, favor preencha todos os campos!", "blue", "lnr lnr-warning", 4000];
            $this->Result = false;
        else:
            $readName = new Read;
            $readName->ExeRead(self::Entity, "WHERE ebook_service = :t", "t={$this->Data['ebook_service']}");
            if ($readName->getResult()):
                $this->Data['ebook_name'] = $this->Data['ebook_name'] . '-' . $readName->getRowCount();
            endif;


            if ($this->Data['ebook_popup']):
                $uplaod = new Upload('../../uploads/');
                $uplaod->Image($this->Data['ebook_popup'], $this->Data['ebook_service'], null, 'popup');
            endif;

            $this->Data['ebook_date'] = date("Y-m-d H:i");

            if (isset($uplaod) && $uplaod->getResult()):
                $this->Data['ebook_popup'] = $uplaod->getResult();
                $this->Data['ebook_cover'] = null;
                $this->Data['ebook_pdf'] = null;
                $this->Create();
            else:
                $this->Data['ebook_popup'] = null;
                $this->Data['ebook_cover'] = null;
                $this->Data['ebook_pdf'] = null;
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
            $this->Error = ["Para atualizar este popup, preencha todos os campos ( Foto, pdf, Pop-up Capa não precisa ser enviada! )", "blue", "lnr lnr-warning", 4000];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();

            $read = new Read;
            $read->ExeRead(self::Entity, "WHERE ebook_id = :post", "post={$this->Post}");

            if (is_array($this->Data['ebook_popup'])):
                $capa = '../../uploads/' . $read->getResult()[0]['ebook_popup'];
                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $uploadCapa = new Upload('../../uploads/');
                $uploadCapa->Image($this->Data['ebook_popup'], $this->Data['ebook_name'], null, 'popup');
            endif;

            if (is_array($this->Data['ebook_cover'])):
                $capaC = '../../uploads/' . $read->getResult()[0]['ebook_cover'];
                if (file_exists($capaC) && !is_dir($capaC)):
                    unlink($capaC);
                endif;

                $uplaodC = new Upload('../../uploads/');
                $uplaodC->Image($this->Data['ebook_cover'], $this->Data['ebook_name'], null, 'ebook');
            endif;

            if (is_array($this->Data['ebook_pdf'])):
                $capaP = '../../uploads/' . $read->getResult()[0]['ebook_pdf'];
                if (file_exists($capaP) && !is_dir($capaP)):
                    unlink($capaP);
                endif;

                $uplaodP = new Upload('../../uploads/');
                $uplaodP->File($this->Data['ebook_pdf'], $this->Data['ebook_name'], 'pdf');
            endif;

//            if ($this->Data['ebook_status'] == '1' && is_null($read->getResult()[0]['ebook_newsletter'])):
//                $News = new AdminNewsletter;
//                $News->ExeNews(self::Entity, $this->Post);
//            endif;

            if (isset($uploadCapa) && $uploadCapa->getResult()):
                $this->Data['ebook_popup'] = $uploadCapa->getResult();
            else:
                unset($this->Data['ebook_popup']);
            endif;

            if (isset($uplaodC) && $uplaodC->getResult()):
                $this->Data['ebook_cover'] = $uplaodC->getResult();
            else:
                unset($this->Data['ebook_cover']);
            endif;

            if (isset($uplaodP) && $uplaodP->getResult()):
                $this->Data['ebook_pdf'] = $uplaodP->getResult();
            else:
                unset($this->Data['ebook_pdf']);
            endif;

            $this->Update();
        endif;
    }

    public function ExeUpdateS($PostId, array $Data) {
        $this->Post = (int) $PostId;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Para atualizar este popup, preencha todos os campos ( Foto, pdf, Pop-up Capa não precisa ser enviada! )", "blue", "lnr lnr-warning", 4000];
            $this->Result = false;
        else:

            $read = new Read;
            $read->ExeRead(self::Entity, "WHERE ebook_id = :post", "post={$this->Post}");

            if (is_array($this->Data['ebook_popup'])):
                $capa = '../../uploads/' . $read->getResult()[0]['ebook_popup'];
                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $uploadCapa = new Upload('../../uploads/');
                $uploadCapa->Image($this->Data['ebook_popup'], $this->Data['ebook_name'], null, 'popup');
            endif;


            if (isset($uploadCapa) && $uploadCapa->getResult()):
                $this->Data['ebook_popup'] = $uploadCapa->getResult();
            else:
                unset($this->Data['ebook_popup']);
            endif;

            unset($this->Data['ebook_cover']);
            unset($this->Data['ebook_pdf']);
            
            $this->Data['ebook_title'] = null;

            $this->Update();
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
        $ReadPost->ExeRead(self::Entity, "WHERE ebook_id = :post", "post={$this->Post}");

        if (!$ReadPost->getResult()):
            $this->Error = ["O popup que você tentou deletar não existe no sistema!", "red", "lnr lnr-warning", 4000];
            $this->Result = false;
        else:
            $PostDelete = $ReadPost->getResult()[0];
            if (file_exists('../../uploads/' . $PostDelete['ebook_cover']) && !is_dir('../../uploads/' . $PostDelete['ebook_cover'])):
                unlink('../../uploads/' . $PostDelete['ebook_cover']);
            endif;
            if (file_exists('../../uploads/' . $PostDelete['ebook_popup']) && !is_dir('../../uploads/' . $PostDelete['ebook_popup'])):
                unlink('../../uploads/' . $PostDelete['ebook_popup']);
            endif;
            if (file_exists('../../uploads/' . $PostDelete['ebook_pdf']) && !is_dir('../../uploads/' . $PostDelete['ebook_pdf'])):
                unlink('../../uploads/' . $PostDelete['ebook_pdf']);
            endif;

            $deleta = new Delete;
            $deleta->ExeDelete(self::Entity, "WHERE ebook_id = :postid", "postid={$this->Post}");

            $this->Error = ["O popup <b>{$PostDelete['ebook_title']}</b> foi removido com sucesso do sistema!", "green", "lnr lnr-smile", 4000];
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
        $this->Data['ebook_status'] = (string) $PostStatus;
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE ebook_id = :id", "id={$this->Post}");
    }

    public function ExeStatusAll($PostId) {
        $this->Post = (int) $PostId;
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, array("ebook_status" => "0"), "WHERE ebook_id != :id", "id={$this->Post}");
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
        $Popup = $this->Data['ebook_popup'];
        $Cover = $this->Data['ebook_cover'];
        $Pdf = $this->Data['ebook_pdf'];
        $Content = $this->Data['ebook_content'];
        unset($this->Data['ebook_popup'], $this->Data['ebook_cover'], $this->Data['ebook_pdf'], $this->Data['ebook_content']);

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['ebook_name'] = Check::Name($this->Data['ebook_title']);
        $this->Data['ebook_date'] = Check::Data($this->Data['ebook_date']);
        $this->Data['ebook_type'] = 'ebook';
        $this->Data['ebook_popup'] = $Popup;
        $this->Data['ebook_cover'] = $Cover;
        $this->Data['ebook_pdf'] = $Pdf;
        $this->Data['ebook_content'] = $Content;
    }

    //Obtem o ID da categoria PAI
//    private function getCatParent() {
//        $rCat = new Read;
//        $rCat->ExeRead("tb_categories", "WHERE category_id = :id", "id={$this->Data['ebook_category']}");
//        if ($rCat->getResult()):
//            return $rCat->getResult()[0]['category_parent'];
//        else:
//            return null;
//        endif;
//    }
//    
    //Verifica o NAME post. Se existir adiciona um pós-fix -Count
    private function setName() {
        $Where = (isset($this->Post) ? "ebook_id != {$this->Post} AND" : '');
        $readName = new Read;
        $readName->ExeRead(self::Entity, "WHERE {$Where} ebook_title = :t", "t={$this->Data['ebook_title']}");
        if ($readName->getResult()):
            $this->Data['ebook_name'] = $this->Data['ebook_name'] . '-' . $readName->getRowCount();
        endif;
    }

    //Cadastra o post no banco!
    private function Create() {
        $cadastra = new Create;
        $cadastra->ExeCreate(self::Entity, $this->Data);

        if ($cadastra->getResult()):
            if ($this->Data['ebook_status'] == '1'):
                $this->ExeStatusAll($cadastra->getResult());
            endif;
//            if ($this->Data['ebook_newsletter'] == '1'):
//                $News = new AdminNewsletter;
//                $News->ExeNews(self::Entity, $cadastra->getResult());
//            endif;
            
            $this->Error = ["O popup {$this->Data['ebook_title']} foi cadastrado com sucesso no sistema!", "green", "lnr lnr-smile", 4000];
            $this->Result = $cadastra->getResult();
        endif;
    }

    //Atualiza o post no banco!
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE ebook_id = :id", "id={$this->Post}");
        if ($Update->getResult()):
            if ($this->Data['ebook_status'] == '1'):
                $this->ExeStatusAll($this->Post);
            endif;
            $this->Error = ["O popup <b>{$this->Data['ebook_title']}</b> foi atualizado com sucesso no sistema!", "green", "lnr lnr-smile", 4000];
            $this->Result = true;
        endif;
    }

}
