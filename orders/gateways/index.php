<?php if (0) { ?>	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <? } 

/*
Malzoomat:
piade sazi tabe payerror() <-exit akharesh   tabe r()
moteghaier haye global :  $paym1  -<<  shenase terminal
estafade az tavabe :
payreq($amount,$order_id)
getpayinfo()
-> chek kardan tekrari naboodan au va vojood orderid
confirmpay($price)
*/

function apicall($arr){
    $ch = curl_init("http://pay.seemawebgroup.ir/api.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arr));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 40);
    $answer = curl_exec($ch); 
   // echo $answer;
    if ( curl_errno($ch) == 0 ) { 
        $answer = json_decode($answer, TRUE);
        return $answer;
    }else{
        $out["status"] =  "ERR";//curl_error($ch);//
        return $out;
    }	
}
function payreq($amount,$order_id ,$ret="",$gateway=0){
	if ( $ret ) {if ( strpos($ret,"?")) {$ret.="&gateway=$gateway";}else{$ret.="?gateway=$gateway";}}else{ $sitepro = ($_SERVER['HTTPS']=='on') ? 'https://':'http://' ; $ret = $sitepro . $_SERVER['SERVER_NAME'] . "/confirm.php?gateway=$gateway&id=" . $order_id ; }
	global $paym1; // needed

	$parameters = array (
     "apikey"=> "YMcenter26",
     "fnc"=> "pay",
	 "siteorderid"=> $order_id ,
	 "mablagh"=> $amount,
 	 "ret"=> $ret ,
     "itemname"=> "" ,
     "gateway"=> $gateway ,
     "domain"=> $_SERVER["SERVER_NAME"] ,

     "itemid"=> 0 
      );
	
    $out = apicall($parameters);
    //print_r($out);
    if ($out["status"] != "ok") {payerror( "خطا در اتصال به درگاه پرداخت. کد خطا : $out[status] درصورت تداوم مشکل مدیریت را مطلع سازید" ); exit();}   
    if ( $out["redirect"]) {redi($out["redirect"]);}
    if ($out["msg"]) {echo $out["msg"];}
}



function getpayinfo($sqcheck=""){
    global $au,$orderid,$rs,$paymablagh;
$parameters = array (
 "apikey"=> "YMcenter26",
 "fnc"=> "getpayinfo",
 "gateway"=>$_REQUEST["gateway"],
 "post"=> $_REQUEST 
 );
	
    $out = apicall($parameters);
    if ( $out["status"] != 'ok'){payerror("خطا : " . $out["msg"]);return false ;}
	$au = $out["au"];
    $orderid = $out["orderid"];
	//print_r($out);
    if(! $orderid ){ payerror("خطا در اطلاعات بازگشتی از بانک");return false ;  }
	if ( ! $au) { payerror("تراکنش انجام نشد");return false ;  }
	if ($sqcheck) {  
		 if ( rss($sqcheck . "au='$au' ") ) { payerror('این تراکنش قبلا انجام شده است'); return false ;  }
		 if (! rss( $sqcheck . "id='$orderid' ") ) { payerror('خطا در پرداخت'); return false ;  }
		 $paymablagh = $rs["mablagh"];
		 return $paymablagh;
		 } // end sq check
	}




// ghabl az confirmpay() hatman getpayinfo() seda zade shavad
function confirmpay($price=0){
	global $paymablagh ;
	if ( ! $price ) { $price = $paymablagh ; }
	global $paym1,$rs ,$orderid ,$au ;  // 

    $parameters = array (
     "apikey"=> "YMcenter26",
     "fnc"=> "confirm",
     "gateway"=>$_REQUEST["gateway"],
     "post"=> $_REQUEST 
     );

    $out = apicall($parameters);
    If ($out["status"] =="ok") { return "ok" ;   }else { payerror($out["msg"]); } 
}


// dar multi hast baraye jay dige uncoment shavad
if (!function_exists('redi')) {
function redi($adr){
header("Location: $adr");
echo "<script>window.location='$adr';</script>"; 
exit();
}
}
//  





?>
