<?php

use app\App;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Пример API сервера
 */

/**
 * Подключени конфигурационного файла проекта
 */
require_once './app/config.php';
require_once './app/Common/autoloader.php';
require_once './app/app.class.php';
$app = new App();
global $app;

$controller = null;
$action = null;

try {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
} catch(Exception $ex) {
    echo json_encode([
        'status' => false,
        'ex' => $ex->getMessage()
    ]);
}

if($controller === null || $action === null) {
    echo json_encode([
        'status' => false,
    ]);
} else {
    $controller = trim('app\Controllers\ ') . strtolower($controller).'Controller';
    $action = 'action'.$action;
}

$currentControllerObject = new $controller($app);

try {
    $response = $currentControllerObject->$action();
    if($response) {
        echo json_encode($response);
    }else {
        echo $response;
    }
} catch (Exception $ex) {
    echo json_encode([
        'status' => false,
        'err' => $ex->getTraceAsString(),
    ]);
}
