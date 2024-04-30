<?php
if (!$Adm) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<main class="content">
    <!--<div class="div-header">-->
    <header class="header-box">
        <h2 class="header-box-h">Cadastro de posts no sistema</h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=posts/index"><span class="lnr lnr-list"></span>  Posts</a>
        </div>
    </header>
    <div class="loader">
        <div class="processing"></div>
    </div>
    <!--</div>-->

    <div class="box content-box">
        <form method="post" id="form-posts" class="form-services form-horizontal" action="posts" enctype="multipart/form-data">
            <div class="row-m">
                <label>
                    <span class="lnr lnr-picture"></span>  Foto
                </label>
                <input type="file" name="post_cover" class="post_cover inpt-null"/> 
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-graduation-hat"></span>  Titulo
                </label>
                <input class="inpt-null" name="post_title" type="text"/>
            </div>
            <div class="row-f">
                <label>
                    <span class="lnr lnr-text-align-left"></span>   Conteúdo
                </label>
                <textarea class="inpt-null js_editor" name="post_content" type="text"></textarea>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-calendar-full"></span>  Data
                </label>
                <input class="inpt-null" name="post_date" type="text" value="<?= date("d/m/Y H:i:s"); ?>"/>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-layers"></span> Categoria
                </label>
                <select class="inpt-null" name="post_category">
                    <option></option>
                    <?php
                    $Read = new Read;
                    $dois = 2;
                    $Read->FullRead("SELECT * FROM ws_categories WHERE category_parent IS NULL");
                    foreach ($Read->getResult() as $d):
                        extract($d);
                        ?>
                        <optgroup label="<?= $category_title; ?>">
                            <?php
                            $Read->FullRead("SELECT * FROM ws_categories WHERE category_parent = :id", "id={$category_id}");
                            foreach ($Read->getResult() as $v):
                                var_dump($v);
                                ?>
                                <option value="<?= $v['category_id']; ?>"><?= $v['category_title']; ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-question-circle"></span> Publicar?
                </label>
                <select class="inpt-null" name="post_status">
                    <option></option>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
            </div>
            <div class="row-btn">
                <input name="post_author" type="hidden" value="<?= $userlogin['IdUsuario']; ?>"/>
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Salvar post</button>
            </div>
        </form>
    </div>
</main>