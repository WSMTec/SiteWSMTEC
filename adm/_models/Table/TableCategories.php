<?php

$Col = array(
    0 => 'category_title',
    1 => 'category_content',
    2 => 'category_parent'
);
$Read = new Read;
$Read->FullRead("SELECT * FROM ws_categories WHERE category_parent IS NULL");
$Rows = $Read->getRowCount();
$TotalRows = $Rows;

//PESQUISA
$Query = "SELECT * FROM ws_categories";
if (!empty($Req['search']['value'])) {
    $Query .= " WHERE";
    $Query .= " (category_title LIKE '%' :value '%')";
    $Query .= " AND category_parent IS NULL";
} else {
    $Query .= " WHERE category_parent IS NULL";
}
$Read->FullRead($Query, "value={$Req['search']['value']}");
$Rows = $Read->getRowCount();

//ORDEM
$Query .= " ORDER BY {$Col[$Req['order'][0]['column']]} {$Req['order'][0]['dir']} LIMIT {$Req['start']}, {$Req['length']}";
$Read->FullRead($Query);
$Data = array();

foreach ($Read->getResult() as $dt):
    extract($dt);
    $Read->ExeRead("ws_categories", "WHERE category_parent = :c", "c={$category_id}");
    $parent = array();
    foreach ($Read->getResult() as $v):
        $parent[] = " {$v['category_title']}";
    endforeach;
    $SubData = array();
    $SubData[] = $category_title;
    $SubData[] = $category_content;
    $SubData[] = ($parent ? $parent : "<i style='color:#bbb;'>Não á uma subcategoria</i>");
    $SubData[] = ""
            . "<div>"
            . "<button name='btn-href[]' data-href='?exe=categories/update&category={$category_id}' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-pencil'></span></button> "
            . "<button name='btn-modal[]' data-function='categories-delete' value='{$category_id}' type='button' class='btn btn-danger btn-xs btn-rigth'><span class='lnr lnr-trash'></span></button>"
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
