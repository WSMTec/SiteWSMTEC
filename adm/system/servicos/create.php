<?php
if (!$Adm && !$Coord):
    header('Location: ../../painel.php');
    die;
endif;
?>
<main class="content">
    <!--<div class="div-header">-->
    <header class="header-box">
        <h2 class="header-box-h">Cadastro de serviços no sistema</h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=servicos/index"><span class="lnr lnr-list"></span>  Serviços</a>
        </div>
    </header>
    <!--</div>-->

    <div class="box content-box">
        <form id="form-servicos" method="post" class="form-servicos" action="servicos">
            <div class="row-m">
                <label>
                    <span class="lnr lnr-code"></span>  Código
                </label>
                <input class="inpt-null" name="CodServico" type="number"/>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-graduation-hat"></span>  Nome
                </label>
                <input class="inpt-null" name="NomeServico" type="text"/>
            </div>
            <div class="row-f">
                <label>
                    <span class="lnr lnr-text-align-left"></span>   Descrição
                </label>
                <textarea class="inpt-null" style="border: 1px solid #aaa;" name="DescServico"></textarea>
            </div>
            <div class="row-btn">
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Salvar serviço</button>
            </div>
        </form>
    </div>
</main>
