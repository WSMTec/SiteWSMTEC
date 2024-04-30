<?php
if (!$Adm && !$Coord):
    header('Location: painel.php');
    exit();
endif;
?>
<main class="content">
    <?php
    $office = filter_input(INPUT_GET, "department", FILTER_DEFAULT);
    $departament = explode('-', $office);
    $Read = new Read;
    $Read->ExeRead("tb_department", "WHERE dep_id = :id", "id={$departament[0]}");
    if (!$Read->getRowCount()):
        header('Location: painel.php');
        exit();
    endif;
    ?>


    <!--<div class="div-header">-->
    <header class="header-box">
        <h2 class="header-box-h">Editar departamento <?= $Read->getResult()[0]["dep_title"]; ?> da empresa <?= Check::CompaniesByName($departament[1]); ?></h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=department/index"><span class="lnr lnr-list"></span>  Departamentos</a>
        </div>
    </header>
    <!--</div>-->
    <?php
    extract($Read->getResult()[0]);
    ?>
    <div class="box content-box">
        <form id="form-department-update" method="post" class="form-department-update" action="department-update">
            <div class="row-f">
                <label>
                    <span class="lnr lnr-apartment"></span>  Nome
                </label>
                <input name="dep_title" class="inpt-null" type="text" value="<?= $dep_title; ?>"/>
            </div>
            <div class="row-f">
                <label>
                    <span class="lnr lnr-text-align-left"></span>  Descrição
                </label>
                <textarea name="dep_description" class="inpt-null"><?= $dep_description; ?></textarea>
            </div>
            <input name="dep_id_companies" type="hidden" value="<?= $dep_id_companies; ?>"/>
            <input name="dep_id" type="hidden" value="<?= $dep_id; ?>"/>

            <div class="row-btn">
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Atualizar Departamento</button>
            </div>
        </form>
    </div>
</main>
