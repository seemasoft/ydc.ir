<?
session_start();
include("../connection.php");
$user =sql($_REQUEST["user"]);
$pass= sql($_REQUEST["pass"]);

if (rss("select * from iadmin where user='" . $user ."' and pass='" .$pass."'") ==1){

if ($rs["ok"]==1){
//login is correct
$_SESSION["adminlogin"]=$user;
setcookie("mu",$user,time()+ 5000000);
setcookie("mp",crypt($pass,"mdc"),time()+ 5000000);



header("Location: main.php");
}else{
$e = "این اکانت غیر فعال است";
}
}
else
{
header("location: login.php?err=1");
$e="نام کاربری و یا رمز عبور نادرست است";
}

include("header.php");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">





<p align="center"><span lang="fa"><b>
<font size="2" face="Tahoma" color="#FF0000"><?echo $e ?>  
</font></b></span><b><font face="Tahoma" color="#FF0000"> 
<font size="2">&nbsp;</font><span lang="fa"><font size="2">&nbsp;</font></span></font></b></p>

<p align="center" dir="rtl">
<font id="LID1"

    style="COLOR: black; font-style:normal; font-variant:normal; font-weight:700; line-height:11pt; font-size:10pt; font-family:Tahoma">
<a href="javascript:history.back(1)">بازگشت</a></font></p>
<p align="center" dir="rtl">&nbsp;</p>


<? 
include("bottom.php");

?>