<?php

$Col = array(
    0 => 'post_title',
    1 => 'post_title',
    2 => 'post_content',
    3 => 'post_data',
    4 => 'post_category'
);
$Read = new Read;
$Read->FullRead("SELECT * FROM tb_solution INNER JOIN tb_categories_solution ON category_id = post_category");
$Rows = $Read->getRowCount();
$TotalRows = $Rows;

//PESQUISA
$Query = "SELECT * FROM tb_solution INNER JOIN tb_categories_solution ON category_id = post_category";
if (!empty($Req['search']['value'])) {
    $Query .= " WHERE";
    $Query .= " (post_title LIKE '%' :value '%')";
    $Query .= " OR (post_content LIKE '%' :value '%')";
//} else {
//    $Query .= " WHERE category_parent IS NULL";
}
$Read->FullRead($Query, "value={$Req['search']['value']}");
$Rows = $Read->getRowCount();

//ORDEM
$Query .= " ORDER BY {$Col[$Req['order'][0]['column']]} {$Req['order'][0]['dir']} LIMIT {$Req['start']}, {$Req['length']}";
$Read->FullRead($Query);
$Data = array();

foreach ($Read->getResult() as $dt):
    extract($dt);
    $a = mb_strimwidth($post_content, 0, 100, "...");
    $SubData = array();
    $SubData[] = "<div data-tootip='oiii'>{$post_title}</div>";
    $SubData[] = $a;
    $SubData[] = date("d/m/Y H:i", strtotime($post_date));
    $SubData[] = $category_title;
    $SubData[] = ""
            . "<div>"
            . "<button name='btn-href[]' data-href='?exe=solution/update&posts={$post_id}' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-pencil'></span></button> "
            . "<button name='btn-modal[]' data-function='solution-delete' value='{$post_id}' type='button' class='btn btn-danger btn-xs btn-rigth'><span class='lnr lnr-trash'></span></button>"
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
