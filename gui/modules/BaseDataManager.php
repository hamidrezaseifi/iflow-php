<?php
namespace app\modules;

use app\datamodels\Department;
use app\datamodels\WorkflowType;

class BaseDataManager  
{
    public static function getDepartments() {
        
        if(!isset($_SESSION['logedInfo']['departments'])){
            $loggedInfo = $_SESSION['logedInfo'];
            
            $CompId= $loggedInfo['user']->getCompany()->getId();
            
            $url = \Yii::$app->params['services']['profile']['urls']['department-list'].$CompId;
            $rest = new RestTemplate();
            $models = $rest->getData($url);
            //print_r($departments) ;
            $_SESSION['logedInfo']['departments'] = Department::createArray($models);
            //print_r($_SESSION['logedInfo']['departments']) ; exit;
        }
        
        return $_SESSION['logedInfo']['departments'];
    }

    public static function getWorkflowTypes() {
        
        if(!isset($_SESSION['logedInfo']['workflowtypes'])){
            $loggedInfo = $_SESSION['logedInfo'];
            
            $CompId= $loggedInfo['user']->getCompany()->getId();
            
            $url = \Yii::$app->params['services']['workflow']['urls']['workflowtype-list'].$CompId;
            $rest = new RestTemplate();
            $models = $rest->getData($url);
            //print_r($departments) ;
            $_SESSION['logedInfo']['workflowtypes'] = WorkflowType::createArray($models);
            //print_r($_SESSION['logedInfo']['departments']) ; exit;
        }
        
        return $_SESSION['logedInfo']['workflowtypes'];
    }
}

