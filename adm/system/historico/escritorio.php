<?php
if (!$Adm):
    header('Location: painel.php');
    exit();
endif;
?>
<main class="content">
    <?php
    $office = filter_input(INPUT_GET, 'e', FILTER_DEFAULT);
    $Read = new Read;
    $Read->ExeRead("n_escritorios");
    if (!$Read->getResult()):
        WSErro("Escritório não encontrado!", WS_ERROR);
    endif;
    ?>
    <header class="header-box">
        <h2 class="header-box-h">Histórico de recibos do escritório <?= $office; ?></h2>
        <div class="header-box-btn">
            <select class="select-office">
                <option class="clik-op" value="index">TODOS OS ESCRITÓRIOS</option> 
                <?php
                foreach ($Read->getResult() as $values):
                    extract($values);
                    ?>
                    <option <?= strtoupper($office) == $nome_esc ? "selected=''" : ""; ?> class="clik-op" value="<?= strtolower($nome_esc); ?>"><?= $nome_esc; ?></option>
                    <?php
                endforeach;
                ?>
            </select>
            <!--<a class="btn-default btn-blue" href="?exe=taloes/create"><span class="lnr lnr-plus-circle"></span> Novo Talão</a>-->
        </div>
    </header>
    <div class="box">
        <table id="<?= $office; ?>" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Data</th>
                    <th>Funcionário</th>
                    <th>Entregador</th>
                    <th>Status</th>
                    <th>Valor</th>
                    <!--<th></th>-->
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Data</th>
                    <th>Funcionário</th>
                    <th>Entregador</th>
                    <th>Status</th>
                    <th>Valor</th>
                    <!--<th></th>-->
                </tr>
            </tfoot>
        </table>
    </div>
</main>