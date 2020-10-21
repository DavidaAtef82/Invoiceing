<?php
define('ENTRY_POINT', 'SERVICE');
////////////////////////////
require_once('inc/.inc.php');
////////////////////////////

$param = array_merge($_POST, $_GET, $_FILES);
switch(true){
    case (!isset($param['module']) || empty($param['module'])):
    case (!isset($param['service']) || empty($param['service'])):
        header("location:" . WEB__PUBLIC . "/service.php?response=404");
        die();
}

$param['controller_type'] = 'service';
$param['controller_class'] = $param['service'];

$strControllerClass = '\Ns' . strtoupper($param['module']) . '\ClsCtrlService' . $param['service'];
if (!class_exists($strControllerClass)) {
    header("location:" . WEB__PUBLIC . "/service.php?response=404");
    die();
}

$objController = new $strControllerClass($param);    
$objController->DoAction();