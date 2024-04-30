<?php
//if (!$Adm):
//    header('Location: painel.php');
//    exit();
//endif;
?>
<main class="content">
    <!--<div class="div-header">-->
    <header class="header-box">
        <h2 class="header-box-h">Cadastro de URL estático</h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=configuration/sitemap"><span class="lnr lnr-list"></span>  URLs</a>
        </div>
    </header>
    <!--</div>-->
    <div class="box content-box">
        <form id="form-sitemap" method="post" class="form-sitemap" action="sitemap">
            <div class="row-f">
                <label>
                    <span class="lnr lnr-user"></span>   Descrição
                </label>
                <input name="page_description" class="inpt-null" type="text"/>
            </div>
            <div class="row-f">
                <label>
                    <span class="lnr lnr-text-align-left"></span>   Name(ex: /areas, /sobre, /quem-somos...)
                </label>
                <input name="page_name" class="inpt-null" type="text"/>
            </div>

            <div class="row-btn">
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Salvar</button>
            </div>
        </form>
    </div>
</main>
