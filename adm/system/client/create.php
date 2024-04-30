<?php
if (!$Adm) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<main class="content">
    <!--<div class="div-header">-->
    <header class="header-box">
        <h2 class="header-box-h">Cadastro de clientes no site</h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=client/index"><span class="lnr lnr-list"></span>  Clientes</a>
        </div>
    </header>
    <!--</div>-->

    <div class="box content-box">
        <form method="post" id="form-client" class="form-client form-horizontal" action="client" enctype="multipart/form-data">
            <div class="row-m">
                <label>
                    <span class="lnr lnr-picture"></span>  Foto
                </label>
                <input type="file" name="client_cover" class="post_cover inpt-null"/> 
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-code"></span>  Nome
                </label>
                <input class="inpt-null" name="client_title" type="text"/>
            </div>
            <div class="row-btn">
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Salvar Cliente</button>
            </div>
        </form>
    </div>
</main>
