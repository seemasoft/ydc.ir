<?
include ("check.php");
include ("header.php");
$maxinpage =300 ;
if ( $admintype < 5 ) { echo 'دسترسی غیر مجاز ' ; exit();  }


if ($_REQUEST["rid"] && $_REQUEST["update"]){
    rssetupdate("estekhdam","where id='".r("rid")."'");
    brschange("mark1","mark2","mark3","infotext");
    rsendupdate();
    die("Updated<script>window.close();</script>");
}

if($_REQUEST["limit"] && is_numeric($_REQUEST["limit"])){
    $limit = r("limit");
}
rss("select * from estekhdam  order by t desc limit 0,$limit " );



?>
<div style="direction: rtl">
<p style="margin-right: 40px">تعداد:<? echo $rsrecordcount . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;صفحه  '. ($p+1) .' از '  .  ceil($ts) ; ?>
</p>
</div>

<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
<style>
.row{
    margin-top: 40px;
    border:1px #888 solid;
}
.cl{
    padding: 5px;
}

</style>
<div class="container">
<? do{
?>
<form method="post" action="resumelist.php" target="_bkank">
    <input type="hidden" name="rid" value="<?=$rs["id"] ?>">
<div class="row">
  <? if($rs["pic"] ){echo "<div class='col-md-12'><img class='img-responsive' src='/estekhdam/upload/pic/$rs[pic]'></div>";}  ?>
<div class="cl col-md-3"><?=$rs["jobtitle"] ?></div>
<div class="cl col-md-3"><?=$rs["name"] ?></div>

<div class="cl col-md-3"><?=$rs["tavalod"] ?></div>
<div class="cl col-md-3"><?=$rs["madrak"] ?></div>
<div class="cl col-md-3"><?=$rs["daneshgah"] ?></div>
<div class="cl col-md-3"><?=$rs["taahol"] ?></div>
<div class="cl col-md-6"><?=$rs["address"] ?></div>

<div class="cl col-md-3"><?=$rs["email"] ?></div>

<div class="cl col-md-3"><a href="tel:<?=$rs["mobile"] ?>"><?=$rs["mobile"] ?></a></div>
<div class="cl col-md-3"><? if ($rs["resume"]){echo "<a class='btn btn-info' target='_blank' href='/estekhdam/upload/resume/$rs[resume]'>رزومه</a>";} ?><a target="_blank" class="btn btn-success" href="https://api.whatsapp.com/send?phone=98<?= $rs["mobile"] ?>&text=<?= urlencode("سلام خوبین. یه فرم رزومه برای $rs[jobtitle] در سایت سیما سافت تکمیل کرده بودید با اسم $rs[name] درسته ؟") ?>">واتساپ</a> <a target="_blank" class="btn btn-primary" href="tg://resolve?phone=98<?= $rs["mobile"] ?>">تلگرام</a>
</div>


<div class="cl col-md-4"><?=$rs["maharat"] ?></div>

<div class="cl col-md-4"><?=$rs["savabegh"] ?></div>
<div class="cl col-md-4"><?=$rs["sharayet"] ?></div>
<div class="col-md-12">توضیحات <textarea class="form-control" name="infotext"><?= $rs["infotext"] ?></textarea></div>

<div class="col-md-3">امتیاز 1<input class="form-control" type="number" name="mark1" value="<?= $rs["mark1"] ?>"></div>
<div class="col-md-3">امتیاز 2<input class="form-control" type="number" name="mark2" value="<?= $rs["mark2"] ?>"></div>
<div class="col-md-3">امتیاز 3<input class="form-control" type="number" name="mark3" value="<?= $rs["mark3"] ?>"></div>
<div class="col-md-3" style="padding:10px ;"><button name="update" value="1" type="submit" target="blank" class="btn btn-warning "  href="resumeshow.php">ذخیره</button></div>


<?  if($rs["pic"]){ ?><div class="col-md-12"><img src="pic/<?=$rs["pic"] ?>" alt="" /></div><? } ?>



</div>
</form>

<?    }while(rsmovenext());?>

</div>
<?
include ("bottom.php");
?>