<?php

/**
 * AdminCategory.class [ MODEL ADMIN ]
 * Responável por gerenciar as urls do sistema no admin!
 * 
 * @copyright (c) Jefferson Androcles
 */
class AdminSitemap {

    private $Data;
    private $CatId;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados!
    const Entity = 'tb_sitemap';

    /**
     * <b>Cadastrar url:</b> Envelope titulo, descrição, data e sessão em um array atribuitivo e execute esse método
     * para cadastrar a url. Case seja uma sessão, envie o page_parent como STRING null.
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Result = false;
            $this->Error = ['<b>Erro ao cadastrar:</b> Para cadastrar uma url, preencha todos os campos!', 'blue', 'lnr lnr-warning', 4000];
        else:
            $this->setData();
            $this->setName();
            $this->Create();
        endif;
    }

    /**
     * <b>Atualizar url:</b> Envelope os dados em uma array atribuitivo e informe o id de uma
     * url para atualiza-la!
     * @param INT $CategoryId = Id da url
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($CategoryId, array $Data) {
        $this->CatId = (int) $CategoryId;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Result = false;
            $this->Error = ["<b>Erro ao atualizar:</b> Para atualizar a url {$this->Data['page_name']}, preencha todos os campos!", 'blue', 'lnr lnr-warning', 4000];
        else:
            $this->setData();
            $this->setName();
            $this->Update();
        endif;
    }

    /**
     * <b>Deleta url:</b> Informe o ID de uma url para remove-la do sistema. Esse método verifica
     * o tipo de url e se é permitido excluir de acordo com os registros do sistema!
     * @param INT $CategoryId = Id da url
     */
    public function ExeDelete($CategoryId) {
        $this->CatId = (int) $CategoryId;

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE page_id = :delid", "delid={$this->CatId}");

        if (!$read->getResult()):
            $this->Result = false;
            $this->Error = ['Oppsss, você tentou remover uma url que não existe no sistema!', 'blue', 'lnr lnr-warning', 4000];
        else:
            $delete = new Delete;
            $delete->ExeDelete(self::Entity, "WHERE page_id = :deletaid", "deletaid={$this->CatId}");

            $this->Result = true;
            $this->Error = ["A url foi removida com sucesso do sistema!", 'green', 'lnr lnr-smile', 4000];
        endif;
    }

    /**
     * <b>Verificar Cadastro:</b> Retorna TRUE se o cadastro ou update for efetuado ou FALSE se não. Para verificar
     * erros execute um getError();
     * @return BOOL $Var = True or False
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * <b>Obter Erro:</b> Retorna um array associativo com a mensagem e o tipo de erro!
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
        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
        $this->Data['page_update'] = date('Y-m-d H:i:s');
    }

    //Verifica o NAME da url. Se existir adiciona um pós-fix +1
    private function setName() {
        $Where = (!empty($this->CatId) ? "page_id != {$this->CatId} AND" : '' );

        $readName = new Read;
        $readName->ExeRead(self::Entity, "WHERE {$Where} page_name = :t", "t={$this->Data['page_name']}");
        if ($readName->getResult()):
            $this->Result = false;
            $this->Error = ["A <b>url</b> já existe em nossa base de dados!", 'blue', 'lnr lnr-warning', 4000];
        endif;
    }

    //Cadastra a url no banco!
    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::Entity, $this->Data);
        if ($Create->getResult()):
            $this->Result = $Create->getResult();
            $this->Error = ["<b>Sucesso:</b> A url {$this->Data['page_name']} foi cadastrada no sistema!", 'green', 'lnr lnr-smile', 4000];
        endif;
    }

    //Atualiza url
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE page_id = :catid", "catid={$this->CatId}");
        if ($Update->getResult()):
            $this->Result = true;
            $this->Error = ["<b>Sucesso:</b> A {$tipo} {$this->Data['page_name']} foi atualizada no sistema!", 'green', 'lnr lnr-smile', 4000];
        endif;
    }

}
