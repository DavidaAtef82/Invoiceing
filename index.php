<?php
define('ENTRY_POINT', 'INDEX');
////////////////////////////
require_once('inc/.inc.php');
////////////////////////////
$param = array_merge($_POST,$_GET,$_FILES);
if(!isset($param['module'])){
    $param['module'] = 'cmn';
}
if(!isset($param['page'])){
    $param['page'] = 'Index';
}
if(!isset($param['action'])){
    $param['action'] = 'Default';
}
$param['controller_type'] = 'page';
$param['controller_class'] = $param['page'];


$strControllerClass = '\Ns' . strtoupper($param['module']) . '\ClsCtrlPage' . $param['page'];
if (!class_exists($strControllerClass)) {
    header("location:" . WEB__PUBLIC . "/index.php?response=404");
    die();
}
$objController = new $strControllerClass($param);

$objController->DoAction();