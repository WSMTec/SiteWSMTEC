<section class="section_heading">
    <div class="content">
        <header class="main_header_content_article_narrow">
            <div class="main_header_content_article_heading_narrow">
                <h1>
                    <div id="typed-strings">
                        <span>Fale Conosco</span>
                        
                    </div>
                    <span id="typed"></span>
                </h1>
            </div>
        </header>
    </div>
</section>

<section class="content">
    <div class="section_contact">
        <header class="header_contact">
            <h1>Informações de Endereço</h1>
            <article>
                <h2><span class="icon-phone"></span>Telefones</h2>
                <ul>
                    <li>(11) 2262-1285</li>
                </ul>
            </article>
            <article>
                <h2><span class="icon-compass"></span>E-mail</h2>
                <ul>
                    <li>contato@wsmtec.com.br</li>
                </ul>
            </article>
            <article>
                <h2><span class="icon-location2"></span>Endereço</h2>
                <ul>
                    <li>
                        Av. Torres Tibagy nº 846 <br>
                        Vila Aprazivel - Guarulhos - SP <br> CEP: 07060-020
                    </li>
                </ul>
            </article>
        </header>
        <article class="article_contact">
            <header>
                <h2>
                    Envie-nos sua dúvida ou proposta através do formulário abaixo.
                </h2>
            </header>
            <?php
            $Contato = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//            var_dump($Contato);
            if (isset($Contato) && isset($Contato['SendPostForm'])):
                $Cod = $Contato["g-recaptcha-response"];
                unset($Contato['SendPostForm'], $Contato["g-recaptcha-response"]);
                $Contato['Cod'] = $Cod;
                $Contato['Assunto'] = "Formulario de Contato do Site - " . $Contato['assunto'];
                $Contato['Mensagem'] = $Contato['mensagem'] . "<br/><br/><br/>Nome: {$Contato['nome']}<br/>E-mail: {$Contato['email']}<br/>Empresa: {$Contato['empresa']}<br/>Telefone: {$Contato['telefone']}";
                $Contato['RemetenteNome'] = $Contato['nome'];
                $Contato['RemetenteEmail'] = $Contato['email'];
                $Contato['DestinoNome'] = 'CONTATO - WSMTEC';
                $Contato['DestinoEmail'] = 'contato@wsmtec.com.br';

                $SendMail = new EmailContato;
                $SendMail->Enviar($Contato);

                if ($SendMail->getError()):
                    WSErro($SendMail->getError()[0], $SendMail->getError()[1]);
                endif;
            endif;
            ?>
            <form method="post" action="">
                <div class="smash">
                    <input type="text" name="nome" required="required" placeholder="Nome"/>
                    <input type="text" name="empresa" required="required" placeholder="Empresa"/>
                </div>
                <div class="smash">
                    <input type="tel" name="telefone" required="required" placeholder="Telefone" />
                    <input type="email" name="email" required="required" placeholder="E-mail"/>
                </div>
                <div class="smash">
                    <input style="width: 100%" name="assunto" required="required" type="text" placeholder="Assunto"/>
                </div>
                <div class="smash">
                    <textarea style="width: 100%;" name="mensagem" required="required" placeholder="Mensagem"></textarea>
                </div>
                <br/>
                <div class="smash">
                    <!-- Div do ReCaptcha foi adicionado no final do formulário -->
                    <div class="g-recaptcha" data-sitekey="6LeekL4ZAAAAAKgwoTunPSAx2dz9QPZxWSBjgRQt"></div>
                </div>
                <div class="smash">
                    <input class="orange_btn" value="Enviar Mensagem" style="width: 100%; text-transform: uppercase; font-weight: 500;" type="submit" name="SendPostForm"/>
                </div>  
            </form>
        </article>
    </div>
</section>
<section class="maps">
    <div class="content">
        <h1>Localização</h1>
    </div>
    <!--<iframe src="" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>-->
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3660.035470868143!2d-46.55027638502425!3d-23.459184984733614!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cef50cf0777257%3A0x68a61877f604086c!2sAv.+Torres+Tibagy%2C+846+-+Vila+Aprazivel%2C+Guarulhos+-+SP%2C+07060-020!5e0!3m2!1spt-BR!2sbr!4v1565988080566!5m2!1spt-BR!2sbr" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
</section>
