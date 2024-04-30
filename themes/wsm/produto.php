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
                            <span><?= $prod_title; ?></span>
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
            <?= $prod_description; ?>
        </article>

        <aside class="aside_prod_uni">
            <div class="content_prod">
                <div class="inside_prod">


                    <span class="t_prod">Gostou do produto - <?= $prod_title; ?>? Envie-nos uma mensagem</span>

                    <?php
                    $Contato = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                    if (isset($Contato) && isset($Contato['send_prod'])):
                        unset($Contato['send_prod']);
                        $Contato['assunto'] = $prod_title;
                        $Contato['Assunto'] = "Formulario de Produto do Site - " . $Contato['assunto'];
                        $Contato['Mensagem'] = $Contato['desc_prod'] . "<br/><br/><br/>Nome: {$Contato['nome_prod']}<br/> E-mail: {$Contato['email_prod']}<br/>";
                        $Contato['RemetenteNome'] = $Contato['nome_prod'];
                        $Contato['RemetenteEmail'] = $Contato['email_prod'];
                        $Contato['DestinoNome'] = 'TI - WSMTEC';
                        $Contato['DestinoEmail'] = 'ti@wsmtec.com.br';

                        $SendMail = new Email;
                        $SendMail->Enviar($Contato);

                        if ($SendMail->getError()):
                            echo '<p><small style="color: #555;">';
                            echo 'Muito obrigado pelo contato! Retornaremos o mais rapido possível!';
                            echo '</small></p>';
                        endif;
                    endif;
                    ?>
                    <div class="content_flex form_prod">
                        <div class="div_form_prod">
                            <form id="f_prod" method="post">
                                <div class="divInpt">
                                    <input required="" type="text" name="nome_prod" id="" placeholder="Seu nome?"/>
                                    <span class="notfy_nome"></span>
                                </div>
                                <div class="divInpt">
                                    <input required="" type="email" name="email_prod" id="" placeholder="Seu e-mail?"/>
                                    <span class="notfy_email"></span>
                                </div>
                                <div class="divInpt">
                                    <textarea required="" rows="10" style="resize: none;" type="text" name="desc_prod" id="" placeholder="Quer acrescentar algo?"></textarea>
                                </div>
                                <div class="divInpt">
                                    <input class="orange_btn" name="send_prod" type="submit" value="Enviar"/>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr/>
                    <span class="footerProd"><p>A WSMTEC agradece o seu interesse em nosso produto - <?= $prod_title ?>!</p></span>
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
                        <?= $serv_content; ?>                    
                    </div>   
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
