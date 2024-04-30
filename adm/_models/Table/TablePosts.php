<?php

$Col = array(
    0 => 'post_title',
    1 => 'post_title',
    2 => 'post_content',
    3 => 'post_date',
    4 => 'post_category'
);
$Read = new Read;
$Read->FullRead("SELECT * FROM ws_posts INNER JOIN ws_categories ON category_id = post_category");
$Rows = $Read->getRowCount();
$TotalRows = $Rows;

//PESQUISA
$Query = "SELECT * FROM ws_posts INNER JOIN ws_categories ON category_id = post_category";
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

    $SubData = array();
    $SubData[] = "<center>" . Check::Image('uploads/' . $post_cover, $post_title, 80, 30, true) . "</center>";
    $SubData[] = "<div data-tootip='oiii'>{$post_title}</div>";
    $SubData[] = Check::Words($post_content, 10);
    $SubData[] = date("d/m/Y H:i", strtotime($post_date));
    $SubData[] = $category_title;
    $SubData[] = ""
            . "<div>"
            . "<button name='btn-href[]' data-href='?exe=posts/update&posts={$post_id}' type='button' class='btn btn-primary btn-xs btn-left'><span class='lnr lnr-pencil'></span></button> "
            . "<button name='btn-modal[]' data-function='posts-delete' value='{$post_id}' type='button' class='btn btn-danger btn-xs btn-rigth'><span class='lnr lnr-trash'></span></button>"
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
