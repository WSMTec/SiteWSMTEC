<main class="content">
    <?php
    ?>
    <header class="header-box">
        <h2 class="header-box-h">Gerenciamento de Tickets</h2>
        <div class="header-box-btn">
            <?php if ($Adm) : ?>
                <a style="margin-right: 2%; color: #fff;" class="btn-default btn-warning" href="?exe=tickets/generate"><span class="lnr lnr-plus-circle"></span> Gerar Relatório de Tickets</a>
            <?php endif; ?>
            <a class="btn-default btn-blue" href="?exe=tickets/create"><span class="lnr lnr-plus-circle"></span> Novo Ticket</a>
        </div>
    </header>

    <?php
    $read = new Read;
    //    $chart = new Chart;
    ?>

    <div class="box content-box">
        <div class="box-chart">
            <div class="row-chart-ttl-ctb ck_t">
                <a href="?exe=tickets/index" style="text-decoration:none">
                <p>Todos:</p>
                <h1>
                    <?php
                    if ($Adm) :
                        $read->FullRead("SELECT count(*) as ttl FROM tb_tickets");
                    elseif ($Coord) :
                        $read->FullRead("SELECT count(*) as ttl FROM tb_tickets WHERE idempresatickets = '{$_SESSION['userlogin']['IdEmpresaUsuario']}'");
                    else :
                        $read->FullRead("SELECT count(*) as ttl FROM tb_tickets WHERE iduser = :u", "u={$userlogin['IdUsuario']}");
                    endif;

                    echo "{$read->getResult()[0]['ttl']}";
                    ?>
                </h1>
                </a>
            </div>

            <div class="row-chart-ttl-ctb ck_a">
                <a href="?exe=tickets/abt" style="text-decoration:none">
                <p>Abertos:</p>
                <h1>
                    <?php
                    if ($Adm) :
                        $read->FullRead("SELECT count(*) as ttl FROM tb_tickets WHERE status = 'ABERTO' OR status = 'AGUARDANDO'");
                    elseif ($Coord) :
                        $read->FullRead("SELECT count(*) as ttl FROM tb_tickets WHERE status = 'ABERTO' OR status = 'AGUARDANDO' AND idempresatickets = '{$_SESSION['userlogin']['IdEmpresaUsuario']}'");
                    else :
                        $read->FullRead("SELECT count(*) as ttl FROM tb_tickets WHERE status = 'ABERTO' AND iduser = :u", "u={$userlogin['IdUsuario']}");
                    endif;

                    echo "{$read->getResult()[0]['ttl']}";
                    ?>
                </h1>
                </a>
            </div>

            <div class="row-chart-ttl-ctb ck_p">
                <a href="?exe=tickets/pdt" style="text-decoration:none">
                <p>Pendentes:</p>
                <h1>
                    <?php
                    if ($Adm) :
                        $read->FullRead("SELECT count(*) as ttl FROM tb_tickets WHERE status = 'PENDENTE'");
                    elseif ($Coord) :
                        $read->FullRead("SELECT count(*) as ttl FROM tb_tickets WHERE status = 'PENDENTE' AND idempresatickets = '{$_SESSION['userlogin']['IdEmpresaUsuario']}'");
                    else :
                        $read->FullRead("SELECT count(*) as ttl FROM tb_tickets WHERE status = 'PENDENTE' AND iduser = :u", "u={$userlogin['IdUsuario']}");
                    endif;

                    echo "{$read->getResult()[0]['ttl']}";
                    ?>
                </h1>
                </a>
            </div>

            <div class="row-chart-ttl-ctb ck_ag active_tic">
                <a href="?exe=tickets/agd" style="text-decoration:none">
                <p>Aguardando:</p>
                <h1>
                    <?php
                    if ($Adm) :
                        $read->FullRead("SELECT count(*) as ttl FROM tb_tickets WHERE status = 'AGUARDANDO'");
                    elseif ($Coord) :
                        $read->FullRead("SELECT count(*) as ttl FROM tb_tickets WHERE status = 'AGUARDANDO' AND idempresatickets = '{$_SESSION['userlogin']['IdEmpresaUsuario']}'");
                    else :
                        $read->FullRead("SELECT count(*) as ttl FROM tb_tickets WHERE status = 'AGUARDANDO' AND iduser = :u", "u={$userlogin['IdUsuario']}");
                    endif;

                    echo "{$read->getResult()[0]['ttl']}";
                    ?>
                </h1>
                </a>
            </div>

            <div class="row-chart-ttl-ctb fnlz ck_f">
                <a href="?exe=tickets/fnd" style="text-decoration:none">
                <p>Finalizados:</p>
                <h1>
                    <?php
                    if ($Adm) :
                        $read->FullRead("SELECT count(*) as ttl FROM tb_tickets WHERE status = 'FINALIZADO'");
                    elseif ($Coord) :
                        $read->FullRead("SELECT count(*) as ttl FROM tb_tickets WHERE status = 'FINALIZADO' AND idempresatickets = '{$_SESSION['userlogin']['IdEmpresaUsuario']}'");
                    else :
                        $read->FullRead("SELECT count(*) as ttl FROM tb_tickets WHERE status = 'FINALIZADO' AND iduser = :u", "u={$userlogin['IdUsuario']}");
                    endif;

                    echo "{$read->getResult()[0]['ttl']}";
                    ?>
                </h1>
                </a>
            </div>
        </div>
    </div>


    <div class="box">
        <table id="table-tickets" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Empresa</th>
                    <th><span class="lnr lnr-user"></span> Usuário</th>
                    <th><span class="lnr lnr-calendar-full"></span> Data</th>
                    <th><span class="lnr lnr-bubble"></span> Assunto</th>
                    <th><span class="lnr lnr-star"></span> Status</th>
                    <th><span class="lnr lnr-flag"></span> Prioridade</th>
                    <th><span class="lnr lnr-code"></span> Código</th>
                    <th></th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>Empresa</th>
                    <th><span class="lnr lnr-user"></span> Usuário</th>
                    <th><span class="lnr lnr-calendar-full"></span> Data</th>
                    <th><span class="lnr lnr-bubble"></span> Assunto</th>
                    <th><span class="lnr lnr-star"></span> Status</th>
                    <th><span class="lnr lnr-flag"></span> Prioridade</th>
                    <th><span class="lnr lnr-code"></span> Código</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>

        <div class="box_mobile">
            <?php
            if (!$Coord) {
                $EmpCoord = " ";
            } else {
                $EmpCoord = " WHERE tb_empresas.IdEmpresa = '{$_SESSION['userlogin']['IdEmpresaUsuario']}'";
            }
            $Read = new Read;

            if ($Adm || $Coord) :
                $Read->FullRead("SELECT *, NomeEmpresa, NomeUsuario FROM tb_tickets
INNER JOIN tb_usuarios ON tb_usuarios.IdUsuario = tb_tickets.iduser
INNER JOIN tb_empresas ON tb_empresas.IdEmpresa = tb_tickets.idempresatickets 
INNER JOIN tb_mensagens ON tb_mensagens.idticket = tb_tickets.id {$EmpCoord} GROUP BY id ORDER BY tb_tickets.data DESC");
                $Rows = $Read->getRowCount();
            else :
                $Read->FullRead("SELECT *, NomeEmpresa, NomeUsuario FROM tb_tickets
INNER JOIN tb_usuarios ON tb_usuarios.IdUsuario = tb_tickets.iduser
INNER JOIN tb_empresas ON tb_empresas.IdEmpresa = tb_tickets.idempresatickets WHERE iduser = :u ORDER BY tb_tickets.data DESC", "u={$_SESSION['userlogin']['IdUsuario']}");
                $Rows = $Read->getRowCount();
            endif;

            $TotalRows = $Rows;

            foreach ($Read->getResult() as $dt) :
                extract($dt);
                if ($_SESSION['userlogin']['nivel_user'] >= 3 && $status == "PENDENTE") :
                    $btns = "<div>
            <button name='btn-href[]' data-href='?exe=tickets/room&ticket={$id}' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-enter'></span></button>
                <button name='btn-modal[]' data-function='tickets-active' data-name='tickets' value='{$id}' type='button' class='btn btn-success btn-xs btn-rigth'><span class='lnr lnr-history'></span></button>
                </div>";
                elseif ($status == "FINALIZADO") :
                    $btns = "<div>
                <button name='btn-href[]' data-href='?exe=tickets/room&ticket={$id}' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-enter'></span></button> 
                </div>";
                else :
                    $btns = "<div>
                <button name='btn-href[]' data-href='?exe=tickets/room&ticket={$id}' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-enter'></span></button> 
                <button name='btn-modal[]' data-function='tickets-finalize' data-name='tickets' value='{$id}' type='button' class='btn btn-danger btn-xs btn-rigth'><span class='lnr lnr-power-switch'></span></button>
                </div>";
                endif;
                if ($_SESSION['userlogin']['nivel_user'] >= 3 && $statusmsg === 'N' && $remetente !== $_SESSION['userlogin']['IdUsuario']) :
                    $ass = "<b>{$assunto}</b>";
                else :
                    $ass = $assunto;
                endif;
            ?>
                <div class="bloco_mob">
                    <div class="p_mob">
                        <?= $NomeEmpresa; ?>
                    </div>
                    <div class="s_mob">
                        <div style="flex-basis: 100%;">
                            <span><small>Usuário:</small></span>
                            <span><?= $NomeUsuario; ?></span>
                        </div>
                        <div style="    
                             display: flex;
                             width: 100%;
                             justify-content: space-between;">
                            <div>
                                <span><small>Data:</small></span>
                                <span><?= date("d/m/Y H:i", strtotime($datainicio)); ?></span>
                            </div>
                            <div>
                                <span><small>Código:</small></span>
                                <span><?= $codigo; ?></span>
                            </div>
                        </div>
                        <div style="flex-basis: 100%;">
                            <span><small>Assunto:</small></span>
                            <span><?= $ass; ?></span>
                        </div>
                        <div>
                            <span><small>Status:</small></span>
                            <span><?= $status; ?></span>
                        </div>
                    </div>
                    <div class="t_mob">

                    </div>
                    <div class="q_mob">
                        <?= $btns; ?>
                    </div>
                </div>
            <?php
            endforeach;
            ?>
        </div>
    </div>
</main>