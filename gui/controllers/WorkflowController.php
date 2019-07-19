<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\RestTemplate;
use app\modules\BaseDataManager;
use app\datamodels\WorkflowType;



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
        
        $workflowTypes = BaseDataManager::getWorkflowTypes();
        //print_r($output) ; exit;
        return $this->render('testreadlist',['types' => $workflowTypes]);
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
        
        
        $workflowTypes = BaseDataManager::getWorkflowTypes();
        $workflowTypes = WorkflowType::renderArrayToJson($workflowTypes);
        //print_r($workflowTypes);
        
        echo json_encode($workflowTypes);
        exit;
    
    }
}
