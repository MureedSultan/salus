<?php

require $_SERVER['DOCUMENT_ROOT'].'/assets/php/include.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
      //ini_set("display_errors", "1");
      //error_reporting(E_ALL);
      require_once $_SERVER['DOCUMENT_ROOT'].'/assets/php/recaptcha.class.php';
      require_once $_SERVER['DOCUMENT_ROOT'].'/assets/php/mailJet.class.php';
      header('Content-Type: application/json');
      $data;
      $contactResponse = [];
      $status;
      $returnResponse;
      // --------- START CAPTCHA ---------
      $secret = '6LfYEwwTAAAAADRKXdhTHbu0YXqKCIIeyR0LFzwF';
      $response = null;
      $reCaptcha = new ReCaptcha($secret);
      if($_POST["g-recaptcha-response"]){
        $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]);
      }
      if($response != null && $response->success){
        $status = "success";
        $returnResponse = "Done!";
      }else{
        $status = "error";
        $returnResponse = "Please make sure you filled out the captcha!";
      }
      // --------- END CAPTCHA ---------
      // --------- START MAIL ---------
      $data = array('status' => $status, 'response' => 'Contact Form: '.$returnResponse);
      array_push($contactResponse, $data);
      echo json_encode($contactResponse);
      // --------- END MAIL ---------


      $apiKey = "02e888df4e7869599fd536d4c15469bf";
      $secretKey = "7ad366e4ad7dddade2bbf53e91d988bb";


      $mj = new Mailjet($apiKey, $secretKey);
      $params = array(
      	"method" => "POST",
      	"from" => "noreply@mureedsultan.com",
      	"to" => "Jeremy.darter@salustelehealth.com",
      	"subject" => "New Contact Mail",
      	"text" => "From: ".$_POST['form-name']."\n".'Email Address: '.$_POST['form-email']."\n".'Subject: '. $_POST['form-subject']."\n".'Message: '. $_POST['form-message']
      );
      $paramsReply = array(
      	"method" => "POST",
      	"from" => "noreply@mureedsultan.com",
      	"to" => $_POST['form-email'],
      	"subject" => "Contact Form",
      	"text" => "Thanks for contacting Salus Telehealth!"
      );
      $result = $mj->sendEmail($params);
      $resultReply = $mj->sendEmail($paramsReply);
      if ($mj->_response_code == 200)
      	return true;
      else
      	return false;

      break;
    default:
      $thisPage = new Page();
      $thisPage->meta = '';
      $thisPage->content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/pages/'.$autoPage);
      if(isset($_GET['email'])){
        $thisPage->content = str_replace('{email}', $_GET['email'], $thisPage->content);
      } else {
        $thisPage->content = str_replace('{email}', '', $thisPage->content);
      }

      $thisPage->title = $autoTitle;
      $thisPage->canonical = 'http://salustelehealth.com/about';
      $thisPage->description = '';
      $thisPage->background = 'background--dark';
      $thisPage->output();
}
