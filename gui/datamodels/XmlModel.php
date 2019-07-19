<?php
namespace app\datamodels;

use yii\base\Model;

class XmlModel extends Model
{
    private function array_to_xml( &$xml_data ) {
        
        
        foreach( $this->attributes as $key => $value ) {
            
            if( is_array($value) ) {
                $subnode = $xml_data->addChild($key);
                array_to_xml($value, $subnode);
            } else {
                $xml_data->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }
    
    public function renderToXml(){
        
        
        $modelName = $this->getClassName();
        
        $xml_data = new \SimpleXMLElement('<?xml version="1.0"?><' . $modelName . '></' . $modelName . '>');
        
        // function call to convert array to xml
        $this->array_to_xml($xml_data);
        
        //saving generated xml file;
        $result = $xml_data->asXML();
        
        return $result;
    }
    
    private function getClassName(){
        $path = explode('\\', get_class($this));
        return array_pop($path);
    }
    
    public function renderToJson(){
        
        $result = [];
        
        foreach( $this->attributes as $key => $value ) {
            
            if(method_exists ($value, 'renderToJson')){
                $result[$key] = $value->renderToJson();
            } 
            else {
                if(is_array($value)){
                    $result[$key] = XmlModel::renderArrayToJson($value);
                }
                else {
                    $result[$key] = $value;
                }
            }
            
            
            
        }
        
        return $result;
    }
    
    
    public static function renderArrayToJson($list){
        
        $result = [];
        foreach( $list as $item ) {
            
            $result[] = $item->renderToJson();
        }
        
        return $result;
    }
    
    
}

