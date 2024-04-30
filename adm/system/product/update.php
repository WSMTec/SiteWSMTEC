<?php
if (!$Adm):
    header('Location: painel.php');
    exit();
endif;
?>
<main class="content">
    <?php
    $office = filter_input(INPUT_GET, "product", FILTER_VALIDATE_INT);
    $Read = new Read;
    $Read->ExeRead("tb_product", "WHERE prod_id = :id", "id={$office}");
    ?>

    <header class="header-box">
        <h2 class="header-box-h">Atualizar o produto <?= $Read->getResult()[0]['prod_title']; ?></h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=product/index"><span class="lnr lnr-list"></span>  Produtos</a>
        </div>
    </header>
    <div class="loader">
        <div class="processing"></div>
    </div>

    <?php
    extract($Read->getResult()[0]);
    ?>
    <div class="box content-box">
        <form method="post" id="form-product-update" class="form-product form-horizontal" action="product-update" enctype="multipart/form-data">
            <div class="row-m">
                <label>
                    <span class="lnr lnr-picture"></span> Foto
                </label>
                <input type="file" name="prod_img" class="prod_cover"/> 
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-graduation-hat"></span>   Nome
                </label>
                <input class="inpt-null" name="prod_title" type="text" value="<?= $prod_title; ?>"/>
            </div>
            <div class="row-f">
                <label>
                    <span class="lnr lnr-text-align-left"></span>  Resumo em texto
                </label>
                <textarea class="inpt-null js_editor" name="prod_content" type="text"><?= $prod_content; ?></textarea>
            </div>
            <div class="row-f">
                <label>
                    <span class="lnr lnr-text-align-left"></span> Conteúdo
                </label>
                <textarea class="inpt-null js_editor" name="prod_description" type="text"><?= $prod_description; ?></textarea>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-layers"></span>Categoria
                </label>
                <select class="inpt-null" name="prod_type_title">
                    <option></option>
                    <option <?= ($prod_type_title == 'software' ? 'selected' : ''); ?> value="software">Software</option>
                    <option <?= ($prod_type_title == 'hardware' ? 'selected' : ''); ?> value="hardware">Hardware</option>
                </select>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-question-circle"></span> Publicar?
                </label>
                <select class="inpt-null" name="prod_status">
                    <option></option>
                    <option <?= ($prod_status == '1' ? 'selected' : ''); ?> value="1">Sim</option>
                    <option <?= ($prod_status == '0' ? 'selected' : ''); ?> value="0">Não</option>
                </select>
            </div>
            <div class="row-btn">
                <input name="prod_id" value="<?= $prod_id; ?>" type="hidden"/>
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Atualizar Produto</button>
            </div>
        </form>
    </div>
</main>
