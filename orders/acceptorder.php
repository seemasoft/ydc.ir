<?

if ( ! $okch ) { exit() ; } 


if ($tservice[$itemid]){
if ($tservice[$itemid] == 'rnd' ) {  $ticket = rand(1000000,9000000).rand(10,90000000).rand(10000000,99999999); } 
if ( ! $ticket ) { $ticket= @file_get_contents("http://www.ydc.ir/".$tservice[$itemid]."/newticket.asp?id=uysladfggskj122340&p=Ymsfhal12hasdnnfhhal&ay=" . $ay[$itemid] . "&title=" .  urlencode($itemname[$itemid]) ); }
rschange("ticket",$ticket );
$tmpfile = $tservice[$itemid] ; 
}else{ $tmpfile = "az" ;  }
rsendupdate();
 



$trmahsool = "<tr><td>".$itemname[$itemid]."</td><td><a href='".$slink[$itemid]."' >دانلود نرم افزار </a></td></tr>";

for($i=1;$i<sizeof($plg);$i++){ 
$trmahsool = $trmahsool . "<tr><td>".$pname[$plg[$i]]."</td><td>".$pdeliver[$plg[$i]]."</td></tr>";
 } 

if ( $adminlogin ) { $bpath =  "../orders/mailtemp/" ; } else {  $bpath =  "mailtemp/" ;   } 
$tmphtml = file_get_contents($bpath . sqls($tmpfile) . ".htm");
$tmphtml = str_replace("<ticket>",$ticket ,$tmphtml);
$tmphtml = str_replace("<orderid>",$orderid,$tmphtml);
$tmphtml = str_replace("<trmahsool>",$trmahsool,$tmphtml);
$tmphtml = str_replace("<product>",$itemname[$itemid],$tmphtml);
$tmphtml = str_replace("<info>",$info[$itemid],$tmphtml);




include_once ("mail.php");
sendmail("noreply@ydc.ir",$email, $itemname[$itemid] ,$tmphtml);

include_once (__DIR__ ."/function.php");
poorsantcalc($orderid);

?>