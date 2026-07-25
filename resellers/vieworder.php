<?
include ("check.php");
include ("header.php");
if ( $admintype < 10 ) { echo 'دسترسی غیر مجاز ' ; exit();  }

rss("select * from payments where orderid='" . sql($_REQUEST['id']) . "'" );

$orderst[0] = "پرداخت ناموفق" ;
$orderst[2] = "در انتظار تایید واریز" ;
$orderst[10] = "پرداخت آنلاین" ;
$orderst[11] = "پرداخت تایید شده" ;
$orderst[12] = "تحویل شده" ;

include ("../info.php");
$plg = explode(",",$rs["pluglist"]);

if ($_REQUEST['q']=="accept"){
 $okch = 1;
$itemid = $rs["item"];
$orderid = sql($_REQUEST['id']);
$email = $rs["email"] ; 
$ticket = $rs["ticket"] ; 

rssetupdate("payments","where orderid=".$orderid);
rschange("v", 11); //kharid ba movafaghiat
include("../orders/acceptorder.php");
echo "<br><br>";
showinfo("سفارش با موفقیت تایید و به ایمیل مشتری ارسال شد","success");
echo $tmphtml ;

}




 ?>


<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
<link href="../css/rtable.css" rel="stylesheet">
<br><br><br>

<h1>جزئیات سفارش  <?= $rs["orderid"] ?> : <?= $rs["onvan"] ;?></h1>
<h1  style="color:green" > نام مشتری : <?= $rs["name"] ?>  </h1>    
<div align="center">


    <table class="rwd-table">
    <tr style="background-color:#000000">
       <th>تاریخ</th>
       <th style="width: 22px">وضعیت</th>
       <th style="width: 22px">تلفن</th>
      <th>ایمیل</th>
      <th>آدرس</th>
       <th>مبلغ</th>
      <th>پورسانت</th>

       </tr>

<tr <? if ($rs["v"] == 10 ){ echo ' style="background-color:#CCFF99"' ; } elseif($rs["v"] == 2) { echo ' style="background-color:#FF9900"' ;  } ?> >
  <td data-th="تاریخ"><?= $rs["tarikh"] ;?> </td>   
  <td data-th="تلفن" style="width: 22px"><?= $orderst[$rs["v"]] ?></td>   
  <td data-th="تلفن" style="width: 22px"><?= $rs["phone"] . " " . $rs["mobile"] ?></td>   
 <td data-th="ایمیل"><?= $rs["email"] ;?></td>
 <td data-th="ایمیل"><?= $rs["address"] ;?> کد پستی : <?= $rs["zip"] ;?> </td>
  <td data-th="مبلغ"><?= $rs["mablagh"] ?></td>
  <td data-th="پورسانت"><?Echo $rs["refpoorsant"] ;?></td>   

    
  </tr>
    </table>
    
    <h3>جزئیات</h3>
    
    <table class="rwd-table">
    <tr style="background-color:#000000">
       <th style="width: 30px">عنوان</th>
      <th>مبلغ </th>

       </tr>

<?

$trmahsool = "<tr><td>".$itemname[$rs["item"]]."</td><td>". $price[$rs["item"]] . "</td></tr>";
for($i=1;$i<sizeof($plg);$i++){ 
$trmahsool = $trmahsool . "<tr><td>".$pname[$plg[$i]]."</td><td>".$pprice[$plg[$i]]."</td></tr>";
 } 
 
if (($postprice[$rs["post"]] + $invoice * $rs["invoice"]) ) { $trmahsool = $trmahsool . "<tr><td>".$postt[$rs["post"]]."</td><td>".($postprice[$rs["post"]] + $invoice * $rs["invoice"])."</td></tr>"; }
echo $trmahsool ;
?>

    </table>

    
    <a href="vieworder.php?id=<?= sql($_REQUEST['id']) ?>&q=accept" class="btn btn-success">تایید و ارسال سفارش</a>&nbsp;&nbsp;      <a target="_blank" href="pakat.php?id=<?= sql($_REQUEST['id']) ?>" class="btn btn-primary">چاپ پاکت</a>&nbsp;    <a href="invoice.php?id=<?= sql($_REQUEST['id']) ?>" class="btn btn-warning">چاپ فاکتور</a>   <a href="invoice.php?id=<?= sql($_REQUEST['id']) ?>&sigmohr=1" class="btn btn-warning">چاپ فاکتور با مهر</a>    
 
    
    
   		</div>


<?

include ("bottom.php");
?>