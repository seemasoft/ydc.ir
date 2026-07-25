<?php
require_once("MailConfigure.php");
function sendmail($sfrom,$sto,$ssubject,$body){
Send_mail($sfrom,$sto,$ssubject,$body,1);
}


function tempmail($temp,$sfrom,$sto,$ssubject,$f1="",$f2="",$f3="",$f4=""){

$fname = "mailtemp/".$temp;
if (file_exists($fname)) {
$fp = fopen($fname,"r");
$content = fread($fp,filesize($fname));
fclose($fp);

 }
else {
echo "File specified does not exist! or There has been a script error";
 }
 

$content = str_replace("#f1#",$f1,$content);
$content = str_replace("#f2#",$f2,$content);
$content = str_replace("#f3#",$f3,$content);
$content = str_replace("#f4#",$f4,$content);

//echo $content ;


Send_mail($sfrom,$sto,$ssubject,$content,1);
}

?>