<?php
if (!$Adm) :
    header('Location: ../painel.php');
    die;
endif;
?>
<main class="content">
    <!--<div class="div-header">-->
    <header class="header-box">
        <h2 class="header-box-h">Cadastro de serviços para o site</h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=services/index"><span class="lnr lnr-list"></span>  Serviços</a>
        </div>
    </header>
    <div class="loader">
        <div class="processing"></div>
    </div>
    <!--</div>-->

    <div class="box content-box">
        <form method="post" id="form-services" class="form-services form-horizontal" action="services" enctype="multipart/form-data">
            <div class="row-m">
                <label>
                    <span class="lnr lnr-picture"></span>  Foto
                </label>
                <input type="file" name="serv_img" class="serv_cover inpt-null"/> 
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-graduation-hat"></span>   Nome
                </label>
                <input class="inpt-null" name="serv_title" type="text"/>
            </div>
            <div class="row-f">
                <label>
                    <span class="lnr lnr-list"></span>   Resumo em lista
                </label>
                <textarea class="inpt-null js_editor" name="serv_content" type="text"></textarea>
            </div>
            <div class="row-f">
                <label>
                    <span class="lnr lnr-text-align-left"></span>   Conteúdo
                </label>
                <textarea class="inpt-null js_editor" name="serv_description" type="text"></textarea>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-question-circle"></span> Publicar?
                </label>
                <select class="inpt-null" name="serv_status">
                    <option></option>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
            </div>
            <div class="row-btn">
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Salvar Produto</button>
            </div>
        </form>
    </div>
</main>