<?php
if (!$Adm):
    header('Location: ../../painel.php');
    die;
endif;
?>
<main class="content">
    <!--<div class="div-header">-->
    <header class="header-box">
        <h2 class="header-box-h">Gerar relatórios personalizados</h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=reports/index"><span class="lnr lnr-list"></span>  Relatórios</a>
        </div>
    </header>
    <!--</div>-->

    <div class="box content-box">
        <form autocomplete="on" method="post" action="print.php?report=true" target="_blank" class="form-reports ts-grid">
            <div class="row-m">
                <label>
                    Empresas
                </label>
                <select required="" class="inpt-null" name="IdEmpresaRelatorio">
                    <option></option>
                    <option value="todos">Todos</option>
                    <?php
                    $Read = new Read;
                    $Read->ExeRead("tb_empresas");
                    foreach ($Read->getResult() as $v):
                        extract($v);
                        ?>
                        <option value="<?= $IdEmpresa; ?>"><?= $NomeEmpresa; ?></option>
                        <?php
                    endforeach;
                    ?>
                </select>
            </div>
            <div class="row-m">
                <div class="row-m">
                    <label>
                        Data Inicio
                    </label>
                    <input required="" class="inpt-null" name="HInicioRelatorio" type="date"/>
                </div>
                <div class="row-m">
                    <label>
                        Data Fim
                    </label>
                    <input required="" class="inpt-null" name="HFimRelatorio" type="date"/>
                </div>
            </div>


            <div class="row-btn">
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Gerar Relatório</button>
            </div>
        </form>

        <div class="content-box">
            <?php
            $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if ($post):
                if ($post['IdEmpresaRelatorio'] == 'todos'):
                    $Read->FullRead(""
                            . "SELECT *
                            FROM tb_empresas 
                            JOIN tb_relatorios ON IdEmpresaRelatorio = IDEmpresa
                            WHERE DataRelatorio BETWEEN :ini AND :fim
                            GROUP BY NomeEmpresa ORDER BY IdEmpresaRelatorio, CodigoRelatorio", "ini={$post['HInicioRelatorio']}&fim={$post['HFimRelatorio']}");
                    echo " <h2>Todos os relatório por periodo</h2>";
                    ?>
                    <table border="1" style="width: 100%;" class="table_print">
                        <thead>
                        <th colspan="2" rowspan="4">
                            <img src="images/logo_med.png" width="180"/>
                        </th>
                        <th colspan="6" rowspan="4">
                            Relatório de Atendimento(Relatorio) - HelpDesk <br/>
                            Período de : <?= $post['HInicioRelatorio']; ?> a <?= $post['HFimRelatorio']; ?>  <br/>
                            Seleção de Clientes : TODOS <br/>
                        </th>
                        </thead>
                        <?php
                        foreach ($Read->getResult() as $v):
                            extract($v);
                            ?>
                            <tr>
                                <td colspan="2" rowspan="1">Razão Social :</td>
                                <th colspan="6" rowspan="1"><?= $NomeEmpresa; ?></th>
                            </tr>
                            <tr>
                                <th colspan="1">Nro Chamado</th>
                                <th colspan="1">Consultor Técnico</th>
                                <th colspan="2">Descrição do Serviço</th>
                                <th colspan="1">Hora Inicio</th>
                                <th colspan="1">Hora Final</th>
                                <th colspan="1">Horas Aplicadas</th>
                                <th colspan="1">Data Atendimento</th>
                            </tr>
                            <?php
                            $Read->FullRead("SELECT *
                            FROM tb_relatorios 
                            WHERE DataRelatorio BETWEEN :ini AND :fim AND IdEmpresaRelatorio = :id
                            ORDER BY DataRelatorio ASC", "ini={$post['HInicioRelatorio']}&fim={$post['HFimRelatorio']}&id={$IdEmpresa}");
                            $r = $Read->getRowCount();
                            foreach ($Read->getResult() as $x):
//                                extract($v);
                                ?>
                                <tr>
                                    <td colspan="1"><?= $x['CodigoRelatorio']; ?></td>
                                    <td colspan="1"><?= $x['ConsultorRelatorio']; ?></td>
                                    <td colspan="2"><?= $x['DescServicoRelatorio']; ?></td>
                                    <td colspan="1"><?= $x['HInicioRelatorio']; ?></td>
                                    <td colspan="1"><?= $x['HFimRelatorio']; ?></td>
                                    <td colspan="1"><?= $x['HTotalRelatorio']; ?></td>
                                    <td colspan="1"><?= $x['DataRelatorio']; ?></td>
                                </tr>
                                <?php
                            endforeach;
                            ?>
                            <tr>
                                <td colspan="8" rowspan="1"><br></td>
                            </tr>
                            <tr>
                                <td colspan="4" rowspan="1"></td>
                                <td colspan="4" rowspan="1">Total de atendimentos : <?= $r; ?></td>
                            </tr>
                            <tr>
                                <td colspan="8" rowspan="1"><br></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </table>
                    <?php
                else:
                    $Read->FullRead("SELECT * FROM tb_empresas WHERE IdEmpresa = :id", "id={$post['IdEmpresaRelatorio']}");
                    echo " <h2>Relatório de uma empresa por periodo</h2>";
                    ?>
                    <table border="1" style="width: 100%;" class="table_print">
                        <thead>
                        <th colspan="2" rowspan="4">
                            <img src="images/logo_med.png" width="180"/>
                        </th>
                        <th colspan="6" rowspan="4">
                            Relatório de Atendimento(Relatorio) - HelpDesk <br/>
                            Período de : <?= $post['HInicioRelatorio']; ?> a <?= $post['HFimRelatorio']; ?>  <br/>
                            Seleção de Clientes : <?= $Read->getResult()[0]['NomeEmpresa']; ?> <br/>
                        </th>
                        </thead>
                        <?php
                        foreach ($Read->getResult() as $v):
                            extract($v);
                            ?>
                            <tr>
                                <td colspan="2" rowspan="1">Razão Social :</td>
                                <th colspan="6" rowspan="1"><?= $NomeEmpresa; ?></th>
                            </tr>
                            <tr>
                                <th colspan="1">Nro Chamado</th>
                                <th colspan="1">Consultor Técnico</th>
                                <th colspan="2">Descrição do Serviço</th>
                                <th colspan="1">Hora Inicio</th>
                                <th colspan="1">Hora Final</th>
                                <th colspan="1">Horas Aplicadas</th>
                                <th colspan="1">Data Atendimento</th>
                            </tr>
                            <?php
                            $Read->FullRead("
                            SELECT * FROM tb_relatorios 
                            WHERE DataRelatorio BETWEEN :ini AND :fim AND IdEmpresaRelatorio = :id
                            ORDER BY DataRelatorio ASC", "ini={$post['HInicioRelatorio']}&fim={$post['HFimRelatorio']}&id={$post['IdEmpresaRelatorio']}");
                            $r = $Read->getRowCount();
                            foreach ($Read->getResult() as $x):
                                ?>
                                <tr>
                                    <td colspan="1"><?= $x['CodigoRelatorio']; ?></td>
                                    <td colspan="1"><?= $x['ConsultorRelatorio']; ?></td>
                                    <td colspan="2"><?= $x['DescServicoRelatorio']; ?></td>
                                    <td colspan="1"><?= $x['HInicioRelatorio']; ?></td>
                                    <td colspan="1"><?= $x['HFimRelatorio']; ?></td>
                                    <td colspan="1"><?= $x['HTotalRelatorio']; ?></td>
                                    <td colspan="1"><?= $x['DataRelatorio']; ?></td>
                                </tr>
                                <?php
                            endforeach;
                            ?>
                            <tr>
                                <td colspan="8" rowspan="1"><br></td>
                            </tr>
                            <tr>
                                <td colspan="4" rowspan="1"></td>
                                <td colspan="4" rowspan="1">Total de atendimentos : <?= $r; ?></td>
                            </tr>
                            <tr>
                                <td colspan="8" rowspan="1"><br></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </table>
                <?php
                endif;
            endif;
            ?>
        </div>


<!--        <table summary="A nossa loja, Metal & Cia,  oferece uma grande variedade de instrumentos semi-novos em ótimo estado de conservação">
            <caption>Catálogo da Metal & Cia</caption>
            <thead>
                <tr><th colspan="4">Tabela de preços</th></tr>
            </thead>
            <tfoot>
                <tr><td colspan="4">Visite nossa loja</td></tr>
            </tfoot>
            <tbody>
                <tr>
                    <td rowspan="2"> Seminovos</td>
                    <td>Trompete</td>
                    <td>Trombone</td>
                    <td>Trompa</td>
                </tr>
                <tr>
                    <td>$500</td>
                    <td>$640</td>
                    <td>$650</td>
                </tr>
            </tbody>
        </table>-->

    </div>
</main>
