<?
include ("check.php");
include ("header.php");
$maxinpage =30 ;
if ( ! $_REQUEST['yousha']) { die("access deny"); }
?>

<div style="direction:rtl">
	<h1 class="pgheader"> گزارش ماهانه </h1>
</div>
<? rss("select sum(mablagh),count(*) , substr(tarikh,3,5)  from payments where v > 9 group by substr(tarikh,3,5) desc "); 
    ?>



<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
<link href="../css/rtable.css" rel="stylesheet">

    
<div align="center">

    <table class="rwd-table">
    <tr style="background-color:#000000">
       <th>ماه</th>
       <th>پرداختی</th>
       <th>سود</th>
       </tr>
    <?
    
    $i=0;
    do { 
    
    ?>
    <tr>
  <td data-th="تاریخ"><?= $rs[2] ;?> </td>   
  <td data-th="مبلغ"><?= $rs[0] ?></td>
  <td data-th="پورسانت"><?=  ($rs[0] >20000000 )? number_format( ($rs[0]-20000000) * 0.005 ): 0 ;?></td>   
    
  </tr>

    
<?    
$i++;
if ($i > $maxinpage-1 ) { break;}
}while(rsmovenext())
    ?>
    </table>
   		</div>




<?

include ("bottom.php");
?>