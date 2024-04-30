<?php



ob_start();

session_start();

include '../../_app/Config.inc.php';



$Nivel = [3, 4];

$Coo = [6];

$Adm = (in_array($_SESSION['userlogin']['nivel_user'], $Nivel));

$Coord = (in_array($_SESSION['userlogin']['nivel_user'], $Coo));



$Req = $_REQUEST;

$Param = strip_tags(trim($Req['Param']));

$Read = new Read;

$Value = strtoupper($Req['Value']);

$Read->ExeRead("tb_empresas", "WHERE NomeEmpresa = :e LIMIT 1", "e={$Req['Value']}");

switch ($Param):
 case 'posts-index':
        require './Table/TablePosts.php';
        break;
    case 'solution-index':
        require './Table/TableSolution.php';
        break;
    case 'popup-index':
        require './Table/TablePopup.php';
        break;
    case 'categories-index':
        require './Table/TableCategories.php';
        break;
    case 'categories-solution-index':
        require './Table/TableCategoriesSolution.php';
        break;
    case 'product-index':
        require './Table/TableProduct.php';
        break;
    case 'services-index':
        require './Table/TableServices.php';
        break;
    case 'client-index':
        require './Table/TableClient.php';
        break;
//    DASHBOARD
    case 'administradores-index':
        unset($Req['value']);
        require './Table/TableAdm.php';
        break;
    case 'companies-index':
        unset($Req['value']);
        require './Table/TableCompanies.php';
        break;
    case 'users-index':
        unset($Req['value']);
        require './Table/TableUsers.php';
        break;
    case 'department-index':
        unset($Req['value']);
        $Coord;
        require './Table/TableDepartment.php';
        break;
    case 'servicos-index':
        unset($Req['value']);
        require './Table/TableServicos.php';
        break;
    case 'reports-index':
        require './Table/TableReports.php';
        break;
    case 'uploads-index':
        require './Table/TableUploads.php';
        break;
    case 'downloads-index':
        require './Table/TableDownloads.php';
        break;
    case 'tickets-index':
        $Adm;
        require './Table/TableTickets.php';
        break;
    case 'tickets-abt':
        $Adm;
        require './Table/TableAbt.php';
        break;
    case 'tickets-pdt':
        $Adm;
        require './Table/TablePdt.php';
        break;
    case 'tickets-agd':
        $Adm;
        require './Table/TableAgd.php';
        break;
    case 'tickets-fnd':
        $Adm;
        require './Table/TableFnd.php';
        break;
endswitch;





