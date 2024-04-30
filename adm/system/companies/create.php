<?php
if (!$Adm) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<main class="content">
    <!--<div class="div-header">-->
    <header class="header-box">
        <h2 class="header-box-h">Cadastro de empresas no sistema</h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=companies/index"><span class="lnr lnr-list"></span>  Empresas</a>
        </div>
    </header>
    <!--</div>-->

    <div class="box content-box">
        <form autocomplete="on" method="post" class="form" id="form-companies" action="companies">
            <div class="row-f">
                <header>
                    <h3>
                        <span class="lnr lnr-apartment"></span> Dados Basicos
                    </h3>
                </header>
            </div>
            <div class="row-m">
                <label>
                    Empresa
                </label>
                <input autocomplete="off" class="inpt-null" name="NomeEmpresa" type="text"/>
            </div>
            <div class="row-m">
                <div class="row-m">
                    <label>
                        Contato
                    </label>
                    <input class="inpt-null" name="ContatoEmpresa" type="text"/>
                </div>
                <div class="row-m">
                    <label>
                        Cnpj
                    </label>
                    <input class="inpt-null" name="CnpjEmpresa" type="number"/>
                </div>
            </div>
            <div class="row-m">
                <label>
                    E-mail
                </label>
                <input class="inpt-null" name="EmailEmpresa" type="email"/>
            </div>
            <div class="row-m">
                <label>
                    Telefone
                </label>
                <input class="inpt-null" name="Telefone" type="text"/>
            </div>
            <div class="row-f">
                <header>
                    <h3>
                        <span class="lnr lnr-user"></span> Dados de Usuário Senior 
                    </h3>
                </header>
            </div>
            <div class="row-m">
                <label>
                    Nome de Usuário
                </label>
                <input class="inpt-null" name="NomeUsuario" type="text"/>
            </div>
            <div class="row-m">
                <div class="row-m">
                    <label>
                        E-mail de Usuário
                    </label>
                    <input class="inpt-null" name="EmailUsuario" type="email"/>
                </div>
                <div class="row-m">
                    <label>
                        Senha
                    </label>
                    <input class="inpt-null" name="SenhaUsuario" type="password"/>
                </div>
            </div>
            <div class="row-f">
                <header>
                    <h3>
                        <span class="lnr lnr-map-marker"></span> Dados de Endereço 
                    </h3>
                </header>
            </div>
            <div class="row-m">
                <label>
                    Rua
                </label>
                <input id="logradouro" class="inpt-null" name="RuaEndereco" type="text"/>
            </div>
            <div class="row-m">
                <div class="row-m">
                    <label>
                        Cep
                    </label>
                    <input id="cep" class="inpt-null" name="CepEndereco" type="text"/>
                </div>
                <div class="row-m">
                    <label>
                        Estato
                    </label>
                    <input value="SP" id="uf" class="inpt-null" name="UfEndereco" type="text"/>
                </div>
            </div>
            <div class="row-m">
                <div class="row-m">
                    <label>
                        Cidade
                    </label>
                    <input value="São Paulo" id="localidade" class="inpt-null" name="CidadeEndereco" type="text"/>
                </div>
                <div class="row-m">
                    <label>
                        Bairro
                    </label>
                    <input id="bairro" class="inpt-null" name="BairroEndereco" type="text"/>
                </div>
            </div>
            <div class="row-m">
                <div class="row-m">
                    <label>
                        N° Casa
                    </label>
                    <input id="numero" class="inpt-null" name="NumEndereco" type="number"/>
                </div>
                <div class="row-m">
                    <label>
                        Complemento
                    </label>
                    <input class="inpt-null" name="ComEndereco" type="text" />
                </div>
            </div>
            <div class="row-f">
                <div class="row-f">
                    <label>
                        Observação
                    </label>
                    <textarea name="ObsEmpresa" class="inpt-null" style="border: 1px solid #aaa;"></textarea>
                </div>
            </div>
            <div class="row-btn">
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Salvar Empresa</button>
            </div>
        </form>
    </div>
</main>
