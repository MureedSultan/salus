<?php

require $_SERVER['DOCUMENT_ROOT'].'/assets/php/include.php';

$thisPage = new Page();
$thisPage->meta = '';
$thisPage->content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/pages/'.$autoPage);
$thisPage->title = $autoTitle;
$thisPage->canonical = 'http://salustelehealth.com/about';
$thisPage->description = '';
$thisPage->background = 'background--dark';
$thisPage->output();
