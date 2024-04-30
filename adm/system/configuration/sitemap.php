<?php
$Read = new Read;
?>
<main class="content">
    <!--<div class="div-header">-->
    <header class="header-box">
        <h2 class="header-box-h">Sitemap</h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue btn-rigth" style="margin-right: 2%;" href="?exe=configuration/create"><span class="lnr lnr-list"></span>  Adicionar Url</a>
           <!--  <a class="btn-default btn-green btn-left" href="?exe=configuration/gerar"><span class="lnr lnr-list"></span>  Gerar e enviar</a>-->
        </div>
    </header>
    <!--</div>-->
    <div class="box content-box">
        <small>Pagina estática</small>
        <?php
        $Read->FullRead("SELECT * FROM tb_sitemap");
        foreach ($Read->getResult() as $it) {
            ?>
            <div class="row-f">
                <label>
                    <a href="<?= HOME . $it['page_name']; ?>" target="_blank">   <?= HOME . $it['page_name']; ?></a><br/>
                    <button name='btn-modal[]' data-function='sitemap-delete' value='<?= $it['page_id']; ?>' type='button' class='' style="font-size: 0.8em;
    background-color: #555;
    color: #fff;
    padding: 0.2em 0.8em;
    border-radius: 5px;
    border: none;">Excluir</button>
                </label>
            </div>
            <?php
        }
        ?>
        <small>Serviços</small>
        <?php
        $Read->FullRead("SELECT * FROM tb_services");
        foreach ($Read->getResult() as $it) {
            ?>
            <div class="row-f">
                <label>
                    <a href="<?= HOME . "/servico/" . $it['serv_name']; ?>" target="_blank">  <?= HOME . "/servico/" . $it['serv_name']; ?></a>
                </label>
            </div>
            <?php
        }
        ?>
        <small>Produtos</small>
        <?php
        $Read->FullRead("SELECT * FROM tb_product");
        foreach ($Read->getResult() as $it) {
            ?>
            <div class="row-f">
                <label>
                    <a href="<?= HOME . "/produto/" . $it['prod_name']; ?>" target="_blank">  <?= HOME . "/produto/" . $it['prod_name']; ?></a>
                </label>
            </div>
            <?php
        }
        ?>
        <small>Artigos</small>
        <?php
        $Read->FullRead("SELECT * FROM ws_posts WHERE post_status = '1'");
        foreach ($Read->getResult() as $it) {
            ?>
            <div class="row-f">
                <label>
                    <a href="<?= HOME . "/artigo/" . $it['post_name']; ?>" target="_blank"> <?= HOME . "/artigo/" . $it['post_name']; ?></a>
                </label>
            </div>
            <?php
        }
        ?>
    </div>
</main>
