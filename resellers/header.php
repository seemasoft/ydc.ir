<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>بخش نمایندگان</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
 <script src="../js/jquery-1.10.0.min.js"></script>
    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-rtl.min.css" rel="stylesheet">
     <script src="../js/bootstrap.min.js"></script>
    
    <link href="../css/yekan.css" rel="stylesheet">

   <link href="../css/ptables.css" rel="stylesheet">
    <link href="../css/admintheme.css" rel="stylesheet">
<style>
 
body {
	margin-left:10px;
	margin-right:10px;
	padding:10px;
}

body,span,div,p,table ,h1,h2,h3,h4,h5,h6 {
		font-family:'B yekan',Tahoma ;.
		font-weight:normal;
}
.page-header{
	    margin-top: 100px;

}
</style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<? if ( $adminlogin ) { ?>
<nav class="navbar navbar-default navbar-fixed-top" >
	<div class="container"> 
		<div class="navbar-header">
	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
			<a href="main.php" class="navbar-brand">بخش نمایندگان</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse pull-right" >
			<ul class="nav navbar-nav navbar-right" style="direction:rtl"    >
			<li><a href="main.php" >صفحه اصلی</a></li>
			<li><a href="rates.php" >جدول تخفیف</a></li>
			<li><a href="products.php" >ثبت سفارش</a></li>

				<li class="dropdown" ><a href="#"  class="dropdown-toggle" data-toggle="dropdown" >لیست سفارشات</a>
				<ul class="dropdown-menu">
				<li><a href="orderlist.php?status=1">سفارشات پرداخت شده</a></li>
				<li><a href="orderlist.php?status=2">سفارشات پرداخت نشده</a></li>
				<li><a href="orderlist.php">لیست کلیه سفارشات</a></li>
				</ul></li>
				
				<? if ( $admintype == 10 ) { ?>
				<li class="dropdown" ><a href="#"  class="dropdown-toggle" data-toggle="dropdown" >مدیریت</a>
				<ul class="dropdown-menu">
				<li><a href="resellerlist.php" >لیست نمایندگان </a></li>
			</ul>	</li>
			<? } ?>
<li><a href="payrequest.php" >درخواست واریز</a></li>
<li><a href="changepass.php" >تغیر رمز </a></li>
<li><a href="logout.php" >خروج </a></li>
</ul>
			
		</div><!--/.nav-collapse -->
	</div>
</nav>	


<? if ( 0 ) { ?>
                <div class="row" style="margin-top:60px;">
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>&nbsp; 
                           اتصال حساب کاربری شما به تلگرام هنوز انجام نشده است. برا این کار از دستگاهی که تلگرام دارد وارد این آدرس شوید :   <a href="http://telegram.me/pasokhyabbot?start=<?=$adminhash ?>" >http://telegram.me/pasokhyabbot?start=<?=$adminhash ?></a>
                        </div>
                    </div>
                </div>

<? } ?>

		
<? }



function payam($str) { 
	
      		?>
      		<center>
      		<div class="alert alert-dismissable alert-danger"  style="width:70%;min-width:600px;">

  <strong> <?= $str ?> </strong>
  <br><br> 
  <a href="javascript:window.history.back(0)" class="btn btn-warning">بازگشت</a>
</div>
         </center>
         
         <?
         include("bottom.php") ;
      exit () ; 

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
                <!-- /.row -->
				<? } ?>