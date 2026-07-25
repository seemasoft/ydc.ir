<?
if (is_numeric($_SERVER["QUERY_STRING"]) ) {
header("Location: https://www.ydc.ir/orders/?id=" . $_SERVER["QUERY_STRING"] );
}else{
	echo "آدرس وارد شده صحیح نیست";
}
?>