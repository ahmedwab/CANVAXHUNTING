<?php

$curltext="https://publish.twitter.com/oembed?url=";
// From URL to get webpage contents.
$url = $curltext."https://twitter.com/VaxHuntersCan/status/1389386058949971970";
  
// Initialize a CURL session.
$ch = curl_init(); 
  
// Return Page contents.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  
//grab URL and pass it to the variable.
curl_setopt($ch, CURLOPT_URL, $url);
  
$result = curl_exec($ch);
  
$decoded_data = json_decode($result);

echo "$decoded_data->html \n";


?>