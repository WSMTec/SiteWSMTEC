<?php/** * Seo [ MODEL ] * Classe de apoio para o modelo LINK. Pode ser utilizada para gerar SSEO para as páginas do sistema! *  * @copyright (c) Jefferson Androcles */class Seo {    private $File;    private $Link;    private $Data;    private $Tags;    /* DADOS POVOADOS */    private $seoTags;    private $seoData;    function __construct($File, $Link) {        $this->File = strip_tags(trim($File));        $this->Link = strip_tags(trim($Link));    }    /**     * <b>Obter MetaTags:</b> Execute este método informando os valores de navegação para que o mesmo obtenha     * todas as metas como title, description, og, itemgroup, etc.     *      * <b>Deve ser usada com um ECHO dentro da tag HEAD!</b>     * @return HTML TAGS =  Retorna todas as tags HEAD     */    public function getTags() {        $this->checkData();        return $this->seoTags;    }    /**     * <b>Obter Dados:</b> Este será automaticamente povoado com valores de uma tabela single para arquivos     * como categoria, artigo, etc. Basta usar um extract para obter as variáveis da tabela!     *      * @return ARRAY = Dados da tabela     */    public function getData() {        $this->checkData();        return $this->seoData;    }    /*     * ***************************************     * **********  PRIVATE METHODS  **********     * ***************************************     */    //Verifica o resultset povoando os atributos    private function checkData() {        if (!$this->seoData):            $this->getSeo();        endif;    }    //Identifica o arquivo e monta o SEO de acordo    private function getSeo() {        $ReadSeo = new Read;        switch ($this->File):            //SEO:: PRODUTOS            case 'produto':                $ReadSeo->ExeRead("tb_product", "WHERE prod_name = :link", "link={$this->Link}");                if (!$ReadSeo->getResult()):                    $this->seoData = null;                    $this->seoTags = null;                else:                    $extract = extract($ReadSeo->getResult()[0]);                    $this->seoData = $ReadSeo->getResult()[0];                    $this->Data = [$prod_title . ' - ' . SITENAME, strip_tags($prod_content), HOME . "/produto/{$prod_name}", HOME . "/uploads/{$prod_img}"];                endif;                break;            //SEO:: SERVIÇOS            case 'servico':                $ReadSeo->ExeRead("tb_services", "WHERE serv_name = :link", "link={$this->Link}");                if (!$ReadSeo->getResult()):                    $this->seoData = null;                    $this->seoTags = null;                else:                    $extract = extract($ReadSeo->getResult()[0]);                    $this->seoData = $ReadSeo->getResult()[0];                    $this->Data = [$serv_title . ' - ' . SITENAME, strip_tags($serv_content), HOME . "/servico/{$serv_name}", HOME . "/uploads/{$serv_img}"];                endif;                break;            //SEO:: POST            case 'artigo':                $Admin = (isset($_SESSION['userlogin']['user_level']) && $_SESSION['userlogin']['user_level'] == 3 ? true : false);                $Check = ($Admin ? '' : 'post_status = 1 AND');                $ReadSeo->ExeRead("ws_posts", "WHERE {$Check} post_name = :link", "link={$this->Link}");                if (!$ReadSeo->getResult()):                    $this->seoData = null;                    $this->seoTags = null;                else:                    $extract = extract($ReadSeo->getResult()[0]);                    $this->seoData = $ReadSeo->getResult()[0];                    $this->Data = [$post_title . ' - ' . SITENAME, $post_content, HOME . "/artigo/{$post_name}", HOME . "/uploads/{$post_cover}"];                    //post:: conta views do post                    $ArrUpdate = ['post_views' => $post_views + 1];                    $Update = new Update();                    $Update->ExeUpdate("ws_posts", $ArrUpdate, "WHERE post_id = :postid", "postid={$post_id}");                endif;                break;            //SEO:: CATEGORIA            case 'categoria':                $ReadSeo->ExeRead("ws_categories", "WHERE category_name = :link", "link={$this->Link}");                if (!$ReadSeo->getResult()):                    $this->seoData = null;                    $this->seoTags = null;                else:                    extract($ReadSeo->getResult()[0]);                    $this->seoData = $ReadSeo->getResult()[0];                    $this->Data = [$category_title . ' - ' . SITENAME, $category_content, HOME . "/categoria/{$category_name}", INCLUDE_PATH . '/images/site.png'];                    //category:: conta views da categoria                    $ArrUpdate = ['category_views' => $category_views + 1];                    $Update = new Update();                    $Update->ExeUpdate("ws_categories", $ArrUpdate, "WHERE category_id = :catid", "catid={$category_id}");                endif;                break;            //SEO:: PESQUISA            case 'pesquisa':                $ReadSeo->ExeRead("ws_posts", "WHERE post_status = 1 AND (post_title LIKE '%' :link '%' OR post_content LIKE '%' :link '%')", "link={$this->Link}");                if (!$ReadSeo->getResult()):                    $this->seoData = null;                    $this->seoTags = null;                else:                    $this->seoData['count'] = $ReadSeo->getRowCount();                    $this->Data = ["Pesquisa por: {$this->Link}" . ' - ' . SITENAME, "Sua pesquisa por {$this->Link} retornou {$this->seoData['count']} resultados!", HOME . "/pesquisa/{$this->Link}", INCLUDE_PATH . '/images/site.png'];                endif;                break;//            case 'produto':////                $this->Data = ["Blog - " . SITENAME, "Notícias e Artigos sobre o mundo da Tecnologia!", HOME . '/blog', INCLUDE_PATH . '/images/site.png'];////                break;            //SEO:: Contatos            case 'contatos':                $this->Data = ["Contatos - " . SITENAME, "Tem alguma dúvida? Entre em contato conosco, ficaremos felizes em ajudar. A Wsmtec tem interesse na sua opnião!", HOME . '/contatos', INCLUDE_PATH . '/images/site.png'];                break;            //SEO:: Blog            case 'blog':                $this->Data = ["Blog - " . SITENAME, "Notícias e Artigos sobre o mundo da Tecnologia!", HOME . '/blog', INCLUDE_PATH . '/images/site.png'];                break;            //SEO:: Serviços            case 'produtos':                $this->Data = ["Produtos - " . SITENAME, "A WSM atua com um portfólio completo de Soluções em Software e Hardware para atender os mais diversos tipos de clientes e plataformas.", HOME . '/produtos', INCLUDE_PATH . '/images/site.png'];                break;            //SEO:: Serviços            case 'servicos':                $this->Data = ["Serviços - " . SITENAME, "A WSM atua com um portfólio completo de Soluções em Software e Hardware para atender os mais diversos tipos de clientes e plataformas.", HOME . '/servicos', INCLUDE_PATH . '/images/site.png'];                break;            //SEO:: Sobre            case 'sobre':                $this->Data = ["Sobre - " . SITENAME, "Com mais de uma década de história, a WSM Tecnologia é uma empresa especializada no Desenvolvimento e Implantação de Sistemas de Gestão Corporativa, com crescimento expressivo.", HOME . '/sobre', INCLUDE_PATH . '/images/site.png'];                break;            //SEO:: INDEX            case 'index':                $this->Data = [SITENAME . ' - Soluções em Informática!', SITEDESC, HOME, INCLUDE_PATH . '/images/site.png'];                break;            //SEO:: 404            default :                $this->Data = [SITENAME . ' - 404 - nada encontrado!', SITEDESC, HOME . '/404', INCLUDE_PATH . '/images/site.png'];        endswitch;        if ($this->Data):            $this->setTags();        endif;    }    //Monta e limpa as tags para alimentar as tags    private function setTags() {        $this->Tags['Title'] = $this->Data[0];        $this->Tags['Content'] = Check::Words(html_entity_decode($this->Data[1]), 25);        $this->Tags['Link'] = $this->Data[2];        $this->Tags['Image'] = $this->Data[3];        $this->Tags = array_map('strip_tags', $this->Tags);        $this->Tags = array_map('trim', $this->Tags);        $this->Data = null;        //NORMAL PAGE        $this->seoTags = '<title>' . $this->Tags['Title'] . '</title> ' . "\n";        $this->seoTags .= '<meta name="description" content="' . $this->Tags['Content'] . '"/>' . "\n";        $this->seoTags .= '<meta name="robots" content="index, follow" />' . "\n";        $this->seoTags .= '<link rel="base" href="' . HOME . '"/>' . "\n";        $this->seoTags .= '<link rel="canonical" href="' . $this->Tags['Link'] . '">' . "\n";        $this->seoTags .= "\n";        //FACEBOOK        $this->seoTags .= '<meta property="og:site_name" content="' . SITENAME . '" />' . "\n";        $this->seoTags .= '<meta property="og:locale" content="pt_BR" />' . "\n";        $this->seoTags .= '<meta property="og:title" content="' . $this->Tags['Title'] . '" />' . "\n";        $this->seoTags .= '<meta property="og:description" content="' . $this->Tags['Content'] . '" />' . "\n";        $this->seoTags .= '<meta property="og:image" content="' . $this->Tags['Image'] . '" />' . "\n";        $this->seoTags .= '<meta property="og:url" content="' . $this->Tags['Link'] . '" />' . "\n";        $this->seoTags .= '<meta property="og:type" content="article" />' . "\n";        $this->seoTags .= "\n";        //ITEM GROUP (TWITTER)        $this->seoTags .= '<meta itemprop="name" content="' . $this->Tags['Title'] . '">' . "\n";        $this->seoTags .= '<meta itemprop="description" content="' . $this->Tags['Content'] . '">' . "\n";        $this->seoTags .= '<meta itemprop="url" content="' . $this->Tags['Link'] . '">' . "\n";        $this->seoTags .= '<meta itemprop="image" content="' . $this->Tags['Image'] . '">' . "\n";        $this->seoTags .= '<link rel="shortcut icon" type="image/png" href="' . INCLUDE_PATH . '/images/flavicon.png' . '">' . "\n";        $this->Tags = null;    }}