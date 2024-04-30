<?php

require_once '../vendor/autoload.php';

use Twilio\Rest\Client;

$sid = "ACae9934cc6eeace5d2c1be7e9b4297c2e";
$token = "46db2f9f463bb0933f18bf32dad06f81";
$twilio = new Client($sid, $token);

$message = $twilio->messages
        ->create("whatsapp:+551122621285", // to 
        array(
            "from" => "whatsapp:+14155238886",
            "body" => "Nova mensagem, para dois contatos, WSMTEC!"
        )
);

print($message->sid);

$sids = "AC7ea78119d0ae85f72de081c11a8e13f2";
$tokens = "1cc2ac997f0e070fc3d6d95eaba0348d";
$twilios = new Client($sids, $tokens);

$messages = $twilios->messages
        ->create("whatsapp:+5511984627070", // to 
        array(
            "from" => "whatsapp:+14155238886",
            "body" => "Nova mensagem, para dois contatos, WSMTEC!"
        )
);
print($messages->sid);
//use Twilio\Rest\Client;
// Update the path below to your autoload.php, 
// see https://getcomposer.org/doc/01-basic-usage.md 
//require_once '/path/to/vendor/autoload.php'; 
//use Twilio\Rest\Client; 
// 
//$sid = "ACae9934cc6eeace5d2c1be7e9b4297c2e";
//$token = "46db2f9f463bb0933f18bf32dad06f81";
//$twilio = new Client($sid, $token);

//$message = $twilio->messages
//        ->create("whatsapp:+5511984627070", // to 
//        array(
//            "from" => "whatsapp:+14155238886",
//            "body" => "Mensagem do sistema de WSM!"
//        )
//);
//$messages = $twilio->messages
//        ->create("whatsapp:+551122621285", // to 
//        array(
//            "from" => "whatsapp:+14155238886",
//            "body" => "Mensagem do sistema de WSM!"
//        )
//);
//
//
//print($message->sid);

// Your Account SID and Auth Token from twilio.com/console. 
// 
//$account_sid = 'AC7ea78119d0ae85f72de081c11a8e13f2';
//$auth_token = '1cc2ac997f0e070fc3d6d95eaba0348d';
// 
//// A Twilio number you own with SMS capabilities
// 
//$twilio_number = "+19292948508";
//$client = new Client($account_sid, $auth_token);
// 
//$client->messages->create(
//    // Where to send a text message (your cell phone?)
//    '+5511984627070',
//    array(
//        'from' => $twilio_number,
//        'body' => 'I sent this message in under 10 minutes!'
//    )
//);
//print($client->sid);
//14155238886

//require_once '.../vendor/autoload.php'; 
// 
//use Twilio\Rest\Client; 
// 
//$sid    = "AC7ea78119d0ae85f72de081c11a8e13f2"; 
//$token  = "1cc2ac997f0e070fc3d6d95eaba0348d";  
//$twilio = new Client($sid, $token); 
// 
//$message = $twilio->messages 
//                  ->create("whatsapp:+5511984627070", // to 
//                           array( 
//                               "from" => "whatsapp:+14155238886",       
//                               "body" => "Nova mensagem, agora vai!" 
//                           ) 
//                  ); 
// 
//print($message->sid);


