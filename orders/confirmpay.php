<?
$softname="order" ;
$divinc = 1 ; 

include ("../header.php");
include_once ("../connection.php");
include_once ("../info.php");

include("gateways/index.php");
getpayinfo();


function payerror($payam){
	global $divinc;
?>
<div class="alert alert-danger"><?=$payam ?> <button class="btn btn-danger" onclick="window.history.back(0)">بازگشت</button></div>
<?
include("../footer.php");
 exit();
}

if (rss("select * from payments where au='$au'")){

?>
<div style="text-align:center;font-size:24px;">
<img border="0" src="img/alert.png"><br>
<br>
این تراکنش قبلا انجام شده است. لطفا پست الکترونیک خود را برسی کنید . شماره سفارش : <?echo sql($_REQUEST['id']) ; ?><br><br><a href="/">بازگشت به صفحه اصلی </a>   
</div>


<?
include("../footer.php");
exit();
}





if (! rss("select * from payments where orderid='$orderid'")){echo 'شماره سفارش معتبر نیست' ; exit();}
//$orderid =sql($_REQUEST['id']);
$mablagh = $rs["mablagh"];
$phone = $rs["phone"];
$itemid = $rs["item"];
$email = $rs["email"];
$plg = explode(",",$rs["pluglist"]);



if ($rs["au"]) {
?>
<div style="text-align:center;font-size:24px;">
<img border="0" src="img/alert.png"><br>
<br>
این تراکنش قبلا انجام شده است. لطفا پست الکترونیک خود را برسی کنید . شماره سفارش : <?echo sql($_REQUEST['id']) ; ?><br><br><a href="/">بازگشت به صفحه اصلی </a>   
</div>

<?

include("../footer.php");
exit();
}


$out = confirmpay($mablagh);

if ($out=="ok"){
//////////////////////////////////////////////////////////////////
//hame chiz ok
///////////////////// amaliat sodoor ..//////////

rssetupdate("payments","where orderid=".sql($orderid));

rschange("au",$_POST['SaleReferenceId']);
rschange("v", 10); //kharid ba movafaghiat


$okch = 1;

//invisible alarms


include("acceptorder.php");

echo $tmphtml ;

include ("../footer.php");


 } else {
?>
<div style="text-align:center;font-size:24px;">
<img border="0" src="img/alert.png"><br>
<br>
تراکنش ناموفق بود. .  <br><br>
شماره سفارش : <?echo sql($_REQUEST['id']) ; ?>  شماره ارجاء :  <?= sql($_POST['SaleReferenceId']) ?><br><br><a href="/">بازگشت به صفحه اصلی </a>   
</div>

<?
include ("../footer.php");
exit();
 }





?>