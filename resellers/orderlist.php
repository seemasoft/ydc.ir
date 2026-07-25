<?
include ("check.php");
include ("header.php");
$maxinpage =30 ;
?><? if ($_REQUEST['status'] == 1 ) { ?>

<div style="direction:rtl">
	<h1 class="pgheader"> لیست سفارشات پرداخت شده </h1>
	در این بخش اطلاعات کلیه سفارشات پرداخت شده که توسط لینک معرفی شما ثبت شده اند و یا توسط خودتان از طریق بخش نمایندگان ثبت و پرداخت گردیده قابل مشاهده می باشد
</div>
<? } elseif ($_REQUEST['status'] == 2 ) { ?>

<div  style="direction:rtl">
	<h1 class="pgheader" > لیست سفارشات در انتظار پرداخت </h1>
	در این بخش اطلاعات کلیه سفارشاتی که توسط لینک معرفی شما ثبت شده اند اما هنوز پرداخت آنها با موفقیت انجام نشده و یا پرداخت آنها تایید نشده است قابل مشاهده می باشد
</div>

<? } else { ?>
<div  style="direction:rtl">
	<h1 class="pgheader"> مشاهده لیست کلیه سفارشات </h1>
در این بخش لیست کلیه سفارشاتی که توسط شما و یا لینک معرفی شما ثبت شده است قابل مشاهده  می باشد 
</div>
<? } ?>
<br><br>
<?

$searchin = sqls($_REQUEST['searchin']);
if ( strlen($searchin) > 15 ) {exit(); }
if ( $searchin ) { $ssql = " and payments.$searchin like '%". sql($_REQUEST['search']) . "%' "  ;}

	if ($adminlogin == 'admin') { $adminsq = "" ; } else { $adminsq = " and ref = '$adminlogin' " ; }
	
	if($_REQUEST['status'] == 1) { $stsql = " and v > 9 "  ; } elseif($_REQUEST['status'] == 2) { $stsql = " and v < 9 "  ;  } else { $stsql = "" ; }
	
    rss("select * from payments where 1 $stsql $adminsq $ssql order by timestamp desc " );
if ( $_REQUEST["p"]) {
$p =  sql($_REQUEST["p"]);
}
else
{
$p = 0;
}
$ts = $rsrecordcount / $maxinpage ; 

if ($rsrecordcount !=0) {
rsmove ($p * $maxinpage );


    ?>
<div style="direction: rtl">
<p style="margin-right: 40px">تعداد:<? echo $rsrecordcount . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;صفحه  '. ($p+1) .' از '  .  ceil($ts) ; ?>
</p>
</div>


<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
<link href="../css/rtable.css" rel="stylesheet">

    
<div align="center">

    <table class="rwd-table">
    <tr style="background-color:#000000">
       <th>تاریخ</th>
       <th>نام مشتری</th>
       <th>تلفن</th>
      <th>ایمیل</th>
      <th>شماره سفارش</th>
       <th>عنوان سفارش</th>
       <th>مبلغ</th>
      <th>سهم شما</th>
     <? if ($admintype > 9 ) { ?> <th></th> <? } ?>
       </tr>
    <?
    

    $i=0;
    do { 
    
    
    ?>
     <tr <? if ($rs["v"] > 9 ){ echo ' style="background-color:#CCFF99"' ; } elseif($rs["v"] == 2) { echo ' style="background-color:#FF9900"' ;  } ?> >
  <td data-th="تاریخ"><?= $rs["tarikh"] ;?> </td>   
  <td data-th="نام مشتری"><?= $rs["name"] ;?> </td> 
  <td data-th="تلفن"><?= $rs["phone"] . " " . $rs["mobile"] ?></td>   
 <td data-th="ایمیل"><?= $rs["email"] ;?></td>
 <td data-th="شماره سفارش"><?= $rs["orderid"] ;?></td>
 <td data-th="عنوان سفارش"><?= $rs["onvan"] ;?></td>
  <td data-th="مبلغ"><?= $rs["mablagh"] ?></td>
  <td data-th="پورسانت"><?Echo $rs["refpoorsant"] ;?></td>   
<? if ($admintype > 9 ) { ?><td data-th="عملیات"><?echo '		<a class="btn btn-warning"  href="vieworder.php?id='.$rs["orderid"].'">';?>مشاهده</a></td> <? } ?>
    
  </tr>

    
<?    
$i++;
if ($i > $maxinpage-1 ) { break;}
}while(rsmovenext())
    ?>
    </table>
   		</div>



		<p align="center"><font face="Tahoma" style="font-size: 8pt">
	<? if ( rsmovenext()){echo	'<a href="porseshlist.php?status='. sqls($_REQUEST["status"]) .'&p=' .  ($p+1).'&search='. $_REQUEST["search"] .'&searchin='. $_REQUEST["searchin"].'"><span style="text-decoration: none" lang="fa">
		صفحه بعدی </span></a>  ';}?> &nbsp;
		
			<? 
			$s=0;
			while( $s < ($rsrecordcount /$maxinpage)){echo	'<a href="porseshlist.php?status='. sqls($_REQUEST["status"]) .'&p=' .  ($s) .'&search='. $_REQUEST["search"] .'&searchin='. $_REQUEST["searchin"] .'"><span style="text-decoration: none" lang="fa">
		'.($s+1). ' </span></a> &nbsp;&nbsp; '; $s++ ; }?>
		
		 <span lang="fa">
<? if ($p > 0 ){ 
echo '	<a href="porseshlist.php?status='. sqls($_REQUEST["status"]) .'&p='. ( $p-1) .'&search='. $_REQUEST["search"] .'&searchin='. $_REQUEST["searchin"].'"><span style="text-decoration: none">صفحه قبلی
</span></a></span></font>';}?>




<?
}
else
{
?>

 
  		</td>
	</tr>
	<tr>

		<td width="78%">
		&nbsp;</td>
	</tr>
</table>


<?

}
?>
  </center>
</div>


<form method="POST" action="orderlist.php?status=<?=sqls($_REQUEST["status"])?>">
	<div class="col-sm-2">جستجو: </div>
	<div class="col-sm-3"><input type="text" name="search" class="form-control"></div>
	<div class="col-sm-3"><select class="form-control" name="searchin">
		<option value="orderid">شماره سفارش</option>
		<option selected="" value="name">نام مشتری</option>
		<option value="email">ایمیل</option>
		<option value="phone">شماره تلفن</option>
		<option value="mobile">موبایل</option>
		<option value="onvan">عنوان سفارش</option>
		<option value="tarikh">تاریخ</option>
		<option value="address">آدرس</option>
		<? if ($admintype==10 ) { ?><option value="ref">معرف</option><? } ?>
		</select></div>
	<div class="col-sm-2"><button type="submit" class="btn btn-success" >جستجو</button></div>
	
</form>










<?

include ("bottom.php");
?>