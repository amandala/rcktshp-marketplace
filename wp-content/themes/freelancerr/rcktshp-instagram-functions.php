<?php 

$access_token = '13475079.96b1818.47be6e640b304b41bd15a7bb703e6edd';


function fetchData($url){
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_TIMEOUT, 20);
  $result = curl_exec($ch);
  curl_close($ch); 
  return $result;
}


// Gets the users user id given their username 
function getClientId($insta_user_name){
  global $access_token;

  $users = fetchData("https://api.instagram.com/v1/users/search?q=".$insta_user_name."&access_token=".$access_token);

  $result = json_decode($users, true);
  return (int)$result['data'][0]['id'];
}

// Gets the user's intagram feed given their user id
// vars: count = the number of photos to get  
function getInstaFeed($insta_user_id){
  global $access_token;
  $count = 10; //the number of photos to get

  if($insta_user_id !== ''){
    $result = fetchData("https://api.instagram.com/v1/users/".$insta_user_id."/media/recent/?count=".$count."&access_token=".$access_token);
    $result = json_decode($result, true);

    return $result['data'];
   
  }

}



?>