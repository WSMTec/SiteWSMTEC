<?php
if (!$Adm && !$Coord):
    header('Location: painel.php');
    exit();
endif;
?>
<main class="content">
    <!--<div class="div-header">-->
    <header class="header-box">
        <h2 class="header-box-h">Cadastro de categorias de soluções</h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=categories-solution/index"><span class="lnr lnr-list"></span>  Categorias</a>
        </div>
    </header>
    <!--</div>-->
    <div class="box content-box">
        <form id="form-categories-solution" method="post" class="form-categories" action="categories-solution">
            <div class="row-m">
                <label>
                    <span class="lnr lnr-user"></span>   Titulo
                </label>
                <input name="category_title" class="inpt-null" type="text"/>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-calendar-full"></span>   Data
                </label>
                <input name="category_date" class="inpt-null" type="text" value="<?= date("d/m/Y H:i:s"); ?>"/>
            </div>
            <div class="row-f">
                <label>
                    <span class="lnr lnr-text-align-left"></span>   Conteúdo
                </label>
                <textarea name="category_content" class="inpt-null"></textarea>
            </div>

            <div class="row-m">
                <label>
                    <span class="lnr lnr-layers"></span>   Seção
                </label>
                <select  class="inpt-null" name="category_parent">
                    <option value="null"> Selecione a Seção: </option>
                    <?php
                    $Read = new Read;
                    $Read->ExeRead("tb_categories_solution", "WHERE category_parent is null");
                    foreach ($Read->getResult() as $values):
                        extract($values);
                        ?>
                        <option  class="clik-op" value="<?= $category_id; ?>"><?= $category_title; ?></option>
                        <?php
                    endforeach;
                    ?>
                </select>
            </div>
            <div class="row-btn">
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Salvar categoria</button>
            </div>
        </form>
    </div>
</main>
