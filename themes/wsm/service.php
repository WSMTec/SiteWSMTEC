<?php
if ($Link->getData()):
    extract($Link->getData());
else:
    header('Location: ' . HOME . DIRECTORY_SEPARATOR . '404');
endif;
?>
<style>
    .section_heading_ebook:after{
        background-image: url(<?= ($ebook_cover ? '../uploads/' . $ebook_cover : '../uploads/blog/6.jpg'); ?>);
        background-attachment: fixed;
    }
</style>

<div class="main_ebook">
    <section class="section_heading_ebook"> 
        <header class="main_header_ebook">
            <div class="content">

                <h1>
                    <?= $ebook_title; ?>
                </h1>
                <p>
                    <?= $ebook_summary; ?>
                    <!--<time datetime="<?= date('Y-m-d', strtotime($ebook_date)); ?>" pubdate>Enviada em: <?= date('d/m/Y H:i', strtotime($ebook_date)); ?>Hs</time>-->
                </p>

            </div>
        </header>
        <!--        <div class="main_ebook_option">
                    <div class="main_ebook_option_div"> 
                        <span><img src="<?= INCLUDE_PATH; ?>/images/artigos/eye.png" width=""/> 2548</span>                
                        <span><img src="<?= INCLUDE_PATH; ?>/images/artigos/like.png" width=""/> 1200</span>
                        <span><img src="<?= INCLUDE_PATH; ?>/images/artigos/twitter.png" width=""/> </span>
                        <span><img src="<?= INCLUDE_PATH; ?>/images/artigos/whatsapp.png" width=""/> </span>
                        <span class="facebook"> 
                            <a class="faceb" href="https://facebook.com/sharer.php?u=<?php echo HOME . $_SERVER['REQUEST_URI'] ?>" target="_blank" title="Compartilhar"><img src="<?= INCLUDE_PATH; ?>/images/artigos/facebook.png" width=""/> </a>
                        </span>
                    </div>
                </div>-->
    </section>

</div>
<div class="main_ebook_ebook">
    <!--FECHA DIV FRASE-->
    <div class="content_flex">
        <article class="article_ebook">
            <div class="img_ebook">
                <img alt="<?= $ebook_title; ?>" title="<?= $ebook_title; ?>" src="<?= HOME; ?>/tim.php?src=<?= HOME; ?>/uploads/<?= ($ebook_cover ? $ebook_cover : 'blog/6.jpg'); ?>&w=580" />
                <!--<img alt="" title="" src="<?= HOME; ?>/tim.php?src=<?= HOME; ?>/uploads/blog/6.jpg&w=460&h=230" />-->
                <p>
                    <?= $ebook_content; ?>
                </p>
            </div>  
            <div class="form_ebook_div">
                <div class="form_ebook">
                    <div class="header_form">
                        <h2>Tire suas dúvidas e peça uma demontração!</h2>
                        <p>
                            <!--Basta preencher o fomulário abaixo:-->
                            Basta preencher o fomulário abaixo para recebe-lo em seu e-mail.
                        </p>
                    </div>
                    <form action="<?= HOME . '/confirm' ?>" class="" method="post">
                        <div class="">
                            <input name="new_nome" required="" type="text" placeholder="Nome">
                            <input name="new_email" required type="text" placeholder="Email">
                            <input name="new_phone" required type="text" placeholder="Telefone">
                            <input name="new_company" type="text" placeholder="Empresa">
                            <input name="new_type" type="hidden" value="<?= $ebook_title; ?>">
                            <input name="ebook" type="hidden" value="<?= $ebook_name; ?>">
                            <input name="SendEbookForm" type="hidden">
                            <button>Entra em contato</button>
                        </div>
                    </form>
                </div>  
            </div>  
        </article>
    </div>
    <!--    <div class="ebook_coments">
            <div class="like_fb">
                <div class="fb-like" data-href="" data-width="" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
            </div>  
            <div class="coments_fb">
                <div class="fb-comments" data-href="" data-width="600" data-numposts="10"></div>
            </div>
        </div>-->
</div>

