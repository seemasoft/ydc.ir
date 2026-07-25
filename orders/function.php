<?

putenv("TZ=Asia/Tehran");
function isemail($email){

if ( strpos($email,"@")<3 or strpos($email,".")<1 ){
return false;
}
else {
return true;
}
}



    function readfiletext($filename)
    {
    $fp = fopen($filename, "r") or die("Couldn?t open $filename");
    while(!feof($fp))
    {
    $line = fgets($fp);
    $st .= "$line";
    }
    fclose($fp);
    return $st;
    }


function dateshamsi()
{
$gy = date("Y");
$gm = date("m");
$gd = date("d");
list($y , $m , $d) = g2p($gy, $gm, $gd);

return "$y/$m/$d";
}

function tarikhsort()
{
$gy = date("Y");
$gm = date("m");
if ($gm < 10 ){ $gm = $gm * 10 ; }
$gd = date("d");
if ($gd < 10 ){ $gd = $gd * 10 ; }

list($y , $m , $d) = g2p($gy, $gm, $gd);

return $y * 10000 +$m * 100 + $d ;
}



function div($a,$b) {
    return (int) ($a / $b);
}

function g2p ($g_y, $g_m, $g_d) 
{
    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31); 
    $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);     
    


   

   $gy = $g_y-1600; 
   $gm = $g_m-1; 
   $gd = $g_d-1; 

   $g_day_no = 365*$gy+div($gy+3,4)-div($gy+99,100)+div($gy+399,400); 

   for ($i=0; $i < $gm; ++$i) 
      $g_day_no += $g_days_in_month[$i]; 
   if ($gm>1 && (($gy%4==0 && $gy%100!=0) || ($gy%400==0))) 
      /* leap and after Feb */ 
      $g_day_no++; 
   $g_day_no += $gd; 

   $j_day_no = $g_day_no-79; 

   $j_np = div($j_day_no, 12053); /* 12053 = 365*33 + 32/4 */ 
   $j_day_no = $j_day_no % 12053; 

   $jy = 979+33*$j_np+4*div($j_day_no,1461); /* 1461 = 365*4 + 4/4 */ 

   $j_day_no %= 1461; 

   if ($j_day_no >= 366) { 
      $jy += div($j_day_no-1, 365); 
      $j_day_no = ($j_day_no-1)%365; 
   } 

   for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i) 
      $j_day_no -= $j_days_in_month[$i]; 
   $jm = $i+1; 
   $jd = $j_day_no+1; 

   return array($jy, $jm, $jd); 
} 

function jalali_to_gregorian($j_y, $j_m, $j_d) 
{ 
    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31); 
    $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);
    
   

   $jy = $j_y-979; 
   $jm = $j_m-1; 
   $jd = $j_d-1; 

   $j_day_no = 365*$jy + div($jy, 33)*8 + div($jy%33+3, 4); 
   for ($i=0; $i < $jm; ++$i) 
      $j_day_no += $j_days_in_month[$i]; 

   $j_day_no += $jd; 

   $g_day_no = $j_day_no+79; 

   $gy = 1600 + 400*div($g_day_no, 146097); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */ 
   $g_day_no = $g_day_no % 146097; 

   $leap = true; 
   if ($g_day_no >= 36525) /* 36525 = 365*100 + 100/4 */ 
   { 
      $g_day_no--; 
      $gy += 100*div($g_day_no,  36524); /* 36524 = 365*100 + 100/4 - 100/100 */ 
      $g_day_no = $g_day_no % 36524; 

      if ($g_day_no >= 365) 
         $g_day_no++; 
      else 
         $leap = false; 
   } 

   $gy += 4*div($g_day_no, 1461); /* 1461 = 365*4 + 4/4 */ 
   $g_day_no %= 1461; 

   if ($g_day_no >= 366) { 
      $leap = false; 

      $g_day_no--; 
      $gy += div($g_day_no, 365); 
      $g_day_no = $g_day_no % 365; 
   } 

   for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++) 
      $g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap); 
   $gm = $i+1; 
   $gd = $g_day_no+1; 

   return array($gy, $gm, $gd); 
}




function tarakonesh($tuser,$tmablagh, $tonvan,$tresid , $sumadd ){
	global $db;
mysqli_query($db,"INSERT INTO tarakonesh (`user`, `mablagh`, `tarikh`, `onvan` , `au`,`v`,`time`) VALUES ('$tuser', $tmablagh, '".dateshamsi()."', '$tonvan', '$tresid',1,". time() . ");"); 
mysqli_query($db,"update iadmin set credit = credit + $tmablagh , ordersum = ordersum + $sumadd where user='$tuser'");
}

function poorsantcalc($orderid){
	global $db;
$rs = mysqli_fetch_array( mysqli_query($db,"select * from payments where orderid='$orderid'")) ;
if ($rs["refpoorsant"] || ! $rs["ref"] || $rs["v"] < 10 ) { return 0 ; }
$rsref = mysqli_fetch_array( mysqli_query($db,"select * from iadmin where id='" . sql($rs["ref"]) . "'")) ;

$poorsant = $rs["mablagh"] * getkarmozd($rsref)  / 100 ; 
mysqli_query($db,"update payments set refpoorsant = '$poorsant' where orderid= '$orderid' ");
tarakonesh(sql($rsref["user"]) , sql($poorsant) , "سود سفارش $orderid" , $orderid , ($rs["mablagh"] - $poorsant) ) ;
}


function karmozdrate($ordersum ){
if ($ordersum >= 150000000) { return 60 ; }
if ($ordersum >= 100000000) { return 55 ; }
if ($ordersum >= 80000000) { return 50 ; }
if ($ordersum >= 30000000) { return 45 ; }
if ($ordersum >= 10000000) { return 40 ; }
if ($ordersum >= 5000000) { return 30 ; }
return 0  ;
}

function getkarmozd($rsref){
	global $db;
$newkarmozd = karmozdrate($rsref["ordersum"])  ; 
if ( $newkarmozd < $rsref["karmozd"] ) { return $rsref["karmozd"] ; } else { return $newkarmozd ; } 
}

?>