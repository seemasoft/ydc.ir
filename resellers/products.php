<?
include ("check.php");
include ("header.php");
include ("../info.php");
include_once("../orders/function.php");

rss("select * from iadmin where id='$adminid' ");
$karmozd = getkarmozd($rs);
?>
<div style="direction:rtl">
	<h1 class="pgheader"> لیست سفارشات پرداخت شده </h1>
	در این بخش اطلاعات کلیه سفارشات پرداخت شده که توسط لینک معرفی شما ثبت شده اند و یا توسط خودتان از طریق بخش نمایندگان ثبت و پرداخت گردیده قابل مشاهده می باشد
</div>
<br><br>

<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
<link href="../css/rtable.css" rel="stylesheet">

    
<div align="center">

    <table class="rwd-table">
    <tr style="background-color:#000000">
       <th>عنوان</th>
       <th>قیمت اصلی</th>
      <th>تخفیف شما</th>
       <th>پرداختی شما</th>
   <th></th> 
       </tr>
    <?
    

    $i=0;
   foreach ($itemname as $key => $pr ){
   if ($price[$key] < 100000 ) { continue ; } 
    
    ?>
     <tr>
  <td data-th="عنوان"><?= $pr ;?> </td>   
  <td data-th="قیمت اصلی"><?= mablagh($price[$key]) ;?> </td> 
 <td data-th="تخفیف شما"><?= mablagh(round($price[$key] * $karmozd / 100)) ;?></td>
  <td data-th="پرداختی شما"><?=  mablagh(round($price[$key] * (100-$karmozd) / 100)) ?></td>   
<td data-th="عملیات"><?echo '		<a class="btn btn-warning"  href="ordertype.php?id='.$key.'">';?>ثبت سفارش</a></td>     
  </tr>

    
<?    
} 
?>
    </table>
   		</div>



<?

include ("bottom.php");
?>