<?php
if (!$Adm):
    header('Location: painel.php');
    exit();
endif;
?>
<main class="content">
    <?php
    $office = filter_input(INPUT_GET, "client", FILTER_VALIDATE_INT);
    $Read = new Read;
    $Read->ExeRead("tb_client", "WHERE client_id = :id", "id={$office}");
    ?>
    <!--<div class="div-header">-->
    <header class="header-box">
        <h2 class="header-box-h">Editar cliente <?= $Read->getResult()[0]["client_title"]; ?></h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=client/index"><span class="lnr lnr-list"></span>  Clientes</a>
        </div>
    </header>
    <!--</div>-->
    <?php
    extract($Read->getResult()[0]);
    ?>
    <div class="box content-box">
        <form method="post" id="form-client-update" class="form-client form-horizontal" action="client-update" enctype="multipart/form-data">
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
                <input class="inpt-null" name="client_title" type="text" value="<?= $client_title; ?>"/>
            </div>

            <div class="row-btn">
                <input name="client_id" value="<?= $client_id; ?>" type="hidden"/>
                <button class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Atualizar Cliente</button>
            </div>
        </form>
    </div>
</main>
