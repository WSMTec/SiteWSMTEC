<?php
if (!$Adm && !$Coord):
    header('Location: painel.php');
    exit();
endif;
?>
<main class="content">
    <?php
    $office = filter_input(INPUT_GET, "servicos", FILTER_VALIDATE_INT);
    $Read = new Read;
    $Read->ExeRead("tb_servicos", "WHERE IdServico = :id", "id={$office}");
    ?>
    <!--<div class="div-header">-->
    <header class="header-box">
        <h2 class="header-box-h">Editar serviço <?= $Read->getResult()[0]["NomeServico"]; ?></h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=servicos/index"><span class="lnr lnr-list"></span>  Serviços</a>
        </div>
    </header>
    <!--</div>-->
    <?php
    extract($Read->getResult()[0]);
    ?>
    <div class="box content-box">
        <form id="form-servicos-update" method="post" class="form" action="servicos-update">
            <div class="row-m">
                <label>
                    <span class="lnr lnr-code"></span> Código
                </label>
                <input class="inpt-null" name="CodServico" type="number" value="<?= $CodServico; ?>"/>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-license"></span>   Nome do serviço
                </label>
                <input class="inpt-null" name="NomeServico" type="text" value="<?= $NomeServico; ?>"/>
            </div>
            <div class="row-f">
                <label>
                    <span class="lnr lnr-text-align-left"></span>   Descrição
                </label>
                <textarea class="inpt-null" style="border: 1px solid #aaa;" name="DescServico"><?= $DescServico; ?></textarea>
            </div>
            <div class="row-btn">
                <input name="IdServico" value="<?= $IdServico; ?>" type="hidden"/>
                <button class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Atualizar Serviço</button>
            </div>
        </form>
    </div>
</main>
