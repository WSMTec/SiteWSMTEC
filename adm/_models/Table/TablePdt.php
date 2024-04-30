<?php

$Col = array(
    0 => 'NomeEmpresa',
    1 => 'NomeUsuario',
    2 => 'datainicio',
    3 => 'assunto',
    4 => 'status',
    5 => 'status_tickets',
    6 => 'codigo'
);
if (!$Coord) {
    $EmpCoord = " WHERE tb_tickets.status = 'PENDENTE'";
} else {
    $EmpCoord = " WHERE tb_empresas.IdEmpresa = '{$_SESSION['userlogin']['IdEmpresaUsuario']}' AND tb_tickets.status = 'PENDENTE'";
}
$Read = new Read;

if ($Adm || $Coord) :
    $Read->FullRead("SELECT *, NomeEmpresa, NomeUsuario FROM tb_tickets
INNER JOIN tb_usuarios ON tb_usuarios.IdUsuario = tb_tickets.iduser
INNER JOIN tb_empresas ON tb_empresas.IdEmpresa = tb_tickets.idempresatickets 
INNER JOIN tb_mensagens ON tb_mensagens.idticket = tb_tickets.id {$EmpCoord} GROUP BY id");
    $Rows = $Read->getRowCount();
else :
    $Read->FullRead("SELECT *, NomeEmpresa, NomeUsuario FROM tb_tickets
INNER JOIN tb_usuarios ON tb_usuarios.IdUsuario = tb_tickets.iduser
INNER JOIN tb_empresas ON tb_empresas.IdEmpresa = tb_tickets.idempresatickets WHERE iduser = :u", "u={$_SESSION['userlogin']['IdUsuario']}");
    $Rows = $Read->getRowCount();
endif;

$TotalRows = $Rows;

//PESQUISA

if ($Adm || $Coord) :
    $op = (!empty($Req['search']['value']) ? "" : " {$EmpCoord} GROUP BY id");
    $Query = "SELECT *, NomeEmpresa, NomeUsuario FROM tb_tickets
INNER JOIN tb_usuarios ON tb_usuarios.IdUsuario = tb_tickets.iduser
INNER JOIN tb_empresas ON tb_empresas.IdEmpresa = tb_tickets.idempresatickets 
INNER JOIN tb_mensagens ON tb_mensagens.idticket = tb_tickets.id {$op}";
    if (!empty($Req['search']['value'])) {
        if (!$Coord) {
            $EmpCoord = " AND tb_tickets.status = 'PENDENTE'";
        } else {
            $EmpCoord = " AND tb_empresas.IdEmpresa = '{$_SESSION['userlogin']['IdEmpresaUsuario']}' AND tb_tickets.status = 'PENDENTE'";
        }
        $Query .= " WHERE";
        $Query .= " (assunto LIKE '%' :value '%'";
        $Query .= " OR NomeUsuario LIKE '%' :value '%'";
        $Query .= " OR status LIKE '%' :value '%'";
        $Query .= " OR codigo LIKE '%' :value '%'";
        $Query .= " OR data LIKE '%' :value '%')";
        $Query .= " {$EmpCoord} GROUP BY id";
    }
    $Read->FullRead($Query, "value={$Req['search']['value']}");
else :
    $opt = (empty($Req['search']['value']) ? "WHERE iduser = :u GROUP BY id" : "");
    $Query = "SELECT *, NomeEmpresa, NomeUsuario FROM tb_tickets 
INNER JOIN tb_usuarios ON tb_usuarios.IdUsuario = tb_tickets.iduser 
INNER JOIN tb_empresas ON tb_empresas.IdEmpresa = tb_tickets.idempresatickets 
INNER JOIN tb_mensagens ON tb_mensagens.idticket = tb_tickets.id {$opt}";
    $p = (empty($Req['search']['value']) ? "u={$_SESSION['userlogin']['IdUsuario']}" : "");
    if (!empty($Req['search']['value'])) {
        $Query .= " WHERE";
        $Query .= " assunto LIKE '%' :value '%'";
        $Query .= " AND iduser = :u GROUP BY id";
        $p = "value={$Req['search']['value']}&u={$_SESSION['userlogin']['IdUsuario']}";
    }
    $Read->FullRead($Query, $p);
endif;


$Rows = $Read->getRowCount();

//ORDEM
$Query .= " ORDER BY {$Col[$Req['order'][0]['column']]} {$Req['order'][0]['dir']} LIMIT {$Req['start']}, {$Req['length']}";
$Read->FullRead($Query);
$Data = array();

foreach ($Read->getResult() as $dt) :
    extract($dt);
    if ($_SESSION['userlogin']['nivel_user'] >= 3 && $status == "PENDENTE") :
        $btns = "<div>
            <button name='btn-href[]' data-href='?exe=tickets/room&ticket={$id}' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-enter'></span></button>
                <button name='btn-modal[]' data-function='tickets-active' data-name='tickets' value='{$id}' type='button' class='btn btn-success btn-xs btn-rigth'><span class='lnr lnr-history'></span></button>
                </div>";
    elseif ($status == "FINALIZADO") :
        $btns = "<div>
                <button name='btn-href[]' data-href='?exe=tickets/room&ticket={$id}' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-enter'></span></button> 
                </div>";
    else :
        $btns = "<div>
                <button name='btn-href[]' data-href='?exe=tickets/room&ticket={$id}' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-enter'></span></button> 
                <button name='btn-modal[]' data-function='tickets-finalize' data-name='tickets' value='{$id}' type='button' class='btn btn-danger btn-xs btn-rigth'><span class='lnr lnr-power-switch'></span></button>
                </div>";
    endif;
    if ($_SESSION['userlogin']['nivel_user'] >= 3 && $status_tickets == "ALTA") :
        $pri = "<font style='color: red;'>{$status_tickets}</font>";
    elseif ($status_tickets == "MEDIA") :
        $pri = "<font style='color: orange;'>{$status_tickets}</font>";
    elseif ($status_tickets == "BAIXA") :
        $pri = "<font style='color: yellow;'>{$status_tickets}</font>";
    else :
        $pri = "<font style='color: #000;'>{$status_tickets}</font>";
    endif;
    if ($_SESSION['userlogin']['nivel_user'] >= 3 && $statusmsg === 'N' && $remetente !== $_SESSION['userlogin']['IdUsuario']) :
        $ass = "<b>{$assunto}</b>";
    else :
        $ass = $assunto;
    endif;

    $SubData = array();
    $SubData[] = $NomeEmpresa;
    $SubData[] = $NomeUsuario;
    $SubData[] = date("d/m/Y H:i", strtotime($datainicio));
    $SubData[] = $ass;
    $SubData[] = "<span class='status-ticket-{$id}'>{$status}</span>";
    $SubData[] = $pri;
    $SubData[] = $codigo;
    $SubData[] = $btns;

    $Data[] = $SubData;
endforeach;
$Json = array(
    "draw" => intval($Req['draw']),
    "recordsTotal" => intval($Rows),
    "recordsFiltered" => intval($TotalRows),
    "data" => $Data
);
echo json_encode($Json);
