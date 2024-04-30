<?php
if (!$Adm):
    header('Location: painel.php');
    exit();
endif;
?>
<main class="content">
    <?php
    $office = filter_input(INPUT_GET, "posts", FILTER_VALIDATE_INT);
    $Read = new Read;
    $Read->ExeRead("ws_posts", "WHERE post_id = :id", "id={$office}");
    ?>

    <header class="header-box">
        <h2 class="header-box-h">Atualizar post <?= $Read->getResult()[0]['post_title']; ?></h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=posts/index"><span class="lnr lnr-list"></span>  POSTS</a>
        </div>
    </header>
    <div class="loader">
        <div class="processing"></div>
    </div>

    <?php
    extract($Read->getResult()[0]);
    ?>
    <div class="box content-box">
        <form method="post" class="form-posts" id="form-posts-update" action="posts-update">
            <div class="row-m">
                <label>
                    <span class="lnr lnr-picture"></span>  Foto
                </label>
                <input type="file" name="post_cover" class="post_cover"/> 
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-graduation-hat"></span>   Titulo
                </label>
                <input class="inpt-null" name="post_title" type="text" value="<?= $post_title; ?>"/>
            </div>
            <div class="row-f">
                <label>
                    <span class="lnr lnr-text-align-left"></span> Conteúdo
                </label>
                <textarea class="inpt-null js_editor" name="post_content" type="text"><?= $post_content; ?></textarea>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-calendar-full"></span>   Data
                </label>
                <input class="inpt-null" name="post_date" type="text" value="<?= date("d/m/Y H:i:s", strtotime($post_date)); ?>"/>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-layers"></span> Categoria
                </label>
                <select class="inpt-null" name="post_category">
                    <option></option>
                    <?php
                    $dois = 2;
                    $Read->FullRead("SELECT * FROM ws_categories WHERE category_parent IS NULL");
                    foreach ($Read->getResult() as $d):
                        ?>
                        <optgroup label="<?= $d['category_title']; ?>">
                            <?php
                            $Read->FullRead("SELECT * FROM ws_categories WHERE category_parent = :id", "id={$d['category_id']}");
                            foreach ($Read->getResult() as $v):
                                ?>
                                <option <?= ($v['category_id'] == $post_category ? "selected" : ""); ?> value="<?= $v['category_id']; ?>"><?= $v['category_title']; ?></option>
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
                    <option <?= ($post_status == '1' ? 'selected' : ''); ?> value="1">Sim</option>
                    <option <?= ($post_status == '0' ? 'selected' : ''); ?> value="0">Não</option>
                </select>
            </div>
            <div class="row-btn">
                <input name="post_id" type="hidden" value="<?= $post_id; ?>"/>
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Atualizar post</button>
            </div>
        </form>
    </div>
</main>
