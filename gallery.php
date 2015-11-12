<?php

require $_SERVER['DOCUMENT_ROOT'].'/assets/php/include.php';

$thisPage = new Page();
$thisPage->meta = '';
$thisPage->content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/pages/'.$autoPage);
$pics;

$dir    = 'assets/img/gallery';
$files1 = scandir($dir);

foreach($files1 as $file){
  if ($file != "." && $file != "..") {
    $pics .= '
    <div class="nf-item spacing">
        <div class="item-box">
            <a class="cbox-gallary1" href="assets/img/gallery/'.$file.'">
                <img alt="1" src="assets/img/gallery/'.$file.'" class="item-container">
                <div class="item-mask">

                </div>
            </a>
        </div>
    </div>';
  }
}
$thisPage->content = str_replace('{pics}', $pics, $thisPage->content);
$thisPage->title = $autoTitle;
$thisPage->canonical = 'http://salustelehealth.com/gallery';
$thisPage->description = '';
$thisPage->background = 'background--dark';
$thisPage->output();
