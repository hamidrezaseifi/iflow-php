<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\RestTemplate;
use app\modules\BaseDataManager;



class WorkflowController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login', 'test'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    
    public function actionIndex()
    {
        return $this->render('index');
    }

   
    public function actionTest()
    {
        
        
        
        return $this->render('test');
    }
    
    public function actionTestreadlist()
    {
        
        $log=$_SESSION['logedInfo'];
        $CompId=$log['user']->getCompany()->getId();
        
        $url = \Yii::$app->params['services']['workflow']['urls']['workflowtype-list'].$CompId;
        //print_r($url) ; exit;
        $rest = new RestTemplate();
        
        
        $output = $rest->getData($url);
               
        $output = isset($output["WorkflowTypeList"]) ? $output["WorkflowTypeList"] : $output;
        $output = isset($output["WorkflowTypeEdo"]) ? $output["WorkflowTypeEdo"] : $output;
        //print_r($output) ; exit;
        return $this->render('testreadlist',['types' => $output]);
    }
    
    public function actionWorkflowtypes()
    {
        return $this->render('workflowtypes');
    }
    
    public function actionCreate()
    {
        $log=$_SESSION['logedInfo'];
        $CompId=$log['user']->getCompany()->getId();
        
        $userurl = \Yii::$app->params['services']['profile']['urls']['user-list'].$CompId;
        
        $rest = new RestTemplate();
              
        $workflowTypes = BaseDataManager::getWorkflowTypes();
        //print_r($workflowTypes) ; exit;
        $departments = BaseDataManager::getDepartments();        
        //print_r($departments) ; exit;
        
        $user = $rest->getData($userurl);
        $user = $user['UserList']['User'];
         
        return $this->render('create',['workflowTypes' => $workflowTypes, 'users' => $user ,'departments'=>$departments]);
       
    }
    
    public function actionLoadworkflowtypes()
    {
        header('Content-type: application/json');
        $this->layout=false;
        
        $log=$_SESSION['logedInfo'];
        $CompId=$log['user']->getCompany()->getId();
        
        $url = \Yii::$app->params['services']['workflow']['urls']['workflowtype-list'].$CompId;
        //print_r($url) ; exit;
        $rest = new RestTemplate();
        
        
        $output = $rest->getData($url);
        
        //print_r($output) ; exit;
        
        $output = isset($output["WorkflowTypeList"]) ? $output["WorkflowTypeList"] : $output;
        $output = isset($output["WorkflowTypeEdo"]) ? $output["WorkflowTypeEdo"] : $output;
        
        echo json_encode($output);
        exit;
    
    }
}
