<?php

$Col = array(
    0 => 'prod_img',
    1 => 'prod_title',
    2 => 'prod_content'
);
$Read = new Read;
$Read->FullRead("SELECT * FROM tb_product");
$Rows = $Read->getRowCount();
$TotalRows = $Rows;

//PESQUISA
$Query = "SELECT * FROM tb_product";
if (!empty($Req['search']['value'])) {
    $Query .= " WHERE";
    $Query .= " (prod_title LIKE '%' :value '%')";
    $Query .= " OR (prod_content LIKE '%' :value '%')";
//} else {
//    $Query .= " WHERE description_parent IS NULL";
}
$Read->FullRead($Query, "value={$Req['search']['value']}");
$Rows = $Read->getRowCount();

//ORDEM
$Query .= " ORDER BY {$Col[$Req['order'][0]['column']]} {$Req['order'][0]['dir']} LIMIT {$Req['start']}, {$Req['length']}";
$Read->FullRead($Query);
$Data = array();
//"<img src='../uploads/{$prod_img}' width='50'/>";
foreach ($Read->getResult() as $dt):
    extract($dt);
    $SubData = array();
    $SubData[] = "<center>" . Check::Image('uploads/' . $prod_img, $prod_title, 80, 30, true) . "</center>";
    $SubData[] = $prod_title;
    $SubData[] = $prod_content;
    $SubData[] = ""
            . "<div>"
            . "<button name='btn-href[]' data-href='?exe=product/update&product={$prod_id}' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-pencil'></span></button> "
            . "<button name='btn-modal[]' data-function='product-delete' value='{$prod_id}' type='button' class='btn btn-danger btn-xs btn-rigth'><span class='lnr lnr-trash'></span></button>"
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
