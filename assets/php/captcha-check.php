<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/assets/php/recaptcha.class.php';

$secret = '6LfYEwwTAAAAADRKXdhTHbu0YXqKCIIeyR0LFzwF';

$response = null;

$reCaptcha = new ReCaptcha($secret);

if($_POST["g-recaptcha-response"]){
  $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]);
}

if($response != null && $response->success){
  echo "Hi " . $_POST["name"] . " (" . $_POST["email"] . "), thanks for submitting the form!";
}
