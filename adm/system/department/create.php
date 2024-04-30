<?php
if (!$Adm && !$Coord):
    header('Location: painel.php');
    exit();
endif;
?>
<main class="content">
    <header class="header-box">
        <h2 class="header-box-h">Cadastro de departamento para uma empresa</h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=department/index"><span class="lnr lnr-list"></span>  Departamentos</a>
        </div>
    </header>

    <div class="box content-box">
        <form id="form-department" method="post" class="form-department" action="department">
            <div class="row-f">
                <label>
                    <span class="lnr lnr-apartment"></span>  Nome
                </label>
                <input name="dep_title" class="inpt-null" type="text"/>
            </div>
            <div class="row-f">
                <label>
                    <span class="lnr lnr-text-align-left"></span>  Descrição
                </label>
                <textarea name="dep_description" class="inpt-null"></textarea>
            </div>
            <?php
            if ($Adm):
                ?>
                <div class="row-m">
                    <label>
                        <span class="lnr lnr-apartment"></span>  Empresas
                    </label>
                    <select class="inpt-null" name="dep_id_companies">
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
                <?php
            elseif ($Coord):
                ?>
                <input name="dep_id_companies" type="hidden" value="<?= $_SESSION['userlogin']['IdEmpresaUsuario']; ?>"/>
                <?php
            endif;
            ?>

            <div class="row-btn">
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Salvar Departamento</button>
            </div>
        </form>
    </div>
</main>
