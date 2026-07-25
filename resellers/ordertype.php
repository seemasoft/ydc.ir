<?
include ("check.php");
include ("header.php");
include ("../info.php");
include_once("../orders/function.php");

rss("select * from iadmin where id='$adminid' ");
$karmozd = getkarmozd($rs);
$cdisable = ! $rs["ordersum"] ;

?>
<div style="direction:rtl">
	<h1 class="pgheader"> انتخاب نحوه تسویه حساب&nbsp; </h1>
	شما به دو صورت قادرید سفارش خود را از بخش نمایندگان ثبت و پرداخت نمایید. جهت 
	ادامه سفارش می بایست یکی از دو حالت زیر را برای ادامه و تکمیل سفارش انتخاب 
	نمایید</div>
<br><br>



<form target="_blank" method="post" action="order.php">
<input type="hidden" name="id" value="<?=r("id") ?>">
   <div class="form-group ">
	<label class="radio <?= $cdisable? 'disabled':'' ?>" >
	<input type="radio"  name="paymode" value="1" <?= $cdisable? 'disabled':'' ?> ><span style="color:red;font-weight:bold;margin-right:40px;"> پرداخت با استفاده از اعتبار حساب نمایندگی</span><br>
  در این روش شما می توانید ابتدا سفارش خود را ثبت نموده و سپس در هر زمان دیگری با استفاده از اعتبار موجود در حساب نمایندگی خود 
	   مبلغ سفارش را با کسر درصد تخفیف خود پرداخت نمایید 
	  <? if ( $cdisable ) { ?><br><span style="color:#FF9933">توجه: پرداخت اعتباری برای نمایندگان جدید قابل استفاده نیست .  برای فعال شدن این گزینه می بایست حداقل یک فروش موفق به صورت نقدی انجام دهید</span> <? }  ?>
 
 </label>
 	</div>   

<br>

   <div class="form-group ">
	<label class="radio" >
	<input type="radio"  name="paymode" value="2"   ><span style="color:red;font-weight:bold;margin-right:40px;">پرداخت کل مبلغ و دریافت سود همکاری به صورت واریز بانکی</span>
<br>
در این روش شما به صفحه عادی ثبت سفارش سایت ارجاء داده می شوید و می بایست فرم مربوطه را تکمیل و مبلغ اعلامی که بدون تخفیف می باشد را به صورت کامل پرداخت نمایید ( و یا می توانید لینک زیر را در اختیار مشتری خود قرار دهید تا خود مشتری اطلاعات خواسته شده را تکمیل و مبلغ سفارش را به صورت آنلاین پرداخت نماید و محصول را بلافاصله دریافت کند ).
پس از ثبت سفارش و پرداخت کل مبلغ توسط شما (و یا مشتری شما) سود همکاری شما که برابر با درصد تخفیف فعلی شما از محصولات می باشد به صورت اعتبار ریالی به حساب شما در پنل نمایندگی افزوده خواهد شد.
<br>
شما می توانید در هر زمان از اعتبار نمایندگی خود برای خرید سایر محصولات به صورت آنلاین استفاده کنید و یا از منوی امور مالی ، درخواست واریز آن را به حساب بانکی خود ثبت نمایید
<br>
لینک خرید مستقیم محصول : <span style="color:red;font-family:Arial, Helvetica, sans-serif;"><a target="_blank" href="http://<?=$siteaddress ?>/orders/?r=<?=$adminid?>&id=<?=r("id") ?>"><?=$siteaddress ?>/orders/?r=<?=$adminid?>&id=<?=r("id") ?></a></span>
 </label>
 	</div>

       
        <div class="form-group col-md-12" style="padding-bottom:50px; text-align:center" >
 <button type="submit" id="btn" class="btn btn-success" >تایید و ادامه </button>
<a href="main.php" id="btn" class="btn btn-warning" > بازگشت به صفحه اصلی </a>
</div>
</form>


<?

include ("bottom.php");
?>