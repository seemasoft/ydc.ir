<?
include ("check.php");
include_once ("../connection.php");

rss("select * from iadmin where user='".$adminlogin."'");
if ($_REQUEST["pass"]!=$rs["pass"]){
include ("header.php");

echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<p><br><br><br><span lang="fa"><font size="1">
<span style="font-family: Tahoma; font-weight: 700">لطفا رمز عبور فعل&#1740; خود را صح&#1740;ح وارد کن&#1740;د </span></font></span></p>
<p>
<font id="LID1"

    style="COLOR: black; font-style:normal; font-variant:normal; font-weight:700; line-height:11pt; font-family:Tahoma" size="1">
<a href="javascript:history.back(1)">بازگشت به صفحه قبل</a></font></p>
<p><br>
&nbsp;</p>';

include ("bottom.php");
Exit();
}

if ($_REQUEST["new1"]!=$_REQUEST["new2"] or $_REQUEST["new1"]==''){
include ("header.php");

echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<p><br><br><br><span lang="fa"><font size="1">
<span style="font-family: Tahoma; font-weight: 700">دو رمز عبور وارد شده مشابه هم ن&#1740;ستند </span></font></span></p>
<p>
<font id="LID1"

    style="COLOR: black; font-style:normal; font-variant:normal; font-weight:700; line-height:11pt; font-family:Tahoma" size="1">
<a href="javascript:history.back(1)">بازگشت به صفحه قبل</a></font></p>
<p><br>
&nbsp;</p>';

include ("bottom.php");
Exit();
}



setcookie("mu","",time()-3600,"");
setcookie("mp","",time()-3600, "");
setcookie("mu","",time()-3600,"/");
setcookie("mp","",time()-3600, "/");
$_SESSION["adminlogin"]="";


rssetupdate("iadmin","where user='".$adminlogin."'");
rschange("pass",$_REQUEST["new1"]);
rsendupdate();

include ("header.php");


?><br><br><br>
<p>&nbsp;</p>
<p align="center"><b><font face="Tahoma" size="2"><span lang="fa">رمز عبور شما 
با موفق&#1740;ت تغ&#1740;&#1740;ر &#1740;افت</span></font></b></p>
<p align="center"><b><font face="Tahoma" size="2"><span lang="fa">
<a href="main.php"><span style="text-decoration: none">بازگشت به صفحه اصل&#1740;</span></a></span></font></b></p>

<?

include ("bottom.php");



?>