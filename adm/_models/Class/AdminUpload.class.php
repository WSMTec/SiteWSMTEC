<?php

/**
 * AdminPost.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os posts no Admin do sistema!
 * 
 * @copyright (c) Jefferson Androcles
 */
class AdminUpload {

    private $Data;
    private $Post;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'tb_uploads';

    /**
     * <b>Cadastrar o Post:</b> Envelope os dados do post em um array atribuitivo e execute esse método
     * para cadastrar o post. Envia a capa automaticamente!
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        $this->setData();
        $this->checkData();

        if ($this->Result):
            if (is_array($this->Data['Upload'])):
                $upload = new Upload;
                $upload->File($this->Data['Upload'], $this->Data['NomeUp'], 'files', 100);
            endif;

            if (isset($upload) && $upload->getResult()):
                $this->Data['Upload'] = $upload->getResult();
                $this->Create();
            else:
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
    public function ExeUpdate(array $Data) {
        $this->Data = $Data;
        $read = new Read;
        $delete = new Delete;
        if (in_array('', $this->Data) || !isset($this->Data['IdEmpresaUp'])):
            $this->Error = ["Existem campos em branco. Favor preencha todos os campos!", 'blue', 'lnr lnr-warning', 5000];
            $this->Result = false;
        else:
            if (is_array($this->Data['Upload'])):

                $read->ExeRead(self::Entity, "WHERE name_up = :u", "u={$this->Data['name_up']}");
                $exe = '../uploads/' . $read->getResult()[0]['Upload'];
                if (file_exists($exe) && is_file($exe)):
                    unlink($exe);
                endif;

                $upload = new Upload;
                $upload->File($this->Data['Upload'], $this->Data['name_up'], 'files', 100);

                if ($upload->getResult()):
                    $this->Data['Upload'] = $upload->getResult();
                    $delete->ExeDelete(self::Entity, "WHERE name_up = :u", "u={$this->Data['name_up']}");
                    $this->ExeCreate($this->Data);
                else:
                    $this->Error = ["Erro ao atualizar, verifique seu upload!", 'blue', 'lnr lnr-warning', 5000];
                    $this->Result = false;
                endif;
            else:
                $read->ExeRead(self::Entity, "WHERE name_up = :u ", "u={$this->Data['name_up']}");
                $this->Data['Upload'] = $read->getResult()[0]['Upload'];
                $delete->ExeDelete(self::Entity, "WHERE name_up = :u", "u={$this->Data['name_up']}");
                $this->ExeCreate($this->Data);
            endif;
        endif;
    }

    /**
     * <b>Deleta Post:</b> Informe o ID do post a ser removido para que esse método realize uma checagem de
     * pastas e galerias excluinto todos os dados nessesários!
     * @param INT $PostId = Id do post
     */
    public function ExeDelete($Name) {
        $this->Post = (string) $Name;

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE name_up = :u", "u={$this->Post}");

        if (!$read->getResult()):
            $this->Error = ["O upload que você tentou deletar não existe no sistema!", 'red', 'lnr lnr-warning', 5000];
            $this->Result = false;
        else:
            $Nome = $read->getResult()[0]['NomeUp'];
            $exe = '../uploads/' . $read->getResult()[0]['Upload'];
            if (file_exists($exe) && is_file($exe)):
                unlink($exe);
            endif;

            $deleta = new Delete;
            $deleta->ExeDelete(self::Entity, "WHERE name_up = :u", "u={$this->Post}");

            $this->Error = ["O upload <b>{$Nome}</b> foi removido com sucesso do sistema!", 'green', 'lnr lnr-smile', 5000];
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
        $this->Data['post_status'] = (string) $PostStatus;
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE post_id = :id", "id={$this->Post}");
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
        $IdEmpresaUp = (isset($this->Data['IdEmpresaUp']) ? $this->Data['IdEmpresaUp'] : null);
        $Upload = $this->Data['Upload'];
        unset($this->Data['Upload'], $this->Data['IdEmpresaUp']);

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
        if (!isset($this->Data['name_up'])):
            $this->Data['name_up'] = Check::Name($this->Data['NomeUp']);
        endif;
        $this->Data['Upload'] = $Upload;
        $this->Data['IdEmpresaUp'] = $IdEmpresaUp;
    }

    private function checkData() {
        if (in_array('', $this->Data)):
            $this->Error = ["Existem campos em branco. Favor preencha todos os campos!", 'blue', 'lnr lnr-warning', 5000];
            $this->Result = false;
        else:
            $this->setName();
        endif;
    }


    
    private function setName() {
        $readName = new Read;
        $readName->ExeRead(self::Entity, "WHERE name_up = :t", "t={$this->Data['name_up']}");
        if ($readName->getResult()):
            $this->Error = ["Oppsss, o upload <b>{$this->Data['NomeUp']}</b> já está cadastrado no sistema!", 'red', 'lnr lnr-warning', 4000];
            $this->Result = false;
        else:
            $this->Result = true;
        endif;
    }

    private function UploadName() {
        $Files = array();
        $Count = count($this->Data['IdEmpresaUp']);
        $FileKeys = array_keys($this->Data);

        for ($up = 0; $up < $Count; $up++):
            foreach ($FileKeys as $Keys):
                $Files[$up][$Keys] = $this->Data[$Keys][$up];
                $Files[$up]["NomeUp"] = $this->Data["NomeUp"];
                $Files[$up]["name_up"] = $this->Data["name_up"];
                $Files[$up]["DescUp"] = $this->Data["DescUp"];
                $Files[$up]["Upload"] = $this->Data["Upload"];
            endforeach;
        endfor;
        $this->Data = $Files;
    }

    //Cadastra o post no banco!
    private function Create() {
        $this->UploadName();
        $Create = new Create;
        $u = null;
        foreach ($this->Data as $Uploads):
            $Create->ExeCreate("tb_uploads", $Uploads);
            if ($Create->getResult()):
                $u = true;
            endif;
        endforeach;
        if ($u):
            $this->Error = ["O upload {$this->Data[0]['NomeUp']}, foi cadastrado no sistema!", 'green', 'lnr lnr-smile', 4000];
            $this->Result = true;
        endif;
    }

}
