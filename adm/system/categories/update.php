<?php
if (!$Adm):
    header('Location: painel.php');
    exit();
endif;
?>
<main class="content">
    <?php
    $office = filter_input(INPUT_GET, "category", FILTER_VALIDATE_INT);
    $Read = new Read;
    ?>

    <header class="header-box">
        <h2 class="header-box-h">Atualizar categoria de posts</h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=categories/index"><span class="lnr lnr-list"></span>  Categorias</a>
        </div>
    </header>

    <?php
    $Read->ExeRead("ws_categories", "WHERE category_id = :id", "id={$office}");
    extract($Read->getResult()[0]);
    ?>
    <div class="box content-box">
        <form method="post" class="categories" id="form-categories-update" action="categories-update">
            <div class="row-m">
                <label>
                    <span class="lnr lnr-graduation-hat"></span>  Titulo
                </label>
                <input value="<?= $category_title; ?>" name="category_title" class="inpt-null" type="text"/>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-calendar-full"></span>  Data
                </label>
                <input value="<?= date("d/m/Y H:i:s", strtotime($category_date)); ?>" name="category_date" class="inpt-null" type="text"/>
            </div>
            <div class="row-f">
                <label>
                    <span class="lnr lnr-text-align-left"></span>   Conteúdo
                </label>
                <textarea name="category_content" class="inpt-null"><?= $category_content; ?></textarea>
            </div>
            <?php
            $Read->FullRead("SELECT * FROM ws_categories WHERE category_parent = :id", "id={$category_id}");
            if ($Read->getRowCount()):
                ?>
                <div class="row-f sub-row"> 
                    <label>
                        <span class="lnr lnr-layers"></span>  Sub categorias
                    </label>
                    <?php
                    foreach ($Read->getResult() as $v):
                        ?>
                        <div id="new-row" class="row-f new-row">
                            <div class="row-m">
                                <label>
                                    Titulo
                                </label>
                                <input disabled="" value="<?= $v['category_title']; ?>" type="text"/>
                            </div>
                            <div class="row-m">
                                <label>
                                    Descrição
                                </label>
                                <input disabled="" value="<?= $v['category_content']; ?>" type="text"/>
                            </div>
                            <div style="margin-top: 1%;">
                                <div>
                                    <button name='btn-modal[]' data-function='categories-delete' value='<?= $v['category_id']; ?>' type='button' class='btn-default btn-danger btn-table'><span class="lnr lnr-cross"></span> Remover</button>
                                </div>
                            </div>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
                <?php
            endif;
            ?>
            <div class="row-btn">
                <input name="category_parent" type="hidden" value="<?= $category_parent ? $category_parent : 'null'; ?>"/>
                <input name="category_id" type="hidden" value="<?= $category_id; ?>"/>
                <button class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Atualizar categoria</button>
            </div>
        </form>
    </div>
</main>
