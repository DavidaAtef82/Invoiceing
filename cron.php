<?php
define('ENTRY_POINT', 'CRON');
////////////////////////////
require_once('inc/.inc.php');
////////////////////////////

if(isset($argv[1])){
    // command line invokation
    chdir(dirname(__FILE__));
    $module = (isset($argv[2]) && !empty($argv[2]))? $argv[2] : '';
    $cron = (isset($argv[3]) && !empty($argv[3]))? $argv[3] : '';
    $arrParams = (count($argv) > 4)? array_slice($argv, 4) : array();
}elseif(!empty($_GET)){
    // most probably this is an http invokation
    $arr = array_values($_GET);
    $module = (isset($arr[0]) && !empty($arr[0]))? $arr[0] : '';
    $cron = (isset($arr[1]) && !empty($arr[1]))? $arr[1] : '';
    $arrParams = (count($arr) > 2)? array_slice($arr, 2) : array();
}else{
    $module = '';
    $cron = '';
    $arrParams = array();
}

$param['module'] = $module;
$param['cron'] = $cron;
$param['action'] = 'default';
$param['params'] = $arrParams;
$param['controller_type'] = 'cron';
$param['controller_class'] = $param['cron'];

$strControllerClass = '\Ns' . strtoupper($module) . '\ClsCtrlCron' . $cron;

switch(true){
    case (!isset($param['module']) || empty($param['module'])):
    case (!isset($param['cron']) || empty($param['cron'])):
    case (!class_exists($strControllerClass)):
        die('Invalid parameters.');
}

$objController = new $strControllerClass($param);
$objController->DoAction();