<section class="section_heading">
    <div class="content">
        <header class="main_header_content_article_narrow">
            <div class="main_header_content_article_heading_narrow">
                <h1>
                    <div id="typed-strings">
                        <span>Serviços </span>
                    </div>
                    <span id="typed"></span>
                </h1>
            </div>
        </header>
    </div>
</section>

<section class="section_services">
    <div class="content">
        <header class="section_services_header">
            <h1>Conheça todos os nossos serviços</h1>
            <p class="tagline">
                Somos uma empresa especializada no
                desenvolvimento de soluções voltadas ao ambiente corporativo de pequenas,
                médias e grandes empresas. Atuamos com um portfólio completo de Soluções em Software e Hardware.
            </p>
        </header>

        <div class="section_services_content">
            <?php
            $read_serv = new Read;
            $read_serv->ExeRead("tb_services");
            foreach ($read_serv->getResult() as $data):
                extract($data);
                ?>
                <article>
                    <div><img title="" alt="" src="<?= HOME; ?>/uploads/<?= $serv_img; ?>"/></div>
                    <div>
                        <h2>
                            <?= $serv_title; ?>
                        </h2>
                        <?= $serv_content; ?>
                    </div>   
                    <div>
                        <a class="btn uppercase strong btn_orange_full_small" href="<?= HOME; ?>/servico/<?= $serv_name; ?>" title="Serviços de desenvolvimento de sistemas na Wsmtec">Conheça!</a>
                    </div>                   
                </article>
            <?php endforeach; ?>

            <!-- comment 

            <article>
                <div><img title="" alt="" src="https://wsmtec.com.br/uploads/servicos/2018/10/backup.jpg"/></div>
                <div>
                    <h2>
                        BACKUP CORPORATIVO
                    </h2>
                    <ul>
                        <li>Velocidade de Backup / Restauração</li>
                        <li>Criptografia</li>
                        <li>Envio de HD Externo</li>
                        <li>Retenção e versionamento dos dados</li>
                        <li>FTP</li>
                        <li>Backup de Sistemas Microsoft / Linux e Unix</li>
                        <li>Backup do Outlook (pst)</li>
                        <li>Banco de dados Oracle, MySql, MSSQL, Firebird, Postgre</li>
                        <li>Plugins para máquinas virtuais VMWARE e Hyper-V</li>
                    </ul>
                </div>   
                <div>
                    <a class="btn uppercase strong btn_orange_full_small" href="https://wsmtec.backupmanager.info/" title="Serviços de desenvolvimento de sistemas na Wsmtec" target="_blank">Conheça!</a>
                </div>                   
            </article>
            -->
        </div> 
    </div>
</section>

<!--FECHA SERVIÇOS-->
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
<!--            <article>
                <header>
                    <h1>Que tal uma consultoria? entre em contato!</h1>
                    <p>
                        A WSM desenvolve sistemas e aplicações para as necessidades do seu
                        negócio
                    </p>
                </header>
                <h2>
                    <a title="" href="">Orçamento</a> 
                </h2>
            </article>-->
<!--FECHA ORÇAMENTO-->