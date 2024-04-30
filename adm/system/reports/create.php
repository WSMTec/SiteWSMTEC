<?php
if (!$Adm && !$Coord):
    header('Location: ../../painel.php');
    die;
endif;
?>
<main class="content">
    <!--<div class="div-header">-->
    <header class="header-box">
        <h2 class="header-box-h">Cadastro de relatórios no sistema</h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=reports/index"><span class="lnr lnr-list"></span>  Relatórios</a>
        </div>
    </header>
    <!--</div>-->

    <div class="box content-box">
        <form id="form-reports" autocomplete="on" method="post" class="form-reports ts-grid" action="reports">
            <?php
            if ($Adm):
                ?>
                <div class="row-m">
                    <label>
                        Empresas
                    </label>
                    <select class="inpt-null" name="IdEmpresaRelatorio">
                        <option></option>
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
                            Consultor
                        </label>
                        <input class="inpt-null" name="ConsultorRelatorio" type="text"/>
                    </div>
                    <div class="row-m">
                        <label>
                            Projetos
                        </label>
                        <input class="inpt-null" name="ProjetoRelatorio" type="text"/>
                    </div>
                </div>
                <?php
            elseif ($Coord):
                ?>
                <input name="IdEmpresaRelatorio" type="hidden" value="<?= $_SESSION['userlogin']['IdEmpresaUsuario']; ?>"/>
                <div class="row-m">
                    <label>
                        Consultor
                    </label>
                    <input class="inpt-null" name="ConsultorRelatorio" type="text"/>
                </div>
                <div class="row-m">
                    <label>
                        Projetos
                    </label>
                    <input class="inpt-null" name="ProjetoRelatorio" type="text"/>
                </div>
                <?php
            endif;
            ?>

            <div class="row-m">
                <label>
                    Fase(s)
                </label>
                <input class="inpt-null" name="FaseRelatorio" type="text"/>
            </div>
            <div class="row-m">
                <label>
                    TS(*)
                </label>
                <input class="inpt-null" name="TsRelatorio" type="text"/>
            </div>
            <div class="row-f">
                <label>
                    Serviços
                </label>
                <div class="ts_services">
                    <?php
                    $Read->ExeRead("tb_servicos");
                    $Col = 2;
                    $Count = ceil($Read->getRowCount() / $Col);

                    $li = "<ul>";
                    $i = 0;
                    foreach ($Read->getResult() as $item):
                        if ($i == $Count) {
                            $li .= '</ul><ul>';
                            $i = 0;
                        }
                        $li .= "<li>{$item['CodServico']} - {$item['NomeServico']}</li>";
                        $i++;
                    endforeach;
                    $li .= "<ul>";
                    echo $li;
                    ?>
                </div>
            </div>
            <div class="row-f ts-row">
                <div class="row-f ts-range">
                    <div class="row-m">
                        <div class="row-m">
                            <label>
                                Hora Inicio
                            </label>
                            <input class="inpt-null ts-start" name="HInicioRelatorio" type="time"/>
                        </div>
                        <div class="row-m">
                            <label>
                                Hora Fim
                            </label>
                            <input class="inpt-null ts-end" name="HFimRelatorio" type="time"/>
                        </div>
                    </div>
                    <div class="row-m">
                        <div class="row-m">
                            <label>
                                Total de Horas
                            </label>
                            <input class="inpt-null ts-sum" name="HTotalRelatorioText" type="text"/>
                        </div>
                        <div class="row-m">
                            <label>
                                Módulos
                            </label>
                            <input class="inpt-null" name="FasesModulosRelatorio" type="text"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-f">
                <label>
                    Descrição do serviço
                </label>
                <textarea name="DescServicoRelatorio" class="inpt-null js_editor" style="border: 1px solid #aaa;"></textarea>
            </div>
            <div class="row-f">
                <label>
                    Observação do cliente
                </label>
                <textarea name="ObsClienteRelatorio" class="inpt-null js_editor" style="border: 1px solid #aaa;"></textarea>
            </div>
            <div class="row-m">
                <div class="row-m">
                    <label>
                        Cliente Sponsor
                    </label>
                    <input class="inpt-null" name="ClienteSponsorRelatorio" type="text"/>
                </div>
                <div class="row-m">
                    <label>
                        Coordenador de projeto
                    </label>
                    <input class="inpt-null" name="CoordProjetoRelatorio" type="text" />
                </div>
            </div>
            <div class="row-m">
                <label>
                    Gerente de projeto
                </label>
                <input class="inpt-null" name="GerenteProjetoRelatorio" type="text"/>
            </div>
            <div id="new-row" class="row-f new-row">

            </div>

            <div class="row-btn">
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Salvar Relatório</button>
                <button id="add-row-user" class="btn-default btn-clean" type="button"><span class="lnr lnr-plus-circle"></span> Treinamento/Usuários</button>
            </div>
        </form>
    </div>
</main>
