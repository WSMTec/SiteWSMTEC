<?php

ob_start();
session_start();
include '../../_app/Config.inc.php';
$Read = new Read;
$action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);

if ($action == 'bar'):
    $Read->FullRead("SELECT agent_name as label, agent_views as value FROM ws_siteviews_agent");
    $Data = array();
    if (!$Read->getResult()):
        $Data[] = ['label' => 'Sem Registro'];
    else:
        foreach ($Read->getResult() as $dt):
            (int) $dt['value'];
            $Data[] = $dt;
        endforeach;
    endif;


    echo json_encode($Data);
endif;

if ($action == 'pie'):
    $Read->FullRead("SELECT post_title as label, post_views as value FROM ws_posts ORDER BY value DESC LIMIT 6");

    $Data = array();
    if (!$Read->getResult()):
        $Data[] = ['label' => 'Sem Registro'];
    else:
        foreach ($Read->getResult() as $dt):
            $Data[] = $dt;
        endforeach;
    endif;
    echo json_encode($Data);
endif;

if ($action == 'pie-c'):
    $Read->FullRead("SELECT post_title as label, post_views as value FROM ws_posts ORDER BY value DESC LIMIT 6");


    $Data = array();
    if (!$Read->getResult()):
        $Data[] = ['label' => 'Sem Registro'];
    else:
        foreach ($Read->getResult() as $dt):
            $Data[] = $dt;
        endforeach;
    endif;
    echo json_encode($Data);
endif;


if ($action == 'bar-t'):
    $office = $_SESSION['userlogin']['id_esc_user'];
    $Read->FullRead("SELECT post_title as label, post_views as value FROM ws_posts ORDER BY value DESC LIMIT 6");
    $Data = array();
    if (!$Read->getResult()):
        $Data[] = ['label' => 'Sem Registro'];
    else:
        foreach ($Read->getResult() as $dt):
            $Data[] = $dt;
        endforeach;
    endif;
    echo json_encode($Data);
endif;
