<?php

$Col = array(
    0 => 'CodServico',
    1 => 'NomeServico',
    2 => 'DescServico'
);

$Read = new Read;
$Read->FullRead("SELECT * FROM tb_servicos");
$Rows = $Read->getRowCount();
$TotalRows = $Rows;

$Query = "SELECT * FROM tb_servicos";
if (!empty($Req['search']['value'])) {
    $Query .= " WHERE";
    $Query .= " NomeServico LIKE '%' :value '%'";
}

$Read->FullRead($Query, "value={$Req['search']['value']}");
$Rows = $Read->getRowCount();

$Query .= " ORDER BY {$Col[$Req['order'][0]['column']]} {$Req['order'][0]['dir']} LIMIT {$Req['start']}, {$Req['length']}";
$Read->FullRead($Query);
$Data = array();

foreach ($Read->getResult() as $dt):
    extract($dt);
    $SubData = array();
    $SubData[] = $CodServico;
    $SubData[] = $NomeServico;
    $SubData[] = $DescServico;
    $SubData[] = ""
            . "<div>"
            . "<button name='btn-href[]' data-href='?exe=servicos/update&servicos={$IdServico}' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-pencil'></span></button> "
            . "<button name='btn-modal[]' data-function='servicos-delete' value='{$IdServico}' type='button' class='btn btn-danger btn-xs btn-rigth'><span class='lnr lnr-trash'></span></button>      "
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
