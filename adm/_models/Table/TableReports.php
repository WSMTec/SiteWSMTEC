<?php

$Col = array(
    0 => 'NomeEmpresa',
    1 => 'ConsultorRelatorio',
    2 => 'DataRelatorio',
    3 => 'CodigoRelatorio',
    4 => 'DescServicoRelatorio',
    5 => 'ProjetoRelatorio',
    6 => 'HTotalRelatorioText',
    7 => 'FaseRelatorio'
);
if (!$Coord) {
    $EmpCoord = "";
} else {
    $EmpCoord = " AND IdEmpresa = '{$_SESSION['userlogin']['IdEmpresaUsuario']}'";
}
$Read = new Read;
$Read->FullRead("SELECT * FROM tb_relatorios INNER JOIN tb_empresas ON IdEmpresa = IdEmpresaRelatorio {$EmpCoord}");
$Rows = $Read->getRowCount();
$TotalRows = $Rows;

//PESQUISA
$Query = "SELECT * FROM tb_relatorios INNER JOIN tb_empresas ON IdEmpresa = IdEmpresaRelatorio {$EmpCoord}";
$p = '';
if (!empty($Req['search']['value'])) {
    $Query .= " WHERE";
    $Query .= " (ConsultorRelatorio LIKE '%' :value '%'";
    $Query .= " OR ProjetoRelatorio LIKE '%' :value '%'";
    $Query .= " OR DescServicoRelatorio LIKE '%' :value '%') {$EmpCoord}";
    $p = "value={$Req['search']['value']}";
}
$Read->FullRead($Query, $p);
$Rows = $Read->getRowCount();

//ORDEM
$Query .= " ORDER BY {$Col[$Req['order'][0]['column']]} {$Req['order'][0]['dir']} LIMIT {$Req['start']}, {$Req['length']}";
$Read->FullRead($Query);
$Data = array();

foreach ($Read->getResult() as $dt):
    extract($dt);
    $SubData = array();
    
    $SubData[] = $NomeEmpresa;
    $SubData[] = $ConsultorRelatorio;
    $SubData[] = date("d/m/Y", strtotime($DataRelatorio));
    $SubData[] = $CodigoRelatorio;
    $SubData[] = Check::Words($DescServicoRelatorio, 5);
    $SubData[] = $ProjetoRelatorio;
    $SubData[] = $HTotalRelatorioText;
    $SubData[] = Check::Words($FaseRelatorio, 5);
    $SubData[] = ""
            . "<div style='display: flex; '>"
            . "<button name='btn-print[]' data-href='print.php?relatorio={$IdRelatorio}' type='button' class='btn btn-success btn-xss btn-left'><span class='lnr lnr-printer'></span></button> "
            . "<button name='btn-href[]' data-href='?exe=reports/update&reports={$IdRelatorio}' type='button' class='btn btn-primary btn-xss btn-left'><span class='lnr lnr-pencil'></span></button> "
            . "<button name='btn-modal[]' data-function='reports-delete' value='{$IdRelatorio}' type='button' class='btn btn-danger btn-xss btn-rigth'><span class='lnr lnr-trash'></span></button>"
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
