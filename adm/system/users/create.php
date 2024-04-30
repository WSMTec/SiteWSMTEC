<?php
if (!$Adm && !$Coord):
    header('Location: painel.php');
    exit();
endif;
?>
<main class="content">

    <header class="header-box">
        <h2 class="header-box-h">Cadastro de usuários para empresas</h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=users/index"><span class="lnr lnr-list"></span>  Usuários</a>
        </div>

    </header>

    <div class="box content-box">
        <form id="form-user" method="post" class="form-user" action="user">
            <div class="row-m">
                <label>
                    <span class="lnr lnr-user"></span>   Usuário
                </label>
                <input name="NomeUsuario" class="inpt-null" type="text"/>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-lock"></span>   Senha
                </label>
                <input name="SenhaUsuario" class="inpt-null" type="password"/>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-envelope"></span>   E-mail
                </label>
                <input name="EmailUsuario" class="inpt-null" type="email"/>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-menu-circle"></span>   Nível
                </label>
                <select id="nivel_user" class="inpt-null" name="nivel_user">
                    <option></option>
                    <option  class="clik-op" value="1">Funcionário</option>   
                    <?php
                    if ($Adm):
                        ?>
                        <option  class="clik-op" value="2">Diretor</option>                 
                        <option  class="clik-op" value="3">Administrador</option>
                        <optgroup label="Coordenação">
                            <option  class="clik-op" value="6">Coordenador</option>
                        </optgroup>
                        <?php
                    endif;
                    ?>
                </select>
            </div>


            <?php
            if ($Adm):
                ?>
                <div class="row-m companies_hide">
                    <label>
                        <span class="lnr lnr-apartment"></span>   Empresa
                    </label>
                    <select style="width: 50%;" class="inpt-null" name="IdEmpresaUsuario" id="IdEmpresa">
                        <option></option>
                        <?php
                        $Read = new Read;
                        $Read->ExeRead("tb_empresas");
                        foreach ($Read->getResult() as $values):
                            extract($values);
                            ?>
                            <option  class="clik-op" value="<?= $IdEmpresa; ?>"><?= $NomeEmpresa; ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="row-m department_hide">
                    <label>
                        <span class="lnr lnr-apartment"></span>   Departamento
                    </label>
                    <span class="carregando" style="font-size: 0.7em; color: #ccc; text-transform: uppercase;">Aguarde, carregando...</span>
                    <select  class="inpt-null" name="dep_id_user" id="dep_id">
                        <option></option>
                    </select>
                </div>
                <?php
            elseif ($Coord):
                ?>
                <div class="row-m companies_hide">
                    <label>
                        <span class="lnr lnr-apartment"></span>   Empresa
                    </label>
                    <select style="width: 50%;" class="inpt-null" name="IdEmpresaUsuario" id="IdEmpresa">
                        <option></option>
                        <?php
                        $Read = new Read;
                        $Read->ExeRead("tb_empresas", "WHERE IdEmpresa = '{$_SESSION['userlogin']['IdEmpresaUsuario']}'");
                        foreach ($Read->getResult() as $values):
                            extract($values);
                            ?>
                            <option  class="clik-op" value="<?= $IdEmpresa; ?>"><?= $NomeEmpresa; ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="row-m department_hide">
                    <label>
                        <span class="lnr lnr-apartment"></span>   Departamento
                    </label>
                    <span class="carregando" style="font-size: 0.7em; color: #ccc; text-transform: uppercase;">Aguarde, carregando...</span>
                    <select  class="inpt-null" name="dep_id_user" id="dep_id">
                        <option></option>
                    </select>
                </div>
                <?php
            endif;
            ?>





            <div class="row-btn">
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Salvar Usuário</button>
            </div>
        </form>
    </div>
</main>
