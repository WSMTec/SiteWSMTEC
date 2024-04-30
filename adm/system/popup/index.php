<main class="content">    <header class="header-box">        <h2 class="header-box-h">Gerencie todos os pop-up cadastrados</h2>        <div class="header-box-btn">            <a class="btn-default btn-blue" href="?exe=popup/create"><span class="lnr lnr-plus-circle"></span> Novo pop-up</a>        </div>    </header>    <div class="box">        <table id="table-report" class="table table-striped table-bordered" style="width:100%">            <thead>                <tr>                    <th style="width: 80px;"><span class="lnr lnr-picture"></span> Imagem</th>                    <th><span class="lnr lnr-graduation-hat"></span> Titulo</th>                    <th><span class="lnr lnr-text-align-left"></span> Descrição</th>                    <th><span class="lnr lnr-calendar-full"></span> Data</th>                    <th></th>                </tr>            </thead>            <tfoot>                <tr>                    <th><span class="lnr lnr-picture"></span> Imagem</th>                    <th><span class="lnr lnr-graduation-hat"></span> Titulo</th>                    <th><span class="lnr lnr-text-align-left"></span> Descrição</th>                    <th><span class="lnr lnr-calendar-full"></span> Data</th>                    <th></th>                </tr>            </tfoot>        </table>        <div class="box_mobile">            <?php            $Read = new Read;            $Read->FullRead("SELECT * FROM tb_ebook");            $Rows = $Read->getRowCount();            $TotalRows = $Rows;            foreach ($Read->getResult() as $dt):                extract($dt);                if ($ebook_popup != '') {                    $img = Check::Image('uploads/' . $ebook_popup, $ebook_title, 240, 120, true);                } else {                    $img = Check::Image('uploads/blog/6.jpg', $ebook_title, 240, 120, true);                }                if ($ebook_type == 'ebook') {                    $title = "<div data-tootip='oiii'>{$ebook_title}</div>";                    $cont = Check::Words($ebook_content, 10);                    $btn = ""                            . "<div>"                            . "<button name='btn-href[]' data-href='?exe=popup/update&posts={$ebook_id}' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-pencil'></span></button> "                            . "<button name='btn-modal[]' data-function='popup-delete' value='{$ebook_id}' type='button' class='btn btn-danger btn-xs btn-rigth'><span class='lnr lnr-trash'></span></button>"                            . "</div>";                } else {                    $title = "<i>Serviço({$ebook_service})</i>";                    $cont = "<i>Serviço({$ebook_service})</i>";                    $btn = ""                            . "<div>"                            . "<button name='btn-href[]' data-href='?exe=popup/update&posts={$ebook_id}' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-pencil'></span></button> "                            . "<button name='btn-modal[]' data-function='popup-delete' value='{$ebook_id}' type='button' class='btn btn-danger btn-xs btn-rigth'><span class='lnr lnr-trash'></span></button>"                            . "</div>";                }                ?>                <div class="bloco_mob">                    <div class="p_mob">                        <?= "<center>" . $img . "</center>"; ?>                    </div>                    <div class="s_mob">                        <div style="flex-basis: 100%;">                            <span><small>Titulo:</small></span>                            <span><?= $title . ($ebook_status == '1' ? " <span style='color: green'>Ativo!!!</span>" : ""); ?></span>                        </div>                        <div style="flex-basis: 100%;">                            <span><small>Descrição:</small></span>                            <span><?= $cont; ?></span>                        </div>                        <div>                            <span><small>Data:</small></span>                            <span><?= date("d/m/Y H:i", strtotime($ebook_date)); ?></span>                        </div>                        <!--                        <div style="flex-basis: 100%;">                                                    <span><small>Descrição:</small></span>                                                    <span><?= Check::Words($DescServicoRelatorio, 5); ?></span>                                                </div>                                                <div>                                                    <span><small>Hr Total:</small></span>                                                    <span><?= $HTotalRelatorioText; ?></span>                                                </div>-->                    </div>                    <div class="t_mob">                    </div>                    <div class="q_mob">                        <?= $btn; ?>                    </div>                </div>                <?php            endforeach;            ?>        </div>    </div></main>