<main class="content">
    <header class="header-box">
        <h2 class="header-box-h"><?= (!$Adm ? 'Histórico de todos os recibos gerados pelo escritório' : 'Histórico de todos os recibos gerados pelo sistema') ?></h2>
        <div class="header-box-btn">
            <?php if ($Adm): ?>
                <select class="select-office">
                    <option class="clik-op" selected="" value="index">TODOS OS ESCRITÓRIOS</option>
                    <?php
                    $Read = new Read;
                    $Read->ExeRead("n_escritorios");
                    foreach ($Read->getResult() as $values):
                        extract($values);
                        ?>
                        <option  class="clik-op" value="<?= strtolower($nome_esc); ?>"><?= $nome_esc; ?></option>
                        <?php
                    endforeach;
                    ?>
                </select>
            <?php endif; ?>
<!--            <a class="btn-default btn-blue" href="?exe=taloes/create"><span class="lnr lnr-plus-circle"></span> Novo Talão</a>-->
        </div>
    </header>
    <div class="box">
        <table id="table-admin" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Escritório</th>
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
                    <th>Escritório</th>
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