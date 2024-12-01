<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'autoload.php';

$config = new \App\Service\Config();
$templating = new \App\Service\Templating();
$router = new \App\Service\Router();

$action = $_REQUEST['action'] ?? null;

switch ($action) {

    case 'post-index':
    case null:
        $controller = new \App\Controller\PostController();
        $view = $controller->indexAction($templating, $router);
        break;
    case 'post-create':
        $controller = new \App\Controller\PostController();
        $view = $controller->createAction($_REQUEST['post'] ?? null, $templating, $router);
        break;
    case 'post-edit':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\PostController();
        $view = $controller->editAction($_REQUEST['id'], $_REQUEST['post'] ?? null, $templating, $router);
        break;
    case 'post-show':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\PostController();
        $view = $controller->showAction($_REQUEST['id'], $router, $templating);
        break;
    case 'post-delete':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\PostController();
        $view = $controller->deleteAction($_REQUEST['id'], $router);
        break;


    case 'vehicle-index':
        $controller = new \App\Controller\VehicleController();
        $view = $controller->indexAction($router, $templating);
        break;


    case 'vehicle-create':
        $controller = new \App\Controller\VehicleController();
        $view = $controller->createAction($router, $_REQUEST['vehicle'] ?? null, $templating);
        break;


    case 'vehicle-edit':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\VehicleController();
        $view = $controller->editAction($router, $_REQUEST['id'], $_REQUEST['vehicle'] ?? null, $templating);
        break;


    case 'vehicle-show':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\VehicleController();
        $view = $controller->showAction($router, $_REQUEST['id'], $templating);
        break;

    case 'vehicle-delete':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\VehicleController();
        $view = $controller->deleteAction($_REQUEST['id'], $router);
        break;

    case 'info':
        $controller = new \App\Controller\InfoController();
        $view = $controller->infoAction();
        break;

    default:
        $view = 'Not found';
        break;
}

if ($view) {
    echo $view;
}
