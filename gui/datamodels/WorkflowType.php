<?php
namespace app\datamodels;


class WorkflowType extends XmlModel 
{
    public $ID = 0;
    public $CompanyId = 0;
    public $BaseTypeId = 0;
    public $Title = "";
    public $Comments = "";
    public $SendToController = 0;
    public $ManualAssign = 0;
    public $IncreaseStepAutomatic = 0;
    public $Status = 0;
    public $Version = 0;
    public $StepList = [];

    function __construct($data) {
        if(isset($data) && is_array($data)){
            $this->ID = $data['ID'];
            $this->CompanyId = $data['CompanyId'];
            $this->BaseTypeId = $data['BaseTypeId'];
            $this->Title = $data['Title'];
            $this->Comments = is_string ($data['Comments']) ? $data['Comments'] : '';
            $this->SendToController = $data['SendToController'];
            $this->ManualAssign = $data['ManualAssign'];
            $this->IncreaseStepAutomatic = $data['IncreaseStepAutomatic'];
            $this->Status = $data['Status'];
            $this->Version = $data['Version'];
            $this->StepList = WorkflowTypeStep::createArray($data['WorkflowTypeStepList']);
        }
    }

    public function attributes()
    {
        
        $names = ['ID', 'CompanyId', 'BaseTypeId', 'Title', 'Comments', 'SendToController', 'ManualAssign', 'IncreaseStepAutomatic', 
            'Status', 'Version', 'StepList', ];
        
        return $names;
    }

    
    public static function createArray($data){
        $data = isset($data['WorkflowTypeList']) && is_array($data['WorkflowTypeList']) ? $data['WorkflowTypeList'] : $data; 
        $data = isset($data['WorkflowType']) && is_array($data['WorkflowType']) ? $data['WorkflowType'] : $data; 
        
        $items = [];
        foreach($data as $item){
            $items[] = new WorkflowType($item);
        }
        
        return $items;
    }
    
    
}

