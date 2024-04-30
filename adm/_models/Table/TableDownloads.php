<?php

$Col = array(
    0 => 'NomeUp',
    1 => 'Upload',
    2 => 'DescUp'
);

$Read = new Read;
$Read->FullRead("SELECT * FROM tb_uploads WHERE IdEmpresaUp = '{$_SESSION['userlogin']['IdEmpresaUsuario']}' GROUP BY NomeUp");
$Rows = $Read->getRowCount();
$TotalRows = $Rows;

$Group = (empty($Req['search']['value']) ? "WHERE IdEmpresaUp = '{$_SESSION['userlogin']['IdEmpresaUsuario']}' GROUP BY NomeUp" : "");
$Query = "SELECT * FROM tb_uploads {$Group}";
if (!empty($Req['search']['value'])) {
    $Query .= " WHERE";
    $Query .= " NomeUp LIKE '%' :value '%'";
    $Query .= " AND IdEmpresaUp = '{$_SESSION['userlogin']['IdEmpresaUsuario']}' GROUP BY NomeUp";
}

$Read->FullRead($Query, "value={$Req['search']['value']}");
$Rows = $Read->getRowCount();

$Query .= " ORDER BY {$Col[$Req['order'][0]['column']]} {$Req['order'][0]['dir']} LIMIT {$Req['start']}, {$Req['length']}";
$Read->FullRead($Query);
$Data = array();

foreach ($Read->getResult() as $dt):
    extract($dt);
    $SubData = array();
    $SubData[] = $NomeUp;
    $SubData[] = "<a id='btn-download' href='?exe=uploads/index&action={$name_up}' class='btn-download'>{$Upload}</a>";
    $SubData[] = $DescUp;
    $SubData[] = ""
            . "<div>"
            . "<a href='?exe=uploads/index&action={$name_up}' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-download'></span></a> "
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
