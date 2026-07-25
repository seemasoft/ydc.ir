<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
$softname = "order";$divinc  =1 ; 
$ret = "https://www.ydc.ir/orders";
include("../info.php");
include("../header.php");
include("../connection.php");
include("function.php");


if ( strpos($_REQUEST['name'],"ا") === false &&  strpos($_REQUEST['name'],"ب") === false && strpos($_REQUEST['name'],"ی") === false && strpos($_REQUEST['name'],"ه") === false && strpos($_REQUEST['name'],"ر") === false && strpos($_REQUEST['name'],"م") === false && strpos($_REQUEST['name'],"د") === false && strpos($_REQUEST['name'],"ح") === false && strpos($_REQUEST['name'],"ز") === false && strpos($_REQUEST['name'],"ل") === false ) { echo "لطفا برای وارد کردن نام و نام خانوادگی از حروف فارسی استفاده نمایید"; exit();}



$p = $price[$_REQUEST["itemid"]];
if ( ! $p ) { echo "خطا! محصول یافت نشد" ; exit(); }
$plg = $_REQUEST['plugins'] ;
if (is_array($plg)) {   $i=1 ;foreach($plg as $plugid ) {  
$p = $p + $pprice[$plugid] ;
$pluglist.= "," . $plugid ;
 $i++; } } 

if ( $_REQUEST['post'] == "pishtaz" ) { $p = $p + $pishtaz ; }
elseif ( $_REQUEST['post'] == "sefareshi" ) { $p = $p + $sefareshi ; }

if ( $_REQUEST['invoice'] ) { $p = $p + $invoice ; }

function getorderid(){
	global $db;
$orderid = rand(100000000,999999999);
if (mysqli_num_rows(mysqli_query($db,"select * from payments where orderid='$orderid'"))){ return getorderid(); } else { return $orderid  ; }

}

rsaddnew("payments");
$orderid = getorderid();
rsadd("mablagh",$p);
rsadd("phone",sql($_REQUEST['phone']));
rsadd("mobile",sql($_REQUEST['mobile']));
 
rsadd("onvan",$itemname[$_REQUEST["itemid"]]);
rsadd("item",$_REQUEST["itemid"]);
rsadd("pluglist",$pluglist);
rsadd("name",sql($_REQUEST['name']));
rsadd("email",sql($_REQUEST['email']));
rsadd("post",sql($_REQUEST['post']));
rsadd("address",$_REQUEST['address']);
rsadd("invoice",$_REQUEST['invoice']);
rsadd("ref",$_COOKIE['ref']);
rsadd("source",$_COOKIE['source']);

rsadd("orderid",$orderid);
rsadd("timestamp",time());
rsadd("tarikh",dateshamsi());
rsadd("ip",$_SERVER['REMOTE_ADDR']);
rsadd("zip",$_REQUEST['zip']);
if ($_REQUEST['paymode'] ==2 || $_REQUEST['paymode'] ==3) {  rsadd("resid",$_REQUEST['resid1'].$_REQUEST['resid2']); rsadd("v",2) ; }

rsadd("paymode",$_REQUEST['paymode']);

rsupdate();
//include("header.php");

if ($_REQUEST['paymode'] ==2 || $_REQUEST['paymode'] ==3) {

include_once ("mail.php");
sendmail("noreply@ydc.ir",$adminmail, "ثبت سفارش پرداخت بانکی  " . $itemname[$_REQUEST["itemid"]] ,  "https://wwww.ydc.ir/resellers/vieworder.php?id=$orderid"  );


?>
<h3 style="color:green">سفارش شما با موفقیت ثبت شد</h3>
<h3>شماره سفارش : <span style="color:red" ><?=$orderid ?></span></h3>

<h3>همکاران ما در بخش فروش به زودی اطلاعات سفارش شما را برسی و در صورت صحت اطلاعات پرداخت نسبت به ارسال آن اقدام خواهند نمود</h3>
<center>
<br><br>
در صورت تمایل می توانید برای پیگیری و تسریع روند تایید سفارش خود  با  
<a href="/contact.php">بخش پشتیبانی فروش</a> تماس بگیرید
</center>
<?
include("../footer.php");
exit();
}



?>
<center><br><br><br><i class="fa fa-spinner fa-spin fa-4x fa-fw"></i>
<br><br>
<h1>در حال اتصال به سرویس بانک...</h1>
<br><br><br><br><br><br><br><br><br>
</center>


<?
include("gateways/index.php");
payreq($p,$orderid ,$ret="https://www.ydc.ir/orders/confirmpay.php",$gateway=0);

function payerror($payam){
		global $divinc;
?>
<div class="alert alert-danger"><?=$payam ?> <button class="btn btn-danger" onclick="window.history.back(0)">بازگشت<button></div>
<?
include("../footer.php");
 exit();
}
 
include("../footer.php");


?>