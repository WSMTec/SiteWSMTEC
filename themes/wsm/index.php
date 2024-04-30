<main>
    <!--FECHA DIV FRASE-->
    <section class="content">
        <div class="main_section_soluction_content">
            <header class="main_section_soluction_header">
                <h1>A WSM Tecnologia trabalha com uma gama de produtos e serviços.</h1>
                <p class="tagline">
                    A WSM possui a melhor e mais experiente equipe de consultores especializados e certificados, com atuação destacada em projetos de alta complexidade de empresas de diversos portes, nos segmentos de:
                </p>
            </header>
            <!--FIM DO CABEÇALHO DE SOLUÇOES-->
            <div class="main_section_soluction_article_flex">
                <article class="main_section_soluction_article">
                    <div class="main_section_soluction_article_img"><img title="" alt="" src="<?= INCLUDE_PATH ?>/images/solucoes/icon-infra.png"/></div>
                    <div class="main_section_soluction_article_text">
                        <h2>
                            Backup Corporativo
                        </h2>
                        <p>
                            Soluções corporativas de backup e armazenamento de dados em nuvem compatíveis com os mais diversos tipos de sistemas operacionais, bancos de dados, aplicações e sistemas de virtualização
                        </p>
                    </div>
                </article>
                <article class="main_section_soluction_article">
                    <div class="main_section_soluction_article_img"><img title="" alt="" src="<?= INCLUDE_PATH ?>/images/solucoes/icon-desenvolvimento.png"/></div>
                    <div class="main_section_soluction_article_text">
                        <h2>
                            Fábrica de Software
                        </h2>
                        <p>
                            Desenvolvimentos de rotinas específicas e personalizações
                        </p>
                    </div>
                </article>
                <article class="main_section_soluction_article">
                    <div class="main_section_soluction_article_img"><img title="" alt="" src="<?= INCLUDE_PATH ?>/images/solucoes/icon-erp.png"/></div> 
                    <div class="main_section_soluction_article_text">
                        <h2>
                            Implementação de Software ERP – CRM – ECF - SPEDs
                        </h2>
                        <p>
                            Arquitetura de Soluções e Software Selection, Mapeamento de Processos, Implementação do Software, Gerência de Projetos e PMO
                        </p> 
                    </div> 
                </article>
            </div>
        </div>
    </section>
    <!--FECHA SOLUCOES-->
    <article class="main_article_call">
        <div class="content_flex wrap">
            <header class="main_article_call_header">
                <h1>Que tal uma consultoria? entre em contato!</h1>
                <p class="tagline">
                    A WSM desenvolve sistemas e aplicações para as necessidades do seu
                    negócio. Atuamos com um portfólio completo de Soluções em Software e Hardware.
                </p>
            </header>
            <div class="main_article_call_btn">
                <h2><a class="btn strong uppercase btn_green_full" title="Solicite um orçamento" href="contatos">Solicitar um Orçamento</a></h2>
            </div>
        </div>
    </article>
    <!--FECHA CALL-->

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
    <!--FECHA SERVIÇOS-->
    <section class="main_section_customers">
        <div class="content">
            <header class="main_section_customers_header">
                <h1>Conheça alguns de nossos clientes</h1>
                <!--<p class="tagline">Realizamos instalação, configuração, consultoria, suporte local e remoto.</p>-->
            </header>
            <div class="customers autoplay">
                <?php
                $Read = new Read;
                $Read->ExeRead("tb_client");
                foreach ($Read->getResult() as $item):
                    extract($item);
                    ?>
                    <div class="no-out">
                        <img alt="<?= $client_title; ?>" title="<?= $client_title; ?>" src="<?= HOME; ?>/uploads/<?= $client_cover; ?>" width="76" />                                
                    </div>               
                    <?php
                endforeach;
                ?>
                <!--                 <div class="no-out">
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
                                 </div>-->
            </div>

        </div>
    </section>
    <!--FECHA CLIENTES-->
    <section class="main_section_best">
        <div class="content">
            <header class="main_section_best_header">
                <h1>Por que nossos serviços são diferenciados?</h1>
                <p class="tagline">A WSM oferece confiabilidade, segurança e comprometimento, buscando sempre excelência na qualidade dos serviços e ética em todas as etapas.</p>
            </header>
            <div class="main_section_best_content">
                <article>
                    <div><img title="Sistema de atendimento online na Wsmtec" alt="Sistema de atendimento online na Wsmtec" src="<?= INCLUDE_PATH ?>/images/diferencas/01.png"/></div>
                    <div><h2>Sistema de atendimento online.</h2></div>
                </article>
                <article>
                    <div><img title="Relatórios Mensais na Wsmtec" alt="Relatórios Mensais na Wsmtec" src="<?= INCLUDE_PATH ?>/images/diferencas/01.png"/></div>
                    <div><h2>Relatórios Mensais.</h2></div>
                </article>
                <article>
                    <div><img title="Atendimento em até 4h na Wsmtec" alt="Atendimento em até 4h na Wsmtec" src="<?= INCLUDE_PATH ?>/images/diferencas/01.png"/></div>
                    <div><h2>Atendimento em até 4h.</h2></div>
                </article>
                <article>
                    <div><img title="Equipe especializada e certificada na Wsmtec" alt="Equipe especializada e certificada na Wsmtec" src="<?= INCLUDE_PATH ?>/images/diferencas/01.png"/></div>
                    <div><h2>Equipe especializada e certificada.</h2></div>
                </article>
            </div>
        </div>
    </section>
    <!--FECHA DIFERENÇAS-->
</main>
<!--FECHA CONTEUDO-->