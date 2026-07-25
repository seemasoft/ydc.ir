<?

include_once ("../connection.php");
if ($_REQUEST['action']=='activate' && strlen($_REQUEST['key']) > 16 && is_numeric($_REQUEST['key'])) {
if(! rss("select * from payments where ticket='" . sql($_REQUEST['key']) . "' and v > 9" )){ echo -1 ; exit(); }
if ($rs["v"] == 12 ) { echo -2 ; exit(); }
mysqli_query($db,"update payments set v= 12,tozihat='".sql($_REQUEST["data"] ) ."' where orderid='". $rs["orderid"] . "'" );
echo $rs["item"];
exit();

}

?>