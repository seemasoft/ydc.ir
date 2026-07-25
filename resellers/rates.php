<? include("check.php");
include("header.php");
include_once("../info.php");
include_once("../orders/function.php");

rss("select * from iadmin where id='$adminid' ");

?>
<div   style="direction:rtl">
	<h1 class="pgheader" > جدول پلکانی تخفیف نمایندگان</h1><br>
	نماینده گرامی درصد تخفیف نمایندگان بر اساس مجموع کل فروش نماینده و بر طبق 
	جدول زیر به صورت خودکار محاسبه می گردد.<br><br>
	
	<div style="text-align:center"><strong>
	در حال حاضر مجموع کل فروش شما 	<span style="color: #FF0000"><?= mablagh($rs["ordersum"]) ?></span> ریال و درصد تخفیف تعیین شده 
	برای شما&nbsp; <span style="color: #FF0000"><?= farsidigit(getkarmozd($rs)) ?> %</span>&nbsp; می باشد</strong></div>
<br><center>
	<table class="table-hover table-striped" style="width: 60%; min-width:300px; text-align:center;border:1px black solid;font-weight:bold;">
		<tr style="background-color:black;color:yellow;">
			<td>ممجموع فروش</td>
			<td>درصد تخفیف</td>
		</tr>
		<tr>
			<td>کمتر از <?=mablagh(5000000) ?> ریال </td>
			<td><?= farsidigit(karmozdrate(0)) ; ?> % </td>
		</tr>
		<tr>
			<td> <?=mablagh(5000000) ?> تا  <?=mablagh(10000000) ?> ریال </td>
			<td><?= farsidigit(karmozdrate(5000000)) ; ?> % </td>
		</tr>
		<tr>
			<td> <?=mablagh(10000000) ?> تا  <?=mablagh(30000000) ?> ریال </td>
			<td><?= farsidigit(karmozdrate(10000000)) ; ?> % </td>
		</tr>
		<tr>
			<td> <?=mablagh(30000000) ?> تا  <?=mablagh(80000000) ?> ریال </td>
			<td><?= farsidigit(karmozdrate(30000000)) ; ?> % </td>
		</tr>
		<tr>
			<td> <?=mablagh(80000000) ?> تا  <?=mablagh(100000000) ?> ریال </td>
			<td><?= farsidigit(karmozdrate(80000000)) ; ?> % </td>
		</tr>
		<tr>
			<td> <?=mablagh(100000000) ?> تا  <?=mablagh(150000000) ?> ریال </td>
			<td><?= farsidigit(karmozdrate(100000000)) ; ?> % </td>
		</tr>
		<tr>
			<td> بیشتر از <?=mablagh(150000000) ?> ریال </td>
			<td><?= farsidigit(karmozdrate(150000000)) ; ?> % </td>
		</tr>
		</table>
	</center>
	<br>

	</div>
	توجه داشته باشید که ایجاد پنل نمایندگی برای اخذ  تخفیف خرید های شخصی تخلف است و منجر به بسته شدن حساب کاربری شما میگردد
	<br>
شرط استفاده از تخفیف های پنل نمایندگی تبلیغات و فروش محصولات ما به سایرین است و ثبت نام پنل نمایندگی صرفا برای گرفتن تخفیف خرید محصولات برای خود تخلف است
