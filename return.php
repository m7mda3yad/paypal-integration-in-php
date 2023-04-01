<?php
include('PaypalHelper.php');
     
       $paypal = new Paypal();
       $paymentId = $_GET['paymentId']??"";
       $PayerID = $_GET['PayerID']??"";
       $token = $paypal->generateToken() ;
       
       if($token =='404') 
       return ['code'=>'404','message'=>'not found'];
      
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v1/payments/payment/$paymentId/execute");
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($ch, CURLOPT_POST, 1);
       curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"payer_id\": \"$PayerID\"\n}");
       $headers = array();
       $headers[] = 'Content-Type: application/json';
       $headers[] = "Authorization: Bearer $token";
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       $result = curl_exec($ch);
       curl_close($ch);
       if($result['status']=='Approved')
       {
              //do something
       }
       else
       {
              // else
       }
       // print_r(['code'=>'200','message'=>$result]);

