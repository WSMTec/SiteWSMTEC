<?php
if (!$Adm) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<main class="content">
    <!--<div class="div-header">-->
    <header class="header-box">
        <h2 class="header-box-h">Cadastro de pop-up no site</h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=popup/index"><span class="lnr lnr-list"></span>  pop-up</a>
        </div>
    </header>
    <div class="loader">
        <div class="processing"></div>
    </div>
    <!--</div>-->

    <div class="box content-box">
        <form method="post" id="form-popup" class="form-popup form-horizontal" action="popup" enctype="multipart/form-data">

            <div class="row-m">
                <label>
                    <span class="lnr lnr-graduation-hat"></span>  Opções
                </label>
                <select class="inpt-null" name="ebook_type">
                    <option value="ebook">Novo</option>
                    <option value="service">Serviços</option>
                </select>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-picture"></span>  Pop up Capa
                </label>
                <input type="file" name="ebook_popup" class="inpt-null"/> 
            </div>
            <div class="row-f pop_hide">
                <label>
                    <span class="lnr lnr-picture"></span>  Foto
                </label>
                <input type="file" name="ebook_cover" class="ebook_cover inpt-null"/> 
            </div>
            <!--            <div class="row-f pop_hide">
                            <label>
                                <span class="lnr lnr-picture"></span>  PDF
                            </label>
                            <input type="file" name="ebook_pdf" class="ebook_cover inpt-null"/> 
                        </div>-->
            <div class="row-f pop_hide">
                <label>
                    <span class="lnr lnr-graduation-hat"></span>  Titulo
                </label>
                <input class="inpt-null" name="ebook_title" type="text"/>
            </div>

            <div class="row-f pop_hide">
                <label>
                    <span class="lnr lnr-graduation-hat"></span>  Sub Titulo
                </label>
                <input class="inpt-null" name="ebook_summary" type="text"/>
            </div>
            <div class="row-f pop_hide">
                <label>
                    <span class="lnr lnr-text-align-left"></span>   Conteúdo
                </label>
                <textarea class="inpt-null js_editor" name="ebook_content" type="text"></textarea>
            </div>
            <div class="row-f">
                <label>
                    <span class="lnr lnr-graduation-hat"></span>  Instrução
                </label>
                <input required="" class="inpt-null" name="ebook_comment" type="text"/>
            </div> 
            <div class="row-m pop_hide">
                <label>
                    <span class="lnr lnr-calendar-full"></span>  Data
                </label>
                <input class="inpt-null" name="ebook_date" type="text" value="<?= date("d/m/Y H:i:s"); ?>"/>
            </div>

            <div class="row-m service_hide" style="display: none;">
                <label>
                    <span class="lnr lnr-question-circle"></span> Serviço
                </label>
                <select class="inpt-null" name="ebook_service">
                    <?php
                    $Read = new Read;
                    $Read->FullRead("SELECT * FROM tb_services");
                    foreach ($Read->getResult() as $it):
                        ?>
                        <option value="<?= $it['serv_name']; ?>"><?= $it['serv_title']; ?></option>
                        <?php
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="row-m">
                <label>
                    <span class="lnr lnr-question-circle"></span> Publicar?
                </label>
                <select class="inpt-null" name="ebook_status">
                    <option></option>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
            </div>

            <!--            <div class="row-m">
                            <label>
                                <span class="lnr lnr-question-circle"></span> Newsletter?
                            </label>
                            <select class="inpt-null" name="ebook_newsletter">
                                <option></option>
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>-->
            <div class="row-btn">
                <input name="ebook_newsletter" type="hidden" value="0"/>
                <input name="ebook_author" type="hidden" value="<?= $userlogin['IdUsuario']; ?>"/>
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Salvar</button>
            </div>
        </form>
    </div>
</main>