<?php

require $_SERVER['DOCUMENT_ROOT'].'/assets/php/include.php';

$thisPage = new Page();
$thisPage->meta = '';
$thisPage->content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/includes/'.$autoPage);
if(isset($_GET['error'])){
  $thisPage->content = str_replace('{error}', $_GET['error'], $thisPage->content);
  switch($_GET['error']){
    case '401':
      $thisPage->content = str_replace('{error-msg}', "You're not authorized to see this page.<br>Try going back home.", $thisPage->content);
      break;
    case '403':
      $thisPage->content = str_replace('{error-msg}', "Forbidden.<br>Try going back home.", $thisPage->content);
      break;
    case '404':
      $thisPage->content = str_replace('{error-msg}', "We're sorry but the page you're looking for can not be found.<br>Try going back home.", $thisPage->content);
      break;
    case '500':
      $thisPage->content = str_replace('{error-msg}', "Something broke.<br>Try going back home.", $thisPage->content);
      break;
    case '503':
      $thisPage->content = str_replace('{error-msg}', "Sorry, we're experiencing more visitors than expected.<br>Try going back home.", $thisPage->content);
      break;
    default:
      $thisPage->content = str_replace('{error-msg}', "", $thisPage->content);
  }
} else {
  $thisPage->content = str_replace('{error}', '404', $thisPage->content);
  $thisPage->content = str_replace('{error-msg}', "We're sorry but the page you're looking for can not be found.<br>Try going back home.", $thisPage->content);
}
$thisPage->title = $autoTitle;
$thisPage->canonical = '';
$thisPage->description = '';
$thisPage->background = 'background--dark';
$thisPage->nav = false;
$thisPage->footer = false;
$thisPage->output();
