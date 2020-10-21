<?php
define('ENTRY_POINT', 'INDEX');
////////////////////////////
require_once('inc/.inc.php');
////////////////////////////
 $arrReserved =\NsINV\ClsBllPaymentTerm::GetAllReserved();
 print_r($arrReserved[0]);