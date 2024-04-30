<?php

$Col = array(
    0 => 'ebook_cover',
    1 => 'ebook_title',
    2 => 'ebook_content',
    3 => 'ebook_data'
);
$Read = new Read;
$Read->FullRead("SELECT * FROM tb_ebook");
$Rows = $Read->getRowCount();
$TotalRows = $Rows;

//PESQUISA
$Query = "SELECT * FROM tb_ebook";
if (!empty($Req['search']['value'])) {
    $Query .= " WHERE";
    $Query .= " (ebook_title LIKE '%' :value '%')";
    $Query .= " OR (ebook_content LIKE '%' :value '%')";
//} else {
//    $Query .= " WHERE category_parent IS NULL";
}
$Read->FullRead($Query, "value={$Req['search']['value']}");
$Rows = $Read->getRowCount();

//ORDEM
$Query .= " ORDER BY {$Col[$Req['order'][0]['column']]} {$Req['order'][0]['dir']} LIMIT {$Req['start']}, {$Req['length']}";
$Read->FullRead($Query);
$Data = array();

foreach ($Read->getResult() as $dt):
    extract($dt);
    if ($ebook_popup != '') {
        $img = Check::Image('uploads/' . $ebook_popup, $ebook_title, 80, 30, true);
    } else {
        $img = Check::Image('uploads/blog/6.jpg', $ebook_title, 80, 30, true);
    }
    if ($ebook_type == 'ebook') {
        $title = "<div data-tootip='oiii'>{$ebook_title}</div>";
        $cont = Check::Words($ebook_content, 10);
        $btn = ""
                . "<div>"
                . "<button name='btn-href[]' data-href='?exe=popup/update&posts={$ebook_id}' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-pencil'></span></button> "
                . "<button name='btn-modal[]' data-function='popup-delete' value='{$ebook_id}' type='button' class='btn btn-danger btn-xs btn-rigth'><span class='lnr lnr-trash'></span></button>"
                . "</div>";
    } else {
        $title = "<i>Serviço({$ebook_service})</i>";
        $cont = "<i>Serviço({$ebook_service})</i>";
        $btn = ""
                . "<div>"
                . "<button name='btn-href[]' data-href='?exe=popup/update&posts={$ebook_id}' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-pencil'></span></button> "
                . "<button name='btn-modal[]' data-function='popup-delete' value='{$ebook_id}' type='button' class='btn btn-danger btn-xs btn-rigth'><span class='lnr lnr-trash'></span></button>"
                . "</div>";
    }
    $SubData = array();
    $SubData[] = "<center>" . $img . "</center>";
    $SubData[] = $title . ($ebook_status == '1' ? " <span style='color: green'>Ativo!!!</span>" : "");
    $SubData[] = $cont;
    $SubData[] = date("d/m/Y H:i", strtotime($ebook_date));
    $SubData[] = $btn;

    $Data[] = $SubData;
endforeach;
$Json = array(
    "draw" => intval($Req['draw']),
    "recordsTotal" => intval($Rows),
    "recordsFiltered" => intval($TotalRows),
    "data" => $Data
);
echo json_encode($Json);
