<?php
namespace app\modules;

class RestTemplate
{
    const PRODUCE_JSON_PART = 'produces=json';
    
    function postData($url, $data) {
        
        $url = $this->prepareUrl($url);
        
        $jsonData = json_encode($data);
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->prepareHeader(true, $jsonData));
        curl_setopt($ch, CURLOPT_POSTFIELDS,  $jsonData);
        $output = curl_exec($ch);
        curl_close($ch);
        
        $array = $this->resultAsArray($output);
        
        return $array;
    }

    
    function getData($url) {
        
        $url = $this->prepareUrl($url);
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->prepareHeader(false, false));
        $output = curl_exec($ch);
        curl_close($ch);
        
        $array = $this->resultAsArray($output);
        
        return $array;
    }
    
    private function prepareUrl($url) {
        $urlLower = strtolower($url);
        $urlTemp = $url;
        
        /*if(!strpos($urlLower, self::PRODUCE_JSON_PART)){
            $urlTemp .= !strpos($urlLower, '?') ? '?' : '&';
            $urlTemp .= self::PRODUCE_JSON_PART;
        }*/
        
        return $urlTemp;
    }
    
    private function prepareHeader($isPost, $jsonData) {
        
        $token = 'not-logged';
        if(isset($_SESSION['logedInfo']) && isset($_SESSION['logedInfo']['token'])){
            
            $token = $_SESSION['logedInfo']['token'];
            
        }
        
        $header = array('IFLOW-CLIENT-ID: iflow-inner-module', 'iftkid: ' . $token, );
        
        if($isPost){
            $header = array_merge($header, array('Content-Type: application/json', "Content-length: ".strlen($jsonData)));
        }
        
        return $header;
    }
    
    private function resultAsArray($output)
    {
        $array = false;
        
        if($output && strlen($output) > 5){
            
            //print_r($output); exit;
            $result = simplexml_load_string($output);
            
            $json = json_encode($result);
            $array = json_decode($json,TRUE);
        }
        
        return $array;
    }
}

