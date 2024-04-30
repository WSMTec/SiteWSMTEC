<?php

$Col = array(
    0 => 'serv_img',
    1 => 'serv_title',
    2 => 'serv_content',
    3 => 'serv_description'
);
$Read = new Read;
$Read->FullRead("SELECT * FROM tb_services");
$Rows = $Read->getRowCount();
$TotalRows = $Rows;

//PESQUISA
$Query = "SELECT * FROM tb_services";
if (!empty($Req['search']['value'])) {
    $Query .= " WHERE";
    $Query .= " (serv_title LIKE '%' :value '%')";
    $Query .= " OR (serv_content LIKE '%' :value '%')";
//} else {
//    $Query .= " WHERE description_parent IS NULL";
}
$Read->FullRead($Query, "value={$Req['search']['value']}");
$Rows = $Read->getRowCount();

//ORDEM
$Query .= " ORDER BY {$Col[$Req['order'][0]['column']]} {$Req['order'][0]['dir']} LIMIT {$Req['start']}, {$Req['length']}";
$Read->FullRead($Query);
$Data = array();
//"<img src='../uploads/{$serv_img}' width='50'/>";
foreach ($Read->getResult() as $dt):
    extract($dt);
    $SubData = array();
    $SubData[] = "<center>" . Check::Image('uploads/' . $serv_img, $serv_title, 80, 30, true) . "</center>";
    $SubData[] = $serv_title;
    $SubData[] = Check::Words($serv_content, 4);
    $SubData[] = Check::Words($serv_description, 8);
    $SubData[] = ""
            . "<div>"
            . "<button name='btn-href[]' data-href='?exe=services/update&services={$serv_id}' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-pencil'></span></button> "
            . "<button name='btn-modal[]' data-function='services-delete' value='{$serv_id}' type='button' class='btn btn-danger btn-xs btn-rigth'><span class='lnr lnr-trash'></span></button>"
            . "</div>";

    $Data[] = $SubData;
endforeach;
$Json = array(
    "draw" => intval($Req['draw']),
    "recordsTotal" => intval($Rows),
    "recordsFiltered" => intval($TotalRows),
    "data" => $Data
);
echo json_encode($Json);
