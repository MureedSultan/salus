<?php

require $_SERVER['DOCUMENT_ROOT'].'/assets/php/include.php';

$thisPage = new Page();
$thisPage->meta = '';
$thisPage->content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/pages/index.html');
$thisPage->title = 'Home';
$thisPage->canonical = 'http://salustelehealth.com/';
$thisPage->description = 'SALUS Telehealth is an emerging telehealth company that provides its customers with a complete and comprehensive telehealth platform and the equipment resources needed to successfully implement an e-clinical model of care in any healthcare environment. Salus brings unparalleled success in the application and integration of telemedicine programs.';
$thisPage->background = 'background--dark';
$thisPage->js = '<script src="assets/js/plugin/pollyfill.js" type="text/javascript"></script><script src="assets/js/custom/smoothscroll.js" type="text/javascript"></script>';
$thisPage->output();
