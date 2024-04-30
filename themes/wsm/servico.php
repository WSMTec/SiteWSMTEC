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
            <header class="main_header_content_article_narrow">
                <div class="main_header_content_article_heading_narrow">
                    <h1>
                        <div id="typed-strings">
                            <span><?= $serv_title; ?></span>
                        </div>
                        <span id="typed"></span>
                    </h1>
                </div>
            </header>
        </div>
    </section>
    <!--FECHA DIV FRASE-->
    <div class="content_flex between">
        <article class="article_prod_uni">
            <?= $serv_description; ?>
        </article>

        <aside class="aside_prod_uni">
            <div class="content_prod">
                <div class="inside_prod">
                    <span class="t_prod">Gostou do serviço - <?= $serv_title; ?>? Envie-nos uma mensagem</span>
                    <?php
                    $Contato = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                    if (isset($Contato) && isset($Contato['send_serv'])):
                        unset($Contato['send_serv']);
                    
//                        $Contato['desc_serv'] = $Contato['desc_serv'] . "<br/>Nome: {$Contato['nome_serv']}<br/> E-mail: {$Contato['email_serv']}<br/>";

                        $Contato['assunto'] = $serv_title;
                        $Contato['Assunto'] = "Formulario de Serviço do Site - " . $Contato['assunto'];
                        $Contato['Mensagem'] = $Contato['desc_serv'] . "<br/><br/><br/>Nome: {$Contato['nome_serv']}<br/> E-mail: {$Contato['email_serv']}<br/>";
                        $Contato['RemetenteNome'] = $Contato['nome_serv'];
                        $Contato['RemetenteEmail'] = $Contato['email_serv'];
                        $Contato['DestinoNome'] = 'TI - WSMTEC';
                        $Contato['DestinoEmail'] = 'ti@wsmtec.com.br';

                        $SendMail = new Email;
                        $SendMail->Enviar($Contato);

                        if ($SendMail->getError()):
                            echo '<p><small style="color: #555;">';
                            echo 'Muito obrigado pelo contato! Retornaremos o mais rápido possível!';
                            echo '</small></p>';
                        endif;
                    endif;
                    ?>

                    <div class="content_flex form_prod">
                        <div class="div_form_prod">
                            <form id="f_prod" method="post">
                                <div class="divInpt">
                                    <input required="" type="text" name="nome_serv" id="" placeholder="Seu nome?"/>
                                    <span class="notfy_nome"></span>
                                </div>
                                <div class="divInpt">
                                    <input required="" type="email" name="email_serv" id="" placeholder="Seu e-mail?"/>
                                    <span class="notfy_email"></span>
                                </div>
                                <div class="divInpt">
                                    <textarea required="" rows="10" style="resize: none;" type="text" name="desc_serv" id="" placeholder="Quer acrescentar algo?"></textarea>
                                </div>
                                <div class="divInpt">
                                    <input class="orange_btn" name="send_serv" type="submit" value="Enviar"/>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr/>
                    <span class="footerProd"><p>A WSMTEC agradece o seu interesse em nosso serviço - <?= $serv_title ?>!</p></span>
                </div>
            </div>
        </aside>
    </div>
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
