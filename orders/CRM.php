<?php



function SiminCRM($post){
    $post["apikey"] = "2:ASe35Dhh5h6sdzQEFRgdrssdPlkj5681730D";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://simincrm.ir/api/api.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
    //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $server_output = curl_exec($ch);
    curl_close ($ch);
    if(curl_error($ch))
        return array("success"=>false,"msg"=> curl_error($ch) );
    return json_decode($server_output,true);
    }




/*

        $crm = SiminCRM(array(
            "action"=>"person_save",
            "name"=>$rs["name"],
            "mobile"=>$rs["mobile"],
            "email"=>$rs["email"],
            "businessname"=>$rs["title"]." " .$regdomain,
            "website"=>$regdomain,
            "address"=>"",
            "info"=>"ثبت نام اولیه سرویس $rs[period] ماهه از تاریخ $rs[tarikh] از طریق $rs[reseller] وارجاء شده توسط $rs[source] ",
            "phase"=>2,
            "productid"=> 1,//sitesaz
            "phone" => (isset($verify["phone"]) && $verify["phone"]!= $rs["mobile"]) ?$verify["phone"]:"",
            "phone2" => (isset($verify["mobile"]) && $verify["mobile"]!= $rs["mobile"]) ?$verify["mobile"]:""
           
            ));

*/



?>