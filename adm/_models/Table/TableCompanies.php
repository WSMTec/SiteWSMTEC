<?php

$Col = array(
    0 => 'NomeEmpresa',
    1 => 'ContatoEmpresa',
    2 => 'CnpjEmpresa',
    3 => 'EmailEmpresa'
);

$Read = new Read;
$Read->FullRead("SELECT * FROM tb_empresas WHERE status_cmp != 'R'");
$Rows = $Read->getRowCount();
$TotalRows = $Rows;

$Query = "SELECT * FROM tb_empresas WHERE status_cmp != 'R'";
if (!empty($Req['search']['value'])) {
    $Query .= " AND";
    $Query .= " NomeEmpresa LIKE '%' :value '%'";
}

$Read->FullRead($Query, "value={$Req['search']['value']}");
$Rows = $Read->getRowCount();

$Query .= " ORDER BY {$Col[$Req['order'][0]['column']]} {$Req['order'][0]['dir']} LIMIT {$Req['start']}, {$Req['length']}";
$Read->FullRead($Query);
$Data = array();

foreach ($Read->getResult() as $dt):
    extract($dt);
    $SubData = array();
    $SubData[] = $NomeEmpresa;
    $SubData[] = $ContatoEmpresa;
    $SubData[] = $CnpjEmpresa;
    $SubData[] = $EmailEmpresa;
    $SubData[] = ""
            . "<div>"
            . "<button name='btn-href[]' data-href='?exe=companies/update&companies={$IdEmpresa}' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-pencil'></span></button> "
            . "<button name='btn-modal[]' data-function='companies-delete' value='{$IdEmpresa}' type='button' class='btn btn-danger btn-xs btn-rigth'><span class='lnr lnr-trash'></span></button>"
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
