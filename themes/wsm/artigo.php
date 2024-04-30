<?php
if ($Link->getData()):
    extract($Link->getData());
else:
    header('Location: ' . HOME . DIRECTORY_SEPARATOR . '404');
endif;
?>
<div class="main_white">
    <section class="section_heading">
        <div class="content">
            <header class="main_header_post">
                <div class="main_header_content_post">
                    <h1>
                        <?= $post_title; ?>
                    </h1>
                    <p>
                        <time datetime="<?= date('Y-m-d', strtotime($post_date)); ?>" pubdate>Enviada em: <?= date('d/m/Y H:i', strtotime($post_date)); ?>Hs</time>
                    </p>
                </div>
            </header>
        </div>
    </section>
    <!--FECHA DIV FRASE-->
    <div class="content_flex between content_post">
        <article class="article_post">
            <div class="img_post">
                <?= Check::Image('uploads' . DIRECTORY_SEPARATOR . $post_cover, $post_title, 578); ?>
            </div>          
            <?= $post_content; ?>
  
            <div class="facebook"> 
                <a class="faceb" href="https://facebook.com/sharer.php?u=<?php echo HOME . $_SERVER['REQUEST_URI'] ?>" target="_blank" title="Compartilhe no Facebook"><span class="icon-facebook2"></span> Compartilhe no Facebook</a>
            </div>
        </article>
 
        <aside class="aside_post">
            <header class="aside_header">
                <h1>
                    Relacionados:
                </h1>
            </header>
            <?php
            $cat = Check::CatByName('noticias');
            $post = new Read;
            $post->ExeRead("ws_posts", "WHERE post_status = 1 AND (post_cat_parent = :cat OR post_category = :cat) ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "cat={$cat}&limit=6&offset=3");
            if (!$post->getResult()):
                WSErro('Desculpe, ainda não existem notícias cadastradas. Favor volte mais tarde!', WS_INFOR);
            else:
                foreach ($post->getResult() as $data):
                    extract($data);
                    ?>
                    <article class="article_post css_flex css_flex_between">
                        <div class="div_img">
                            <img alt="<?= $post_title; ?>" title="<?= $post_title; ?>" src="<?= HOME; ?>/tim.php?src=<?= HOME; ?>/uploads/<?= $post_cover; ?>&w=460&h=230" />                                
                        </div>
                        <header class="header_post">
                            <h1><a href="<?= HOME; ?>/artigo/<?= $post_name; ?>"><?= Check::Words($post_title, 6); ?></a></h1>
                            <time datetime="<?= date('Y-m-d', strtotime($post_date)); ?>" pubdate><?= date('d/m/Y H:i', strtotime($post_date)); ?></time>

                        </header>
                    </article>
                    <?php
                endforeach;
            endif;
            ?>
        </aside>
    </div>
</div>

