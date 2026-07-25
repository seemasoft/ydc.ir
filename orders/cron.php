<?
 include("../info.php") ;
 include("../connection.php") ;
 include("wapia.php");
 include("CRM.php");
 $wapiasender="w1002-haghighirr65451ww35a"; //"w1000-HDwndhwwkrdx";
 $maxsms = 1;
 $chktime = time()-864000 ;

 if(rss("select * from payments where mablagh < 200000 and payments.timestamp > $chktime and smsid < $maxsms and v > 0 and email not in (select email from payments where mablagh > 200000 and v > 0)" )){
     do{

        $crm = SiminCRM(array(
            "action"=>"person_save",
            "name"=>$rs["name"],
            "mobile"=>$rs["mobile"],
            "email"=>$rs["email"],
            "businessname"=>"",
            "website"=>"",
            "address"=>$rs["address"],
            "info"=>"سفارش $rs[onvan] در تاریخ $rs[tarikh] شماره سفارش:#$rs[orderid]#",
            "phase"=>2,
            "productid"=> 2, //softwares
            "phone" => $rs["phone"] ,
            "userid" => 3         
            ));

           // print_r($crm);


         $msg = "سلام. حقیقی هستم از سیما سافت\nاگر در مورد $rs[onvan] که سفارش دادید سوالی دارید خوشحال میشم بتونم کمکتون کنم  ";
          $wres =  WapiaSend($rs["mobile"],$msg,$wapiasender);
          //echo $msg . "<br> To: $rs[mobile]" . $wres;

          mysqli_query($db,"update payments set smsid=smsid+1 where orderid='$rs[orderid]'");
          exit();
     }while(rsmovenext());
 }

 //echo mysqli_error($db);
 ?>OK