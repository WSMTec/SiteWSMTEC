<div class="content">

    <!--<div class="div-header">-->
    <header class="header-box">
        <h2 class="header-box-h">Newsletter</h2>
    </header>
    <div class="loader">
        <div class="processing"></div>
    </div>
    <!--</div>-->

    <div class="box content-box">
        <form method="post" id="form-newsletter" class="form-newsletter form-horizontal" action="newsletter" enctype="multipart/form-data">

            <div class="row-f">
                <label>
                    <span class="lnr lnr-picture"></span> Posts
                </label>
                <select required="" class="inpt-null" name="post_id">
                    <option></option>
                    <?php
                    $Read = new Read;
                    $Read->FullRead("SELECT * FROM ws_posts WHERE post_newsletter IS NULL");
                    foreach ($Read->getResult() as $d):
                        extract($d);
                        ?>
                        <option value="<?= $post_id; ?>"><?= $post_title; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row-btn" style="padding-top: 3%;">
                <button id="btn-form" class="btn-green btn-default" type="submit"><span class="lnr lnr-checkmark-circle"></span> Disparar e-mails</button>
            </div>
        </form>

        <div style="margin-top: 1.5%; display: flex; flex-wrap: wrap; flex-basis: 100%;">
            <?php
            $Read->FullRead("SELECT * FROM tb_newsletter");
            foreach ($Read->getResult() as $d):
                extract($d);
                ?>
                <div class="emails-news">
                    <?= $new_email ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div> <!-- content home -->