<?
include ("check.php");
include ("header.php");
include_once ("../connection.php");



?>

<form method="POST" action="changepassconfirm.php">
<h1 class="pgheader">تغییر رمز عبور</h1>


   <ol class="breadcrumb">
   <li class="active">
  <i class="fa fa-info-circle"></i> از طریق این بخش قادرید رمز ورود خود را به بخش مدیریت تغییر دهید</li>
	</ol>


<div class="form-group" style="margin-top:50px;">
          <label class="col-md-3  control-label  vertical-center"> رمز عبور فعلی :</label><span class="need"></span>
                <div class="col-md-5  vertical-center ">
                     <input type="password" class="form-control" name="pass"   value="" placeholder="" >
                </div>
               
				<div class="col-md-4 ">
					<div class="alert alert-dismissible alert-success smalltext vertical-center" >
  						<button type="button" class="close" data-dismiss="alert">×</button>
  						رمز عبور فعلی خود را وارد نمایید
  						</div>
                </div>            
 				</div>



<div class="form-group" style="margin-top:50px;">
          <label class="col-md-3  control-label  vertical-center"> رمز عبور جدید :</label><span class="need"></span>
                <div class="col-md-5  vertical-center ">
                     <input type="password" class="form-control" name="new1"   value="" placeholder="" >
                </div>
               
				<div class="col-md-4 ">
					<div class="alert alert-dismissible alert-success smalltext vertical-center" >
  						<button type="button" class="close" data-dismiss="alert">×</button>
  						رمز عبور جدید خود را در این قسمت وارد نمایید
  						</div>
                </div>            
 				</div>


<div class="form-group" style="margin-top:50px;">
          <label class="col-md-3  control-label  vertical-center"> تکرار رمز جدید:</label><span class="need"></span>
                <div class="col-md-5  vertical-center ">
                     <input type="password" class="form-control" name="new2"   value="" placeholder="" >
                </div>
               
				<div class="col-md-4 ">
					<div class="alert alert-dismissible alert-success smalltext vertical-center" >
  						<button type="button" class="close" data-dismiss="alert">×</button>
  						در این فیلد رمز عبور جدید خود را مجددا وارد نمایید
  						</div>
                </div>            
 				</div>


<div class="form-group col-md-12" style="padding-bottom:50px; text-align:center" >
 <button type="submit" id="btn" class="btn btn-success" >تغییر رمز عبور </button>
<a href="main.php" id="btn" class="btn btn-info" > انصراف </a>
</div>



</form>



<?
include ("bottom.php");
?>