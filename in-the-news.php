<?php

require $_SERVER['DOCUMENT_ROOT'].'/assets/php/include.php';

$thisPage = new Page();
$thisPage->content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/pages/in-the-news.html');


$db = new Db();
$news = $db->query("SELECT * FROM news WHERE id>(?) ORDER BY date DESC", "i", "0");
$div;
foreach($news as $new){
    $div .= '<div class="pr">
      <h2>'.$new['title'].'</h2>
      <p>'.date("F j, Y", strtotime($new['date'])).' - '.$new['description'].'</p>
      <a class="btn btn-md btn-black-line" href="'.$new['link'].'" target="_blank">Read More</a>
      <div class="clearfix"></div>
      </div>';
}
$thisPage->content = str_replace('{prs}', $div, $thisPage->content);


$thisPage->meta = '';
$thisPage->title = 'Press Releases';
$thisPage->canonical = 'http://salus.dev.mureedsultan.com/press-releases';
$thisPage->description = '';
$thisPage->background = 'background--dark';
$thisPage->output();
