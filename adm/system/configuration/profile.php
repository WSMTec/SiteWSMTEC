<?php
//if (!$Adm):
//    header('Location: painel.php');
//    exit();
//endif;
?>
<main class="content">
    <?php
    ?>

    <header class="header-box">
        <h2 class="header-box-h">Meu perfil</h2>
    </header>

    <?php
    $Read->ExeRead("tb_usuarios", "WHERE IdUsuario = :id", "id={$userlogin['IdUsuario']}");
    extract($Read->getResult()[0]);
    ?>
    <div class="box content-box">
        <form id="form-user-profile" method="post" class="form-user-profile" action="user-profile" enctype="multipart/form-data">
            <div class="phot" style="flex-basis: 100%;
                 justify-content: center;
                 display: flex;
                 margin-bottom: 3%;">
                 <?php
                 if (empty($FotoUsuario)) {
                     ?>
                    <img style="border-radius: 50%;" src="<?= HOME; ?>/tim.php?src=<?= HOME; ?>/uploads/22.jpg&w=200&h=200">
                    <?php
                } else {
                    ?>
                    <img style="border-radius: 50%;" src="<?= HOME; ?>/tim.php?src=<?= HOME; ?>/uploads/<?= $FotoUsuario; ?>&w=200&h=200">
                    <?php
                }
                ?>

            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-picture"></span>  Foto
                </label>
                <input type="file" name="FotoUsuario" class="post_cover inpt-null"/> 
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-user"></span>  Nome
                </label>
                <input name="NomeUsuario" class="inpt-null" type="text" value="<?= $NomeUsuario; ?>"/>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-lock"></span>  Nova Senha?
                </label>
                <input name="SenhaUsuario" type="password"/>
            </div>
            <div class="row-m">
                <label>
                    <span class="lnr lnr-envelope"></span>   E-mail
                </label>
                <input name="EmailUsuario" class="inpt-null" type="email" value="<?= $EmailUsuario; ?>"/>
            </div>


            <div class="row-btn">
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Atualizar Perfil</button>
            </div>
        </form>
    </div>
</main>
