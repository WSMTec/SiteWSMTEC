<?php
if (!$Adm) :
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
        <form autocomplete="on" method="post" class="form-reports ts-grid">
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
                    $Read->FullRead("SELECT Rel.IdEmpresaRelatorio AS CodigoEmpresa,
                                Emp.NomeEmpresa AS RazaoSocial,
                                Rel.ConsultorRelatorio AS ConsultorTecnico,
                                Rel.ProjetoRelatorio AS Projeto,
                                Rel.CodigoRelatorio AS NroChamado,
                                Rel.DescServicoRelatorio AS DescricaoServico,
                                Rel.HInicioRelatorio AS HInicio,
                                Rel.HFimRelatorio AS HFinal,
                                Rel.HTotalRelatorio AS HTotal,
                                Rel.DataRelatorio AS DataAtendimento
                                FROM tb_relatorios AS Rel
                                JOIN tb_empresas AS Emp ON Rel.IdEmpresaRelatorio = Emp.IDEmpresa
                                WHERE Rel.DataRelatorio BETWEEN :ini AND :fim
                                GROUP BY Emp.NomeEmpresa 
                                ORDER BY Rel.IdEmpresaRelatorio, Rel.CodigoRelatorio", "ini={$post['HInicioRelatorio']}&fim={$post['HFimRelatorio']}");
                    echo " <h2>Todos os relatório por periodo</h2>";
                    ?>
                    <table cellspacing="1" border="1">
                        <colgroup width="126"></colgroup>
                        <colgroup width="156"></colgroup>
                        <colgroup width="367"></colgroup>
                        <colgroup width="80"></colgroup>
                        <colgroup width="114"></colgroup>
                        <colgroup width="112"></colgroup>
                        <colgroup width="129"></colgroup>
                        <tr>
                            <td rowspan="3" colspan="2" height="19" align="left" valign=bottom><font color="#000000">LOGO</font></td>
                            <td align="left" valign=bottom><font color="#000000">Relatório de Atendimento(Relatorio) - HelpDesk</font></td>
                            <td align="left" valign=bottom><font color="#000000"><br></font></td>
                            <td align="left" valign=bottom><font color="#000000"><br></font></td>
                            <td align="left" valign=bottom><font color="#000000"><br></font></td>
                            <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        </tr>
                        <tr>
                            <td align="left" valign=bottom><font color="#000000">Período de : 01/02/2019 a 28/02/2019</font></td>
                            <td align="left" valign=bottom><font color="#000000"><br></font></td>
                            <td align="left" valign=bottom><font color="#000000"><br></font></td>
                            <td align="left" valign=bottom><font color="#000000"><br></font></td>
                            <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        </tr>
                        <tr>
                            <td align="left" valign=bottom><font color="#000000">Seleção de Clientes : TODOS</font></td>
                            <td align="left" valign=bottom><font color="#000000"><br></font></td>
                            <td align="left" valign=bottom><font color="#000000"><br></font></td>
                            <td align="left" valign=bottom><font color="#000000"><br></font></td>
                            <td align="center" valign=bottom><font color="#000000">Pag: 01/01</font></td>
                        </tr>
                        <tr>
                            <td height="19" align="left" valign=bottom><font color="#000000"><br></font></td>
                            <td align="left" valign=bottom><font color="#000000"><br></font></td>
                            <td align="left" valign=bottom><font color="#000000"><br></font></td>
                            <td align="left" valign=bottom><font color="#000000"><br></font></td>
                            <td align="left" valign=bottom><font color="#000000"><br></font></td>
                            <td align="left" valign=bottom><font color="#000000"><br></font></td>
                            <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        </tr>
                        <?php
                        foreach ($Read->getResult() as $v):
                            extract($v);
                            ?>

                            <tr>
                                <td height="19" align="left" valign=bottom><font color="#000000">Razão Social :</font></td>
                                <td align="left" valign=bottom><b><font color="#000000">01 - <?= $RazaoSocial; ?></font></b></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                            </tr>
                            <tr>
                                <td height="19" align="left" valign=bottom><font color="#000000"><br></font></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                            </tr>
                            <tr>
                                <td height="19" align="left" valign=bottom><b><font color="#000000">Nro Chamado</font></b></td>
                                <td align="left" valign=bottom sdnum="1033;1033;MMM-YY"><b><font color="#000000">Contultor Técnico</font></b></td>
                                <td align="left" valign=bottom><b><font color="#000000">Descrição do Serviço</font></b></td>
                                <td align="left" valign=bottom><b><font color="#000000">Hora Inicio</font></b></td>
                                <td align="center" valign=bottom><b><font color="#000000">Hora Final</font></b></td>
                                <td align="left" valign=bottom><b><font color="#000000">Horas Aplicadas</font></b></td>
                                <td align="left" valign=bottom><b><font color="#000000">Data Atendimento</font></b></td>
                            </tr>
                            <tr>
                                <td height="19" align="left" valign=bottom sdnum="1033;1033;MMM-YY"><font color="#000000"><?= $NroChamado; ?></font></td>
                                <td align="left" valign=bottom><font color="#000000"><?= $ConsultorTecnico; ?></font></td>
                                <td align="left" valign=bottom><font color="#000000">Não imprime PDF</font></td>
                                <td align="right" valign=bottom sdval="0.583333333333333" sdnum="1033;1033;H:MM"><font color="#000000">14:00</font></td>
                                <td align="right" valign=bottom sdval="0.75" sdnum="1033;1033;H:MM"><font color="#000000">18:00</font></td>
                                <td align="right" valign=bottom sdval="0.166666666666667" sdnum="1033;1033;H:MM"><font color="#000000">4:00</font></td>
                                <td align="right" valign=bottom sdval="43524" sdnum="1033;1033;MM-DD-YY"><font color="#000000">02-28-19</font></td>
                            </tr>
                            <tr>
                                <td height="19" align="left" valign=bottom sdnum="1033;1033;MMM-YY"><font color="#000000">10/2019</font></td>
                                <td align="left" valign=bottom><font color="#000000">Wladimir</font></td>
                                <td align="left" valign=bottom><font color="#000000">Não imprime PDF</font></td>
                                <td align="right" valign=bottom sdval="0.583333333333333" sdnum="1033;1033;H:MM"><font color="#000000">14:00</font></td>
                                <td align="right" valign=bottom sdval="0.75" sdnum="1033;1033;H:MM"><font color="#000000">18:00</font></td>
                                <td align="right" valign=bottom sdval="0.166666666666667" sdnum="1033;1033;H:MM"><font color="#000000">4:00</font></td>
                                <td align="right" valign=bottom sdval="43524" sdnum="1033;1033;MM-DD-YY"><font color="#000000">02-28-19</font></td>
                            </tr>
                            <tr>
                                <td height="19" align="left" valign=bottom sdnum="1033;1033;MMM-YY"><font color="#000000">11/2019</font></td>
                                <td align="left" valign=bottom><font color="#000000">Wladimir</font></td>
                                <td align="left" valign=bottom><font color="#000000">Não imprime PDF</font></td>
                                <td align="right" valign=bottom sdval="0.583333333333333" sdnum="1033;1033;H:MM"><font color="#000000">14:00</font></td>
                                <td align="right" valign=bottom sdval="0.75" sdnum="1033;1033;H:MM"><font color="#000000">18:00</font></td>
                                <td align="right" valign=bottom sdval="0.166666666666667" sdnum="1033;1033;H:MM"><font color="#000000">4:00</font></td>
                                <td align="right" valign=bottom sdval="43524" sdnum="1033;1033;MM-DD-YY"><font color="#000000">02-28-19</font></td>
                            </tr>
                            <tr>
                                <td height="19" align="left" valign=bottom sdnum="1033;1033;MMM-YY"><font color="#000000">18/2019</font></td>
                                <td align="left" valign=bottom><font color="#000000">Wladimir</font></td>
                                <td align="left" valign=bottom><font color="#000000">Não imprime PDF</font></td>
                                <td align="right" valign=bottom sdval="0.583333333333333" sdnum="1033;1033;H:MM"><font color="#000000">14:00</font></td>
                                <td align="right" valign=bottom sdval="0.75" sdnum="1033;1033;H:MM"><font color="#000000">18:00</font></td>
                                <td align="right" valign=bottom sdval="0.166666666666667" sdnum="1033;1033;H:MM"><font color="#000000">4:00</font></td>
                                <td align="right" valign=bottom sdval="43524" sdnum="1033;1033;MM-DD-YY"><font color="#000000">02-28-19</font></td>
                            </tr>
                            <tr>
                                <td height="19" align="left" valign=bottom sdnum="1033;1033;MMM-YY"><font color="#000000">28/2019</font></td>
                                <td align="left" valign=bottom><font color="#000000">Wladimir</font></td>
                                <td align="left" valign=bottom><font color="#000000">Não imprime PDF</font></td>
                                <td align="right" valign=bottom sdval="0.583333333333333" sdnum="1033;1033;H:MM"><font color="#000000">14:00</font></td>
                                <td align="right" valign=bottom sdval="0.75" sdnum="1033;1033;H:MM"><font color="#000000">18:00</font></td>
                                <td align="right" valign=bottom sdval="0.166666666666667" sdnum="1033;1033;H:MM"><font color="#000000">4:00</font></td>
                                <td align="right" valign=bottom sdval="43524" sdnum="1033;1033;MM-DD-YY"><font color="#000000">02-28-19</font></td>
                            </tr>
                            <tr>
                                <td height="19" align="left" valign=bottom sdnum="1033;1033;MMM-YY"><font color="#000000">82/2019</font></td>
                                <td align="left" valign=bottom><font color="#000000">Wladimir</font></td>
                                <td align="left" valign=bottom><font color="#000000">Não imprime PDF</font></td>
                                <td align="right" valign=bottom sdval="0.583333333333333" sdnum="1033;1033;H:MM"><font color="#000000">14:00</font></td>
                                <td align="right" valign=bottom sdval="0.75" sdnum="1033;1033;H:MM"><font color="#000000">18:00</font></td>
                                <td align="right" valign=bottom sdval="0.166666666666667" sdnum="1033;1033;H:MM"><font color="#000000">4:00</font></td>
                                <td align="right" valign=bottom sdval="43524" sdnum="1033;1033;MM-DD-YY"><font color="#000000">02-28-19</font></td>
                            </tr>
                            <tr>
                                <td height="19" align="left" valign=bottom><font color="#000000"><br></font></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                            </tr>
                            <tr>
                                <td height="19" align="left" valign=bottom><font color="#000000"><br></font></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                                <td align="left" valign=bottom><font color="#000000">Total de atendimentos : 6</font></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                            </tr>

                            <?php
                        endforeach;
                        ?>
                    </table>
                    <?php
                else:
                    $Read->FullRead("SELECT Rel.IdEmpresaRelatorio AS CodigoEmpresa,
                                    Emp.NomeEmpresa AS RazaoSocial,
                                    Rel.ConsultorRelatorio AS ConsultorTecnico,
                                    Rel.ProjetoRelatorio AS Projeto,
                                    Rel.CodigoRelatorio AS NroChamado,
                                    Rel.DescServicoRelatorio AS DescricaoServico,
                                    Rel.HInicioRelatorio AS HInicio,
                                    Rel.HFimRelatorio AS HFinal,
                                    Rel.HTotalRelatorio AS HTotal,
                                    Rel.DataRelatorio AS DataAtendimento
                              FROM tb_relatorios AS Rel
                              JOIN tb_empresas AS Emp  ON Rel.IdEmpresaRelatorio = Emp.IDEmpresa
                              WHERE Rel.DataRelatorio BETWEEN :ini AND :fim
                              AND   Emp.IdEmpresa = :emp
                              ORDER BY Rel.IdEmpresaRelatorio, Rel.CodigoRelatorio", "ini={$post['HInicioRelatorio']}&fim={$post['HFimRelatorio']}&emp={$post['IdEmpresaRelatorio']}");
                    echo "<h2>Relatório por periodo de uma empresa</h2>";
                    foreach ($Read->getResult() as $v):
                        extract($v);
                        ?>
                        <p> <?= $NroChamado; ?> <hr></p>


                        <?php
                    endforeach;
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
