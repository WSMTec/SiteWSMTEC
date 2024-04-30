<?php

/**
 * Check.class [ HELPER ]
 * Classe responável por manipular e validade dados do sistema!
 * 
 * @copyright (c) Jefferson Androcles
 */
class Check {

    private static $Data;
    private static $Format;

    /**
     * <b>Verifica E-mail:</b> Executa validação de formato de e-mail. Se for um email válido retorna true, ou retorna false.
     * @param STRING $Email = Uma conta de e-mail
     * @return BOOL = True para um email válido, ou false
     */
    public static function Email($Email) {
        self::$Data = (string) $Email;
        self::$Format = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';

        if (preg_match(self::$Format, self::$Data)):
            return true;
        else:
            return false;
        endif;
    }

    public static function Board($Board) {
        self::$Data = (string) $Board;
        self::$Format = '/[A-Z]{3}+-[0-9]{3}$/';

        if (preg_match(self::$Format, self::$Data)):
            return true;
        else:
            return false;
        endif;
    }

    /**
     * <b>Tranforma URL:</b> Tranforma uma string no formato de URL amigável e retorna o a string convertida!
     * @param STRING $Name = Uma string qualquer
     * @return STRING = $Data = Uma URL amigável válida
     */
    public static function Name($Name) {
        self::$Format = array();
        self::$Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        self::$Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

        self::$Data = strtr(utf8_decode($Name), utf8_decode(self::$Format['a']), self::$Format['b']);
        self::$Data = strip_tags(trim(self::$Data));
        self::$Data = str_replace(' ', '-', self::$Data);
        self::$Data = str_replace(array('-----', '----', '---', '--'), '-', self::$Data);

        return strtolower(utf8_encode(self::$Data));
    }

    public static function NamePerson($Name) {
        self::$Data = (string) $Name;
        self::$Data = mb_ereg_replace('\.', '. ', self::$Data);
        self::$Data = mb_ereg_replace('\s+', ' ', self::$Data);
        self::$Data = mb_convert_case(self::$Data, MB_CASE_TITLE, mb_detect_encoding(self::$Data));
        $partsName = mb_split(' ', self::$Data);
        $exceptions = array('de', 'di', 'do', 'da', 'dos', 'das', 'dello', 'della', 'dalla', 'dal', 'del', 'e', 'em', 'na', 'no', 'nas', 'nos', 'van', 'von',
            'y'
        );
        for ($i = 0; $i < count($partsName); ++$i) {
            foreach ($exceptions as $exception):
                if (mb_strtolower($partsName[$i]) == mb_strtolower($exception)):
                    $partsName[$i] = $exception;
                endif;
                if (mb_ereg_match('^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$', mb_strtoupper($partsName[$i]))):
                    $partsName[$i] = mb_strtoupper($partsName[$i]);
                endif;
            endforeach;
        }
        return implode(' ', $partsName);
    }

    /**
     * <b>Tranforma Data:</b> Transforma uma data no formato DD/MM/YY em uma data no formato TIMESTAMP!
     * @param STRING $Name = Data em (d/m/Y) ou (d/m/Y H:i:s)
     * @return STRING = $Data = Data no formato timestamp!
     */
    public static function Data($Data) {
        self::$Format = explode(' ', $Data);
        self::$Data = explode('/', self::$Format[0]);

        if (empty(self::$Format[1])):
            self::$Format[1] = date('H:i:s');
        endif;

        self::$Data = self::$Data[2] . '-' . self::$Data[1] . '-' . self::$Data[0] . ' ' . self::$Format[1];
        return self::$Data;
    }

    public static function Hours($Start, $End) {
        $entrada = explode(':', $Start);
        $saida = explode(':', $End);
        $minutos = ( $saida[0] - $entrada[0] ) * 60 + $saida[1] - $entrada[1];
        if ($minutos < 0) {
            $minutos += 24 * 60;
        }
        $tempo = sprintf('%d:%d', $minutos / 60, $minutos % 60);
        return $tempo;
    }

    /**
     * <b>Limita os Palavras:</b> Limita a quantidade de palavras a serem exibidas em uma string!
     * @param STRING $String = Uma string qualquer
     * @return INT = $Limite = String limitada pelo $Limite
     */
    public static function Words($String, $Limite, $Pointer = null) {
        self::$Data = strip_tags(trim($String));
        self::$Format = (int) $Limite;

        $ArrWords = explode(' ', self::$Data);
        $NumWords = count($ArrWords);
        $NewWords = implode(' ', array_slice($ArrWords, 0, self::$Format));

        $Pointer = (empty($Pointer) ? '...' : ' ' . $Pointer );
        $Result = ( self::$Format < $NumWords ? $NewWords . $Pointer : self::$Data );
        return $Result;
    }

    /**
     * <b>Obter categoria:</b> Informe o name (url) de uma categoria para obter o ID da mesma.
     * @param STRING $category_name = URL da categoria
     * @return INT $category_id = id da categoria informada
     */
    public static function CatByName($CategoryName) {
        $read = new Read;
        $read->ExeRead('ws_categories', "WHERE category_name = :name", "name={$CategoryName}");
        if ($read->getRowCount()):
            return $read->getResult()[0]['category_id'];
        else:
            echo "A categoria {$CategoryName} não foi encontrada!";
            die;
        endif;
    }

    public static function CompaniesByName($IdEmpresa) {
        $read = new Read;
        $read->ExeRead('tb_empresas', "WHERE IdEmpresa = :id", "id={$IdEmpresa}");
        if ($read->getRowCount()):
            return $read->getResult()[0]['NomeEmpresa'];
        else:
            echo "A empresa não foi encontrada!";
            die;
        endif;
    }

    public static function DepByName($IdEmpresa) {
        $read = new Read;
        $read->ExeRead('tb_department', "WHERE dep_title = 'DIRETORIA' AND dep_id_companies = :id", "id={$IdEmpresa}");
        if ($read->getRowCount()):
            return $read->getResult()[0]['dep_id'];
        else:
            echo "O Departamento não foi encontrado!";
            die;
        endif;
    }

    /**
     * <b>Usuários Online:</b> Ao executar este HELPER, ele automaticamente deleta os usuários expirados. Logo depois
     * executa um READ para obter quantos usuários estão realmente online no momento!
     * @return INT = Qtd de usuários online
     */
    public static function UserOnline() {
        $now = date('Y-m-d H:i:s');
        $deleteUserOnline = new Delete;
        $deleteUserOnline->ExeDelete('ws_siteviews_online', "WHERE online_endview < :now", "now={$now}");

        $readUserOnline = new Read;
        $readUserOnline->ExeRead('ws_siteviews_online');
        return $readUserOnline->getRowCount();
    }

    /**
     * <b>Imagem Upload:</b> Ao executar este HELPER, ele automaticamente verifica a existencia da imagem na pasta
     * uploads. Se existir retorna a imagem redimensionada!
     * @return HTML = imagem redimencionada!
     */
    public static function Image($ImageUrl, $ImageDesc, $ImageW = null, $ImageH = null, $ImageDash = null) {
        self::$Data = $ImageUrl;
        if (file_exists(self::$Data) && !is_dir(self::$Data)):
            $patch = HOME;
            $imagem = self::$Data;
            return "<img src=\"{$patch}/tim.php?src={$patch}/{$imagem}&w={$ImageW}&h={$ImageH}\" alt=\"{$ImageDesc}\" title=\"{$ImageDesc}\"/>";
        elseif ($ImageDash):
            $patch = HOME;
            $imagem = self::$Data;
            return "<img src=\"{$patch}/tim.php?src={$patch}/{$imagem}&w={$ImageW}&h={$ImageH}\" alt=\"{$ImageDesc}\" title=\"{$ImageDesc}\"/>";
        else:
            return false;
        endif;
    }

    /**
     * <b>Imagem Upload:</b> Ao executar este HELPER, ele automaticamente verifica a existencia da imagem na pasta
     * uploads. Se existir retorna a imagem redimensionada!
     * @return HTML = imagem redimencionada!
     */
    public static function ThumbImage($ImageUrl, $ImageDesc, $ImageW = null, $ImageH = null, $ImageCache = null) {
        $imgCache = pathinfo($ImageUrl, PATHINFO_BASENAME);
        $arrCache = explode('.', $imgCache);
        $cache = "{$ImageCache}{$arrCache[0]}-{$ImageW}-{$ImageH}.{$arrCache[1]}";
        self::$Data = $cache;
        if (file_exists($cache) && !is_dir($cache)):
            echo "<img src=\"{$cache}\" alt=\"{$ImageDesc}\" title=\"{$ImageDesc}\"/>";
        else:
            switch ($arrCache[1]):
                case 'png':
                    echo "png";
                    break;
                case 'jpg':
                    $img = imagecreatefromjpeg($ImageUrl);
                    $size = array(imagesx($img), imagesy($img));
                    $new_size = array(
                        ($size[1] * $ImageW / $ImageH),
                        ($size[0] * $ImageH / $ImageW),
                    );
                    $thumb = imagecreatetruecolor($ImageW, $ImageH);
                    if ($new_size[0] > $size[0]) {
                        $new_thumb = imagecopyresampled($thumb, $img, 0, 0, 0, (($size[1] - $new_size[1]) / 2), $ImageW, $ImageH, $size[0], $new_size[1]);
                    } else {
                        $new_thumb = imagecopyresampled($thumb, $img, 0, 0, (($size[0] - $new_size[0]) / 2), 0, $ImageW, $ImageH, $new_size[0], $size[1]);
                    }
                    if ($new_thumb !== false) {
                        imagejpeg($thumb, $cache, 100);
                        imagedestroy($thumb);
                        imagedestroy($img);
                        echo "<img src=\"{$cache}\" alt=\"{$ImageDesc}\" title=\"{$ImageDesc}\"/>";
                    }
                    break;
                case 'jpeg':
                    echo "jpeg";
                    break;
                default:
                    echo "Default";
            endswitch;
        endif;
    }

    public static function BarCode($Number) {
        $fino = 1;
        $largo = 3;
        $altura = 50;

        $barcodes[0] = '00110';
        $barcodes[1] = '10001';
        $barcodes[2] = '01001';
        $barcodes[3] = '11000';
        $barcodes[4] = '00101';
        $barcodes[5] = '10100';
        $barcodes[6] = '01100';
        $barcodes[7] = '00011';
        $barcodes[8] = '10010';
        $barcodes[9] = '01010';

        for ($f1 = 9; $f1 >= 0; $f1--) {
            for ($f2 = 9; $f2 >= 0; $f2--) {
                $f = ($f1 * 10) + $f2;
                $texto = '';
                for ($i = 1; $i < 6; $i++) {
                    $texto .= substr($barcodes[$f1], ($i - 1), 1) . substr($barcodes[$f2], ($i - 1), 1);
                }
                $barcodes[$f] = $texto;
            }
        }

        $Code = '<img src="images/p.gif" width="' . $fino . '" height="' . $altura . '" border="0" />';
        $Code .= '<img src="images/b.gif" width="' . $fino . '" height="' . $altura . '" border="0" />';
        $Code .= '<img src="images/p.gif" width="' . $fino . '" height="' . $altura . '" border="0" />';
        $Code .= '<img src="images/b.gif" width="' . $fino . '" height="' . $altura . '" border="0" />';

        $Code .= '<img ';

        $texto = $Number;

        if ((strlen($texto) % 2) <> 0) {
            $texto = '0' . $texto;
        }

        while (strlen($texto) > 0) {
            $i = round(substr($texto, 0, 2));
            $texto = substr($texto, strlen($texto) - (strlen($texto) - 2), (strlen($texto) - 2));

            if (isset($barcodes[$i])) {
                $f = $barcodes[$i];
            }

            for ($i = 1; $i < 11; $i += 2) {
                if (substr($f, ($i - 1), 1) == '0') {
                    $f1 = $fino;
                } else {
                    $f1 = $largo;
                }

                $Code .= 'src="images/p.gif" width="' . $f1 . '" height="' . $altura . '" border="0">';
                $Code .= '<img ';

                if (substr($f, $i, 1) == '0') {
                    $f2 = $fino;
                } else {
                    $f2 = $largo;
                }

                $Code .= 'src="images/b.gif" width="' . $f2 . '" height="' . $altura . '" border="0">';
                $Code .= '<img ';
            }
        }
        $Code .= 'src="images/p.gif" width="' . $largo . '" height="' . $altura . '" border="0" />';
        $Code .= '<img src="images/b.gif" width="' . $fino . '" height="' . $altura . '" border="0" />';
        $Code .= '<img src="images/p.gif" width="1" height="' . $altura . '" border="0" />';

        return $Code;
    }

    public static function htmldump($variable, $height = "20em") {
        echo "<pre style=\"border: 1px solid #000; height: {$height}; overflow: auto; margin: 0.5em;\">";
        var_dump($variable);
        echo "</pre>\n";
    }

}
