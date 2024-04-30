<?php
if (!class_exists('Login')) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<main class="content">
    <!--<div class="div-header">-->
    <header class="header-box">
        <h2 class="header-box-h">Cadastro de talões para um escritório</h2>
        <div class="header-box-btn">
            <a class="btn-default btn-blue" href="?exe=taloes/index"><span class="lnr lnr-list"></span>  Talões</a>
        </div>
    </header>
    <!--</div>-->
    <?php
    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if ($data && $data['SendPostForm']):
        $data['serv_img'] = ($_FILES['serv_img']['tmp_name'] ? $_FILES['serv_img'] : null);
        unset($data['SendPostForm']);
        require('_models/AdminServico.class.php');
        $cadastra = new AdminServico;
        $cadastra->ExeCreate($data);

        if (!$cadastra->getResult()):
            WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
        else:
            header("Location:painel.php?exe=servicos/update&create=true&emp={$cadastra->getResult()}");
        endif;
    endif;
    ?>
    <div class="box content-box">
        <form>
            <div class="row-m">
                <div class="row-m">
                    <label>
                        <span class="lnr lnr-pencil"></span>   Cod/Inicial
                    </label>
                    <input type="number"/>
                </div>
                <div class="row-m">
                    <label>
                        <span class="lnr lnr-pencil"></span>   Cod/Final
                    </label>
                    <input type="number"/>
                </div>
            </div>
            <div class="row-m">
                <div class="row-m">
                    <label>
                        <span class="lnr lnr-calendar-full"></span>   Data/Vc
                    </label>
                    <input type="date"/>
                </div>
                <div class="row-m">
                    <label>
                        <span class="lnr lnr-apartment"></span>   Escritório
                    </label>
                    <select>
                        <option>Selecione um escritório:</option>
                        <option>COTIC</option>
                        <option>WSM</option>
                    </select>
                </div>
            </div>
            <div class="row-btn">
                <button class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Salvar Talão</button>
            </div>
        </form>
    </div>
</main>
