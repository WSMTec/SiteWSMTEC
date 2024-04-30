<main class="content">
    <?php
    $Read = new Read;
    $IdN = filter_input(INPUT_GET, 'n', FILTER_DEFAULT);

    if ($Adm):
        $typ = explode('-', $IdN);
        $Id = (int) $typ[0];
        $Update = new Update;
        $TypeN = $typ[1];
        if ($TypeN === 't'):
            $Read->FullRead("SELECT * FROM n_notificacoes 
                              INNER JOIN n_contribuintes_tel ON id_tel = id_dup_not
                              INNER JOIN n_usuarios ON id_user = id_user_not
                              INNER JOIN n_contribuintes ON id_cont = id_cont_tel
                              WHERE id_not = :id", "id={$Id}");
        else:
            $Read->FullRead("SELECT * FROM n_notificacoes 
                              INNER JOIN n_contribuintes_end ON id_end = id_dup_not
                              INNER JOIN n_contribuintes ON id_cont = id_cont_end
                              INNER JOIN n_usuarios ON id_user = id_user_not
                              WHERE id_not = :id", "id={$Id}");
        endif;
        if (!$Read->getRowCount()):
            header('Location: painel.php');
            exit();
        endif;
        extract($Read->getResult()[0]);
        if ($status_not === "NL"):
            $Update->ExeUpdate("n_notificacoes", array("status_not" => "SL"), "WHERE id_not = :id", "id={$Id}");
        endif;
    else:
//        $Read->ExeRead("n_escritorios", "WHERE id_esc = :id", "id={$userlogin['id_esc_user']}");
//        $office = strtolower($Read->getResult()[0]['nome_esc']);
//        $idOffice = $Read->getResult()[0]['id_esc'];
    endif;
    ?>
    <header class="header-box">
        <h2 class="header-box-h"><?= (!$Adm ? "Notificações - {$type_not}" : "Notificações - {$type_not}") ?></h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=notificacoes/index"><span class="lnr lnr-list"></span> Notificações</a>
        </div>
    </header>
    <div class="box"> 
        <?php
        if ($TypeN === 't'):
            ?>
            <table id="" class="table-default" style="width:100%">
                <thead class="th-default">
                    <tr>
                        <th>Contribuinte</th>
                        <th>Tipo</th>
                        <th>Telefone</th>
                        <th>Ramal</th>
                        <th>Status</th>
                        <th>Data de cadastro</th>
                        <th>Data real</th>
                        <th>Usuário</th>
                    </tr>
                </thead>
                <tbody class="td-default"> 
                    <tr>
                        <td><?= $nome_cont; ?></td>
                        <td><?= $param_cont; ?></td>
                        <td><?= $fone_tel; ?></td>
                        <td><?= $ramal_tel; ?></td>
                        <td><?= $status_tel; ?></td>
                        <td><?= date("d/m/Y", strtotime($dta_cad_cont)); ?></td>
                        <td><?= date("d/m/Y", strtotime($date_real_cont)); ?></td>
                        <td style="display: flex;"><?= $usuario_user; ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;" colspan="8">
                            <button data-function="phone-delete" data-name="telefone" name="btn-delete[]" value="<?= $id_dup_not; ?>" type="button" class="btn-default btn-danger btn-table" style="font-size: 1em; text-transform: uppercase; font-weight: 500; padding: 0.3em 1em !important;"><span class="lnr lnr-trash"></span> Telefone</button>
                            <?php
                            if ($status_tel !== "A"):
                                ?>
                                <button id="btn-atv" data-function="phone-atv" data-name="telefone" name="phone-atv" value="<?= $id_dup_not; ?>" type="button" class="btn-default btn-green btn-table" style="font-size: 1em; text-transform: uppercase; font-weight: 500; padding: 0.3em 1em !important;"><span class="lnr lnr-thumbs-up"></span> Ativar</button>
                                <?php
                            endif;
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="header-box">
                <div class="btns-tal">
                    <span class='txt-label'>Semelhantes</span>
                </div>
            </div>        

            <table id="" class="table-default" style="width:100%">
                <tbody class="td-default">
                    <?php
                    $Read->FullRead("SELECT * FROM n_contribuintes_tel 
                            INNER JOIN n_contribuintes ON id_cont = id_cont_tel
                            INNER JOIN n_usuarios ON id_user = id_user_cont WHERE fone_tel = :fone AND id_tel != :id", "fone={$fone_tel}&id={$id_dup_not}");
                    foreach ($Read->getResult() as $v):
                        ?>
                        <tr>
                            <td><?= $v['nome_cont']; ?></td>
                            <td><?= $v['param_cont']; ?></td>
                            <td><?= $v['fone_tel']; ?></td>
                            <td><?= $v['ramal_tel']; ?></td>
                            <td><?= $v['status_tel']; ?></td>
                            <td><?= date("d/m/Y", strtotime($v['dta_cad_cont'])); ?></td>
                            <td><?= date("d/m/Y", strtotime($v['date_real_cont'])); ?></td>
                            <td style="display: flex;"><?= $v['usuario_user']; ?></td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </tbody>
                <tfoot class="th-default">
                    <tr>
                        <th>Contribuinte</th>
                        <th>Tipo</th>
                        <th>Telefone</th>
                        <th>Ramal</th>
                        <th>Status</th>
                        <th>Data de cadastro</th>
                        <th>Data real</th>
                        <th>Usuário</th>
                    </tr>
                </tfoot>
            </table>
            <?php
        else:
            ?>
            <table id="" class="table-default" style="width:100%">
                <thead class="th-default">
                    <tr>
                        <th>Contribuinte</th>
                        <th>Tipo</th>
                        <th>Data de cadastro</th>
                        <th>Data real</th>
                        <th>Rua</th>
                        <th>Numero</th>
                        <th>Complemento</th>
                        <th>Status</th>
                        <th>Usuário</th>
                    </tr>
                </thead>
                <tbody class="td-default"> 
                    <tr>
                        <td><?= $nome_cont; ?></td>
                        <td><?= $param_cont; ?></td>
                        <td><?= date("d/m/Y", strtotime($dta_cad_cont)); ?></td>
                        <td><?= date("d/m/Y", strtotime($date_real_cont)); ?></td>
                        <td><?= $rua_end; ?></td>
                        <td><?= $num_end; ?></td>
                        <td><?= $complemento_end; ?></td>
                        <td><?= $status_end; ?></td>
                        <td style="display: flex;"><?= $usuario_user; ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;" colspan="9">
                            <button data-function="address-delete" data-name="endereço" name="btn-delete[]" value="<?= $id_dup_not; ?>" type="button" class="btn-default btn-danger btn-table" style="font-size: 1em; text-transform: uppercase; font-weight: 500; padding: 0.3em 1em !important;"><span class="lnr lnr-trash"></span> Endereço</button>
                            <?php
                            if ($status_end !== "A"):
                                ?>
                                <button id="btn-atv" data-function="address-atv" data-name="endereço" name="address-atv" value="<?= $id_dup_not; ?>" type="button" class="btn-default btn-green btn-table" style="font-size: 1em; text-transform: uppercase; font-weight: 500; padding: 0.3em 1em !important;"><span class="lnr lnr-thumbs-up"></span> Ativar</button>
                                <?php
                            endif;
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="header-box">
                <div class="btns-tal">
                    <span class='txt-label'>Semelhantes</span>
                </div>
            </div>        

            <table id="" class="table-default" style="width:100%">
                <tbody class="td-default">
                    <?php
                    $Read->FullRead("SELECT * FROM n_contribuintes_end 
                            INNER JOIN n_contribuintes ON id_cont = id_cont_end
                            INNER JOIN n_usuarios ON id_user = id_user_cont WHERE rua_end = :end AND num_end = :num AND id_end != :id", "end={$rua_end}&num={$num_end}&id={$id_dup_not}");
                    foreach ($Read->getResult() as $v):
                        ?>
                        <tr>
                            <td><?= $v['nome_cont']; ?></td>
                            <td><?= $v['param_cont']; ?></td>
                            <td><?= date("d/m/Y", strtotime($v['dta_cad_cont'])); ?></td>
                            <td><?= date("d/m/Y", strtotime($v['date_real_cont'])); ?></td>
                            <td><?= $v['rua_end']; ?></td>
                            <td><?= $v['num_end']; ?></td>
                            <td><?= $v['complemento_end']; ?></td>
                            <td><?= $v['status_end']; ?></td>
                            <td style="display: flex;"><?= $v['usuario_user']; ?></td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </tbody>
                <tfoot class="th-default">
                    <tr>
                        <th>Contribuinte</th>
                        <th>Tipo</th>
                        <th>Data de cadastro</th>
                        <th>Data real</th>
                        <th>Rua</th>
                        <th>Numero</th>
                        <th>Complemento</th>
                        <th>Status</th>
                        <th>Usuário</th>
                    </tr>
                </tfoot>
            </table>
        <?php
        endif;
        ?>
    </div>
</main>