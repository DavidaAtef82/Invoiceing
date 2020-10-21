<?php
define('ENTRY_POINT', 'API');
////////////////////////////
require_once('inc/.inc.php');
////////////////////////////

$param = array_merge($_POST, $_GET, $_FILES);
switch(true){
    case (!isset($param['module']) || empty($param['module'])):
    case (!isset($param['api']) || empty($param['api'])):
        header("location:" . WEB__PUBLIC . "/service.php?response=404");
        die();
}

$param['module'] = $param['module'];
$param['api'] = $param['api'];
$param['action'] = 'default';
$param['controller_type'] = 'api';
$param['controller_class'] = $param['api'];

$strControllerClass = '\Ns' . strtoupper($param['module']) . '\ClsCtrlApi' . $param['api'];
if (!class_exists($strControllerClass)) {
    header("location:" . WEB__PUBLIC . "/service.php?response=404");
    die();
}

$objController = new $strControllerClass($param);
$objController->DoAction();