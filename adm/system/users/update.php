<?php
if (!$Adm && !$Coord):
    header('Location: painel.php');
    exit();
endif;
?>
<main class="content">
    <?php
    $getOffice = filter_input(INPUT_GET, "users", FILTER_DEFAULT);
    if (is_numeric($getOffice)):
        if ($Ceo):
            header('Location: painel.php');
            exit();
        endif;
        $user = $getOffice;
        $NameComp = "Editar perfil de administrador do sistema";
    else:
        $getCodigos = explode('-', $getOffice);
        $user = $getCodigos[0];
        $office = $getCodigos[1];
        if (!$Adm && !$Coord):
            if ($user != $userlogin['IdUsuario'] || $office != $userlogin['IdEmpresaUsuario']) {
                header("Location: painel.php");
            }
        endif;
        $Read = new Read;
        $Read->ExeRead("tb_empresas", "WHERE IdEmpresa = :id", "id={$office}");
        $NameComp = "Editar perfil de funcionário ou diretor da empresa {$Read->getResult()[0]["NomeEmpresa"]}";
    endif;
    ?>

    <header class="header-box">
        <h2 class="header-box-h"><?= (!$Adm ? "Editar perfil de funcionário" : "{$NameComp}") ?></h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=users/index"><span class="lnr lnr-list"></span>  Usuários</a>
        </div>
    </header>

    <?php
    $Read->ExeRead("tb_usuarios", "WHERE IdUsuario = :id", "id={$user}");
    extract($Read->getResult()[0]);
    ?>
    <div class="box content-box">
        <form id="form-user-update" method="post" class="form-user-update" action="user-update">
            <div class="row-m">
                <label>
                    <span class="lnr lnr-user"></span>  Usuário
                </label>
                <input name="NomeUsuario" class="inpt-null" type="text" value="<?= $NomeUsuario; ?>"/>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-lock"></span>  Nova Senha?
                </label>
                <input name="SenhaUsuario" class="inpt-null" type="password"/>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-envelope"></span>   E-mail
                </label>
                <input name="EmailUsuario" class="inpt-null" type="email" value="<?= $EmailUsuario; ?>"/>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-menu-circle"></span>   Nível
                </label>
                <select id="nivel_user" class="inpt-null" name="nivel_user">
                    <option <?= ($nivel_user === "1" ? 'selected="selected"' : ''); ?> class="clik-op" value="1">Funcionário</option>   
                    <?php
                    if ($Adm):
                        ?>
                        <option <?= ($nivel_user === "2" ? 'selected="selected"' : ''); ?> class="clik-op" value="2">Diretor</option>  
                        <?php
                    endif;
                    ?>
                    <?php if (is_numeric($getOffice)): ?>
                        <option <?= ($nivel_user === "3" ? 'selected="selected"' : ''); ?> class="clik-op" value="3">Administrador</option>                 
                    <?php endif; ?>
                        <?php
                    if ($Adm):
                        ?>
                        <optgroup label="Coordenação">
                            <option <?= ($nivel_user === "6" ? 'selected="selected"' : ''); ?> class="clik-op" value="6">Coordenador</option>
                        </optgroup>
                        <?php
                    endif;
                    ?>
                </select>
            </div>
            <div class="row-m department_hide">
                <label>
                    <span class="lnr lnr-apartment"></span>   Departamento
                </label>
                <select class="inpt-null" name="dep_id_user" id="dep_id">
                    <option></option>
                    <?php
                    $Read->FullRead("SELECT * FROM tb_department INNER JOIN tb_empresas ON IdEmpresa = dep_id_companies WHERE dep_id_companies = :id AND dep_title != 'DIRETORIA'", "id={$IdEmpresaUsuario}");
                    foreach ($Read->getResult() as $v):
                        ?>
                        <option <?= ($v['dep_id'] === $dep_id_user ? 'selected="selected"' : ''); ?> class="clik-op" value="<?= $v['dep_id']; ?>"><?= $v['dep_title']; ?></option> 
                        <?php
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="row-btn">
                <?php if (!is_numeric($getOffice)): ?>
                    <input name="IdEmpresaUsuario" type="hidden" value="<?= $IdEmpresaUsuario; ?>"/>
                <?php endif; ?>
                <input name="IdUsuario" type="hidden" value="<?= $IdUsuario; ?>"/>
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Atualizar Usuário</button>
            </div>
        </form>
    </div>
</main>
