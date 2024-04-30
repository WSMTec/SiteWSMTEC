<?php

ob_start();
session_start();
include '../../_app/Config.inc.php';
require_once '../../_app/Helpers/Trigger.php';
$trigger = new Trigger;
$action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//SITE

if ($action === 'search-categories-delete'):
    $Read = new Read;
    $Read->ExeRead("ws_categories", "WHERE category_id = :id LIMIT 1", "id={$data['codigo']}");

    $json['title'] = "Deletar";
    $json['description'] = "Deseja remover a categoria <b>{$Read->getResult()[0]['category_title']}</b>?";
    echo json_encode($json);
endif;
if ($action === 'search-posts-delete'):
    $Read = new Read;
    $Read->ExeRead("ws_posts", "WHERE post_id = :id LIMIT 1", "id={$data['codigo']}");

    $json['title'] = "Deletar";
    $json['description'] = "Deseja remover o post <b>{$Read->getResult()[0]['post_title']}</b>?";
    echo json_encode($json);
endif;
if ($action === 'search-sitemap-delete'):
    $Read = new Read;
    $Read->ExeRead("tb_sitemap", "WHERE page_id = :id LIMIT 1", "id={$data['codigo']}");

    $json['title'] = "Deletar";
    $json['description'] = "Deseja remover a url <b>{$Read->getResult()[0]['page_name']}</b>?";
    echo json_encode($json);
endif;
if ($action === 'search-services-delete'):
    $Read = new Read;
    $Read->ExeRead("tb_services", "WHERE serv_id = :id LIMIT 1", "id={$data['codigo']}");

    $json['title'] = "Deletar";
    $json['description'] = "Deseja remover o serviço <b>{$Read->getResult()[0]['serv_title']}</b>?";
    echo json_encode($json);
endif;
if ($action === 'search-product-delete'):
    $Read = new Read;
    $Read->ExeRead("tb_product", "WHERE prod_id = :id LIMIT 1", "id={$data['codigo']}");

    $json['title'] = "Deletar";
    $json['description'] = "Deseja remover o produto <b>{$Read->getResult()[0]['prod_title']}</b>?";
    echo json_encode($json);
endif;
if ($action === 'search-popup-delete'):
    $Read = new Read;
    $Read->ExeRead("tb_ebook", "WHERE ebook_id = :id LIMIT 1", "id={$data['codigo']}");

    $json['title'] = "Deletar";
    $json['description'] = "Deseja remover o eBook <b>{$Read->getResult()[0]['ebook_title']}</b>?";
    echo json_encode($json);
endif;

if ($action === 'search-client-delete'):
    $Read = new Read;
    $Read->ExeRead("tb_client", "WHERE client_id = :id LIMIT 1", "id={$data['codigo']}");

    $json['title'] = "Deletar";
    $json['description'] = "Deseja remover o cliente <b>{$Read->getResult()[0]['client_title']}</b>?";
    echo json_encode($json);
endif;

//DASHBOARD SISTEMA
if ($action === 'search-categories-solution-delete'):
    $Read = new Read;
    $Read->ExeRead("tb_categories_solution", "WHERE category_id = :id LIMIT 1", "id={$data['codigo']}");

    $json['title'] = "Deletar";
    $json['description'] = "Deseja remover a categoria <b>{$Read->getResult()[0]['category_title']}</b>?";
    echo json_encode($json);
endif;
if ($action === 'search-solution-delete'):
    $Read = new Read;
    $Read->ExeRead("tb_solution", "WHERE post_id = :id LIMIT 1", "id={$data['codigo']}");

    $json['title'] = "Deletar";
    $json['description'] = "Deseja remover a solução <b>{$Read->getResult()[0]['post_title']}</b>?";
    echo json_encode($json);
endif;
if ($action === 'search-companies-delete'):
    $Read = new Read;
    $Read->ExeRead("tb_empresas", "WHERE IdEmpresa = :id LIMIT 1", "id={$data['codigo']}");

    $json['title'] = "Deletar";
    $json['description'] = "Deseja remover a empresa <b>{$Read->getResult()[0]['NomeEmpresa']}</b>? Todos os departamentos, usuários, uploads, relatórios e tickets serão deletados, da empresa.";
    echo json_encode($json);
endif;

if ($action === 'search-department-delete'):
    $Read = new Read;
    $Read->ExeRead("tb_department", "WHERE dep_id = :id LIMIT 1", "id={$data['codigo']}");

    $json['title'] = "Deletar";
    $json['description'] = "Deseja remover o departamento <b>{$Read->getResult()[0]['dep_title']}</b>";
    echo json_encode($json);
endif;

if ($action === 'search-user-delete'):
    $Read = new Read;
    $Read->ExeRead("tb_usuarios", "WHERE IdUsuario = :id LIMIT 1", "id={$data['codigo']}");

    $json['title'] = "Deletar";
    $json['description'] = "Deseja remover o usuário <b>{$Read->getResult()[0]['NomeUsuario']}</b>";
    echo json_encode($json);
endif;

if ($action === 'search-training-delete'):
    $Read = new Read;
    $Read->ExeRead("tb_testemunhas", "WHERE IdTes = :id LIMIT 1", "id={$data['codigo']}");

    $json['title'] = "Deletar";
    $json['description'] = "Deseja remover o cliente <b>{$Read->getResult()[0]['NomeTes']}</b>";
    echo json_encode($json);
endif;

if ($action === 'search-upload-delete'):
    $Read = new Read;
    $Read->ExeRead("tb_uploads", "WHERE name_up = :u LIMIT 1", "u={$data['codigo']}");

    $json['title'] = "Deletar";
    $json['description'] = "Deseja remover o upload <b>{$Read->getResult()[0]['NomeUp']}</b>";
    echo json_encode($json);
endif;

if ($action === 'search-servicos-delete'):
    $Read = new Read;
    $Read->ExeRead("tb_servicos", "WHERE IdServico = :u LIMIT 1", "u={$data['codigo']}");

    $json['title'] = "Deletar";
    $json['description'] = "Deseja remover o serviço <b>{$Read->getResult()[0]['NomeServico']}</b>";
    echo json_encode($json);
endif;

if ($action === 'search-reports-delete'):
    $Read = new Read;
    $Read->ExeRead("tb_relatorios", "WHERE IdRelatorio = :u LIMIT 1", "u={$data['codigo']}");

    $json['title'] = "Deletar";
    $json['description'] = "Deseja remover o relatório <b>{$Read->getResult()[0]['ProjetoRelatorio']}</b>";
    echo json_encode($json);
endif;

if ($action === 'search-tickets-active'):
    $Read = new Read;
    $Read->ExeRead("tb_tickets", "WHERE id = :u LIMIT 1", "u={$data['codigo']}");

    $json['title'] = "Ativação";
    $json['description'] = "Deseja aceitar o ticket <b>{$Read->getResult()[0]['assunto']}</b>";
    echo json_encode($json);
endif;

if ($action === 'search-tickets-finalize'):
    $Read = new Read;
    $Read->ExeRead("tb_tickets", "WHERE id = :u LIMIT 1", "u={$data['codigo']}");

    $json['title'] = "Finalizar";
    $json['description'] = "Deseja finalizar o ticket <b>{$Read->getResult()[0]['assunto']}</b>";
    echo json_encode($json);
endif;

if ($action === 'search-list-department'):
    $codigo = filter_input(INPUT_GET, 'codigo', FILTER_DEFAULT);
    $Department = array();
    $Read = new Read;
    $Read->ExeRead("tb_department", "WHERE dep_id_companies = :id AND dep_title != 'DIRETORIA'", "id={$codigo}");
    foreach ($Read->getResult() as $v):
        $Department[] = array(
            "dep_id" => $v['dep_id'],
            "dep_title" => $v['dep_title']
        );
    endforeach;
    echo( json_encode($Department) );
endif;


if ($action === 'search-ticket-msg'):
    $Read = new Read;
    $Read->FullRead(""
            . "SELECT tb_mensagens.*, tb_usuarios.NomeUsuario FROM tb_mensagens "
            . "INNER JOIN tb_usuarios ON IdUsuario = remetente "
            . "WHERE idticket = :u AND idmsg > :last ORDER BY idmsg ASC LIMIT 1", "u={$data['codigo']}&last={$data['last']}");
    if ($Read->getResult()):
        foreach ($Read->getResult() as $comment) {
            $json['comments'][] = $comment;
        }
    else:
        $json['comments'] = null;
    endif;
    echo json_encode($json);
endif;

if ($action === 'search-ticket-msg-push-adm'):
    $Read = new Read;
    $Read->FullRead("SELECT * FROM tb_tickets WHERE status = 'PENDENTE' ORDER BY id DESC");
    if ($Read->getResult()):
        $json['tic_n'] = $Read->getRowCount();
    else:
        $json['tic_n'] = null;
    endif;

    $Read->FullRead("SELECT * FROM tb_tickets WHERE status = 'PENDENTE' AND id > :last ORDER BY id ASC LIMIT 1", "last={$data['codigo']}");
//    echo $data['codigo'];

    if ($Read->getResult()):
        $json['tic_m'] = $Read->getResult()[0]['assunto'];
        $json['tic_i'] = $Read->getResult()[0]['id'];
    else:
        $json['tic_m'] = null;
    endif;
    echo json_encode($json);
endif;
//
//if ($action === 'search-ticket-msg-push'):
//    $Read = new Read;
//    $Read->FullRead("SELECT * FROM tb_mensagens WHERE statusmsg = 'N' AND destino = :i ORDER BY idmsg DESC LIMIT 1", "i={$data['codigo']}");
//    if ($Read->getResult()):
//        $v = strip_tags($Read->getResult()[0]);
//        echo json_encode($Read->getResult()[0]);
//    else:
//        echo json_encode(null);
//    endif;
//endif;
//
//if ($action === 'search-ticket-msg-pushs'):
//    $Read = new Read;
//    $Read->FullRead("SELECT * FROM tb_mensagens WHERE statusmsg = 'N' AND destino = :i ORDER BY idmsg DESC LIMIT 1", "i={$_SESSION['userlogin']['IdUsuario']}");
//    if ($Read->getResult()):
//        $v = strip_tags($Read->getResult()[0]);
//        echo json_encode($v);
//    else:
//        echo json_encode(null);
//    endif;
//endif;


switch ($action):
//    SITE

    case 'popup':
        require('./Class/AdminPopup.class.php');
//        require('./Class/AdminNewsletter.class.php');
        $data['ebook_popup'] = (isset($_FILES['ebook_popup']['tmp_name']) ? $_FILES['ebook_popup'] : '');
        $data['ebook_cover'] = (isset($_FILES['ebook_cover']['tmp_name']) ? $_FILES['ebook_cover'] : 'null');
        $data['ebook_pdf'] = 'null';
//        var_dump($data);

        $Post = new AdminPopup;
        if ($data['ebook_type'] == 'ebook') {
            unset($data['ebook_service']);
            $Post->ExeCreate($data);
//        var_dump($Post);
        } else {
            $Post->ExeCreateS($data);
        }

        if ($Post->getResult()):
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Post->getError()[0], $Post->getError()[1], $Post->getError()[2], $Post->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Post->getError()[0], $Post->getError()[1], $Post->getError()[2], $Post->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'popup-delete':
        require('./Class/AdminPopup.class.php');
        $Post = new AdminPopup;
        $Post->ExeDelete($data['codigo']);
        if ($Post->getResult()):
            $json['row'] = true;
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Post->getError()[0], $Post->getError()[1], $Post->getError()[2], $Post->getError()[3]);
        else:
            $json['row'] = false;
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Post->getError()[0], $Post->getError()[1], $Post->getError()[2], $Post->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'popup-update':
        require('./Class/AdminPopup.class.php');
//        require('./Class/AdminNewsletter.class.php');
        $data['ebook_popup'] = (isset($_FILES['ebook_popup']['tmp_name']) ? $_FILES['ebook_popup'] : 'null');
        $data['ebook_cover'] = (isset($_FILES['ebook_cover']['tmp_name']) ? $_FILES['ebook_cover'] : 'null');
        $data['ebook_pdf'] = 'null';
        $Post = new AdminPopup;
        $IdPost = $data['ebook_id'];
        unset($data['ebook_id']);

        if ($data['ebook_type'] == 'ebook') {
            $Post->ExeUpdate($IdPost, $data);
        } else {
            $Post->ExeUpdateS($IdPost, $data);
        }

        if ($Post->getResult()):
            $json['erro'] = true;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Post->getError()[0], $Post->getError()[1], $Post->getError()[2], $Post->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Post->getError()[0], $Post->getError()[1], $Post->getError()[2], $Post->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'sitemap':
        require('./Class/AdminSitemap.class.php');
        $Cat = new AdminSitemap;
        $Cat->ExeCreate($data);
        if ($Cat->getResult()):
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Cat->getError()[0], $Cat->getError()[1], $Cat->getError()[2], $Cat->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Cat->getError()[0], $Cat->getError()[1], $Cat->getError()[2], $Cat->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'sitemap-update':
        require('./Class/AdminSitemap.class.php');
        $Cat = new AdminSitemap;
        $IdCat = $data['category_id'];
        unset($data['category_id']);
        $Cat->ExeUpdate($IdCat, $data);
        if ($Cat->getResult()):
            $json['erro'] = true;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Cat->getError()[0], $Cat->getError()[1], $Cat->getError()[2], $Cat->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Cat->getError()[0], $Cat->getError()[1], $Cat->getError()[2], $Cat->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'sitemap-delete':
        require('./Class/AdminSitemap.class.php');
        $Cat = new AdminSitemap;
        $Cat->ExeDelete($data['codigo']);
        if ($Cat->getResult()):
            $json['reloadtime'] = true;
//            $json['grid'] = true;
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Cat->getError()[0], $Cat->getError()[1], $Cat->getError()[2], $Cat->getError()[3]);
        else:
            $json['row'] = false;
//            $json['grid'] = false;
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Cat->getError()[0], $Cat->getError()[1], $Cat->getError()[2], $Cat->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'categories':
        require('./Class/AdminCategory.class.php');
        $Cat = new AdminCategory;
        $Cat->ExeCreate($data);
        if ($Cat->getResult()):
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Cat->getError()[0], $Cat->getError()[1], $Cat->getError()[2], $Cat->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Cat->getError()[0], $Cat->getError()[1], $Cat->getError()[2], $Cat->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'categories-update':
        require('./Class/AdminCategory.class.php');
        $Cat = new AdminCategory;
        $IdCat = $data['category_id'];
        unset($data['category_id']);
        $Cat->ExeUpdate($IdCat, $data);
        if ($Cat->getResult()):
            $json['erro'] = true;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Cat->getError()[0], $Cat->getError()[1], $Cat->getError()[2], $Cat->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Cat->getError()[0], $Cat->getError()[1], $Cat->getError()[2], $Cat->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'categories-delete':
        require('./Class/AdminCategory.class.php');
        $Cat = new AdminCategory;
        $Cat->ExeDelete($data['codigo']);
        if ($Cat->getResult()):
            $json['row'] = true;
//            $json['grid'] = true;
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Cat->getError()[0], $Cat->getError()[1], $Cat->getError()[2], $Cat->getError()[3]);
        else:
            $json['row'] = false;
//            $json['grid'] = false;
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Cat->getError()[0], $Cat->getError()[1], $Cat->getError()[2], $Cat->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'posts':
        require('./Class/AdminPost.class.php');
        require('./Class/AdminNewsletter.class.php');
        $data['post_cover'] = (isset($_FILES['post_cover']['tmp_name']) ? $_FILES['post_cover'] : '');
        $Post = new AdminPost;
        $Post->ExeCreate($data);
        if ($Post->getResult()):
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Post->getError()[0], $Post->getError()[1], $Post->getError()[2], $Post->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Post->getError()[0], $Post->getError()[1], $Post->getError()[2], $Post->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'posts-delete':
        require('./Class/AdminPost.class.php');
        $Post = new AdminPost;
        $Post->ExeDelete($data['codigo']);
        if ($Post->getResult()):
            $json['row'] = true;
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Post->getError()[0], $Post->getError()[1], $Post->getError()[2], $Post->getError()[3]);
        else:
            $json['row'] = false;
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Post->getError()[0], $Post->getError()[1], $Post->getError()[2], $Post->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'posts-update':
        require('./Class/AdminPost.class.php');
        require('./Class/AdminNewsletter.class.php');
        $data['post_cover'] = (isset($_FILES['post_cover']['tmp_name']) ? $_FILES['post_cover'] : 'null');
        $Post = new AdminPost;
        $IdPost = $data['post_id'];
        unset($data['post_id']);
        $Post->ExeUpdate($IdPost, $data);
        if ($Post->getResult()):
            $json['erro'] = true;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Post->getError()[0], $Post->getError()[1], $Post->getError()[2], $Post->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Post->getError()[0], $Post->getError()[1], $Post->getError()[2], $Post->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'services':
        require('./Class/AdminServices.class.php');
        $data['serv_img'] = (isset($_FILES['serv_img']['tmp_name']) ? $_FILES['serv_img'] : '');
        $Service = new AdminServices;
        $Service->ExeCreate($data);
        if ($Service->getResult()):
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Service->getError()[0], $Service->getError()[1], $Service->getError()[2], $Service->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Service->getError()[0], $Service->getError()[1], $Service->getError()[2], $Service->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'services-update':
        require('./Class/AdminServices.class.php');
        $data['serv_img'] = (isset($_FILES['serv_img']['tmp_name']) ? $_FILES['serv_img'] : 'null');
        $Service = new AdminServices;
        $IdPost = $data['serv_id'];
        unset($data['serv_id']);
        $Service->ExeUpdate($IdPost, $data);
        if ($Service->getResult()):
            $json['erro'] = true;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Service->getError()[0], $Service->getError()[1], $Service->getError()[2], $Service->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Service->getError()[0], $Service->getError()[1], $Service->getError()[2], $Service->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'services-delete':
        require('./Class/AdminServices.class.php');
        $data['serv_img'] = (isset($_FILES['serv_img']['tmp_name']) ? $_FILES['serv_img'] : 'null');
        $Service = new AdminServices;
        $Service->ExeDelete($data['codigo']);
        if ($Service->getResult()):
            $json['erro'] = true;
            $json['row'] = true;
            $json['notify'] = $trigger->notify($Service->getError()[0], $Service->getError()[1], $Service->getError()[2], $Service->getError()[3]);
        else:
            $json['erro'] = false;
            $json['row'] = false;
            $json['notify'] = $trigger->notify($Service->getError()[0], $Service->getError()[1], $Service->getError()[2], $Service->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'product':
        require('./Class/AdminProduct.class.php');
        $data['prod_img'] = (isset($_FILES['prod_img']['tmp_name']) ? $_FILES['prod_img'] : '');
        $Product = new AdminProduct;
        $Product->ExeCreate($data);
        if ($Product->getResult()):
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Product->getError()[0], $Product->getError()[1], $Product->getError()[2], $Product->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Product->getError()[0], $Product->getError()[1], $Product->getError()[2], $Product->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'product-update':
        require('./Class/AdminProduct.class.php');
        $data['prod_img'] = (isset($_FILES['prod_img']['tmp_name']) ? $_FILES['prod_img'] : 'null');
        $Product = new AdminProduct;
        $IdPost = $data['prod_id'];
        unset($data['prod_id']);
        $Product->ExeUpdate($IdPost, $data);
        if ($Product->getResult()):
            $json['erro'] = true;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Product->getError()[0], $Product->getError()[1], $Product->getError()[2], $Product->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Product->getError()[0], $Product->getError()[1], $Product->getError()[2], $Product->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'product-delete':
        require('./Class/AdminProduct.class.php');
        $Product = new AdminProduct;
        $Product->ExeDelete($data['codigo']);
        if ($Product->getResult()):
            $json['erro'] = true;
            $json['row'] = true;
            $json['notify'] = $trigger->notify($Product->getError()[0], $Product->getError()[1], $Product->getError()[2], $Product->getError()[3]);
        else:
            $json['erro'] = false;
            $json['row'] = false;
            $json['notify'] = $trigger->notify($Product->getError()[0], $Product->getError()[1], $Product->getError()[2], $Product->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'newsletter':
        require('./Class/AdminNewsletter.class.php');
        $News = new AdminNewsletter;
        $News->ExeNews($data['post_id']);
        if ($News->getResult()):
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($News->getError()[0], $News->getError()[1], $News->getError()[2], $News->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($News->getError()[0], $News->getError()[1], $News->getError()[2], $News->getError()[3]);
        endif;
        echo json_encode($json);
        break;
//    DASHBOARD SISTEMA
    case 'user':
        require('./Class/AdminUser.class.php');
        if ($data['nivel_user'] == 2 || $data['nivel_user'] == 3 || $data['nivel_user'] == 6):
            unset($data['dep_id_user']);
        endif;
        if ($data['nivel_user'] == 3):
            unset($data['IdEmpresaUsuario']);
        endif;
        $User = new AdminUser;
        $User->ExeCreate($data);
        if ($User->getResult()):
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($User->getError()[0], $User->getError()[1], $User->getError()[2], $User->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($User->getError()[0], $User->getError()[1], $User->getError()[2], $User->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'user-update':
        require('./Class/AdminUser.class.php');
        if ($data['nivel_user'] == 2 || $data['nivel_user'] == 3 || $data['nivel_user'] == 6):
            unset($data['dep_id_user']);
        endif;
        if ($data['nivel_user'] == 3):
            unset($data['IdEmpresaUsuario']);
        endif;
        $User = new AdminUser;
        $idUser = $data['IdUsuario'];
        unset($data['IdUsuario']);
        $User->ExeUpdate($idUser, $data);
        if ($User->getResult()):
            $json['erro'] = true;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($User->getError()[0], $User->getError()[1], $User->getError()[2], $User->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($User->getError()[0], $User->getError()[1], $User->getError()[2], $User->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'user-delete':
        require('./Class/AdminUser.class.php');
        $Id = $data['codigo'];
        unset($data['codigo']);
        $User = new AdminUser;
        $User->ExeDelete($Id);
        if ($User->getResult()):
            $json['row'] = true;
            $json['erro'] = true;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($User->getError()[0], $User->getError()[1], $User->getError()[2], $User->getError()[3]);
        else:
            $json['erro'] = false;
            $json['row'] = false;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($User->getError()[0], $User->getError()[1], $User->getError()[2], $User->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'user-profile':
        require('./Class/AdminUser.class.php');
        $data['FotoUsuario'] = (isset($_FILES['FotoUsuario']['tmp_name']) ? $_FILES['FotoUsuario'] : 'null');
        $User = new AdminUser;
        $User->ExeProfile($_SESSION['userlogin']['IdUsuario'], $data);
        if ($User->getResult()):
            $json['erro'] = true;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($User->getError()[0], $User->getError()[1], $User->getError()[2], $User->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($User->getError()[0], $User->getError()[1], $User->getError()[2], $User->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'companies':
        require('./Class/AdminCompanies.class.php');
        $Companies = new AdminCompanies;
        $Companies->ExeCreate($data);
        if ($Companies->getResult()):
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Companies->getError()[0], $Companies->getError()[1], $Companies->getError()[2], $Companies->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Companies->getError()[0], $Companies->getError()[1], $Companies->getError()[2], $Companies->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'companies-update':
        require('./Class/AdminCompanies.class.php');
        $Id = $data['IdEmpresa'];
        unset($data['IdEmpresa']);
        $Companies = new AdminCompanies;
        $Companies->ExeUpdate($Id, $data);
        if ($Companies->getResult()):
            $json['erro'] = true;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Companies->getError()[0], $Companies->getError()[1], $Companies->getError()[2], $Companies->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Companies->getError()[0], $Companies->getError()[1], $Companies->getError()[2], $Companies->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'companies-delete':
        require('./Class/AdminCompanies.class.php');
        $Id = $data['codigo'];
        unset($data['codigo']);
        $Companies = new AdminCompanies;
        $Companies->ExeDelete($Id);
        if ($Companies->getResult()):
            $json['row'] = true;
            $json['erro'] = true;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Companies->getError()[0], $Companies->getError()[1], $Companies->getError()[2], $Companies->getError()[3]);
        else:
            $json['erro'] = false;
            $json['row'] = false;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Companies->getError()[0], $Companies->getError()[1], $Companies->getError()[2], $Companies->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'department':
        require('./Class/AdminDepartment.class.php');
        $Department = new AdminDepartment;
        $Department->ExeCreate($data);
        if ($Department->getResult()):
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Department->getError()[0], $Department->getError()[1], $Department->getError()[2], $Department->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Department->getError()[0], $Department->getError()[1], $Department->getError()[2], $Department->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'department-update':
        require('./Class/AdminDepartment.class.php');
        $Department = new AdminDepartment;
        $Id = $data['dep_id'];
        unset($data['dep_id']);
        $Department->ExeUpdate($Id, $data);
        if ($Department->getResult()):
            $json['erro'] = true;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Department->getError()[0], $Department->getError()[1], $Department->getError()[2], $Department->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Department->getError()[0], $Department->getError()[1], $Department->getError()[2], $Department->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'department-delete':
        require('./Class/AdminDepartment.class.php');
        $Department = new AdminDepartment;
        $Id = $data['codigo'];
        unset($data['codigo']);
        $Department->ExeDelete($Id);
        if ($Department->getResult()):
            $json['erro'] = true;
            $json['reset'] = true;
            $json['row'] = true;
            $json['notify'] = $trigger->notify($Department->getError()[0], $Department->getError()[1], $Department->getError()[2], $Department->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Department->getError()[0], $Department->getError()[1], $Department->getError()[2], $Department->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'servicos':
        require('./Class/AdminServicos.class.php');
        $Servicos = new AdminServicos;
        $Servicos->ExeCreate($data);
        if ($Servicos->getResult()):
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Servicos->getError()[0], $Servicos->getError()[1], $Servicos->getError()[2], $Servicos->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Servicos->getError()[0], $Servicos->getError()[1], $Servicos->getError()[2], $Servicos->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'servicos-update':
        require('./Class/AdminServicos.class.php');
        $Servicos = new AdminServicos;
        $Id = $data['IdServico'];
        unset($data['IdServico']);
        $Servicos->ExeUpdate($Id, $data);
        if ($Servicos->getResult()):
            $json['erro'] = true;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Servicos->getError()[0], $Servicos->getError()[1], $Servicos->getError()[2], $Servicos->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Servicos->getError()[0], $Servicos->getError()[1], $Servicos->getError()[2], $Servicos->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'servicos-delete':
        require('./Class/AdminServicos.class.php');
        $Servicos = new AdminServicos;
        $Id = $data['codigo'];
        unset($data['codigo']);
        $Servicos->ExeDelete($Id);
        if ($Servicos->getResult()):
            $json['row'] = true;
            $json['erro'] = true;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Servicos->getError()[0], $Servicos->getError()[1], $Servicos->getError()[2], $Servicos->getError()[3]);
        else:
            $json['row'] = false;
            $json['erro'] = false;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Servicos->getError()[0], $Servicos->getError()[1], $Servicos->getError()[2], $Servicos->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'reports':
        require('./Class/AdminReports.class.php');
        $Reports = new AdminReports;
        $Reports->ExeCreate($data);
        if ($Reports->getResult()):
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Reports->getError()[0], $Reports->getError()[1], $Reports->getError()[2], $Reports->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Reports->getError()[0], $Reports->getError()[1], $Reports->getError()[2], $Reports->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'reports-update':
        require('./Class/AdminReports.class.php');
        $Reports = new AdminReports;
        $Id = $data['IdRelatorio'];
        unset($data['IdRelatorio']);
        $Reports->ExeUpdate($Id, $data);
        if ($Reports->getResult()):
            $json['training'] = true;
            $json['erro'] = true;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Reports->getError()[0], $Reports->getError()[1], $Reports->getError()[2], $Reports->getError()[3]);
        else:
            $json['training'] = false;
            $json['erro'] = false;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Reports->getError()[0], $Reports->getError()[1], $Reports->getError()[2], $Reports->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'reports-delete':
        require('./Class/AdminReports.class.php');
        $Reports = new AdminReports;
        $Id = $data['codigo'];
        unset($data['codigo']);
        $Reports->ExeDelete($Id);
        if ($Reports->getResult()):
            $json['row'] = true;
            $json['erro'] = true;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Reports->getError()[0], $Reports->getError()[1], $Reports->getError()[2], $Reports->getError()[3]);
        else:
            $json['row'] = false;
            $json['erro'] = false;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Reports->getError()[0], $Reports->getError()[1], $Reports->getError()[2], $Reports->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'training-delete':
        require('./Class/AdminReports.class.php');
        $Reports = new AdminReports;
        $Id = $data['codigo'];
        unset($data['codigo']);
        $Reports->ExeDeleteTrain($Id);
        if ($Reports->getResult()):
            $json['grid'] = true;
            $json['erro'] = true;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Reports->getError()[0], $Reports->getError()[1], $Reports->getError()[2], $Reports->getError()[3]);
        else:
            $json['grid'] = true;
            $json['erro'] = false;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Reports->getError()[0], $Reports->getError()[1], $Reports->getError()[2], $Reports->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'upload':
        $data['Upload'] = (isset($_FILES['Upload']['tmp_name']) ? $_FILES['Upload'] : null);
        require('./Class/AdminUpload.class.php');
        $Upload = new AdminUpload;
        $Upload->ExeCreate($data);
        if ($Upload->getResult()):
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Upload->getError()[0], $Upload->getError()[1], $Upload->getError()[2], $Upload->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Upload->getError()[0], $Upload->getError()[1], $Upload->getError()[2], $Upload->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'upload-update':
        $data['Upload'] = (isset($_FILES['Upload']['tmp_name']) ? $_FILES['Upload'] : 'null');
        require('./Class/AdminUpload.class.php');
        $Upload = new AdminUpload;
        $Upload->ExeUpdate($data);
        if ($Upload->getResult()):
            $json['erro'] = true;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Upload->getError()[0], $Upload->getError()[1], $Upload->getError()[2], $Upload->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Upload->getError()[0], $Upload->getError()[1], $Upload->getError()[2], $Upload->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'upload-delete':
        require('./Class/AdminUpload.class.php');
        $Upload = new AdminUpload;
        $Name = $data['codigo'];
        unset($data['codigo']);
        $Upload->ExeDelete($Name);
        if ($Upload->getResult()):
            $json['erro'] = true;
            $json['row'] = true;
            $json['notify'] = $trigger->notify($Upload->getError()[0], $Upload->getError()[1], $Upload->getError()[2], $Upload->getError()[3]);
        else:
            $json['row'] = false;
            $json['erro'] = false;
            $json['notify'] = $trigger->notify($Upload->getError()[0], $Upload->getError()[1], $Upload->getError()[2], $Upload->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'tickets':
        $data['file'] = (isset($_FILES['file']['tmp_name']) ? $_FILES['file'] : 'null');
        require('./Class/AdminTickets.class.php');
        $Ticket = new AdminTickets;
        $Ticket->ExeCreate($data);
        if ($Ticket->getResult()):
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Ticket->getError()[0], $Ticket->getError()[1], $Ticket->getError()[2], $Ticket->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Ticket->getError()[0], $Ticket->getError()[1], $Ticket->getError()[2], $Ticket->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'tickets-active':
        require('./Class/AdminTickets.class.php');
        $Ticket = new AdminTickets;
        $Ticket->ExeActive($data['codigo']);
        if ($Ticket->getResult()):
            $json['erro'] = true;
            $json['href'] = $Ticket->getResult();
            $json['notify'] = $trigger->notify($Ticket->getError()[0], $Ticket->getError()[1], $Ticket->getError()[2], $Ticket->getError()[3]);
        else:
            $json['erro'] = false;
            $json['href'] = false;
            $json['notify'] = $trigger->notify($Ticket->getError()[0], $Ticket->getError()[1], $Ticket->getError()[2], $Ticket->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'tickets-msg':
        $data['file'] = (isset($_FILES['file']['tmp_name']) ? $_FILES['file'] : 'null');
        require('./Class/AdminTickets.class.php');
        $Ticket = new AdminTickets;

        $Id = $data['id'];
        unset($data['id']);
        $Ticket->ExeMsg($Id, $data);

        if ($Ticket->getResult()):
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Ticket->getError()[0], $Ticket->getError()[1], $Ticket->getError()[2], $Ticket->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Ticket->getError()[0], $Ticket->getError()[1], $Ticket->getError()[2], $Ticket->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'tickets-finalize':
        require('./Class/AdminTickets.class.php');
        $Ticket = new AdminTickets;
        $Ticket->ExeFinalize($data['codigo']);
        if ($Ticket->getResult()):
            $json['erro'] = true;
            $json['ticket'] = true;
            $json['notify'] = $trigger->notify($Ticket->getError()[0], $Ticket->getError()[1], $Ticket->getError()[2], $Ticket->getError()[3]);
        else:
            $json['erro'] = false;
            $json['ticket'] = false;
            $json['notify'] = $trigger->notify($Ticket->getError()[0], $Ticket->getError()[1], $Ticket->getError()[2], $Ticket->getError()[3]);
        endif;
        echo json_encode($json);
        break;

    case 'client':
        require('./Class/AdminClient.class.php');
        $data['client_cover'] = (isset($_FILES['client_cover']['tmp_name']) ? $_FILES['client_cover'] : '');
        $Client = new AdminClient;
        $Client->ExeCreate($data);
        if ($Client->getResult()):
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Client->getError()[0], $Client->getError()[1], $Client->getError()[2], $Client->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Client->getError()[0], $Client->getError()[1], $Client->getError()[2], $Client->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'client-delete':
        require('./Class/AdminClient.class.php');
        $Client = new AdminClient;
        $Client->ExeDelete($data['codigo']);
        if ($Client->getResult()):
            $json['row'] = true;
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Client->getError()[0], $Client->getError()[1], $Client->getError()[2], $Client->getError()[3]);
        else:
            $json['row'] = false;
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Client->getError()[0], $Client->getError()[1], $Client->getError()[2], $Client->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'client-update':
        require('./Class/AdminClient.class.php');
        $data['client_cover'] = (isset($_FILES['client_cover']['tmp_name']) ? $_FILES['client_cover'] : 'null');
        $Client = new AdminClient;
        $IdClient = $data['client_id'];
        unset($data['client_id']);
        $Client->ExeUpdate($IdClient, $data);
        if ($Client->getResult()):
            $json['erro'] = true;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Client->getError()[0], $Client->getError()[1], $Client->getError()[2], $Client->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Client->getError()[0], $Client->getError()[1], $Client->getError()[2], $Client->getError()[3]);
        endif;
        echo json_encode($json);
        break;


    case 'categories-solution':
        require('./Class/AdminCategorySolution.class.php');
        $Cat = new AdminCategorySolution;
        $Cat->ExeCreate($data);
        if ($Cat->getResult()):
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Cat->getError()[0], $Cat->getError()[1], $Cat->getError()[2], $Cat->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Cat->getError()[0], $Cat->getError()[1], $Cat->getError()[2], $Cat->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'categories-solution-update':
        require('./Class/AdminCategorySolution.class.php');
        $Cat = new AdminCategorySolution;
        $IdCat = $data['category_id'];
        unset($data['category_id'], $data['category_date']);
        $Cat->ExeUpdate($IdCat, $data);
        if ($Cat->getResult()):
            $json['erro'] = true;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Cat->getError()[0], $Cat->getError()[1], $Cat->getError()[2], $Cat->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Cat->getError()[0], $Cat->getError()[1], $Cat->getError()[2], $Cat->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'categories-solution-delete':
        require('./Class/AdminCategorySolution.class.php');
        $Cat = new AdminCategorySolution;
        $Cat->ExeDelete($data['codigo']);
        if ($Cat->getResult()):
            $json['row'] = true;
//            $json['grid'] = true;
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Cat->getError()[0], $Cat->getError()[1], $Cat->getError()[2], $Cat->getError()[3]);
        else:
            $json['row'] = false;
//            $json['grid'] = false;
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Cat->getError()[0], $Cat->getError()[1], $Cat->getError()[2], $Cat->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'solution':
        require('./Class/AdminSolution.class.php');
        $Post = new AdminSolution;
        $Post->ExeCreate($data);
        if ($Post->getResult()):
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Post->getError()[0], $Post->getError()[1], $Post->getError()[2], $Post->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Post->getError()[0], $Post->getError()[1], $Post->getError()[2], $Post->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'solution-delete':
        require('./Class/AdminSolution.class.php');
        $Post = new AdminSolution;
        $Post->ExeDelete($data['codigo']);
        if ($Post->getResult()):
            $json['row'] = true;
            $json['erro'] = true;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Post->getError()[0], $Post->getError()[1], $Post->getError()[2], $Post->getError()[3]);
        else:
            $json['row'] = false;
            $json['erro'] = false;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Post->getError()[0], $Post->getError()[1], $Post->getError()[2], $Post->getError()[3]);
        endif;
        echo json_encode($json);
        break;
    case 'solution-update':
        require('./Class/AdminSolution.class.php');
        $Post = new AdminSolution;
        $IdPost = $data['post_id'];
        unset($data['post_id'], $data['post_date']);
        $Post->ExeUpdate($IdPost, $data);
        if ($Post->getResult()):
            $json['erro'] = true;
            $json['reset'] = false;
            $json['notify'] = $trigger->notify($Post->getError()[0], $Post->getError()[1], $Post->getError()[2], $Post->getError()[3]);
        else:
            $json['erro'] = false;
            $json['reset'] = true;
            $json['notify'] = $trigger->notify($Post->getError()[0], $Post->getError()[1], $Post->getError()[2], $Post->getError()[3]);
        endif;
        echo json_encode($json);
        break;
endswitch;


if ($action === 'search-notification'):
    if ($_SESSION['userlogin']['nivel_user'] >= 3):
        $Read = new Read;
        $Read->FullRead("SELECT * FROM n_notificacoes WHERE destiny_name = 'ADM' ORDER BY date_not DESC");
        if ($Read->getRowCount()):
            echo "<div class='content-ul'>";
            foreach ($Read->getResult() as $v):
                extract($v);
                $style = ($status_not === 'NL' ? "color: #000;font-style: oblique;" : "");
                $type = ($type_num_not == 1 ? "t" : "e");
                echo "<li class='li-not'><a style='{$style}' href='?exe=notificacoes/escritorio&n={$id_not}-{$type}'>{$type_not}</a><small>{$date_not}</small></li>";
            endforeach;
            echo "</div>";
        else:

        endif;
    else:
        echo '<center>Notificação</center>';
    endif;
endif;
