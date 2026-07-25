<?
function mablagh($srting)
{
  $persian_num = array("۰","۱","۲","۳","۴","۵","۶","۷","۸","۹");
  $latin_num = array("0","1","2","3","4","5","6","7","8","9");
  return str_replace($latin_num, $persian_num, number_format($srting));
} 

function farsidigit($srting)
{
  $persian_num = array("۰","۱","۲","۳","۴","۵","۶","۷","۸","۹");
  $latin_num = array("0","1","2","3","4","5","6","7","8","9");
  return str_replace($latin_num, $persian_num, $srting);

} 

function latinnumber($srting)
{
  $persian_num = array("۰","۱","۲","۳","۴","۵","۶","۷","۸","۹");
  $latin_num = array("0","1","2","3","4","5","6","7","8","9");
  return str_replace($persian_num ,$latin_num, $srting);

} 



$db = mysqli_connect("localhost", "ydcorders", "32672@225", "ydcorders");


function logerror($err){
file_put_contents("c:/log/yslog.log",  date('Y-m-d') ." " .$err.PHP_EOL , FILE_APPEND | LOCK_EX);
}

function rsget($sql)
{
global $db;
//echo $sql ;
$res=mysqli_query($db, $sql);
if($res===false){logerror("gterr ".$sql);return [];}
$rs=mysqli_fetch_assoc($res);
return $rs ;
}

function rss($sql)
{
global $rs,$rsrecordcount,$res,$dindex,$db; $dindex = 0;$res=mysqli_query($db,$sql);
if($res===false){logerror("gterr ".$sql);return [];}
$rs=mysqli_fetch_assoc($res);$rsrecordcount = mysqli_num_rows($res);return $rsrecordcount ;
}


function sql($sql){
    global $db;
    $r=$sql;
    $r= str_replace("'","",$r);
    $r= str_replace(";","",$r);
    $r= str_replace(",","",$r);
    $r= str_replace("from","",$r);
    $r= str_replace("select","",$r);
    $r= str_replace("(","",$r);
    $r= str_replace(")","",$r);
    $r= str_replace("union","",$r);
    $r= mysqli_real_escape_string($db,$r);
    return $r;
    }
        
     function sqls($sql){ global $db;
    $r=$sql;
    $r= str_replace(";","",$r);
    $r= str_replace(",","",$r);
    $r= str_replace(" ","",$r);
    $r= str_replace("from","",$r);
    $r= str_replace("select","",$r);
    $r= str_replace("(","",$r);
    $r= str_replace(")","",$r);
    $r= str_replace("union","",$r);
    $r= str_replace("=","",$r);
    $r= str_replace("+","",$r);
    $r= str_replace("'","",$r);
    $r= str_replace(">","",$r);
    $r= str_replace("<","",$r);
    $r=mysqli_real_escape_string($db,$r);
    //$r=mysqli_real_escape_string($r);
    if ($r != $sql ){}
    return $r;
    }

function r($var){global $db;
return (mysqli_real_escape_string($db,$_REQUEST[$var]));
}







function rsaddnew($table)
{
global $ydctbl;
global $rsf;
global $rsv ;

$ydctbl=$table;
$rsv="";
$rsf="";

}


function rschange($f,$data)
{
global $rsf;
global $rsv ;
global $db;
if ($rsf!=""){
$c=",";
}
$a="'";
$rsf = $rsf .$c. mysqli_real_escape_string($db,$f) . "=" .$a.  mysqli_real_escape_string($db,$data).$a ;

}



function rssetupdate($table,$sql)
{
global $ydctbl;
global $ydcsql;
global $rsf;
global $rsv ;

$ydctbl=$table;
$ydcsql=$sql;

$rsv="";
$rsf="";

}

function rsendupdate()
{
global $ydctbl,$rsf,$rsv,$ydcsql,$db;
mysqli_query($db, "update $ydctbl set $rsf $ydcsql ");

//echo mysqli_error($db);
}

function rsadd($f,$data)
{
global $rsf;
global $rsv ;
global $db;

if ($rsf!=""){
$c=",";
}
$a="'";
$rsf = $rsf .$c. '`' . mysqli_real_escape_string($db,$f) . '`';
$rsv = $rsv . $c .$a. mysqli_real_escape_string($db,$data).$a;

}



function brsadd()
{
	global $rsf;
	global $rsv ;

    $numargs = func_num_args();
    $arg_list = func_get_args();
    for ($i = 0; $i < $numargs; $i++) {
        rsadd($arg_list[$i],$_REQUEST[$arg_list[$i]]) ;
    }
}


function brschange()
{
	global $rsf;
	global $rsv ;

    $numargs = func_num_args();
    $arg_list = func_get_args();
    for ($i = 0; $i < $numargs; $i++) {
        rschange($arg_list[$i],$_REQUEST[$arg_list[$i]]) ;
    }
}





function rsupdate()
{
global $ydctbl,$rsf,$rsv,$db;
mysqli_query($db, "insert into $ydctbl ($rsf) values ($rsv)");
//echo "insert into $ydctbl ($rsf) values ($rsv) " ;
//echo mysqli_error($db);

}





function rsmovenext()
{
global $rs;
global $rsrecordcount;
global $res;
global $dindex;
$dindex++ ;

if ($dindex >= $rsrecordcount)
{
return false ;
}else{
$rs=mysqli_fetch_array($res);
return true;
}
}

function rsmovefirst()
{
global $rs;global $rsrecordcount;global $res;global $dindex;$dindex = 0 ;mysqli_data_seek($res,$dindex);$rs=mysqli_fetch_array($res);return true;
}

function rsmovelast()
{
global $rs;
global $rsrecordcount;
global $res;
global $dindex;
$dindex = $rsrecordcount-1 ;

mysqli_data_seek($res,$dindex);
$rs=mysqli_fetch_array($res);
//echo mysqli_error();
return true;

}

function rsmovepre()
{
global $rs;
global $rsrecordcount;
global $res;
global $dindex;

if ($dindex <= 1)
{
return false ;
}else{
$dindex-- ;
//mysqli_data_seek($res,dindex);
mysqli_data_seek($res,$dindex);
$rs=mysqli_fetch_array($res);
//echo mysqli_error();
return true;
}
}


function rss2($sql)
{
global $dmode ;
global $rs2, $rsrecordcount2,$res2,$dindex2,$db;  $dindex2 = 0;$res2=mysqli_query($db,$sql);
if ($res2 ===false){ echo 'خطا' ; exit(); } 
$rs2=mysqli_fetch_array($res2);
$rsrecordcount2 = mysqli_num_rows($res2);return $rsrecordcount2 ;//echo mysqli_error();
if ($dmode) { echo mysqli_error(); } 
}






function rsmovenext2()
{
global $rs2;
global $rsrecordcount2;
global $res2;
global $dindex2;
global $db;

$dindex2++ ;
if ($dindex2 >= $rsrecordcount2)
{
return false ;
}else{
//mysql_data_seek($res,dindex);
$rs2=mysqli_fetch_array($res2);
//echo mysqli_error($db);
return true;
}
}


function rsmove($line)
{
global $rs;
global $rsrecordcount;
global $res;
global $dindex;
$dindex = $line ;
mysqli_data_seek($res,$dindex);
$rs=mysqli_fetch_array($res);
//echo mysqli_error();
return true;

}
function daytime(){return floor(time() / 86400)  ; }
?>