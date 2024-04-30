

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

            <div class="row-chart-ttl-ctb ck_ag">
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
    </div>
</main>