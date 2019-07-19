<?php
namespace app\datamodels;


class WorkflowType extends XmlModel 
{
    private $ID = 0;
    private $CompanyId = 0;
    private $BaseTypeId = 0;
    private $Title = "";
    private $Comments = "";
    private $SendToController = 0;
    private $ManualAssign = 0;
    private $IncreaseStepAutomatic = 0;
    private $Status = 0;
    private $Version = 0;
    private $StepList = [];

    function __construct($data) {
        if(isset($data) && is_array($data)){
            $this->ID = $data['ID'];
            $this->CompanyId = $data['CompanyId'];
            $this->BaseTypeId = $data['BaseTypeId'];
            $this->Title = $data['Title'];
            $this->Comments = $data['Comments'];
            $this->SendToController = $data['SendToController'];
            $this->ManualAssign = $data['ManualAssign'];
            $this->IncreaseStepAutomatic = $data['IncreaseStepAutomatic'];
            $this->Status = $data['Status'];
            $this->Version = $data['Version'];
            $this->StepList = WorkflowTypeStep::createArray($data['WorkflowTypeStepList']);
        }
    }

    
    /**
     * @return number
     */
    public function getID()
    {
        return $this->ID;
    }
    
    /**
     * @return number
     */
    public function getCompanyId()
    {
        return $this->CompanyId;
    }
    
    /**
     * @return number
     */
    public function getBaseTypeId()
    {
        return $this->BaseTypeId;
    }
    
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->Title;
    }
    
    /**
     * @return string
     */
    public function getComments()
    {
        return $this->Comments;
    }
    
    /**
     * @return number
     */
    public function getSendToController()
    {
        return $this->SendToController;
    }
    
    /**
     * @return number
     */
    public function getManualAssign()
    {
        return $this->ManualAssign;
    }
    
    /**
     * @return number
     */
    public function getIncreaseStepAutomatic()
    {
        return $this->IncreaseStepAutomatic;
    }
    
    /**
     * @return number
     */
    public function getStatus()
    {
        return $this->Status;
    }
    
    /**
     * @return number
     */
    public function getVersion()
    {
        return $this->Version;
    }
    
    /**
     * @return array
     */
    public function getStepList()
    {
        return $this->StepList;
    }
    
    /**
     * @param number $ID
     */
    public function setID($ID)
    {
        $this->ID = $ID;
    }
    
    /**
     * @param number $CompanyId
     */
    public function setCompanyId($CompanyId)
    {
        $this->CompanyId = $CompanyId;
    }
    
    /**
     * @param number $BaseTypeId
     */
    public function setBaseTypeId($BaseTypeId)
    {
        $this->BaseTypeId = $BaseTypeId;
    }
    
    /**
     * @param string $Title
     */
    public function setTitle($Title)
    {
        $this->Title = $Title;
    }
    
    /**
     * @param string $Comments
     */
    public function setComments($Comments)
    {
        $this->Comments = $Comments;
    }
    
    /**
     * @param number $SendToController
     */
    public function setSendToController($SendToController)
    {
        $this->SendToController = $SendToController;
    }
    
    /**
     * @param number $ManualAssign
     */
    public function setManualAssign($ManualAssign)
    {
        $this->ManualAssign = $ManualAssign;
    }
    
    /**
     * @param number $IncreaseStepAutomatic
     */
    public function setIncreaseStepAutomatic($IncreaseStepAutomatic)
    {
        $this->IncreaseStepAutomatic = $IncreaseStepAutomatic;
    }
    
    /**
     * @param number $Status
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;
    }
    
    /**
     * @param number $Version
     */
    public function setVersion($Version)
    {
        $this->Version = $Version;
    }
    
    /**
     * @param Ambigous <multitype:, multitype:\app\datamodels\DepartmentGroup > $StepList
     */
    public function setStepList($StepList)
    {
        $this->StepList = $StepList;
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

