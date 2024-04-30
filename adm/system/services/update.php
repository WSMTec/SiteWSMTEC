<?php
if (!$Adm):
    header('Location: painel.php');
    exit();
endif;
?>
<main class="content">
    <?php
    $office = filter_input(INPUT_GET, "services", FILTER_VALIDATE_INT);
    $Read = new Read;
    $Read->ExeRead("tb_services", "WHERE serv_id = :id", "id={$office}");
    ?>

    <header class="header-box">
        <h2 class="header-box-h">Atualizar o produto <?= $Read->getResult()[0]['serv_title']; ?></h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=services/index"><span class="lnr lnr-list"></span>  Serviços</a>
        </div>
    </header>
    <div class="loader">
        <div class="processing"></div>
    </div>

    <?php
    extract($Read->getResult()[0]);
    ?>
    <div class="box content-box">
        <form method="post" id="form-services-update" class="form-services form-horizontal" action="services-update" enctype="multipart/form-data">
            <div class="row-m">
                <label>
                    <span class="lnr lnr-picture"></span>  Foto
                </label>
                <input type="file" name="serv_img" class="serv_cover"/> 
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-graduation-hat"></span>   Nome
                </label>
                <input class="inpt-null" name="serv_title" type="text" value="<?= $serv_title; ?>"/>
            </div>
            <div class="row-f">
                <label>
                    <span class="lnr lnr-text-align-left"></span>  Resumo em texto
                </label>
                <textarea class="inpt-null js_editor" name="serv_content" type="text"><?= $serv_content; ?></textarea>
            </div>
            <div class="row-f">
                <label>
                    <span class="lnr lnr-text-align-left"></span>   Conteúdo
                </label>
                <textarea class="inpt-null js_editor" name="serv_description" type="text"><?= $serv_description; ?></textarea>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-question-circle"></span> Publicar?
                </label>
                <select class="inpt-null" name="serv_status">
                    <option></option>
                    <option <?= ($serv_status == '1' ? 'selected' : ''); ?> value="1">Sim</option>
                    <option <?= ($serv_status == '0' ? 'selected' : ''); ?> value="0">Não</option>
                </select>
            </div>
            <div class="row-btn">
                <input name="serv_id" value="<?= $serv_id; ?>" type="hidden"/>
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Atualizar Produto</button>
            </div>
        </form>
    </div>
</main>
