<?
session_start();




include_once ("../connection.php");
//$target=$_SERVER['REQUEST_URI'];
$file = $_SERVER["SCRIPT_NAME"];
$file= strstr($file,"/cp/");
$file= str_replace("/cp/","",$file);


if ($_COOKIE["mu"] ){
if(rss("select * from iadmin where user='".sql($_COOKIE["mu"])."'")){
if (crypt($rs["pass"],"mdc")==$_COOKIE["mp"]){
$_SESSION["adminlogin"] = sql($_COOKIE["mu"]);
$adminlogin= sql($_COOKIE["mu"]);


setcookie("mu",$_COOKIE["mu"],time()+ 5000000,"/");
setcookie("mp",$_COOKIE["mp"],time()+ 5000000,"/");



}else{setcookie("mu","",time()-3600,""); header("Location:login.php?target=".$target); exit();}
}else{ setcookie("mu","",time()-3600,""); header("Location: login.php?target=".$target);exit();}

}else{setcookie("mu","",time()-3600,""); header("Location:login.php?target=".$target);exit();}


$adminmail=$rs["email"];
$adminname=$rs["name"];
$admintype=$rs["n"];
$chatid=$rs["chatid"];
$adminhash=$rs["hash"];
$adminid = $rs["id"];

?>