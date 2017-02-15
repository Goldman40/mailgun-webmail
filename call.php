<?php
require 'vendor/autoload.php';
require 'app/config.php';

if (!check_signature($_POST['token'],$_POST['timestamp'],$_POST['signature'])) {
    header('HTTP/1.0 403 Forbidden');

    echo 'You are forbidden!';
    exit();
}

$mail = new \app\mailaction\NewMailIn();
$mail->AddNew($_POST);

function check_signature($token, $timestamp, $signature)
{
    if (time() - $timestamp > 15) {
        return false;
    }
    return hash_hmac('sha256', $timestamp . $token, KEY) === $signature;
}