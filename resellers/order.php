<?
include ("check.php");
include ("../info.php");
include_once("../orders/function.php");

if ($_REQUEST['paymode'] != 1 ){ header("location: http://$siteaddress/orders/?r=$adminid&id=" . r("id") ) ; exit() ; }





?>