<?
include("connection.php");
if ($_REQUEST["action"] == "chorder" ){
if (rss("select * from payments where v >= 10 and orderid='" . sql($_REQUEST['orderid']) . "'" )){
echo "OK|" . $rs["timestamp"] . "|" .$rs["onvan"] . "|" .$rs["name"] ;
}else{

echo "invalid";
}



}
?>