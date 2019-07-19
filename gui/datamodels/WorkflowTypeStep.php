<?php
namespace app\datamodels;


class WorkflowTypeStep extends XmlModel 
{
    public $ID = 0;
    public $WorkflowTypeId = 0;
    public $Title = "";
    public $Comments = "";
    public $StepIndex = 0;
    public $Status = 0;
    public $Version = 0;
    
    function __construct($data) {
        if(isset($data) && is_array($data)){
            $this->ID = $data['ID'];
            $this->WorkflowTypeId = $data['WorkflowTypeId'];
            $this->Title = $data['Title'];
            $this->Comments = is_string ($data['Comments']) ? $data['Comments'] : '' ;
            $this->StepIndex = $data['StepIndex'];
            $this->Status = $data['Status'];
            $this->Version = $data['Version'];
        }
    }
    
    public function attributes()
    {
        
        $names = ['ID', 'WorkflowTypeId', 'Title', 'Comments', 'StepIndex', 'Status', 'Version', ];
        
        return $names;
    }
    
    public static function createArray($data){
        $data = isset($data['WorkflowTypeStepList']) && is_array($data['WorkflowTypeStepList']) ? $data['WorkflowTypeStepList'] : $data; 
        $data = isset($data['WorkflowTypeStep']) && is_array($data['WorkflowTypeStep']) ? $data['WorkflowTypeStep'] : $data; 
        
        $items = [];
        foreach($data as $item){
            if(isset($item['ID']) && isset($item['Title'])){
                $items[] = new WorkflowTypeStep($item);
            }
            
        }
        
        return $items;
    }
    
}

