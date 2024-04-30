<?php
if (!$Adm && !$Coord):
    header('Location: painel.php');
    exit();
endif;
?>
<main class="content">
    <!--<div class="div-header">-->
    <header class="header-box">
        <h2 class="header-box-h">Gerencie todos os usuários do sistema</h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=users/create"><span class="lnr lnr-plus-circle"></span> Novo Usuário</a>
        </div>
    </header>

    <!--</div>-->
    <div class="box">
        <table id="table-users" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Empresa</th>
                    <th><span class="lnr lnr-user"></span> Usuário</th>
                    <th><span class="lnr lnr-envelope"></span> E-mail</th>
                    <th><span class="lnr lnr-menu-circle"></span> Nivel</th>
                    <th><span class="lnr lnr-apartment"></span> Departamento</th>
                    <th></th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>Empresa</th>
                    <th><span class="lnr lnr-user"></span> Usuário</th>
                    <th><span class="lnr lnr-envelope"></span> E-mail</th>
                    <th><span class="lnr lnr-menu-circle"></span> Nivel</th>
                    <th><span class="lnr lnr-apartment"></span> Departamento</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>

        <div class="box_mobile">
            <?php
            if (!$Coord) {
                $EmpCoord = "";
            } else {
                $EmpCoord = " AND IdEmpresa = '{$_SESSION['userlogin']['IdEmpresaUsuario']}'";
            }
            $Read = new Read;
            $Read->FullRead("SELECT tb_usuarios.*, tb_department.*, tb_empresas.NomeEmpresa, tb_empresas.IdEmpresa FROM tb_usuarios "
                    . "LEFT JOIN tb_empresas ON tb_empresas.IdEmpresa = tb_usuarios.IdEmpresaUsuario "
                    . "LEFT JOIN tb_department ON tb_department.dep_id = tb_usuarios.dep_id_user WHERE IdUsuario != :id AND nivel_user < :nivel {$EmpCoord}", "id={$_SESSION['userlogin']['IdUsuario']}&nivel=4");
            $Rows = $Read->getRowCount();
            $TotalRows = $Rows;

            foreach ($Read->getResult() as $dt):
                extract($dt);
                ?>
                <div class="bloco_mob" style="overflow: scroll;">
                    <div class="p_mob">
                        <?= $NomeEmpresa; ?>
                    </div>
                    <div class="s_mob">
                        <div style="flex-basis: 100%;">
                            <span><small>Nome:</small></span>
                            <span><?= $NomeUsuario; ?></span>
                        </div>
                        <!--                        <div style="    
                                                     display: flex;
                                                     width: 100%;
                                                     justify-content: space-between;">
                                                   
                                                </div>-->
                        <div style="flex-basis: 100%;">
                            <span><small>e-mail:</small></span>
                            <span><?= $EmailUsuario; ?></span>
                        </div>
                        <div style="flex-basis: 100%;">
                            <span><small>Nivel:</small></span>
                            <span><?= $NivelUsuario; ?></span>
                        </div>
                        <div style="flex-basis: 100%;">
                            <span><small>Departamento:</small></span>
                            <span><?= $dep_title; ?></span>
                        </div>
                        <!--                        <div>
                                                    <span><small>Hr Total:</small></span>
                                                    <span><?= $HTotalRelatorioText; ?></span>
                                                </div>-->
                    </div>
                    <div class="t_mob">

                    </div>
                    <div class="q_mob">
                        <div>
                            <button  name='btn-href[]' data-href='?exe=users/update&users=<?= $CompUser ?>' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-pencil'></span></button> 
                            <button name='btn-modal[]' data-function='user-delete' data-name='usuario' value='<?= $IdUsuario ?>' type='button' class='btn btn-danger btn-xs btn-rigth'><span class='lnr lnr-trash'></span></button>
                        </div>
                    </div>
                </div>
                <?php
            endforeach;
            ?>
        </div>
    </div>
</main>