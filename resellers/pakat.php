
<head>
<meta content="en-us" http-equiv="Content-Language">
</head>

<? 
include ("check.php");

if ( $admintype < 10 ) { echo 'دسترسی غیر مجاز ' ; exit();  }
rss("select * from payments where orderid='" . sql($_REQUEST['id']) . "'" );
include ("../info.php");

?><br><br><table style="width: 100%;direction:rtl;font-family:'B Traffic';text-align:center">
	<tr>
		<td style="width:50%; text-align: center;">
		<img alt=""  src="../images/pakat.jpg" width="200" ></td>
		<td style="text-align:center;font-size:9pt;">
		فرستنده : شیراز - ملاصدرا ساختمان دناسا طبقه سوم واحد 603&nbsp; کد پستی: 
		7134644499 </td>
	</tr>
	<tr>
		<td style="text-align:right;padding-right:40px;">گیرنده :&nbsp; <?= $rs["address"] ?><br>کد پستی : <?=$rs["zip"] ?> <br>نام گیرنده: <?=$rs["name"] ?><br>تلفن : <?= $rs["phone"] . " " . $rs["mobile"] ?></td>
		<td>&nbsp;</td>
	</tr>
</table>

