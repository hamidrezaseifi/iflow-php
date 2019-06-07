<?php
namespace app\modules;

class RestTemplate
{
    
    function postData($url, $data) {
        
        $jsonData = json_encode($data);
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: application/json', "Content-length: ".strlen($jsonData)));
        curl_setopt($ch, CURLOPT_POSTFIELDS,  $jsonData);
        $output = curl_exec($ch);
        curl_close($ch);
        
        //echo $output;
        
        return $output;
    }
    
    function getData($url) {
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        
        //echo $output;
        
        return $output;
    }
}

