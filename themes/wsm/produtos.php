<section class="section_heading">
    <div class="content">
        <header class="main_header_content_article_narrow">
            <div class="main_header_content_article_heading_narrow">
                <h1>
                    <div id="typed-strings">
                        <span>Produtos</span>
                    </div>
                    <span id="typed"></span>
                </h1>
            </div>
        </header>
    </div>
</section>
<!--FECHA DIV FRASE-->
<div class="main_white">
    <section class="section_prod">
        <div class="content">
            <header class="header_prod">
                <h1>Temos a solução em Hardware para a sua empresa</h1>
                <p>A WSM Tecnologia trabalha com uma gama de produtos e serviços. Para mantermos atualizados nossos conhecimentos e estar sintonizados com lançamentos que ocorram no mercado de tecnologia, mantemos parceria com os principais distribuidores do país, confira alguns desses produtos. </p>
            </header>
            <div class="article_prod_flex">
                <?php
                $read_prod = new Read;
                $type = 'hardware';
                $read_prod->ExeRead("tb_product", "WHERE prod_type_title=:type", "type={$type}");
                foreach ($read_prod->getResult() as $data):
                    extract($data);
                    ?>
                    <article class="article_prod">
                        <div class="img_prod"><img title="<?= $prod_title; ?>" alt="<?= $prod_title; ?>" src="<?= HOME; ?>/uploads/<?= $prod_img; ?>"/></div>
                        <div class="text_prod">
                            <h2>
                                <?= $prod_title; ?>
                            </h2>
                            <p><?= $prod_content; ?></p>
                            <div class="wrap">
                                <a href="<?= HOME; ?>/produto/<?= $prod_name; ?>" class="btn uppercase strong btn_orange_prod">Saiba Mais</a>
                                <a href="<?= HOME; ?>/produto/<?= $prod_name; ?>" class="btn uppercase strong btn_green_prod">Solicitar orçamento</a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>

<section class="main_section_customers">
    <div class="content">
        <header class="main_section_customers_header">
            <h1>Conheça alguns de nossos Parceiros</h1>
            <!--<p class="tagline">Realizamos instalação, configuração, consultoria, suporte local e remoto.</p>-->
        </header>
        <div class="customers autoplay">
            <div class="no-out">
                <img title="" alt="" src="<?= INCLUDE_PATH ?>/images/parceiros/cisco.png" width="96"/>
            </div>
            <div class="no-out">
                <img title="" alt="" src="<?= INCLUDE_PATH ?>/images/parceiros/dell.png" width="96"/>
            </div>
            <div class="no-out">
                <img title="" alt="" src="<?= INCLUDE_PATH ?>/images/parceiros/hp.png" width="96"/>
            </div>
            <div class="no-out"> 
                <img title="" alt="" src="<?= INCLUDE_PATH ?>/images/parceiros/lenovo.png" width="96"/>
            </div>
            <div class="no-out">
                <img title="" alt="" src="<?= INCLUDE_PATH ?>/images/parceiros/micro.png" width="96"/>
            </div>
            <div class="no-out">
                <img title="" alt="" src="<?= INCLUDE_PATH ?>/images/parceiros/cisco.jpg" width="96"/>
            </div>
            <div class="no-out">
                <img title="" alt="" src="<?= INCLUDE_PATH ?>/images/parceiros/hp.jpg" width="96"/>
            </div>
            <div class="no-out">
                <img title="" alt="" src="<?= INCLUDE_PATH ?>/images/parceiros/lenovo.jpg" width="96" />
            </div>
            <div class="no-out">
                <img title="" alt="" src="<?= INCLUDE_PATH ?>/images/parceiros/microsoft.png" width="96"/>
            </div>
        </div>
    </div>
</section>

<div class="main_white">
    <section class="section_prod">
        <div class="content">
            <header class="header_prod">
                <h1>Temos a solução em Software para a sua empresa</h1>
                <p>A WSM Tecnologia possui diversos sistemas totalmente personalizados, desenvolvidos por nós! Quer automatizar sua empresa? confira alguns de nossos sistemas.</p>
            </header>
            <div class="article_prod_flex">
                <?php
                $read_prod = new Read;
                $type = 'software';
                $read_prod->ExeRead("tb_product", "WHERE prod_type_title=:type", "type={$type}");
                foreach ($read_prod->getResult() as $data):
                    extract($data);
                    ?>
                    <article class="article_prod">
                        <div class="img_prod"><img title="<?= $prod_title; ?>" alt="<?= $prod_title; ?>" src="<?= HOME; ?>/uploads/<?= $prod_img; ?>"/></div>
                        <div class="text_prod">
                            <h2>
                                <?= $prod_title; ?>
                            </h2>
                            <p><?= $prod_content; ?></p>
                            <div class="wrap">
                                <a href="<?= HOME; ?>/produto/<?= $prod_name; ?>" class="btn uppercase strong btn_orange_prod">Saiba Mais</a>
                                <a href="<?= HOME; ?>/produto/<?= $prod_name; ?>" class="btn uppercase strong btn_green_prod">Solicitar orçamento</a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>
