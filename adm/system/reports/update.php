<?php
if (!$Adm && !$Coord):
    header('Location: painel.php');
    exit();
endif;
?>
<main class="content">
    <?php
    $office = filter_input(INPUT_GET, "reports", FILTER_VALIDATE_INT);
    $Read = new Read;
    $Read->ExeRead("tb_relatorios", "WHERE IdRelatorio = :id", "id={$office}");
    ?>
    <header class="header-box">
        <h2 class="header-box-h">Editar relatório <?= $Read->getResult()[0]["ProjetoRelatorio"]; ?></h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=reports/index"><span class="lnr lnr-list"></span>  Relatórios</a>
        </div>
    </header>
    <?php
    extract($Read->getResult()[0]);
    ?>
    <div class="box content-box">
        <form id="form-reports-update" autocomplete="on" method="post" class="form-reports ts-grid" action="reports-update">
            <div class="row-m">
                <label>
                    Empresas
                </label>
                <?php
                $Read->FullRead("SELECT * FROM tb_empresas WHERE IdEmpresa = :id", "id={$IdEmpresaRelatorio}");
                $Nome = $Read->getResult()[0]['NomeEmpresa'];
                ?>
                <input disabled="" type="text" value="<?= $Nome; ?>"/>
                <input name="IdEmpresaRelatorio" type="hidden" value="<?= $IdEmpresaRelatorio; ?>"/>
            </div>
            <div class="row-m">
                <div class="row-m">
                    <label>
                        Consultor
                    </label>
                    <input class="inpt-null" name="ConsultorRelatorio" type="text" value="<?= $ConsultorRelatorio; ?>"/>
                </div>
                <div class="row-m">
                    <label>
                        Projetos
                    </label>
                    <input class="inpt-null" name="ProjetoRelatorio" type="text" value="<?= $ProjetoRelatorio; ?>"/>
                </div>
            </div>
            <div class="row-m">
                <label>
                    Fase(s)
                </label>
                <input class="inpt-null" name="FaseRelatorio" type="text" value="<?= $FaseRelatorio; ?>"/>
            </div>
            <div class="row-m">
                <label>
                    TS(*)
                </label>
                <input class="inpt-null" name="TsRelatorio" type="text" value="<?= $TsRelatorio; ?>"/>
            </div>
            <div class="row-f ts-row">
                <div class="row-f ts-range">
                    <div class="row-m">
                        <div class="row-m">
                            <label>
                                Hora Inicio
                            </label>
                            <input class="inpt-null ts-start" name="HInicioRelatorio" type="time" value="<?= $HInicioRelatorio; ?>"/>
                        </div>
                        <div class="row-m">
                            <label>
                                Hora Fim
                            </label>
                            <input class="inpt-null ts-end" name="HFimRelatorio" type="time" value="<?= $HFimRelatorio; ?>"/>
                        </div>
                    </div>
                    <div class="row-m">
                        <div class="row-m">
                            <label>
                                Total de Horas
                            </label>
                            <input class="inpt-null ts-sum" name="HTotalRelatorioText" type="text" value="<?= $HTotalRelatorioText; ?>"/>
                        </div>
                        <div class="row-m">
                            <label>
                                Módulos
                            </label>
                            <input class="inpt-null" name="FasesModulosRelatorio" type="text" value="<?= $FasesModulosRelatorio; ?>"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-f">
                <label>
                    Descrição do serviço
                </label>
                <textarea name="DescServicoRelatorio" class="inpt-null js_editor" style="border: 1px solid #aaa;"><?= $DescServicoRelatorio; ?></textarea>
            </div>
            <div class="row-f">
                <label>
                    Observação do cliente
                </label>
                <textarea name="ObsClienteRelatorio" class="inpt-null js_editor" style="border: 1px solid #aaa;"><?= $ObsClienteRelatorio; ?></textarea>
            </div>
            <div class="row-m">
                <div class="row-m">
                    <label>
                        Cliente Sponsor
                    </label>
                    <input class="inpt-null" name="ClienteSponsorRelatorio" type="text" value="<?= $ClienteSponsorRelatorio; ?>"/>
                </div>
                <div class="row-m">
                    <label>
                        Coordenador de projeto
                    </label>
                    <input class="inpt-null" name="CoordProjetoRelatorio" type="text" value="<?= $CoordProjetoRelatorio; ?>"/>
                </div>
            </div>
            <div class="row-m">
                <label>
                    Gerente de projeto
                </label>
                <input class="inpt-null" name="GerenteProjetoRelatorio" type="text" value="<?= $GerenteProjetoRelatorio; ?>"/>
            </div>
            <div id="new-row" class="row-f new-row">

            </div>

            <?php
            $Read->FullRead("SELECT * FROM tb_testemunhas WHERE IdRelatorio = :id", "id={$IdRelatorio}");
            foreach ($Read->getResult() as $v):
                ?>
                <div id="new-row" class="row-f new-row">
                    <div class="row-f">
                        <label>
                            Treinamento/Usuários
                        </label>
                        <input disabled="" value="<?= $v['NomeTes']; ?>" type="text"/>
                    </div>
                    <button data-function='training-delete' data-name='usuário' name='btn-modal[]' value='<?= $v['IdTes']; ?>' type='button' class='btn-default btn-danger btn-table'><span class="lnr lnr-cross"></span> Remover</button>
                </div>
                <?php
            endforeach;
            ?>

            <div class="row-btn">
                <input name="IdRelatorio" value="<?= $IdRelatorio; ?>" type="hidden"/>
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Atualizar Relatório</button>
                <button id="add-row-user" class="btn-default btn-clean" type="button"><span class="lnr lnr-plus-circle"></span> Treinamento/Usuários</button>
            </div>
        </form>
    </div>
</main>
