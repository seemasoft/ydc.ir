<?php
header('Content-Type: application/json');

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Only POST method is allowed.']);
    exit;
}

// Get POST data
$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$address = $_POST['address'] ?? '';
$extra_info = $_POST['extra_info'] ?? '';
$product_id = $_POST['product_id'] ?? '';
$external_id = $_POST['external_id'] ?? 0;
$product_name = $_POST['product_name'] ?? '';
$discount_code = $_POST['discount_code'] ?? '';

$plg = $_REQUEST['plugins']??[] ; //plug in list
// Basic Validation
if (empty($name) || empty($phone) || empty($product_id)) {
    echo json_encode(['error' => 'Missing required fields (name, phone, product_id).']);
    exit;
}



$softname = "order";$divinc  =1 ; 
$ret = "https://www.ydc.ir/orders";
include("../info.php");
include("../connection.php");
include("function.php");


$p = $price[intval($external_id)] *1  ;

if ( ! $p ) { die (json_encode(['error' => 'Invalid Product']));  }

//die (json_encode(['error' => 'price ' . $external_id . ":". $p])); 

if (is_array($plg)) {   $i=1 ;foreach($plg as $plugid ) {  
$p = $p + $pprice[$plugid] ;
$pluglist.= "," . $plugid ;
 $i++; } } 

 /*
if ( $_REQUEST['post'] == "pishtaz" ) { $p = $p + $pishtaz ; }
elseif ( $_REQUEST['post'] == "sefareshi" ) { $p = $p + $sefareshi ; }
if ( $_REQUEST['invoice'] ) { $p = $p + $invoice ; }
*/

function getorderid(){
	global $db;
$orderid = rand(100000000,999999999);
if (mysqli_num_rows(mysqli_query($db,"select * from payments where orderid='$orderid'"))){ return getorderid(); } else { return $orderid  ; }

}

rsaddnew("payments");
$orderid = getorderid();
rsadd("mablagh",$p);
rsadd("phone",$phone);
rsadd("mobile",$phone);
 
rsadd("onvan",$itemname[$external_id]);
rsadd("item",$external_id);
rsadd("pluglist",$pluglist);
rsadd("name",$name);
rsadd("email",$email);
//rsadd("post",sql($_REQUEST['post']));
//rsadd("address",$_REQUEST['address']);
//rsadd("invoice",$_REQUEST['invoice']);
//rsadd("ref",$_COOKIE['ref']);
rsadd("source",'seemawebgroup.ir');

rsadd("orderid",$orderid);
rsadd("timestamp",time());
rsadd("tarikh",dateshamsi());
//rsadd("ip",$_SERVER['REMOTE_ADDR']);
//rsadd("zip",$_REQUEST['zip']);
rsadd("paymode",0);
rsupdate();

function redi($adr){
    global $orderid;
echo json_encode([
    'success' => true,
    'message' => 'Order created successfully.',
    'transaction_id' => $orderid,
    'pay_url' => $adr
]);
exit();
}


include("gateways/index.php");
payreq($p,$orderid ,"https://www.ydc.ir/orders/confirmpay.php",0);

function payerror($payam){
    echo json_encode(['error' => $payam]);
    exit;
 exit();
}

?>
