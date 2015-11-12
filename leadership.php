<?php

require $_SERVER['DOCUMENT_ROOT'].'/assets/php/include.php';

$thisPage = new Page();
$thisPage->content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/pages/leadership.html');
$thisPage->meta = '';
$thisPage->title = 'Leadership';
$thisPage->canonical = 'http://salustelehealth.com/Leadership';
$thisPage->description = '';
$thisPage->background = 'background--dark';
$thisPage->output();
