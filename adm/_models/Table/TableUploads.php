<?php

$Col = array(
    0 => 'NomeUp',
    1 => 'Upload',
    2 => 'DescUp'
);
if (!$Coord) {
    $EmpCoord = "";
    $EmpCoords = "";
} else {
    $EmpCoord = " AND IdEmpresaUp = '{$_SESSION['userlogin']['IdEmpresaUsuario']}' ";
    $EmpCoords = " WHERE IdEmpresaUp = '{$_SESSION['userlogin']['IdEmpresaUsuario']}' ";
}
$Read = new Read;
$Read->FullRead("SELECT * FROM tb_uploads {$EmpCoords} GROUP BY NomeUp");
$Rows = $Read->getRowCount();
$TotalRows = $Rows;

$Group = (empty($Req['search']['value']) ? " GROUP BY NomeUp" : "");
$Query = "SELECT * FROM tb_uploads {$EmpCoords} {$Group}";
//var_dump($Query);
if (!empty($Req['search']['value'])) {
    $Query .= " WHERE";
    $Query .= " (NomeUp LIKE '%' :value '%')";
    $Query .= " {$EmpCoord} GROUP BY NomeUp";
//    var_dump($Query);
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
    $SubData[] = Check::Words($DescUp, 5);
    $SubData[] = ""
            . "<div>"
            . "<button name='btn-href[]' data-href='?exe=uploads/update&uploads={$name_up}' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-pencil'></span></button> "
            . "<button name='btn-modal[]' data-function='upload-delete' value='{$name_up}' type='button' class='btn btn-danger btn-xs btn-rigth'><span class='lnr lnr-trash'></span></button>"
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
