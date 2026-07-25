<?
include ("check.php");
include ("header.php");
include_once("function.php") ;

echo '<br><br><br>';

function tarakonesh($tuser,$tmablagh,$ttarikh , $tonvan,$tresid,$bankacc,$bankholder){
	global $db;
mysqli_query($db,"INSERT INTO tarakonesh (`user`, `mablagh`, `tarikh`, `onvan` , `au`,`v`,`time`) VALUES ('$tuser', $tmablagh, '$ttarikh', '$tonvan', '$tresid',1,". time() . ");"); 
}



$maxinpage =100 ;

if ($_REQUEST['user'] ){ rss("select * from iadmin where user='" . r("user") . "'" ); } else {  rss("select * from iadmin where payreq and user > '" . r("next") . "'" ) ; }

if ($rsrecordcount) {
showinfo("آخرین اعتبار: " . $rs["credit"] ,"success") ;
showinfo("<bankacc>" . $rs["bankacc"] . "</bankacc>" . "<br>" . "<bankholder>" . $rs["bankholder"] . "</bankholder>" ,"success" ) ; 
$bankacc = $rs["bankacc"] ;
$bankholder = $rs["bankholder"];

if ( is_numeric($_REQUEST['mablagh'])  && $_REQUEST['user']){ 

	mysqli_query($db,"update iadmin set credit = credit + " . r("mablagh") . ",payreq=0,totalpaid = totalpaid + " . (r("mablagh") * -1 ) . " where user = '" . r("user") . "'");	
	tarakonesh(r("user") ,r("mablagh")  ,dateshamsi(),r("onvan"),r("resid"),$bankacc,$bankholder);
	include("../mail.php") ;

	$onvan = r("onvan");
	$mablagh = abs(r("mablagh"));
	tempmail("variz.htm",$smtpuser,$rs["email"] ,"اطلاعیه انجام تراکنش ",$onvan,$mablagh,r("resid") );
	showinfo(" انتقال انجام شد   " . r("mablagh"),"success") ;
?>
	<a href="withdraw.php?next=<?=r("user") ?>" id="nextbtn" class="btn btn-success" > درخواست بعدی</a>
<?
 showinfo("اعتبار فعلی: " . ($rs["credit"] + r("mablagh")) ,"success" ) ;
exit();

 }

 showinfo("اعتبار فعلی: " . ($rs["credit"] + r("mablagh")) ,"success" ) ;


}




if($rs["payreq"]) {  showinfo("درخواست پرداخت : " . "<payreq>" . $rs["payreq"] . "</payreq>" ,"success" ) ; }


?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">



<style type="text/css">
.auto-style1 {
	float: right;
}
</style>
</head>



<div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                   	 انتقال</h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-info-circle"></i>   واریز به حساب کاربران
                            </li>
                        </ol>
                    </div>
                </div>




      <div  dir="rtl" style="text-align:right ;padding-right:20px;padding-left:10px">
<br><br>
<form method="post" action="withdraw.php" name="frmwid">
کاربر: <input type="text" name="user" value="<?=r("user")?>">

مبلغ: <input type="text" name="mablagh" value="<?= r("payreq") ?>">

عنوان: <input type="text" name="onvan" value="واریز درآمد وطن کلیک">&nbsp;&nbsp;

شماره تراکنش: <input type="text" name="resid" id="peygiri">&nbsp;&nbsp;		  
			  <input name="Submit1" type="submit" value="     ثبت    "></form>



</div>



<?

include ("bottom.php");
?>