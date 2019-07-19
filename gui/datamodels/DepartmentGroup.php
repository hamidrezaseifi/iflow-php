<?php
namespace app\datamodels;


class DepartmentGroup extends XmlModel 
{
    private $ID = 0;
    private $DepartmentId = 0;
    private $Title = "";
    private $Status = 0;
    private $Version = 0;
    
    function __construct($data) {
        if(isset($data) && is_array($data)){
            $this->ID = $data['ID'];
            $this->DepartmentId = $data['DepartmentId'];
            $this->Title = $data['Title'];
            $this->Status = $data['Status'];
            $this->Version = $data['Version'];
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
    public function getDepartmentId()
    {
        return $this->DepartmentId;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->Title;
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
     * @param Ambigous <number, unknown> $ID
     */
    public function setID($ID)
    {
        $this->ID = $ID;
    }

    /**
     * @param number $CompanyId
     */
    public function setDepartmentId($DepartmentId)
    {
        $this->DepartmentId = $DepartmentId;
    }

    /**
     * @param string $Title
     */
    public function setTitle($Title)
    {
        $this->Title = $Title;
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

    
    public static function createArray($data){
        $data = isset($data['DepartmentGroupList']) && is_array($data['DepartmentGroupList']) ? $data['DepartmentGroupList'] : $data; 
        $data = isset($data['DepartmentGroup']) && is_array($data['DepartmentGroup']) ? $data['DepartmentGroup'] : $data; 
        
        $items = [];
        foreach($data as $item){
            if(isset($item['ID']) && isset($item['Title'])){
                $items[] = new DepartmentGroup($item);
            }
            
        }
        
        return $items;
    }
    
}

