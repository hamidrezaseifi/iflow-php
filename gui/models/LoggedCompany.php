<?php

namespace app\models;

use yii\base\Model;

class LoggedCompany extends Model
{
    private $id = 0;
    private $companyName= "";
    private $identifiyId = "";
    private $status = 0;
    
    
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @return string
     */
    public function getIdentifiyId()
    {
        return $this->identifiyId;
    }

    /**
     * @return number
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function __construct($config)
    {
        $this->id = $config->id;
        $this->companyName = $config->companyName;
        $this->identifiyId = $config->identifyid;
        $this->status = $config->status;
    }
    
    
    
    
}
