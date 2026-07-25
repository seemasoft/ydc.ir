<?
session_start();

setcookie("mu","",time()-3600,"");
setcookie("mp","",time()-3600, "");

setcookie("mu","",time()-3600,"/");
setcookie("mp","",time()-3600, "/");

$_SESSION["adminlogin"]="";

header("location: index.php");


?>
