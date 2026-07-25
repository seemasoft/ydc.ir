<? 
$softname="order" ; 
 include("../info.php") ; 
  include("../connection.php") ; 
 include("../header.php") ;
$itemid = r("id");
 
 if (! $price[$itemid]) { echo "خطا ! کد محصول نادرست است و یا در حال حاضر ارائه نمی شود" ; include("../footer.php") ; exit(); }
 
 
 
 ?>        
 <script>
 function pricecalc(){
 var price = <?=$price[$itemid] ?> ;
 
<? if (is_array($plugins[$itemid])) {   $i=1 ;foreach($plugins[$itemid] as $plugid ) {   ?>
 if (document.getElementById("plug<?=$i ?>").checked ) { price = price + $("#plug<?=$i ?>").data("price"); }
<? $i++; } } ?>

 if (document.getElementById("invoice").checked ) { price = price + $("#invoice").data("price"); }
 if (document.getElementById("pishtaz").checked ) { price = price + $("#pishtaz").data("price"); }
 if (document.getElementById("sefareshi").checked ) { price = price + $("#sefareshi").data("price"); }


 $("#price").html(persiannum(price) + " ریال " );
 }
 
 function persiannum(num){
var str = num + "" ;
 str = str.replace(  new RegExp(0, 'g') ,"۰");
 str = str.replace(new RegExp(1, 'g') ,"۱");
 str = str.replace(new RegExp(2, 'g') ,"۲");
 str = str.replace(new RegExp(3, 'g') ,"۳"); 
 str = str.replace(new RegExp(4, 'g') ,"۴"); 
 str = str.replace(new RegExp(5, 'g') ,"۵"); 
 str = str.replace(new RegExp(6, 'g') ,"۶"); 
 str = str.replace(new RegExp(7, 'g') ,"۷"); 
 str = str.replace(new RegExp(8, 'g') ,"۸"); 
 str = str.replace(new RegExp(9, 'g') ,"۹"); 
return str;
 }
 
 
 function changemode(pmode){
 if (pmode==1) { 
 //document.getElementById("paymode2").style.display = "none";
  document.getElementById("paymode3").style.display = "none";
 }else if (pmode==2) { 
 //document.getElementById("paymode2").style.display = "block";
  document.getElementById("paymode3").style.display = "none";
 }else if (pmode==3) { 
 //document.getElementById("paymode2").style.display = "none";
  document.getElementById("paymode3").style.display = "block";
 }

 }
 
 
 
 </script> 
 
      
        <div class="section secondary-section " id="portfolio" >
            <div class="triangle"></div>
            <div class="container">
                 <div class="row-fluid " >
                     <div class="highlighted-box ">

                            <h4 class="tcolor">به سامانه ثبت سفارشات خوش آمدید</h4>
                        <p>در این سامانه سعی نموده ایم با ایجاد روش های مختلف پرداخت و نیز امکان پیگیری آسان و همچنین تحویل فوری سفارشات موجبات راحتی خریداران گرامی را فراهم آوریم</p>
                     <form class="fcolor" method="post" action="pay.php"  data-toggle="validator" role="form" >

                        <div class="bgf span12">
                        
                        
                       <h2>نام محصول : <span class="red"><?=$itemname[$itemid] ?></span></h2>
                       <h2>قیمت : <span class="red"><?=mablagh($price[$itemid]) ?></span> ریال</h2><br><br>
                        
               
          <? if (is_array($plugins[$itemid])) { ?>
           <i class="fa fa-dropbox f-lg tcolor"></i>&nbsp;<strong class="tcolor">بسته های جانبی:</strong>
           					<? $i=1 ;foreach($plugins[$itemid] as $plugid ) { ?>
    							 <div class="form-group " style="direction:rtl">
								 <label class="control-label span12 ">
								 <input onclick="pricecalc()" id="plug<?=$i++ ?>"  data-price="<?=$pprice[$plugid] ?>" type="checkbox" class="form-control" name="plugins[]" value="<?=$plugid ?>">&nbsp;&nbsp;<?=$pname[$plugid] ?> - ( <?=mablagh($pprice[$plugid]) ?> ریال ) <br>   <span><?=$pinfo[$plugid] ?></span><br></label>	
								 </div>
                        <? } ?>
          <? } ?>              <br>
                        <i class="fa fa-envelope-o f-lg tcolor"></i>&nbsp;<strong class="tcolor">نحوه ارسال:</strong>
                        <div class="white">لطفا نحوه دریافت نرم افزار درخواستی خود را انتخاب کنید.<br>(توجه داشته باشید که در عمل هیچ تفاوتی بین نرم افزار ارسال شده از طریق اینترنت و یا پست وجود ندارد )</div><br>
                        
                         <input name="itemid" value="<?=$itemid ?>" type="hidden">
                         
                         			 <div class="form-group  ">
								 <label class="control-label span12 ">
								 <input onclick="pricecalc()" type="radio" class="form-control" name="post" value="download" checked="checked">&nbsp;&nbsp;ارسال اینترنتی (دانلود نرم افزار) -  <span> بدون کارمزد     (ارسال فوری)</span><br></label> 
							</div>
                         
                            <div class="form-group ">
                           
								 <label class="control-label span12 ">
								   <span>  تا اطلاع ثانوی ارسال محصولات نرم افزاری   تنها به صورت اینترنتی انجام میپذیرد</span><br>
								 <input disabled="disabled" onclick="pricecalc()" id="pishtaz" data-price="<?=$pishtaz ?>" type="radio" class="form-control" name="post" value="pishtaz">&nbsp;&nbsp;پست پیشتاز  ( <?=mablagh($pishtaz) ?> ریال ) - <span > ارسال ۳ تا ۵ روز </span><br></label>	
							</div>   
							
							 <div class="form-group ">
								 <label class="control-label span12 ">
								 <input  disabled="disabled" onclick="pricecalc()" id="sefareshi"  data-price="<?=$sefareshi ?>" type="radio" class="form-control" name="post" value="sefareshi" >&nbsp;&nbsp;پست سفارشی  ( <?=mablagh($sefareshi) ?> ریال ) - <span > ارسال ۱۰ تا ۱۲ روز </span><br><br> </label>
							</div><br> 
							 
				
							 
							 <i class="fa fa-file-text-o f-lg tcolor"></i>&nbsp;<strong class="tcolor">ارسال فاکتور:</strong>
							 <div class="form-group  ">
								 <label class="control-label span12 ">
								 <input onclick="pricecalc()" id="invoice" data-price="<?=$invoice ?>" type="checkbox" class="form-control" name="invoice" value="1">&nbsp;&nbsp;ارسال فاکتور به همراه مهر شرکت جهت مراکز دولتی - (  کارمزد :  <?=mablagh($invoice) ?>  ریال )<br><br><br></label>	 
							</div>
                           
                           
                           <div class="form-group ">
								 <label class="control-label span6 pull-right">مبلغ نهایی قابل پرداخت:</label>
							     <span class="white" id="price"><?=mablagh($price[$itemid]) ?> ریال</span> 
							</div><br>

							
							<div class="form-group ">
								 <label class="control-label span6 pull-right">نام و نام خانواگی:<span class="red"> *</span></label>
							     <div class="span6" ><input type="text" class="form-control " name="name" data-error="وارد کردن این فیلد الزامی است" required ></div>
							         <div class="span6  help-block with-errors"></div>
							</div><br>
							<div class="form-group">
								 <label class="control-label span6 pull-right">آدرس ایمیل : <span class="red"> *</span></label>
							     <div class="span6" ><input type="email" class="form-control " name="email"  data-error="لطفا یک آدرس ایمیل معتبر وارد نمایید" required ></div>
							         <div class="span6  help-block with-errors"></div>


							     <div class="des" >(ضروری است که آدرس وارد شده حتما معتبر بوده و متعلق به خودتان باشد . بعضی از اطلاعات مورد نیاز شما از این طریق برایتان ارسال می شود.)</div>
							</div><br>
							<div class="form-group ">
								 <label class="control-label span6 pull-right">آدرس دقیق پستی&nbsp; : <span class="red"> *</span></label>
							     <div class="span6" ><input type="text" class="form-control " name="address"  data-error="وارد کردن این فیلد الزامی است" required ></div>
							         <div class="span6  help-block with-errors"></div>

							     <div class="des">(مرسوله به این آدرس پست خواهد 
									 شد)</div>
							</div><br>
							<div class="form-group ">
								 <label class="control-label span6 pull-right">کد پستی ده رقمی&nbsp; : <span class="red"> *</span> </label>
							     <div class="span6" ><input type="text" class="form-control " name="zip"  data-error="وارد کردن این فیلد الزامی است" required ></div>
							         <div class="span6  help-block with-errors"></div>

							     <div class="des">(لطفا به جز ارقام 0 تا 9 از هیچ کاراکتر اضافی مانند - استفاده ننمایید)</div>
							</div><br>
							<div class="form-group">
								 <label class="control-label span6 pull-right">شماره تلفن منزل/محل کار : <span class="red"> *</span></label>
							     <div class="span6" ><input type="text" class="form-control " name="phone"  data-error="وارد کردن این فیلد الزامی است" required ></div>
							         <div class="span6  help-block with-errors"></div>

							     <div class="des">(به همراه کد شهر)</div>
							</div><br>
							<div class="form-group ">
								 <label class="control-label span6 pull-right">شماره تلفن همراه :</label>
							     <div class="span6" ><input type="text" class="form-control " name="mobile"  data-error="وارد کردن این فیلد الزامی است" required ></div>
							         <div class="span6  help-block with-errors"></div>

							</div><br>
							
							
						<i class="fa fa-credit-card f-lg tcolor"></i>&nbsp;<strong class="tcolor">نحوه پرداخت:</strong>
                        <div class="white">لطفا مشخص کنید پرداخت هزینه خود را به چه صورت انجام می دهید</div><br>
   <div class="form-group ">
	<label class="control-label span12 ">
	<input type="radio" class="form-control" name="paymode" value="1" onclick="changemode(1)"  checked="checked">&nbsp;&nbsp;پرداخت آنلاین - <span > تایید و تحویل فوری محصول </span><br></label>	
	</div>   


 
 <? if (1) { ?>
   <div class="form-group ">
	<label class="control-label span12 ">
	<input type="radio" class="form-control" name="paymode" value="3" onclick="changemode(3)" >&nbsp;&nbsp; واریز به حساب بانکی/کارت به کارت   
	   <span > &nbsp;</span><br></label>	
<div id="paymode3" style="display:none" class="tcolor">
لطفا مبلغ سفارش خود را  به شماره کارت 6362141802771221    به نام یوشا ماندنی پور واریز فرمایید و سپس شماره رسید خود را در کادر مقابل وارد نمایید  <input type="text" class="form-control span6" name="resid2" placeholder="رسید پرداخت"  style="max-width:100px;" ></div>
</div>  
<? } ?>
	</div>   

							
							
							 <div class="form-group text-center ">
							 <input type="submit" name="submit" value=" ثبت سفارش" class="button button-sp btn-lg">
							 </div>
							 
							 
							 
							 

							 
							 
							 
                          </form>
                         </div>
                         
                       
                     
                </div>
           </div>
       </div>
    
    <? include("../footer.php") ?>        