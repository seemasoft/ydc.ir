<?
if($_POST['SaleOrderId']){ }else{exit();}
$softname="order" ;
$divinc = 1 ; 

include ("../header.php");
include_once ("../connection.php");
include_once ("../info.php");

if ($_POST['SaleReferenceId'] == '') {
?>
<div style="text-align:center;font-size:24px;">
<img border="0" src="img/alert.png"><br>
<br>
تراکنش انجام نشد   !<br><br><a href="/">بازگشت به صفحه اصلی </a>   
</div>
<?


include("../footer.php");
exit();
}





if (rss("select * from payments where au='".sql($_POST['SaleReferenceId'])."'")){

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





if (! rss("select * from payments where orderid='".sql($_REQUEST['id'])."'")){echo 'شماره سفارش معتبر نیست' ; exit();}
$orderid =sql($_REQUEST['id']);
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



//  this function is to Validate Payment
  include("nusoap/nusoap.php");

$client = new nusoap_client('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
	$namespace='http://interfaces.core.sw.bps.com/';
	$parameters = array(
			'terminalId' => '525300',
			'userName' => 'shargh',
			'userPassword' => '18142',
			'orderId' => $_POST['SaleOrderId']+1,
			'saleOrderId' => sql($_POST['SaleOrderId']),
			'saleReferenceId' => $_POST['SaleReferenceId']);

		// Call the SOAP method
		$result = $client->call('bpVerifyRequest', $parameters, $namespace);

				// Check for a fault
		if ($client->fault) {
			echo '<h2>Fault</h2><pre>';
			print_r($result);
			echo '</pre>';
			die();
			exit();
		} 
		else {
			// Check for errors
		
				$resultStr =$result;
		

			$err = $client->getError();
			if ($err) {
				// Display the error
				echo '<h2>خطا . لطفا با تیم پشتیبانی تماس بگیرید</h2><pre>' . $err . '</pre>';
				die();
					exit();
			}} 

if ($resultStr=="0"){
//settle 


	$svresult = $client->call('bpSettleRequest', $parameters, $namespace);

		// Check for a fault
		if ($client->fault) {
			echo '<h2>Fault</h2><pre>';
			print_r($svresult);
			echo '</pre>';
			die();
			exit();
		} 
		else {
			// Check for errors
		
				$sresultStr = $svresult;
		

			$err = $client->getError();
			if ($err) {
				// Display the error
				echo '<h2>Error</h2><pre>' . $err . '</pre>';
				die();
				exit();
			} }
$sv=0 ;
if ($sresultStr =="0") {$sv=1;}


} //end settle



if( $resultStr != "0" ){

?>
<div style="text-align:center;font-size:24px;">
<img border="0" src="img/alert.png"><br>
<br>
تراکنش ناموفق بود. در صورت کسر وجه از حساب شما می بایست ظرف 24 ساعت وجه مجددا به حساب شما بازگردانده شود. در غیر این صورت با تیم پشتیبانی تماس بگیرید.  <br><br>
شماره سفارش : <?echo sql($_REQUEST['id']) ; ?>  شماره ارجاء :  <?= sql($_POST['SaleReferenceId']) ?><br><br><a href="/">بازگشت به صفحه اصلی </a>   
</div>


<?
include("../footer.php");
exit();
}
else
{


}







$status = 0;
  if ( ($resultStr==0) ) {
  
  if (1) {
 if ($status==0) {
	   // this is a succcessfull payment
	   // we update our DataBase



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

	}


  } else {

?>
<div style="text-align:center;font-size:24px;">
<img border="0" src="img/alert.png"><br>
<br>
پرداخت وجه انجام نشد  <br><br>
شماره سفارش : <?echo sql($_REQUEST['id']) ; ?>  شماره ارجاء :  <?= sql($_POST['SaleReferenceId']) ?><br><br><a href="/">بازگشت به صفحه اصلی </a>   
</div>


<?
include ("../footer.php");

exit();
  }










?>