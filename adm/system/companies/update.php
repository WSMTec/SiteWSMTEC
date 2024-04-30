<?php
if (!$Adm):
    header('Location: painel.php');
    exit();
endif;
?>
<main class="content">
    <?php
    $office = filter_input(INPUT_GET, "companies", FILTER_VALIDATE_INT);
    $Read = new Read;
    $Read->ExeRead("tb_empresas", "WHERE IdEmpresa = :id", "id={$office}");
    ?>
    <!--<div class="div-header">-->
    <header class="header-box">
        <h2 class="header-box-h">Editar empresa <?= $Read->getResult()[0]["NomeEmpresa"]; ?></h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=companies/index"><span class="lnr lnr-list"></span>  Empresas</a>
        </div>
    </header>
    <!--</div>-->
    <?php
    extract($Read->getResult()[0]);
    ?>
    <div class="box content-box">
        <form id="form-companies-update" autocomplete="on" method="post" class="form" action="companies-update">
            <div class="row-f">
                <header>
                    <h3>
                        <span class="lnr lnr-user"></span> Dados Basicos
                    </h3>
                </header>
            </div>
            <div class="row-m">
                <label>
                    Empresa
                </label>
                <input autocomplete="off" class="inpt-null" name="NomeEmpresa" type="text" value="<?= $NomeEmpresa; ?>"/>
            </div>
            <div class="row-m">
                <div class="row-m">
                    <label>
                        Contato
                    </label>
                    <input class="inpt-null" name="ContatoEmpresa" type="text" value="<?= $ContatoEmpresa; ?>"/>
                </div>
                <div class="row-m">
                    <label>
                        Cnpj
                    </label>
                    <input class="inpt-null" name="CnpjEmpresa" type="text"  value="<?= $CnpjEmpresa; ?>"/>
                </div>
            </div>
            <div class="row-m">
                <label>
                    E-mail
                </label>
                <input class="inpt-null" name="EmailEmpresa" type="email" value="<?= $EmailEmpresa; ?>"/>
            </div>
            <?php
            $Read->ExeRead("tb_telefones", "WHERE IdEmpresaTelefone = :id LIMIT 1", "id={$IdEmpresa}");
            ?>
            <div class="row-m">
                <label>
                    Telefone
                </label>
                <input class="inpt-null" name="Telefone" type="text" value="<?= $Read->getResult()[0]['Telefone']; ?>"/>
            </div>
            <div class="row-f">
                <header>
                    <h3>
                        <span class="lnr lnr-apartment"></span> Dados de Endereço 
                    </h3>
                </header>
            </div>
            <?php
            $Read->ExeRead("tb_enderecos", "WHERE IdEmpresaEndereco = :id LIMIT 1", "id={$IdEmpresa}");
            ?>
            <div class="row-m">
                <label>
                    Rua
                </label>
                <input id="logradouro" class="inpt-null" name="RuaEndereco" type="text" value="<?= $Read->getResult()[0]['RuaEndereco']; ?>"/>
            </div>
            <div class="row-m">
                <div class="row-m">
                    <label>
                        Cep
                    </label>
                    <input id="cep" class="inpt-null" name="CepEndereco" type="text" value="<?= $Read->getResult()[0]['CepEndereco']; ?>"/>
                </div>
                <div class="row-m">
                    <label>
                        Estato
                    </label>
                    <input id="uf" class="inpt-null" name="UfEndereco" type="text" value="<?= $Read->getResult()[0]['UfEndereco']; ?>"/>
                </div>
            </div>
            <div class="row-m">
                <div class="row-m">
                    <label>
                        Cidade
                    </label>
                    <input id="localidade" class="inpt-null" name="CidadeEndereco" type="text" value="<?= $Read->getResult()[0]['CidadeEndereco']; ?>"/>
                </div>
                <div class="row-m">
                    <label>
                        Bairro
                    </label>
                    <input id="bairro" class="inpt-null" name="BairroEndereco" type="text" value="<?= $Read->getResult()[0]['BairroEndereco']; ?>"/>
                </div>
            </div>
            <div class="row-m">
                <div class="row-m">
                    <label>
                        N° Casa
                    </label>
                    <input id="numero" class="inpt-null" name="NumEndereco" type="number" value="<?= $Read->getResult()[0]['NumEndereco']; ?>"/>
                </div>
                <div class="row-m">
                    <label>
                        Complemento
                    </label>
                    <input class="inpt-null" name="ComEndereco" type="text" value="<?= $Read->getResult()[0]['ComEndereco']; ?>"/>
                </div>
            </div>
            <div class="row-f">
                <div class="row-f">
                    <label>
                        Observação
                    </label>
                    <textarea name="ObsEmpresa" class="inpt-null" style="border: 1px solid #aaa;"><?= $ObsEmpresa ?></textarea>
                </div>
            </div>

            <div class="row-btn">
                <input name="IdEmpresa" type="hidden" value="<?= $IdEmpresa; ?>"/>
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Atualizar Empresa</button>
            </div>
        </form>
    </div>
</main>
