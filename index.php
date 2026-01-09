<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/controllers/RouteController.php';

$controller = new RouteController();
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'procesar':
        $controller->procesar();
        break;
    case 'mapa':
        $controller->mapa();
        break;
    case 'index':
    default:
        $controller->index();
        break;
}
