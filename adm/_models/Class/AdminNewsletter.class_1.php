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
    private $Table;
    private $Users;
    private $Error;
    private $Result;

//Nome da tabela no banco de dados
//    const Entity = 'tb_posts';

    public function ExeNews($Table = null, $PostId, $Users = null) {
        $this->Table = (is_null($Table) ? null : $Table);
        $this->Users = (is_null($Users) ? null : $Users);
        $this->Post = (int) $PostId;


        $ReadPost = new Read;
        $ReadPost->ExeRead($this->Table, "WHERE post_id = :post", "post={$this->Post}");
//        var_dump($ReadPost->getResult());
        if (!$this->Post):
            $this->Error = ["Existem campos em branco. Selecione um post!", 'blue', 'lnr lnr-warning', 5000];
            $this->Result = false;
        elseif (!$ReadPost->getResult()):
            $this->Error = ["O post que você tentou enviar não está disponível para o newsletter!", "red", "lnr lnr-warning", 4000];
            $this->Result = false;
        elseif (!is_null($this->Users)):
            $Arr = explode(',', $this->Users);
            extract($ReadPost->getResult()[0]);

            $Arr = array_map('strip_tags', $Arr);
            $Arr = array_map('trim', $Arr);

            $up = new Update();
            $up->ExeUpdate($this->Table, array('post_newsletter' => '1'), "WHERE post_id = :id", "id={$this->Post}");
            $Read = new Read;
            $Create = new Create;
            $Bool = false;
            foreach ($Arr as $k => $item) {
                set_time_limit(0);
                $Read->ExeRead("tb_newsletter", "WHERE new_id = :id ORDER BY new_email ASC", "id={$item}");

                $Contato['Assunto'] = "{$post_title}";
                $Contato['Mensagem'] = "<img src='" . HOME . "/uploads/{$post_cover}'/ width='50%'><br><br>" . $post_content;

                if ($post_video != null) {
                    $Contato['Mensagem'] = '<iframe width = "560" height = "415" src = "https://www.youtube.com/embed/' . $post_video . '" frameborder = "0" allow = "accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                }

                $Contato['RemetenteNome'] = "Alberto Preto Advocacia";
                $Contato['RemetenteEmail'] = "contato@albertopreto.adv.br";
                $Contato['DestinoNome'] = $Read->getResult()[0]['new_name'];
                $Contato['DestinoEmail'] = $Read->getResult()[0]['new_email'];

                $SendMail = new Email;
                $SendMail->Enviar($Contato);
                $Create->ExeCreate("tb_send", array("env_id_user" => $item, "env_id_post" => $this->Post, "env_date" => date("Y-m-d H:i:s")));
                $Bool = true;
            }

            if ($Bool):
                $this->Error = ["Os e-mails foram enviados com sucesso!", "green", "lnr lnr-smile", 4000];
                $this->Result = true;
                return;
            endif;
        else:
            extract($ReadPost->getResult()[0]);

            $up = new Update();
            $up->ExeUpdate($this->Table, array('post_newsletter' => '1'), "WHERE post_id = :id", "id={$this->Post}");
            $readP = new Read;
            $readP->ExeRead("tb_newsletter", "ORDER BY new_email ASC");
            foreach ($readP->getResult() as $v):
                set_time_limit(0);

                $Contato['Assunto'] = "{$post_title}";
                $Contato['Mensagem'] = "<img src='" . HOME . "/uploads/{$post_cover}'/ width='50%'><br><br>" . $post_content;

                if ($post_video != null) {
                    $Contato['Mensagem'] = "<a href='https://www.youtube.com/embed/{$post_video}'><img src='" . HOME . "/uploads/{$post_cover}'/ width='50%'></a><br><br>" . $post_content;
                }

                $Contato['RemetenteNome'] = "Alberto Preto Advocacia";
                $Contato['RemetenteEmail'] = "contato@albertopreto.adv.br";
                $Contato['DestinoNome'] = $v['new_name'];
                $Contato['DestinoEmail'] = $v['new_email'];

                $SendMail = new Email;
                $SendMail->Enviar($Contato);
            endforeach;
//            var_dump($SendMail);
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
        $readName->ExeRead($this->Table, "WHERE {$Where} post_title = :t", "t={$this->Data['post_title']}");
        if ($readName->getResult()):
            $this->Data['post_name'] = $this->Data['post_name'] . '-' . $readName->getRowCount();
        endif;
    }

//Cadastra o post no banco!
    private function Create() {
        $cadastra = new Create;
        $cadastra->ExeCreate($this->Table, $this->Data);
        if ($cadastra->getResult()):
            $this->Error = ["O post {$this->Data['post_title']} foi cadastrado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = $cadastra->getResult();
        endif;
    }

//Atualiza o post no banco!
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate($this->Table, $this->Data, "WHERE post_id = :id", "id={$this->Post}");
        if ($Update->getResult()):
            $this->Error = ["O post <b>{$this->Data['post_title']}</b> foi atualizado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}
