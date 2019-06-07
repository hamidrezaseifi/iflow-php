<?php

//print_r($_SERVER);

/*$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "http://localhost:1020/testuser");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$output = curl_exec($ch);

curl_close($ch);

echo $output;*/

$encoded = '<UserEdo><id>1</id><userName>UserName</userName><password>UserName</password><firstName>firstName</firstName><lastName>LastName</lastName><status>1</status><permission>1</permission></UserEdo>';
$encoded = '{
   "id": 1,
   "userName": "UserName",
   "password": "UserName",
   "firstName": "firstName",
   "lastName": "LastName",
   "status": 1,
   "permission": 1
}';

$ch = curl_init("http://localhost:1020/auth/authenticatejson");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS,     "body goes here" );
curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: application/json', "Content-length: ".strlen($encoded))); 
curl_setopt($ch, CURLOPT_POSTFIELDS,  $encoded);
$output = curl_exec($ch);
curl_close($ch);
echo $output;


