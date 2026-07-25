<?
//echo WapiaSend("989173198608","سلام چطوریا","w1000-HDwndhwwkrdx");

function WapiaSend($to,$body,$key){
$req = array(
  'fnc' => 'msg',
  'key' => $key,
  'to' => $to,
  'body' => $body,
	);
return WapiaCall($req);
}
function WapiaCall($req){
$url = "https://panel.wapia.ir/api.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($req));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$out =  curl_exec($ch); 
return $out;
}