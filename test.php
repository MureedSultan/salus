<?php

//header('Expires: ' . gmdate('D, d M Y H:i:s', time() + (60*60*24*7)) . ' GMT');
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + (60 * 60 * 24 * 14)));



//ini_set("display_errors", "1");
//error_reporting(E_ALL);
header('Content-Type: application/json');
$settings = array(
    'oauth_access_token' => "1884966888-3w9M6n9VWnWrnLdSfRFefctnWnuwQ7BHlUUEl0v",
    'oauth_access_token_secret' => "Opk47kzL7zlBe5XKDsIgP1a6mZryJ9lkUFHkaaX8HKNyw",
    'consumer_key' => "onBPIAECBvuAOy3WhOWDku1AH",
    'consumer_secret' => "96MpimmgcfSF1ztUgj1HYlMmwvPb173901j4iPsnI2to81bycp"
);
include $_SERVER['DOCUMENT_ROOT'].'/assets/php/twitter.class.php';
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name=SalusTelehealth';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$tweets = $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();
$tweets = json_decode($tweets, true);
$arr = [];
$currentDate = new DateTime();
for($i = 0; $i < 2; $i++){
  $tweetDate = new DateTime($tweets[$i]['created_at']);
  $interval = $tweetDate->diff($currentDate);
  $interval = $interval->format('%R%a days');
  $interval = str_replace('+', '', $interval);
  if($interval == "0 days"){
    $interval = "Today";
  } else if($interval == "1 days"){
    $interval = "Yesterday";
  }

  $url = $tweets[$i]['text'];
  $url = preg_replace(
    '@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@',
     '<a href="$1">$1</a>',
    $url);


  $data = array('text' => $url, 'time' => $interval, 'oldTime' => $tweetDate, 'currentTime' => $currentDate);
  array_push($arr, $data);
}
/*
foreach($tweets as $tweet){
  $tweetDate = new DateTime($tweet['created_at']);
  $interval = $tweetDate->diff($currentDate);

  $data = array('text' => $tweet['text'], 'time' => $interval->format('%R%a days'));
  array_push($arr, $data);
}
//*/
echo json_encode($arr);
//print_r($tweets);
