<?
namespace Verot\Upload;
include("class.upload.php");


$softname="order" ;
 include("../info.php") ;
 include("../connection.php") ;
 include("../header.php") ;

$jobtitle[]  = "طراح و برنامه نویس وب";
$jobinfo[] = " مسلط به html , CSS, javascript  <br>   در صورت تسلط به زبان برنامه نویسی php در اولویت خواهید بود    <br> امکان همکاری با میزان ساعت توافقی به صورت دورکاری و حضور در محل شرکت (شیراز-ملاصدرا) به صورت ترکیبی (حداقل یک روز در هفته الزام به حضور در محل شرکت)";

$jobtitle[]  = "برنامه نویس سی شارپ";
$jobinfo[] = " مسلط به زبان برنامه نویسی سی شارپ و ویندوز اپلیکیشن     <br> امکان همکاری با میزان ساعت توافقی به صورت دورکاری و حضور در محل شرکت (شیراز-ملاصدرا) به صورت ترکیبی (حداقل یک روز در هفته الزام به حضور در محل شرکت)";

$jobtitle[]  = "بازاریاب تلفنی";
$jobinfo[] = "حقوق ثابت ماهانه + پورسانت  <br> امکان همکاری با میزان ساعت توافقی به صورت دورکاری و حضور در محل شرکت (شیراز-ملاصدرا) به صورت ترکیبی (حداقل یک روز در هفته الزام به حضور در محل شرکت)";


$jobtitle[]  = "بازاریاب حضوری";
$jobinfo[] = "حقوق ثابت ماهانه + پورسانت  <br> امکان همکاری با میزان ساعت توافقی در ماه";

$jobtitle[]  = "ادمین اینستاگرام و بلاگر";
$jobinfo[] = "آشنا به تولید محتوای ویدئویی برای شبکه های اجتماعی<br>نیازمند آشنایی نسبی با نرم افزارهای ویرایش عکس و ویدئو  <br> امکان همکاری با میزان ساعت توافقی به صورت دورکاری یا حضور در محل شرکت (شیراز-ملاصدرا) به صورت ترکیبی (حداقل یک روز در هفته الزام به حضور در محل شرکت)  ";

$jobtitle[]  = "تدوین گر و گرافیست";
$jobinfo[] = "آشنا به نرم افزارهای فتوشاپ ، افترافکت و پریمیر <br> امکان همکاری با میزان ساعت توافقی به صورت دورکاری یا حضور در محل شرکت (شیراز-ملاصدرا) به صورت ترکیبی (حداقل یک روز در هفته الزام به حضور در محل شرکت)  ";


$jobtitle[]  = "تولید کننده محتوای متنی";
$jobinfo[] = "نیاز به آشنایی با اصول سئو و تولید محتوای سئو شده <br> امکان همکاری با میزان ساعت توافقی به صورت دورکاری یا حضور در محل شرکت (شیراز-ملاصدرا) به صورت ترکیبی (حداقل یک روز در هفته الزام به حضور در محل شرکت)  ";


$jobtitle[]  = "کاراموز آزاد";
$jobinfo[] = "کارآموزی ، دریافت جزوات آموزشی و کسب تجربه رایگان در فیلد کاری (طراحی سایت ، اپلیکیشن ، برنامه نویسی ، سئو ، تولید محتوا) <br> امکان همکاری با میزان ساعت توافقی در ماه";

$jobtitle[]  = "کاراموز از طرف هنرستان یا دانشگاه";
$jobinfo[] = "کارآموزی ، دریافت جزوات آموزشی و کسب تجربه رایگان در فیلد کاری (طراحی سایت ، اپلیکیشن ، برنامه نویسی ، سئو ، تولید محتوا) <br> گذراندن دوره کاراموزی هنرستان یا دانشگاه در شرکت ما و دریافت تاییدیه سپری نمودن دوره کاراموزی<BR>تنظیم ساعت کاری متناسب با کلاس های درسی به صورت حضوری و دورکاری";




function isfarsi($str){
if(strpos($str,"ا") !== false) return true;
if(strpos($str,"ب") !== false) return true;
if(strpos($str,"س") !== false) return true;
if(strpos($str,"د") !== false) return true;
if(strpos($str,"و") !== false) return true;
if(strpos($str,"ی") !== false) return true;
if(strpos($str,"م") !== false) return true;
if(strpos($str,"ر") !== false) return true;
if(strpos($str,"ه") !== false) return true;
if(strpos($str,"ز") !== false) return true;
return false;
}






 function showinfo($strinfo, $class){ ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-<?=$class?> alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>&nbsp; 
                            <?= $strinfo ?>
                        </div>
                    </div>
                </div>
       
<? } 
?>
<style>
.forsatbox{
	background-color:#fff;
	border:3px #666 dotted;
	padding:10px;
	margin:10px;
	line-height:auto;
	color:#aaa;
	font-size:12pt;
	border-radius:15px;
}
.forsatbox label{
	color:#000;
	font-weight:900;
	font-size:14pt;
}

.form-group{
	clear:both;
}
.whitetext {
    color: #fff!important;
}
.des {
    color: #FFFFCC!important;
}

</style>                  


<div class="section secondary-section " id="portfolio" >
<form class="fcolor" action="" enctype="multipart/form-data"  role="form" method="post" >
        <div class="triangle"></div>
            <div class="container">
                 <div class="row-fluid " >
                     <div class="highlighted-box ">
                     
                     
<?
				
if($_REQUEST['name']){

$ok = 1;


if(! is_array($_POST['jobtitle'])){ $ok=0;showinfo("لطفا حداقل یکی از موقعیت های شغلی مورد نظر را انتخاب نمایید ","danger"); }
if ( ! isfarsi($_REQUEST['name'])) {  $ok=0;showinfo("لطفا نام و نام خانوادگی خود را با کیبورد فارسی وارد نمایید ","danger");  }
$ip = sql($_SERVER['REMOTE_ADDR']);
$t = time();
if(rss("select id from estekhdam where ip='$ip' and t > " . ($t- 28800) ) ) {  $ok=0;showinfo("از هر دستگاه رایانه یا تلفن همراه در هر 8 ساعت تنها یک بار می توانید درخواست ارسال نمایید ","danger");  } 
if(rss("select email from estekhdam where mobile='".r("mobile")."' and t > " . ($t- 8640000) ) ) {  $ok=0;showinfo("شما قبلا با این اطلاعات ثبت نام انجام داده اید","danger");  } 




$handle = new Upload($_FILES['pic']);
if ($handle->uploaded) {
	$handle->allowed = array('image/jpeg','image/jpg','image/png','image/gif');	
if ($handle->image_x > 1000) {
$handle->image_resize          = true;
//$handle->image_ratio          = true;
$handle->image_ratio_y         = true;
$handle->image_x               = 1000;
}
$handle->file_new_name_body =  time().rand(1000000,9000000);  
	$handle->process('upload/pic' );
	if ($handle->processed) {
		 
		$hasfile =  $handle->file_dst_name ;
		$handle->clean();
	} else {
		$ok = 0;
			showinfo( "خطا در آپلود عکس :  " .  $handle->error ,"danger"); 
	}
}	
	

$handle = new Upload($_FILES['resume']);
if ($handle->uploaded) {
	$handle->allowed = array('application/zip','application/pdf');	
    $handle->file_new_name_body =  time().rand(1000000,9000000);  
	$handle->process('upload/resume');
	if ($handle->processed) {
		$hasfile2 =  $handle->file_dst_name ;
		$handle->clean();
	} else {
			$ok = 0;
			showinfo("خطا در آپلود فایل رزومه / نمونه کار :  " .  $handle->error ,"danger"); 
	}
}	




if($ok){
rsaddnew("estekhdam");
rsadd("ip",$ip);
rsadd("t",$t);
rsadd("pic",$hasfile);
rsadd("resume",$hasfile2);

rsadd("jobtitle",implode(" - " , $_POST['jobtitle']));
brsadd("name","taahol","madrak","daneshgah","mobile","email","address","maharat","savabegh","sharayet","tavalod","instagram");
rsupdate();
$peygiri = rsget("select max(id) from estekhdam")["max(id)"];
showinfo("اطلاعات شما با کد پیگیری ". $peygiri ." ثبت گردید و پس از برسی در صورت لزوم جهت مصاحبه حضوری از شما دعوت به عمل می آید ","success");
echo "</div></div></div></div></div>";
include("../services.php");
include("../footer.php");
exit();

}

}


?>
<h4 class="tcolor">به سامانه ارسال درخواست استخدام/همکاری سیما سافت خوش آمدید</h4>
<p>به اطلاع کلیه علاقمندان و افراد جویای کار می رساند گروه نرم افزاری سیما سافت در نظر دارد از افراد واجد شرایط زیر برای همکاری دعوت به عمل بیاورد</p>

                        <div class="bgf span12">
                        
                        
                       <h2 style="text-center">انتخاب عنواین مورد تقاضا : <span class="red"><?=$itemname[$itemid] ?></span></h2>
                       <div class="whitetext">لطفا پس از انتخاب عنوان یا عناوین شغلی مورد نظر خود فرم درخواست را تکمیل فرمایید تا همکاران ما پس از برسی با شما تماس حاصل نمایند</div>
          <? for($i = 0 ; $i< sizeof($jobtitle);$i++){ ?>               
<div class="forsatbox">                     
<label><input <? if ($_POST["jobtitle"]) { echo in_array($jobtitle[$i],$_POST["jobtitle"])?"checked='checked'":'' ; } ?> value="<?= $jobtitle[$i] ?>" type="checkbox" name="jobtitle[]" >  <?= $jobtitle[$i] ?></label><?= $jobinfo[$i] ?>
</div>    
<? } ?>               
                       
     
						<div class="form-group ">
								 <label class="control-label span6 pull-right">نام و نام خانواگی:<span class="red"> *</span></label>
							     <div class="span6" ><input type="text" class="form-control " name="name"  value="<?=$_REQUEST["name"] ?>"  data-error="وارد کردن این فیلد الزامی است" required ></div>
							         <div class="span6  help-block with-errors"></div>
							</div><br>
							
							
							<div class="form-group">
								 <label class="control-label span6 pull-right">آدرس ایمیل : <span class="red"> *</span></label>
							     <div class="span6" ><input type="email" class="form-control " name="email"  value="<?=$_REQUEST["email"] ?>"   data-error="لطفا یک آدرس ایمیل معتبر وارد نمایید" required ></div>
							         <div class="span6  help-block with-errors"></div>

							</div><br>
							
							<div class="form-group ">
								 <label class="control-label span6 pull-right">شماره تلفن همراه :</label>
							     <div class="span6" ><input type="number" class="form-control " name="mobile"  value="<?=$_REQUEST["mobile"] ?>"  data-error="وارد کردن این فیلد الزامی است" required ></div>
							         <div class="span6  help-block with-errors"></div>

							</div>
							<br>
							
							<div class="form-group ">
								 <label class="control-label span6 pull-right">وضعیت تاهل:<span class="red"> *</span></label>
							     <div class="span6" ><select style="padding:1px;"  name ="taahol" data-error="وارد کردن این فیلد الزامی است" required><option value="">انتخاب کنید</option><option <?=$_REQUEST["taahol"]=='مجرد'?'selected="selected"':'' ?> >مجرد</option><option <?=$_REQUEST["taahol"]=='متاهل'?'selected="selected"':'' ?>  >متاهل</option></select></div>
							         <div class="span6  help-block with-errors"></div>

							</div>

							

						
							<div class="form-group ">
								 <label class="control-label span6 pull-right">منطقه سکونت &nbsp; :</label>
							     <div class="span6" ><input type="text" class="form-control " name="address"  value="<?=$_REQUEST["address"] ?>"  ></div>
							         <div class="span6  help-block with-errors"></div>

							</div>
							
							
							
								<div class="form-group ">
								 	<label class="control-label span6 pull-right">سال تولد :<span class="red"> *</span></label>
							     	<div class="span6" ><input  type="number"  class="form-control " name="tavalod"  value="<?=$_REQUEST["tavalod"] ?>"  data-error="وارد کردن این فیلد الزامی است" required ></div>
									<div class="span6  help-block with-errors"></div>
								</div>

							<br>

								<div class="form-group ">
								 	<label class="control-label span6 pull-right">رشته تحصیلی /مقطع :<span class="red"> *</span></label>
							     	<div class="span6" ><input type="text" class="form-control " name="madrak" value="<?=$_REQUEST["madrak"] ?>"  data-error="وارد کردن این فیلد الزامی است" required ></div>
									<div class="span6  help-block with-errors"></div>
								</div>

								<div class="form-group ">
								 	<label class="control-label span6 pull-right">دانشگاه محل تحصیل :<span class="red"> *</span></label>
							     	<div class="span6" ><input type="text" class="form-control " name="daneshgah" value="<?=$_REQUEST["daneshgah"] ?>"  data-error="وارد کردن این فیلد الزامی است" required ></div>
									<div class="span6  help-block with-errors"></div>
								</div>

													
							
      							<div class="form-group ">
								 	<label class="control-label span6 pull-right">شرح مهارت ها و تخصص ها :<span class="red"> *</span></label>
								 	<div class="des">لطفا شرح کاملی از تخصص ها و مهارت های خود در زمینه عناوین انتخابی بیان فرمایید</div>
							     	<div class="span6" ><textarea style="height:100px;" class="form-control " name="maharat" data-error="وارد کردن این فیلد الزامی است" required ><?=$_REQUEST["maharat"] ?></textarea></div>
									<div class="span6  help-block with-errors"></div>
								</div>
								
								
								<div class="form-group ">
								 	<label class="control-label span6 pull-right">سوابق شغلی :</label>
								 	<div class="des">لطفا شرحی از سوابق شغلی قبلی ،محل فعالیت، مدت فعالیت و علت ترک هر یک را بیان فرمایید</div>
							     	<div class="span6" ><textarea style="height:100px;" class="form-control " name="savabegh"  ><?=$_REQUEST["savabegh"] ?></textarea></div>
									<div class="span6  help-block with-errors"></div>
								</div>
								
								<div class="form-group ">
								 	<label class="control-label span6 pull-right">شرایط همکاری:</label>
								 	<div class="des">در صورتی که شرایط خاصی برای نوع همکاری ، ساعات کاری و حداقل حقوق دریافتی دارید لطفا بیان فرمایید</div>
							     	<div class="span6" ><textarea class="form-control " name="sharayet"  ><?=$_REQUEST["sharayet"] ?></textarea></div>
									<div class="span6  help-block with-errors"></div>
								</div>


								<div class="form-group">
								 <label class="control-label span6 pull-right">عکس : (اختیاری)</label>
								 <div class="des">برای شناسایی سریعتر شما از میان رزومه های ارسالی و افراد مصاحبه شده بهتر است یک عکس از خود انتخاب و ارسال نمایید (رعایت حجاب و موازین اسلامی در تصاویر ارسالی  الزامی است)   </div>
							     <div class="span6" ><input type="file" class="form-control " name="pic"  ></div>
							         <div class="span6  help-block with-errors"></div>
								</div>


								<div class="form-group">
								 <label class="control-label span6 pull-right">فایل رزومه / نمونه کار : (اختیاری)</label>
								 <div class="des">در صورتی که فایل رزومه با فرمت pdf یا نمونه کارهای انجام شده با فرمت zip دارید می توانید در این بخش انتخاب و آپلود نمایید. حداکثر حجم قابل آپلود 4 مگابایت می باشد</div>
							     <div class="span6" ><input type="file" class="form-control " name="resume"     ></div>
							         <div class="span6  help-block with-errors"></div>
								</div>





	</div>   

							
							
							 <div class="form-group text-center ">
							 <input type="submit" name="submit" value=" ثبت درخواست" class="button button-sp btn-lg">
							 </div>
							 
							 
							 
							 

							 

							 
                         </div>
                </div>
           </div>
		   </form>
       </div>
                        

    <?

include("../services.php");
include("../footer.php") ?>