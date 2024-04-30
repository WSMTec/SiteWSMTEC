<?php

$Col = array(
    0 => 'client_cover',
    1 => 'client_title'
);
$Read = new Read;
$Read->FullRead("SELECT * FROM tb_client");
$Rows = $Read->getRowCount();
$TotalRows = $Rows;

//PESQUISA
$Query = "SELECT * FROM tb_client";
if (!empty($Req['search']['value'])) {
    $Query .= " WHERE";
    $Query .= " (client_title LIKE '%' :value '%')";
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

    $SubData = array();
    $SubData[] = "<center>" . Check::Image('uploads/' . $client_cover, $client_title, 80, 30, true) . "</center>";
    $SubData[] = "<div data-tootip='oiii'>{$client_title}</div>";
    $SubData[] = ""
            . "<div>"
            . "<button name='btn-href[]' data-href='?exe=client/update&client={$client_id}' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-pencil'></span></button> "
            . "<button name='btn-modal[]' data-function='client-delete' value='{$client_id}' type='button' class='btn btn-danger btn-xs btn-rigth'><span class='lnr lnr-trash'></span></button>"
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
