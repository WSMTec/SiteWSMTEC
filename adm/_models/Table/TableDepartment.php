<?php

$Col = array(
    0 => 'NomeEmpresa',
    1 => 'dep_title',
    2 => 'dep_description'
);
if (!$Coord) {
    $EmpCoord = "";
} else {
    $EmpCoord = " AND IdEmpresa = '{$_SESSION['userlogin']['IdEmpresaUsuario']}'";
}
//var_dump($Coord, $EmpCoord, $_SESSION['userlogin']['nivel_user']);
$Read = new Read;
$Read->FullRead("SELECT tb_department.*, tb_empresas.NomeEmpresa, tb_empresas.IdEmpresa FROM tb_department "
        . "INNER JOIN tb_empresas ON tb_empresas.IdEmpresa = tb_department.dep_id_companies WHERE dep_status = 'A' {$EmpCoord}");
$Rows = $Read->getRowCount();
$TotalRows = $Rows;


$Query = "SELECT tb_department.*, tb_empresas.NomeEmpresa, tb_empresas.IdEmpresa FROM tb_department "
        . "INNER JOIN tb_empresas ON tb_empresas.IdEmpresa = tb_department.dep_id_companies WHERE dep_status = 'A' {$EmpCoord}";
$par = "";
if (!empty($Req['search']['value'])) {
    $Query .= " AND (NomeEmpresa LIKE '%' :value '%'";
    $Query .= " OR dep_title LIKE '%' :value '%'";
    $Query .= " OR NomeEmpresa LIKE '%' :value '%')";
    $Query .= " {$EmpCoord}";
    $par = "value={$Req['search']['value']}";
}
$Read->FullRead($Query, $par);
$Rows = $Read->getRowCount();

$Query .= " ORDER BY {$Col[$Req['order'][0]['column']]} {$Req['order'][0]['dir']} LIMIT {$Req['start']}, {$Req['length']}";
$Read->FullRead($Query);
$Data = array();

foreach ($Read->getResult() as $dt):
    extract($dt);
    $SubData = array();
    $SubData[] = $NomeEmpresa;
    $SubData[] = $dep_title;
    $SubData[] = $dep_description;
    $SubData[] = ""
            . "<div>"
            . "<button name='btn-href[]' data-href='?exe=department/update&department={$dep_id}-{$IdEmpresa}' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-pencil'></span></button> "
            . "<button name='btn-modal[]' data-function='department-delete' data-name='departamento' value='{$dep_id}' type='button' class='btn btn-danger btn-xs btn-rigth'><span class='lnr lnr-trash'></span></button>"
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
