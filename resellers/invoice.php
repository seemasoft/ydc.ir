<? 
include ("check.php");

if ( $admintype < 10 ) { echo 'دسترسی غیر مجاز ' ; exit();  }
$orderid = sql($_REQUEST['id']) ;
rss("select * from payments where orderid='$orderid'" );
include ("../info.php");
$plg = explode(",",$rs["pluglist"]);


$trmahsool = "<tr><td>".$itemname[$rs["item"]]."</td><td>". mablagh($price[$rs["item"]]) . "</td></tr>";
for($i=1;$i<sizeof($plg);$i++){ 
$trmahsool = $trmahsool . "<tr><td>".$pname[$plg[$i]]."</td><td>". mablagh($pprice[$plg[$i]])."</td></tr>";
 } 
 
if (($postprice[$rs["post"]] + $invoice * $rs["invoice"]) ) { $trmahsool = $trmahsool . "<tr><td>".$postt[$rs["post"]]."</td><td>".mablagh($postprice[$rs["post"]] + $invoice * $rs["invoice"])."</td></tr>"; }


$tmphtml = file_get_contents("../orders/mailtemp/invoice.htm");
$tmphtml = str_replace("<customer>",$rs["name"] ,$tmphtml);
$tmphtml = str_replace("<customerphone>",$rs["mobile"] ,$tmphtml);
$tmphtml = str_replace("<customeraddress>",$rs["address"] ,$tmphtml);


$tmphtml = str_replace("<tarikh>",farsidigit($rs["tarikh"]) ,$tmphtml);
$tmphtml = str_replace("<orderid>",farsidigit($orderid),$tmphtml);
$tmphtml = str_replace("<trmahsool>",$trmahsool,$tmphtml);
$tmphtml = str_replace("<company>",$company,$tmphtml);
$tmphtml = str_replace("<address>",farsidigit($companyaddress),$tmphtml);
$tmphtml = str_replace("<majmoo>",mablagh($rs["mablagh"]) ,$tmphtml);

if ($_REQUEST["sigmohr"]) { $tmphtml = str_replace("<mohr>",'<img src="smohr.jpg" />' ,$tmphtml); } else { $tmphtml = str_replace("<mohr>","" ,$tmphtml);  }



include('../orders/pdf/mpdf.php');
$mpdf=new mPDF('utf-8');
//$html=iconv("utf-8","UTF-8//IGNORE",$tmphtml);
$mpdf=new mPDF('ar','A4','','',5,5,5,5,16,13);
$mpdf->SetDirectionality('rtl');
$mpdf->WriteHTML($tmphtml);

if ($_REQUEST["sigmohr"]) { $mpdf->Output('faktor'.  $orderid  .'.pdf', 'D'); } else {  $mpdf->Output(); }



?>


