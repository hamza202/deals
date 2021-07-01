<?php

require_once './vendor/autoload.php';

use Twilio\Rest\Client;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

// Your Account Sid and Auth Token from twilio.com/console
$sid    = getenv("TWILIO_ACCOUNT_SID");
$token  = getenv("TWILIO_AUTH_TOKEN");
$twilio = new Client($sid, $token);
