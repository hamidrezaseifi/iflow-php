<?php
namespace app\datamodels;


class Department extends XmlModel 
{
    private $ID = 0;
    private $CompanyId = 0;
    private $Title = "";
    private $Status = 0;
    private $Version = 0;
    private $DepartmentGroupList = [];
    
    function __construct($data) {
        if(isset($data) && is_array($data)){
            $this->ID = $data['ID'];
            $this->CompanyId = $data['CompanyId'];
            $this->Title = $data['Title'];
            $this->Status = $data['Status'];
            $this->Version = $data['Version'];
            $this->DepartmentGroupList = DepartmentGroup::createArray($data['DepartmentGroupList']);
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
     * @return multitype:
     */
    public function getDepartmentGroupList()
    {
        return $this->DepartmentGroupList;
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
    public function setCompanyId($CompanyId)
    {
        $this->CompanyId = $CompanyId;
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

    /**
     * @param multitype: $DepartmentGroupList
     */
    public function setDepartmentGroupList($DepartmentGroupList)
    {
        $this->DepartmentGroupList = $DepartmentGroupList;
    }

    
    public static function createArray($data){
        $data = isset($data['DepartmentList']) && is_array($data['DepartmentList']) ? $data['DepartmentList'] : $data; 
        $data = isset($data['Department']) && is_array($data['Department']) ? $data['Department'] : $data; 
        
        $items = [];
        foreach($data as $item){
            $items[] = new Department($item);
        }
        
        return $items;
    }
    
}

