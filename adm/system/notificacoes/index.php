<?php
if (!$Adm):
    header('Location: painel.php');
    exit();
endif;
?>
<main class="content">
    <header class="header-box">
        <h2 class="header-box-h"><?= (!$Adm ? 'Notificações ' : 'Notificações') ?></h2>
    </header>
    <div class="box">
        <table id="" class="table-default" style="width:100%">
            <thead class="th-default">
                <tr>
                    <th>Mensagem</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Usuário</th>
                    <th>Tipo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="td-default"> 
                <?php
                $Read = new Read;
                $Read->FullRead("SELECT * FROM n_notificacoes INNER JOIN n_usuarios ON id_user = id_user_not WHERE destiny_name = 'ADM' ORDER BY date_not DESC");
                foreach ($Read->getResult() as $values):
                    extract($values);
                    ?>
                    <tr>
                        <td><?= $type_not; ?></td>
                        <td><?= $status_not === "NL" ? "Aguardando" : "Visto"; ?></td>
                        <td><?= date("d/m/Y H:i", strtotime($date_not)); ?></td>
                        <td><?= $usuario_user; ?></td>
                        <td><?= $type_num_not == 1 ? "Telefone" : "Endereço"; ?></td>
                        <td> 
                            <a class="btn btn-primary btn-xs btn-left" href='?exe=notificacoes/escritorio&n=<?= $id_not; ?>-<?= $type_num_not == 1 ? "t" : "e"; ?>'><span class="lnr lnr-eye"></span></a>
                        </td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </tbody>
            <tfoot class="th-default">
                <tr>
                    <th>Mensagem</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Usuário</th>
                    <th>Tipo</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</main>