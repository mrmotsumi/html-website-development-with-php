<?php

require __DIR__ .'../../vendor/autoload.php';
use Twilio\Rest\Client;

// Find your Account Sid and Auth Token at twilio.com/console
// DANGER! This is insecure. See http://twil.io/secure
$sid    = "AC14b6fb7c12a47e8bec4c811546d851da";
$token  = "96c0dd264ec5b7773bd137af94b3a594";
$twilio = new Client($sid, $token);



?>