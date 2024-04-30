<?php

/**
 * AdminNewsletter.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os posts no Admin do sistema!
 * 
 * @copyright (c) Jefferson Androcles
 */
class AdminNewsletter {

    private $Data;
    private $Post;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'ws_posts';

    public function ExeNews($PostId) {
        $this->Post = (int) $PostId;

        $ReadPost = new Read;
        $ReadPost->ExeRead(self::Entity, "WHERE post_id = :post AND post_newsletter IS NULL", "post={$this->Post}");

        if (!$this->Post):
            $this->Error = ["Existem campos em branco. Selecione um artigo!", 'blue', 'lnr lnr-warning', 5000];
            $this->Result = false;
        elseif (!$ReadPost->getResult()):
            $this->Error = ["O post que você tentou enviar não está disponível para o newsletter!", "red", "lnr lnr-warning", 4000];
            $this->Result = false;
        else:
            extract($ReadPost->getResult()[0]);

            $up = new Update();
            $up->ExeUpdate("ws_posts", array('post_newsletter' => '1'), "WHERE post_id = :id", "id={$this->Post}");
            $readP = new Read;
            $readP->ExeRead("tb_newsletter", "ORDER BY new_email ASC");
            foreach ($readP->getResult() as $v):
                set_time_limit(0);

                $Contato['Assunto'] = "{$post_title}";
                $Contato['Mensagem'] = "<img src='https://wsmtec.com.br/uploads/{$post_cover}'/ width='100%'><br><br>" . $post_content;
                $Contato['RemetenteNome'] = "WSM Tecnologia em informática";
                $Contato['RemetenteEmail'] = "wsm@wsmtec.com.br";
                $Contato['DestinoNome'] = $v['new_nome'];
                $Contato['DestinoEmail'] = $v['new_email'];

                $SendMail = new Email;
                $SendMail->Enviar($Contato);
            endforeach;
            if ($SendMail->getError()):
                $this->Error = ["Os e-mails foram enviados com sucesso!", "green", "lnr lnr-smile", 4000];
                $this->Result = true;
            endif;
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
        $Cover = $this->Data['post_cover'];
        $Content = $this->Data['post_content'];
        unset($this->Data['post_cover'], $this->Data['post_content']);

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['post_name'] = Check::Name($this->Data['post_title']);
        $this->Data['post_date'] = Check::Data($this->Data['post_date']);
        $this->Data['post_type'] = 'post';
        $this->Data['post_cover'] = $Cover;
        $this->Data['post_content'] = $Content;
        $this->Data['post_cat_parent'] = $this->getCatParent();
    }

    //Verifica o NAME post. Se existir adiciona um pós-fix -Count
    private function setName() {
        $Where = (isset($this->Post) ? "post_id != {$this->Post} AND" : '');
        $readName = new Read;
        $readName->ExeRead(self::Entity, "WHERE {$Where} post_title = :t", "t={$this->Data['post_title']}");
        if ($readName->getResult()):
            $this->Data['post_name'] = $this->Data['post_name'] . '-' . $readName->getRowCount();
        endif;
    }

    //Cadastra o post no banco!
    private function Create() {
        $cadastra = new Create;
        $cadastra->ExeCreate(self::Entity, $this->Data);
        if ($cadastra->getResult()):
            $this->Error = ["O post {$this->Data['post_title']} foi cadastrado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = $cadastra->getResult();
        endif;
    }

    //Atualiza o post no banco!
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE post_id = :id", "id={$this->Post}");
        if ($Update->getResult()):
            $this->Error = ["O post <b>{$this->Data['post_title']}</b> foi atualizado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}
