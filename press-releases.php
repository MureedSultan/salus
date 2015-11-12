<?php

require $_SERVER['DOCUMENT_ROOT'].'/assets/php/include.php';

$thisPage = new Page();
$thisPage->content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/pages/press-releases.html');

if(isset($_GET['pr'])){
  $db = new Db();
  $pr = $db->query("SELECT * FROM prs WHERE date=(?) LIMIT 1", "s", $_GET['pr']);
  $div = '<div class="pr">
      <h2>'.$pr[0]['title'].'</h2>
      <p>'.date("F j, Y", strtotime($pr[0]['date'])).' -</p>
      <p class="lead">'.$pr[0]['content'].'</p>
      <div class="clearfix"></div>
  </div>';
  $thisPage->content = str_replace('{prs}', $div, $thisPage->content);
} else {
  $db = new Db();
  $prs = $db->query("SELECT * FROM prs WHERE id>(?) ORDER BY date DESC", "i", "0");
  $div;
  foreach($prs as $pr){
      $div .= '<div class="pr">
        <h2>'.$pr['title'].'</h2>
        <p>'.date("F j, Y", strtotime($pr['date'])).' -</p>
        <p class="lead">'.$pr['description'].'</p>
        <a class="btn btn-md btn-black-line" href="press-releases/'.$pr['date'].'">Read More</a>
        <div class="clearfix"></div>
        </div>';
  }
  $thisPage->content = str_replace('{prs}', $div, $thisPage->content);
}

$thisPage->meta = '';
$thisPage->title = 'Press Releases';
$thisPage->canonical = 'http://salus.dev.mureedsultan.com/press-releases';
$thisPage->description = '';
$thisPage->background = 'background--dark';
$thisPage->output();
