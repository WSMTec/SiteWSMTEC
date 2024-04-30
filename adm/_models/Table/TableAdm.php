<?php

ob_start();
session_start();

$Col = array(
    0 => 'usuario_user',
    1 => 'email_user'
);

$Read = new Read;
$Read->FullRead("SELECT id_user, usuario_user, email_user FROM n_usuarios WHERE id_user != :id AND nivel_user != :nivel AND status_user != 'R'", "id={$_SESSION['userlogin']['id_user']}&nivel=2");
$Rows = $Read->getRowCount();
$TotalRows = $Rows;

$Query = "SELECT id_user, usuario_user, email_user FROM n_usuarios WHERE id_user != :id AND nivel_user != :nivel AND status_user != 'R'";
$par = "id={$_SESSION['userlogin']['id_user']}&nivel=2";
if (!empty($Req['search']['value'])) {
    $Query .= " AND usuario_user LIKE '%' :value '%'";
    $Query .= " OR email_user LIKE '%' :value '%'";
    $Query .= " AND id_user != :id";
    $Query .= " AND nivel_user != :nivel";
    $Query .= " AND status_user != 'R'";
    $par = "id={$_SESSION['userlogin']['id_user']}&value={$Req['search']['value']}&nivel=2";
}

$Read->FullRead($Query, $par);
$Rows = $Read->getRowCount();


$Query .= " ORDER BY {$Col[$Req['order'][0]['column']]} {$Req['order'][0]['dir']} LIMIT {$Req['start']}, {$Req['length']}";
$Read->FullRead($Query);
$Data = array();

foreach ($Read->getResult() as $dt):
    extract($dt);
    $SubData = array();
    $SubData[] = "<span class='user-name-{$id_user}'>{$usuario_user}</span>";
    $SubData[] = $email_user;
    $SubData[] = ""
            . "<div>"
            . "<button name='btn-modal[]' data-function='user-delete' data-name='administrador' value='{$id_user}' type='button' class='btn btn-danger btn-xs btn-rigth'><span class='lnr lnr-trash'></span></button>"
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

