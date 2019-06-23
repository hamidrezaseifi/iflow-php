<?php
namespace app\modules;

class RestTemplate
{
    private const PRODUCE_JSON_PART = 'produces=json';
    
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
        
        //echo $output;
        
        return $output;
    }
    
    function getData($url) {
        
        $url = $this->prepareUrl($url);
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->prepareHeader(false, false));
        $output = curl_exec($ch);
        curl_close($ch);
        
        //echo $output;
        
        return $output;
    }
    
    private function prepareUrl($url) {
        $urlLower = strtolower($url);
        $urlTemp = $url;
        
        if(!strpos($urlLower, RestTemplate::PRODUCE_JSON_PART)){
            $urlTemp .= !strpos($urlLower, '?') ? '?' : '&';
            $urlTemp .= RestTemplate::PRODUCE_JSON_PART;
        }
        
        return $urlTemp;
    }
    
    private function prepareHeader($isPost, $jsonData) {
        
        $header = array('iflow-inner-module: inner-module', 'iftkid: notloged', );
        
        if($isPost){
            $header = array_merge($header, array('Content-Type: application/json', "Content-length: ".strlen($jsonData)));
        }
        
        return $header;
    }
}

