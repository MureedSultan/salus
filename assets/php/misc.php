<?php

$autoTitle = str_replace('.php', '', basename($_SERVER['PHP_SELF']));
$autoTitle = ucfirst($autoTitle);
$autoPage = str_replace('.php', '.html', basename($_SERVER['PHP_SELF']));

function returnError($error, $thisPage){
  $thisPage->content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/includes/error.html');
  $thisPage->content = str_replace('{error}', $error, $thisPage->content);
  $thisPage->nav = false;
  $thisPage->footer = false;
  $thisPage->title = $error;
  switch($error){
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
}
