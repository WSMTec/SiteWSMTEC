<?phpif (!$Adm && !$Coord):    header('Location: painel.php');    exit();endif;?><main class="content">    <!--<div class="div-header">-->    <header class="header-box">        <h2 class="header-box-h">Gerencie todos os departamentos das empresas</h2>        <div class="header-box-btn">            <a class="btn-default btn-blue" href="?exe=department/create"><span class="lnr lnr-plus-circle"></span> Novo Departamento</a>        </div>    </header>    <!--</div>-->    <div class="box">        <table id="table-department" class="table table-striped table-bordered" style="width:100%">            <thead>                <tr>                    <th>Empresa</th>                    <th><span class="lnr lnr-apartment"></span> Nome</th>                    <th><span class="lnr lnr-text-align-left"></span> Descrição</th>                    <th></th>                </tr>            </thead>            <tfoot>                <tr>                    <th>Empresa</th>                    <th><span class="lnr lnr-apartment"></span> Nome</th>                    <th><span class="lnr lnr-text-align-left"></span> Descrição</th>                    <th></th>                </tr>            </tfoot>        </table>        <div class="box_mobile">            <?php            if (!$Coord) {                $EmpCoord = "";            } else {                $EmpCoord = " AND IdEmpresa = '{$_SESSION['userlogin']['IdEmpresaUsuario']}'";            }//var_dump($Coord, $EmpCoord, $_SESSION['userlogin']['nivel_user']);            $Read = new Read;            $Read->FullRead("SELECT tb_department.*, tb_empresas.NomeEmpresa, tb_empresas.IdEmpresa FROM tb_department "                    . "INNER JOIN tb_empresas ON tb_empresas.IdEmpresa = tb_department.dep_id_companies WHERE dep_status = 'A' {$EmpCoord}");            $Rows = $Read->getRowCount();            $TotalRows = $Rows;            foreach ($Read->getResult() as $dt):                extract($dt);                ?>                <div class="bloco_mob">                    <div class="p_mob">                        <?= $NomeEmpresa; ?>                    </div>                    <div class="s_mob">                        <div style="flex-basis: 100%;">                            <span><small>Nome:</small></span>                            <span><?= $dep_title; ?></span>                        </div>                        <!--                        <div style="                                                         display: flex;                                                     width: 100%;                                                     justify-content: space-between;">                                                    <div>                                                        <span><small>Data:</small></span>                                                        <span><?= date("d/m/Y", strtotime($DataRelatorio)); ?></span>                                                    </div>                                                    <div>                                                        <span><small>Código:</small></span>                                                        <span><?= $CodigoRelatorio; ?></span>                                                    </div>                                                </div>-->                        <div style="flex-basis: 100%;">                            <span><small>Descrição:</small></span>                            <span><?= $dep_description; ?></span>                        </div>                    </div>                    <div class="t_mob">                    </div>                    <div class="q_mob">                        <div style="display: flex; ">                            <button style="margin-right: 3%;" name='btn-href[]' data-href='?exe=department/update&department=<?php $dep_id ?>-<?php $IdEmpresa ?>' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-pencil'></span></button>                            <button name='btn-modal[]' data-function='department-delete' data-name='departamento' value='<?php $dep_id ?>' type='button' class='btn btn-danger btn-xs btn-rigth'><span class='lnr lnr-trash'></span></button>                        </div>                    </div>                </div>                <?php            endforeach;            ?>        </div>    </div></main>