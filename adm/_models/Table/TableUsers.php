<?php

$Col = array(
    0 => 'NomeEmpresa',
    1 => 'NomeUsuario',
    2 => 'EmailUsuario',
    3 => 'NivelUsuario',
    4 => 'dep_title'
);
if (!$Coord) {
    $EmpCoord = "";
} else {
    $EmpCoord = " AND IdEmpresa = '{$_SESSION['userlogin']['IdEmpresaUsuario']}'";
}
$Read = new Read;
$Read->FullRead("SELECT tb_usuarios.*, tb_department.*, tb_empresas.NomeEmpresa, tb_empresas.IdEmpresa FROM tb_usuarios "
        . "LEFT JOIN tb_empresas ON tb_empresas.IdEmpresa = tb_usuarios.IdEmpresaUsuario "
        . "LEFT JOIN tb_department ON tb_department.dep_id = tb_usuarios.dep_id_user WHERE IdUsuario != :id AND nivel_user < :nivel {$EmpCoord}", "id={$_SESSION['userlogin']['IdUsuario']}&nivel=4");
$Rows = $Read->getRowCount();
$TotalRows = $Rows;

$Query = "SELECT tb_usuarios.*, tb_department.*, tb_empresas.NomeEmpresa, tb_empresas.IdEmpresa FROM tb_usuarios "
        . "LEFT JOIN tb_empresas ON tb_empresas.IdEmpresa = tb_usuarios.IdEmpresaUsuario "
        . "LEFT JOIN tb_department ON tb_department.dep_id = tb_usuarios.dep_id_user WHERE IdUsuario != :id AND nivel_user < :nivel {$EmpCoord}";
$par = "id={$_SESSION['userlogin']['IdUsuario']}&nivel=4";

if (!empty($Req['search']['value'])) {
    $Query .= " AND NomeEmpresa LIKE '%' :value '%'";
    $Query .= " OR EmailUsuario LIKE '%' :value '%'";
    $Query .= " OR NomeUsuario LIKE '%' :value '%'";
    $Query .= " AND IdUsuario != :id";
    $Query .= " AND nivel_user = :nivel {$EmpCoord}";
    $par = "id={$_SESSION['userlogin']['IdUsuario']}&value={$Req['search']['value']}&nivel=4";
}

$Read->FullRead($Query, $par);
$Rows = $Read->getRowCount();

$Query .= " ORDER BY {$Col[$Req['order'][0]['column']]} {$Req['order'][0]['dir']} LIMIT {$Req['start']}, {$Req['length']}";
$Read->FullRead($Query);
$Data = array();

foreach ($Read->getResult() as $dt):
    extract($dt);
    $CompUser = "{$IdUsuario}-{$IdEmpresa}";
    if ($NivelUsuario === "ADM"):
        $NomeEmpresa = "ADMINISTRADOR";
        $CompUser = "{$IdUsuario}";
    endif;
    $SubData = array();
    $SubData[] = $NomeEmpresa;
    $SubData[] = $NomeUsuario;
    $SubData[] = $EmailUsuario;
    $SubData[] = $NivelUsuario;
    $SubData[] = $dep_title;
    $SubData[] = ""
            . "<div>"
            . "<button name='btn-href[]' data-href='?exe=users/update&users={$CompUser}' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-pencil'></span></button> "
            . "<button name='btn-modal[]' data-function='user-delete' data-name='usuario' value='{$IdUsuario}' type='button' class='btn btn-danger btn-xs btn-rigth'><span class='lnr lnr-trash'></span></button>"
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
