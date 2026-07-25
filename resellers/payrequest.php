<?
include ("check.php");
include ("header.php");
include_once ("../connection.php");
include_once ("../orders/function.php");

$minpay = 500000;


rss("select * from iadmin where user = '$adminlogin' ");
$credit = $rs["credit"];



if($_REQUEST['payreq']){
$ok =1;
if ( ! is_numeric($_REQUEST['payreq']) ) { showinfo("فیلد مبلغ درخواستی معتبر نیست","danger"); $ok = 0 ;  } 
if ($_REQUEST['payreq'] > $credit ) { showinfo("مبلغ درخواستی بیش از اعتبار شما می باشد","danger"); $ok = 0 ;  } 
}
if ($ok) {
// sabt 


rssetupdate("iadmin","where user ='$adminlogin'");
rschange("bankacc",$_REQUEST['bankacc']);
rschange("payreq",$_REQUEST['payreq']);
rschange("bankholder",$_REQUEST['bankholder']);
rsendupdate();
showinfo ("درخواست واریز با موفقیت ثبت گردید " , "success") ;

include("mail.php");
sendmail($fromemail,$adminmail, "درخواست واریز وجه " , "مبلغ : " .$_REQUEST['payreq'] . "\n شماره حساب:  ". $_REQUEST['bankacc'] ."\n صاحب حساب:  ". $_REQUEST['bankholder']."\n کاربر :  ". $adminlogin );

echo ' <a href="main.php" id="btn" class="btn btn-success" >بازگشت به صفحه اصلی </a>';
include("bottom.php") ;
exit() ;


}
?>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


</head>

		<form action="payrequest.php" method="post"   >


<div>

<h1 class="pgheader"> درخواست واریز وجه </h1>

   <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-info-circle"></i>    در این بخش 
								می توانید درخواست انتقال اعتبار خود را به حساب 
								بانکی ثبت نمایید.&nbsp; 
                            </li>
                        </ol>

	
	</div>

<?

 if ($minpay > $credit) {
showinfo("اعتبار فعلی شما در حال حاضر  $credit ریال می باشد و به حداقل قابل برداشت توسط حساب بانکی نرسیده است. " . "حداقل مبلغ قابل واریز به حساب بانکی $minpay ریال می باشد. " , "info" ) ;
}elseif($rs["payreq"] ) { showinfo("شما در حال حاضر یک درخواست واریز در انتظار دارید.  درخواست پرداخت قبلی شما در بازه زمانی انجام پرداخت های گروهی (1 تا 5 و 15 تا 18 هر ماه ) واریز خواهد شد و پس از آن می توانید درخواست پرداخت مجدد ثبت نمایید  " , "info" ) ;
 }else{ 
 
showinfo("در حال حاضر دو بار در ماه و در تاریخ های بین 1 تا 5 و 15 تا 18 هر ماه کلیه مبالغ درخواستی کاربران به حساب آنها واریز می شود. جهت واریز سریعتر وجه درخواستی بهتر است درخواست واریز خود را یک روز قبل از این تاریخ ها ثبت نمایید " , "info" ) ;

 ?>
<div class="form-group" style="margin-top:50px;">
                <label for="email" class="col-md-3  control-label  vertical-center">شماره حساب بانکی شبا</label>
                <div class="col-md-5  vertical-center ">
                     <input dir="ltr" type="text" class="form-control" name="bankacc"  value="<?=$rs["bankacc"] ?>"   placeholder="IR" >
                           </div>
                
				<div class="col-md-4 ">
					<div class="alert alert-dismissible alert-info smalltext vertical-center" >
  						<button type="button" class="close" data-dismiss="alert">×</button>
لطفا شماره حساب بانکی شبای حساب خود را وارد نمایید
					</div>
                           </div>            
        </div>

<div class="form-group" style="margin-top:50px;">
                <label for="email" class="col-md-3  control-label  vertical-center">نام صاحب حساب</label>
                <div class="col-md-5  vertical-center ">
                     <input dir="ltr" type="text" class="form-control" name="bankholder"  value="<?=$rs["bankholder"] ?>"   placeholder="نام صاحب حساب" >
                           </div>
                
				<div class="col-md-4 ">
					<div class="alert alert-dismissible alert-info smalltext vertical-center" >
  						<button type="button" class="close" data-dismiss="alert">×</button>
نام صاحب حساب بانکی را به صورت دقیق همانگونه که در بانک تعریف شده است وارد نمایید. مسئولیت هر گونه مشکل ناشی از عدم انطباق نام وارد شده و نام صاحب حساب به عهده کاربر می باشد
					</div>
                           </div>            
        </div>


<div class="form-group" style="margin-top:50px;">
                <label for="email" class="col-md-3  control-label  vertical-center">مبلغ برداشت:</label>
                <div class="col-md-5  vertical-center ">
                     <input dir="ltr" type="text" class="form-control" name="payreq"  value="<?=$credit ?>"   placeholder="IR" >
                           </div>
                
				<div class="col-md-4 ">
					<div class="alert alert-dismissible alert-info smalltext vertical-center" >
  						<button type="button" class="close" data-dismiss="alert">×</button>
مبلغ مورد نیاز جهت واریز به حساب بانکی را در این فیلد مشخص نمایید
					</div>
                           </div>            
        </div>
        
        
        
        <div class="form-group col-md-12" style="padding-bottom:50px; text-align:center" >
 <button type="submit" id="btn" class="btn btn-success" >ثبت درخواست واریز </button>
<a href="main.php" id="btn" class="btn btn-info" > انصراف </a>
</div>
		
	
        

<? } ?>
		
		
		
	
		
		
		</form>





<?
include ("bottom.php");
?>