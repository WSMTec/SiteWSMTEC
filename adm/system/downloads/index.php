<?phpif ($Adm):    header("Location: painel.php");endif;?><main class="content">    <header class="header-box">        <h2 class="header-box-h">Faça o download dos softwares necessários para o suporte!</h2>    </header>    <div class="box">        <table id="table-download" class="table table-striped table-bordered" style="width:100%">            <thead>                <tr>                    <th><span class="lnr lnr-download"></span> Nome</th>                    <th><span class="lnr lnr-enter-down"></span> Upload</th>                    <th><span class="lnr lnr-text-align-left"></span> Descrição</th>                    <th></th>                </tr>            </thead>            <tfoot>                <tr>                    <th><span class="lnr lnr-download"></span> Nome</th>                    <th><span class="lnr lnr-enter-down"></span> Upload</th>                    <th><span class="lnr lnr-text-align-left"></span> Descrição</th>                    <th></th>                </tr>            </tfoot>        </table>        <div class="box_mobile">            <?php            $Read = new Read;            $Read->FullRead("SELECT * FROM tb_uploads WHERE IdEmpresaUp = '{$_SESSION['userlogin']['IdEmpresaUsuario']}' GROUP BY NomeUp");            $Rows = $Read->getRowCount();            $TotalRows = $Rows;            foreach ($Read->getResult() as $dt):                extract($dt);                ?>                <div class="bloco_mob" style="overflow: scroll;">                    <!--                    <div class="p_mob">                    <?= $NomeEmpresa; ?>                                        </div>-->                    <div class="s_mob" >                        <div style="flex-basis: 100%;">                            <span><small>Nome:</small></span>                            <span><?= $NomeUp; ?></span>                        </div>                        <div style="flex-basis: 100%;">                            <span><small>Upload:</small></span>                            <span><?= "<a id='btn-download' href='?exe=uploads/index&action={$name_up}' class='btn-download'>{$Upload}</a>"; ?></span>                        </div>                        <div style="flex-basis: 100%;">                            <span><small>Descrição:</small></span>                            <span><?= Check::Words($DescUp, 5); ?></span>                        </div>                    </div>                    <div class="t_mob">                    </div>                    <div class="q_mob">                        <div>                            <a href='?exe=uploads/index&action={$name_up}' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-download'></span></a>                         </div>                     </div>                </div>                <?php            endforeach;            ?>        </div>    </div>    <?php    $Download = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);//    echo $Download;    if (isset($Download)):        $Read = new Read;        $Read->ExeRead("tb_uploads", "WHERE name_up = :n AND IdEmpresaUp = :i LIMIT 1", "n={$Download}&i={$userlogin['IdEmpresaUsuario']}");        if (!$Read->getResult()) {            header("Location: paniel.php");        }        extract($Read->getResult()[0]);        $arquivoLocal = 'uploads/' . $Upload;        echo $arquivoLocal;        if (!file_exists($arquivoLocal)) {            echo "Arquivo não existente!";            exit;        } else {            echo "Arquivo existe!";        }        $fsize = filesize($arquivoLocal);        $path_parts = pathinfo($arquivoLocal);        $ext = strtolower($path_parts["extension"]);        switch ($ext) {            case "pdf": $ctype = "application/pdf";                break;            case "exe": $ctype = "application/octet-stream";                break;            case "zip": $ctype = "application/zip";                break;            case "doc": $ctype = "application/msword";                break;            case "xls": $ctype = "application/vnd.ms-excel";                break;            case "ppt": $ctype = "application/vnd.ms-powerpoint";                break;            case "gif": $ctype = "image/gif";                break;            case "png": $ctype = "image/png";                break;            case "jpeg":            case "jpg": $ctype = "image/jpg";                break;            default: $ctype = "application/force-download";        }        header("Pragma: public"); // required        header("Expires: 0");        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");        header("Cache-Control: private", false); // required for certain browsers        header("Content-Type: $ctype");        header("Content-Disposition: attachment; filename=\"" . basename($arquivoLocal) . "\";");        header("Content-Transfer-Encoding: binary");        header("Content-Length: " . $fsize);        ob_end_clean();        flush();        readfile($arquivoLocal);        echo "Baixando arquivo!";    endif;    ?></main>