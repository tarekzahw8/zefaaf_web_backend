<?php 

function sendSMSHelper($phoneNumber, $message)
    {
        $smsgatewaydata = "http://josmsservice.com/smsonline/msgservicejo.cfm?numbers=962".$phoneNumber.",&senderid=HisasOnline&AccName=Hisas&AccPass=".urlencode("H3!kO3@IrM3")."&msg=".urlencode($message)."&requesttimeout=5000000";  
        $url = $smsgatewaydata;



        $headers = array
                (
                    'Content-Type: application/json'
                );
        $curl=json_encode(array(
                "numbers"=>$phoneNumber,
                "senderid"=>"HisasOnline",
                "AccName"=>"Hisas",
                "AccPass"=>"H3!kO3@IrM3",
                "msg"=>$message,
                "requesttimeout"=>5000000
        ));        
        $ch = curl_init();                       // initialize CURL
        curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, true);    // Set CURL Post Data
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_POSTFIELDS,$curl );
        $output = curl_exec($ch);
        curl_close($ch);                         // Close CURL
        // dd($output,$smsgatewaydata);
        // Use file get contents when CURL is not installed on server.
        // if(!$output){
        //   $output =  file_get_contents($smsgatewaydata);  
        // }
    }

