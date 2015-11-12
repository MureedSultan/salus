<?php

require $_SERVER['DOCUMENT_ROOT'].'/assets/php/include.php';

$thisPage = new Page();
$thisPage->meta = '';
$thisPage->canonical = 'http://salustelehealth.com/staff';
if(isset($_GET['staff'])){
  $title = str_replace("-", " ", $_GET['staff']);
  $title = ucwords($title);
  $thisPage->title = $title;
  if(file_exists($_SERVER['DOCUMENT_ROOT'].'/assets/html/pages/staff-members/'.$_GET['staff'].'.html')){
    $thisPage->content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/pages/staff-members/'.$_GET['staff'].'.html');
  } else {
    returnError('404', $thisPage);
  }
  $thisPage->description = '';
} else {
  $thisPage->content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/pages/staff.html');
  $thisPage->title = 'Staff Directory';
  $thisPage->description = '';
}
$thisPage->background = 'background--dark';
$thisPage->output();
