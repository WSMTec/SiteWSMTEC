    <?php

    $Download = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
    if (isset($Download)):
        $Read = new Read;
        $Read->ExeRead("tb_uploads", "WHERE name_up = :n LIMIT 1", "n={$Download}");
        extract($Read->getResult()[0]);
        $arquivoLocal = 'adm/uploads/' . $Upload;
        echo $arquivoLocal;

        if (!file_exists($arquivoLocal)) {
            echo "Arquivo não existente!";
            exit;
        }

        $fsize = filesize($arquivoLocal);
        $path_parts = pathinfo($arquivoLocal);
        $ext = strtolower($path_parts["extension"]);

        switch ($ext) {
            case "pdf": $ctype = "application/pdf";
                break;
            case "exe": $ctype = "application/octet-stream";
                break;
            case "zip": $ctype = "application/zip";
                break;
            case "doc": $ctype = "application/msword";
                break;
            case "xls": $ctype = "application/vnd.ms-excel";
                break;
            case "ppt": $ctype = "application/vnd.ms-powerpoint";
                break;
            case "gif": $ctype = "image/gif";
                break;
            case "png": $ctype = "image/png";
                break;
            case "jpeg":
            case "jpg": $ctype = "image/jpg";
                break;
            default: $ctype = "application/force-download";
        }

        header("Pragma: public"); // required
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false); // required for certain browsers
        header("Content-Type: $ctype");
        header("Content-Disposition: attachment; filename=\"" . basename($arquivoLocal) . "\";");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: " . $fsize);
        ob_end_clean();
        flush();
        readfile($arquivoLocal);
        
        echo "Baixando arquivo!";
    endif;