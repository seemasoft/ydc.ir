<? include("../refcheck.php"); 
session_start();
$lastch = strtolower(trim($_SESSION['captcha']['code'])) ; 
$_SESSION['captcha'] =rand(1,10000000) ;
include_once("../info.php");
include_once("../connection.php");

?><!DOCTYPE html>
<? $softname="namayandegi";?>
<html lang="en">
<head>
<meta charset=utf-8>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>پذیرش نمایندگی</title>
<meta name="keywords" content="پذیرش نمایندگی,درخواست نمایندگی,همکاری در فروش,درخواست نمایندگی نرم افزار,پذیرش نمایندگی نرم افزار,پذيرش نمايندگي در شهرستانها,پذيرش نمايندگي فعال,اعطاي نمايندگي," >
<meta name="description" content="با تکمیل فرم پذیرش نمایندگی و ثبت نام در بخش همکاری در فروش  در کمتر از پنج دقیقه یکی از صدها نمایندگی فعال فروش محصولات نرم افزاری ما در کشور خواهید شد" >
<? include("../head.php"); ?>       
</head>
            
<body> 
<div class="navbar">
<div class="navbar-inner">
<div class="container">
<a href="" class="brand">
<img src="../images/logo.png"  alt="پذیرش نمایندگی" /> 
</a>
<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
<i class="icon-menu"></i>
</button>
<div class="nav-collapse collapse pull-right">
<ul class="nav" id="top-navigation">
<li class="active">
<a href="/">صفحه اصلی</a>
</li>
<li>
<a href="#about">معرفی سیستم همکاری در فروش</a>
</li>
<li>
<a href="#facility">ثبت نام نماینده فروش</a>
</li>
<li>
<a href="#product">سایر محصولات</a>
</li>

<li>
<a href="/contact.php">پشتیبانی</a>
</li>
</ul>
</div>
</div>
</div>
</div>
<?
        
if ($_REQUEST['submit']){
if (strtolower($_REQUEST['ch']) != $lastch ) { payam("کد امنیتی درون تصویر نادرست وارد شده است") ; }
if ( ! $_REQUEST['user'] ) { payam("نام کاربری وارد نشده است") ; }
if ( ! $_REQUEST['pass'] ) { payam("رمز عبور وارد نشده است") ; }
if ( ! $_REQUEST['name'] ) { payam("لطفا نام و نام خانوادگی خود را وارد نمایید") ; }
if ( ! $_REQUEST['email'] ) { payam("لطفا آدرس ایمیل خود را به صورت صحیح وارد نمایید") ; }
if ( ! $_REQUEST['phone'] ) { payam("لطفا شماره تلفن تماس خود را وارد کنید") ; }

if (  $_REQUEST['pass'] != $_REQUEST['pass2'] ) { payam("دو رمز عبور وارد شده مشابه نیستند") ; }

if (rss("select * from iadmin where user='" . sql($_REQUEST['user']) . "'") ) { payam("نام کاربری وارد شده از قبل در سیستم وجود دارد. لطفا یک نام کاربری دیگر انتخاب نمایید") ; }

rsaddnew("iadmin");
rsadd("user",$_REQUEST['user'] ) ;
rsadd("pass",$_REQUEST['pass'] ) ;
rsadd("name",$_REQUEST['name'] ) ;
rsadd("email",$_REQUEST['email'] ) ;
rsadd("phone",$_REQUEST['phone'] ) ;
rsadd("address",$_REQUEST['address'] ) ;
rsadd("curjob",$_REQUEST['curjob'] ) ;

rsadd("n",0 ) ;
rsadd("ok",1 ) ;

$kin = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','P','Q','R','S','T','U','V','W','X','Y','Z','1','2','3','4','5','6','7','8','9');
for ($i= 0 ; $i < 85 ; $i++ ) { 
$ktemp = $ktemp . $kin[rand(0,35)] ;
}
rsadd("hash",$ktemp);



rsadd("regtime",time() ) ;
rsadd("regip",$_SERVER['REMOTE_ADDR'] ) ;
rsadd("karmozd",0 ) ;
rsadd("credit",0 ) ;
rsupdate();

include_once("../mail.php");
tempmail("newuser.htm",$smtpuser ,sql($_REQUEST['email'])," اطلاعات ورود به پنل" ,$_REQUEST['name'], $_REQUEST['user'] ,$_REQUEST['pass']);
$regok = 1 ; 
payam("ثبت نام شما با موفقیت انجام شد. اطلاعات و راهنمای ورود به پنل نمایندگی به ایمیل شما ارسال گردیده. لطفا صندوق پستی خود را برسی نمایید");
}

function payam($str){ 
global $regok ;
?>
<a id="about"></a>
<div class="section secondary-section " id="portfolio" >
<div class="triangle"></div>
<div class="container">
<div class="row-fluid " >
<div class="highlighted-box center">
<? if ( ! $regok ) { ?> <img src="../orders/img/alert.png"> <? }else {  ?> <img src="../orders/img/tick.png"> <? } ?>
<h3><?= $str ?></h3>
                          
<input type="button" name="back" onclick="window.history.back(0)" value="بازگشت" class="button button-sp btn-lg">

                          
                          
</div>
</div>
</div>
</div>


<? include("../footer.php"); exit() ; } ?>       
        
        
        
        
        
<a id="about"></a>
<div class="section secondary-section " id="portfolio" >
<div class="triangle"></div>
<div class="container">
<div class="row-fluid " >
<div class="highlighted-box ">
                       
                      
                       
<h3>آشنایی با پنل نمایندگی و سیستم همکاری در فروش محصولات نرم افزاری  
</h3>
<p class="infobox">
مفتخریم با اعطای پنل 
نمایندگی فروش محصولات نرم افزاری به صورت رایگان به 
کلیه افراد علاقه مند به فعالیت در این حوزه گامی در 
جهت&nbsp; رونق صنعت نرم افزار های تولید داخل کشور 
برداریم.   ما با سابقه ده ساله&nbsp; در زمینه 
تولید انواع نرم افزارهای مالی ، اداری و آموزشی&nbsp; 
از جمله <a href="/rahavard">نرم افزار حسابداری و 
انبارداری </a>&nbsp;، انواع
<a href="/gozine-bartar">نرم افزار برگزاری آزمون</a> 
، <a href="/tadrib">نرم افزار مدیریت آموزشگاه </a>،
<a href="/yaghoot">نرم افزار مدیریت کتابخانه و 
کتابداری</a>، <a href="/taxi-telefoni">نرم افزار 
تاکسی تلفنی و پیک موتوری</a> ،
<a href="/parsdialer">نرم افزار ارسال پیامک صوتی و 
تبلیغات تلفنی </a>، <a href="/coffenet">نرم افزار 
مدیریت کافی نت&nbsp; و گیم نت</a>&nbsp; و ... می 
آماده همکاری با کلیه افراد علاقه مند به دریافت پنل نمایندگی فروش محصولات نرم افزاری هستیم</p>
							 
<p>
پس از ثبت نام پنل نمایندگی از طریق فرم زیر اطلاعات ورود به بخش نمایندگان برای 
شما ارسال خواهد شد و شما قادرید با استفاده از راهکار های ارائه شده در آن بخش ، به صورت مسقیم&nbsp; 
(با فروش محصولات نرم افزاری&nbsp; به افراد یا سازمان ها ) و یا به صورت غیر 
مستقیم (با معرفی وب سایت ما در سایت ها و شبکه های اجتماعی از طریق لینک های اختصاصی که برای شما ایجاد میگردد) از سود حاصل از فروش محصولات بهره مند شوید

</p>

<p>
میزان سود نمایندگان فروش با توجه به حجم کلی میزان سفارشات ثبت شده توسط آنها  به صورت پله کانی&nbsp; 
و خودکار افزایش می یابد و تا 60 درصد مبلغ فروش هر محصول قابل افزایش است (بیشتر از سود خود شرکت).&nbsp; 
پس از ثبت نام در سامانه می توانید جدول درصد تخفیف و سود فروش به ازای حجم کلی 
فروش را در پنل خود مشاهده نمایید.&nbsp; جهت ثبت نام در بخش نمایندگان کافی است 
فرم&nbsp; مربوطه را در این صفحه تکمیل نمایید.</p>
	
</div>
</div>
</div>
</div>

      
<a id="facility"></a>
<section id="events" class="tbl primary-section">
<div class="triangle"></div>
<div class="container rtl">
           
<br><h3> ثبت نام در بخش همکاری در فروش و دریافت پنل نمایندگی</h3>
جهت ثبت نام در بخش همکاری در فروش و دریافت پنل نمایندگی فرم زیر را تکمیل نمایید <br><br><br><br>

			   
			    
<form  method="post" name="frmreg"  data-toggle="validator"  action="index.php"  >


<div class="form-group ">
<label class="control-label span6 pull-right">نام و نام خانوادگی:<span class="red"> *</span></label>
<input type="text" class="form-control span6 " name="name" placeholder="نام و نام خانوادگی خود را وارد کنید" data-error="وارد کردن این فیلد الزامی است" required >
<div class="span6  help-block with-errors"></div>
</div><br>


  
 
<div class="form-group ">
<label class="control-label span6 pull-right">نام کاربری:<span class="red"> *</span></label>
<input type="text" class="form-control span6 " name="user" placeholder="یک نام کاربری لاتین برای ورود به پنل نمایندگی انتخاب نمایید" data-error="وارد کردن این فیلد الزامی است" required >
<div class="span6  help-block with-errors"></div>
</div><br>


<div class="form-group ">
<label class="control-label span6 pull-right">رمز ورود :<span class="red"> *</span></label>
<input type="password" class="form-control span6 " name="pass" placeholder="یک کلمه رمز برای ورود به پنل نمایندگی انتخاب نمایید" data-error="وارد کردن این فیلد الزامی است" required >
<div class="span6  help-block with-errors"></div>
</div><br>

<div class="form-group ">
<label class="control-label span6 pull-right">تکرار رمز ورود :<span class="red"> *</span></label>
<input type="password" class="form-control span6 " name="pass2" placeholder="رمز انتخابی را مجدد وارد نمایید" data-error="وارد کردن این فیلد الزامی است" required >
<div class="span6  help-block with-errors"></div>
</div><br>


<div class="form-group ">
<label class="control-label span6 pull-right">آدرس ایمیل:<span class="red"> *</span></label>
<input type="email" class="form-control span6 " name="email" placeholder="آدرس پست الکترونیک خود را به دقت وارد نمایید" data-error="وارد کردن این فیلد الزامی است" required >
<div class="span6  help-block with-errors"></div>
</div><br>



<div class="form-group ">
<label class="control-label span6 pull-right">تلفن همراه:<span class="red"> *</span></label>
<input type="text" class="form-control span6 " name="phone" placeholder="شماره تلفن همراه خود را وارد نمایید" data-error="وارد کردن این فیلد الزامی است" required >
<div class="span6  help-block with-errors"></div>
</div><br>


<div class="form-group ">
<label class="control-label span6 pull-right">آدرس: <span class="red"> *</span></label>
<input type="text" class="form-control span6 " name="address" placeholder="آدرس پستی خود را وارد نمایید"  >
<div class="span6  help-block with-errors"></div>
</div><br>
  
  
<div class="form-group ">
<label class="control-label span6 pull-right">شغل فعلی: <span class="red"> *</span></label>
<input type="text" class="form-control span6 " name="curjob" placeholder="لطفا شغل یا فعالیت فعلی خود را ذکر نمایید"  >
<div class="span6  help-block with-errors"></div>
</div><br>
  

  
<div class="form-group">
<label class="control-label span6 pull-right">تصویر امنیتی : <span class="red"> *</span></label>
<img class="span2 pull-right" id="captchaimg"><input type="text"  placeholder="کد درون تصویر را وارد کنید" class="form-control span4" name="ch"  data-error="لطفا کد امنیتی درون تصویر را در این بخش وارد کنید" required >
<div class="span6  help-block with-errors"></div>
</div><br>
<script> window.onload = function(){ document.getElementById('captchaimg').src = '/captcha.php?id='+ Math.random() ;   }  </script>
                            
                            
<div class="clearfix"></div>
  
<br>
<div class="form-group text-center ">
<input type="submit" name="submit" value=" ثبت سفارش" class="button button-sp btn-lg">
</div>

  
</form>
</div>


</section>
        



<div class="section secondary-section">
<div class="triangle"></div>
<div class="container centered">
<p class="title2">
صنعت آی تی و بازار فروش محصولات نرم افزاری یکی از پر رونق ترین 
و پردرآمد ترین حرفه ها در ایران و&nbsp; جهان محسوب می شود. 
گروه ما  تلاش نموده است تا با ارائه سامانه 
مکانیزه فروش محصولات نرم افزای و تامین کلیه نیاز های فنی 
نمایندگان فروش از طریق این سامانه امکان ورود کلیه افراد علاقه 
مند به فعالیت در این حوزه را با داشتن حداقل اطلاعات فنی فراهم 
آورد</p>
             
</div>
</div>
      
<a id="product"></a>

<? include("../product.php") ; ?>
       
<? include("../services.php"); ?>
                
<? include("../footer.php") ?>