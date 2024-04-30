<section class="section_heading">
    <div class="content">
        <header class="main_header_content_article_narrow">
            <div class="main_header_content_article_heading_narrow">
                <h1>
                    <div id="typed-strings">
                        <span>Sobre</span>
                    </div>
                    <span id="typed"></span>
                </h1>
            </div>
        </header>
    </div>
</section>
<!--FECHA DIV FRASE-->
<div class="main_white">
    <section class="content">
        <div class="main_section_content_about">
            <header class="header_about">
                <h1>Já são 15 Anos de História!!!</h1>
                <p class="tagline">
                    Com mais de uma década de história, a WSM Tecnologia é uma empresa especializada no Desenvolvimento e Implantação de Sistemas de Gestão Corporativa, com crescimento expressivo, a WSM Tecnologia investe intensamente em desenvolvimento de pesquisa e desenvolvimento de sistemas oferecendo soluções flexíveis, robustas e escaláveis, permitindo que empresas de pequeno, médio Porte, possam inovar e crescer.
                </p>
            </header>
            <!--FIM DO CABEÇALHO DE SOLUÇOES-->
            <div class="article_about_flex">
                <h2>Desenvolvimento de sistemas</h2>
                <div class="progress">
                    <div class="green" style="width:99%">99%</div>
                </div>
                <h2>Infraestrutura</h2>
                <div class="progress">
                    <div class="blue" style="width:99%">99%</div>
                </div>
                <h2>Gestão de TI</h2>
                <div class="progress">
                    <div class="blue" style="width:99%">99%</div>
                </div>

            </div>
            <article class="article_about">
                <h2>Missão</h2>
                <p>
                    O Compromisso da WSM Tecnologia está em prover VANTAGEM COMPETITIVA através da inteligência de negócios, proporcionar suporte a gestão administrativa de cada cliente, agregar valor em sua rede de relacionamentos e cultivar uma equipe de valor exponencial.
                </p>
            </article>
            <article class="article_about">
                <h2>Visão</h2>
                <p>
                    Ser Reconhecida pela transparência, Comprometimento e Qualidade dos Produtos e Serviços prestados.
                </p>
            </article>
            <article class="article_about">
                <h2>Valores</h2>
                <p>
                    Ser sustentada por uma conduta ÉTICA, destacando-se pelo relacionamento baseado na RESPONSABILIDADE e CONFIANÇA, através da comunicação clara e precisa e no RESPEITO aos imperativos de cada cliente.
                </p>
            </article>
        </div>
    </section>
</div>
<section class="main_section_customers">
    <div class="content">
        <header class="main_section_customers_header">
            <h1>Conheça alguns de nossos clientes</h1>
            <!--<p class="tagline">Realizamos instalação, configuração, consultoria, suporte local e remoto.</p>-->
        </header>
        <div class="customers autoplay">
            <div class="no-out">
                <img title="" alt="" src="<?= INCLUDE_PATH ?>/images/clientes/01.png" width="76"/>
            </div>
            <div class="no-out">
                <img title="" alt="" src="<?= INCLUDE_PATH ?>/images/clientes/02.png" width="76"/>
            </div>
            <div class="no-out">
                <img title="" alt="" src="<?= INCLUDE_PATH ?>/images/clientes/03.png" width="76"/>
            </div>
            <div class="no-out">
                <img title="" alt="" src="<?= INCLUDE_PATH ?>/images/clientes/05.png" width="76"/>
            </div>
            <div class="no-out">
                <img title="" alt="" src="<?= INCLUDE_PATH ?>/images/clientes/04.png" width="76"/>
            </div>
            <div class="no-out">
                <img title="" alt="" src="<?= INCLUDE_PATH ?>/images/clientes/06.png" width="76"/>
            </div>
            <div class="no-out">
                <img title="" alt="" src="<?= INCLUDE_PATH ?>/images/clientes/07.png" width="76"/>
            </div>
            <div class="no-out">
                <img title="" alt="" src="<?= INCLUDE_PATH ?>/images/clientes/08.png" width="76"/>
            </div>
            <div class="no-out">
                <img title="" alt="" src="<?= INCLUDE_PATH ?>/images/clientes/09.png" width="76"/>
            </div>
        </div>
    </div>
</section>
<!--FECHA CLIENTES-->

<section class="main_section_services">
    <div class="content">
        <header class="main_section_services_header">
            <h1>Conheça alguns de nossos serviços</h1>
            <p class="tagline">
                Somos uma empresa especializada no
                desenvolvimento de soluções voltadas ao ambiente corporativo de pequenas,
                médias e grandes empresas. Atuamos com um portfólio completo de Soluções em Software e Hardware.
            </p>
        </header>

        <div class="main_section_services_content">

            <?php
            $read_serv = new Read;
            $read_serv->ExeRead("tb_services", "LIMIT 5");
            foreach ($read_serv->getResult() as $data):
                extract($data);
                ?>

                <article>
                    <div><img title="" alt="" src="<?= HOME; ?>/uploads/<?= $serv_img; ?>"/></div>
                    <div>
                        <h2>
                            <?= $serv_title; ?>
                        </h2>
                        <?= $serv_content; ?>                    </div>   
                    <div>
                        <a class="btn uppercase strong btn_orange_full_small" href="<?= HOME; ?>/servico/<?= $serv_name; ?>" title="Serviços de desenvolvimento de sistemas na Wsmtec">Conheça!</a>
                    </div>                   
                </article>
            <?php endforeach; ?>


            <div class="main_section_services_content_btn">
                <a title="Conheça todos os produtos da Wsmtec" href="produtos" class="btn btn_grey uppercase strong tod_prod">Nossos Produtos</a>
                <a title="Conheça todos os serviços da Wsmtec" href="servicos" class="btn btn_orange uppercase strong">Todos os Serviços</a>
            </div>
        </div> 
    </div>
</section>