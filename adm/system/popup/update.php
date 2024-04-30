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
    $Read->ExeRead("tb_ebook", "WHERE ebook_id = :id", "id={$office}");
    ?>

    <header class="header-box">
        <h2 class="header-box-h">Atualizar pop-up <?= $Read->getResult()[0]['ebook_title']; ?></h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=popup/index"><span class="lnr lnr-list"></span> pop-up</a>
        </div>
    </header>
    <div class="loader">
        <div class="processing"></div>
    </div>

    <?php
    extract($Read->getResult()[0]);
    ?>
    <div class="box content-box">
        <form method="post" class="form-popup" id="form-popup-update" action="popup-update">
            <div class="row-f">
                <label>
                    <span class="lnr lnr-picture"></span>  Pop up Capa
                </label>
                <input type="file" name="ebook_popup" class="inpt-null"/> 
            </div>
            <?php
            if ($ebook_type == 'ebook') {
                ?>
                <div class="row-f">
                    <label>
                        <span class="lnr lnr-picture"></span>  Foto
                    </label>
                    <input type="file" name="ebook_cover" class="ebook_cover inpt-null"/> 
                </div>
                <!--                <div class="row-f">
                                    <label>
                                        <span class="lnr lnr-picture"></span>  PDF
                                    </label>
                                    <input type="file" name="ebook_pdf" class="inpt-null"/> 
                                </div>-->
                <div class="row-f">
                    <label>
                        <span class="lnr lnr-graduation-hat"></span>  Titulo
                    </label>
                    <input class="inpt-null" name="ebook_title" type="text" value="<?= $ebook_title; ?>"/>
                </div>
                <div class="row-f">
                    <label>
                        <span class="lnr lnr-graduation-hat"></span>  Sub Titulo
                    </label>
                    <input class="inpt-null" name="ebook_summary" type="text" value="<?= $ebook_summary; ?>"/>
                </div>
                <div class="row-f">
                    <label>
                        <span class="lnr lnr-text-align-left"></span>   Conteúdo
                    </label>
                    <textarea class="inpt-null js_editor" name="ebook_content" type="text"><?= $ebook_content; ?></textarea>
                </div>

                <div class="row-m">
                    <label>
                        <span class="lnr lnr-calendar-full"></span>  Data
                    </label>
                    <input class="inpt-null" name="ebook_date" type="text" value="<?= date("d/m/Y H:i:s"); ?>"/>
                </div>
                <?php
            } else {
                ?>
                <div class="row-m">
                    <label>
                        <span class="lnr lnr-question-circle"></span> Serviço
                    </label>
                    <select class="inpt-null" disabled="">
                        <?php
                        $Read = new Read;
                        $Read->FullRead("SELECT * FROM tb_services WHERE serv_name = '{$ebook_service}'");
                        ?>
                        <option><?= $Read->getResult()[0]['serv_title']; ?></option>
                    </select>
                </div>

                <?php
            }
            ?>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-graduation-hat"></span>  Instrução
                </label>
                <input required="" class="inpt-null" name="ebook_comment" type="text" value="<?= $ebook_comment; ?>"/>
            </div> 
            <div class="row-m">
                <label>
                    <span class="lnr lnr-question-circle"></span> Publicar?
                </label>
                <select class="inpt-null" name="ebook_status">
                    <option></option>
                    <option <?= ($ebook_status == '1' ? 'selected' : ''); ?> value="1">Sim</option>
                    <option <?= ($ebook_status == '0' ? 'selected' : ''); ?> value="0">Não</option>
                </select>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-calendar-full"></span>  Data Vencimento
                </label>
                <input class="inpt-null" name="ebook_date_venc" type="date" value="<?= date("Y-m-d", strtotime($ebook_date_venc)); ?>"/>
            </div>
            <div class="row-btn">
                <input name="ebook_type" type="hidden" value="<?= $ebook_type; ?>"/>
                <input name="ebook_newsletter" type="hidden" value="0"/>
                <input name="ebook_id" type="hidden" value="<?= $ebook_id; ?>"/>
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Atualizar</button>
            </div>
        </form>
    </div>
</main>
