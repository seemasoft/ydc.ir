<?
if($_SERVER['HTTP_REFERER'] && ! strpos($_SERVER['HTTP_REFERER'],$_SERVER['SERVER_NAME'])  ) { setcookie("source",$_SERVER['HTTP_REFERER'],time()+8640000,"/","." . $_SERVER['SERVER_NAME'] ) ;  }  
if ($_REQUEST['r']) { setcookie("ref",$_REQUEST['r'],time()+20000000,"/","." . $_SERVER['SERVER_NAME'] ) ;  if($softname !="order") { header("location: " . str_replace("?r=". $_REQUEST['r'] ,"",$_SERVER['REQUEST_URI'])   ) ;} } 
$wpsup = (strpos( $_SERVER['HTTP_ACCEPT'], 'image/webp' ) !== false || strpos( $_SERVER['HTTP_USER_AGENT'], ' Chrome/' ));
function swebp($src){global $wpsup; return $wpsup?substr_replace($src,"webp",-3):$src;}
?>