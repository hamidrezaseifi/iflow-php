<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\modules\RestTemplate;
use yii\debug\models\search\Profile;



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
        
        $url = \Yii::$app->params['services']['workflow']['urls']['workflowtype-list'].$CompId;
        $userurl = \Yii::$app->params['services']['profile']['urls']['user-list'].$CompId;
        $departmenturl = \Yii::$app->params['services']['profile']['urls']['department-list'].$CompId;
        //print_r($departmenturl) ; exit;
        $rest = new RestTemplate();
              
        $WorkflowType = $rest->getData($url);
        $department = $rest->getData($departmenturl);
        $department = $department['DepartmentList']['DepartmentEdo'];
        //print_r($department) ; exit;
        
        $user = $rest->getData($userurl);
        $user = $user['UserList']['UserEdo'];
         
        //print_r($user) ; exit;
        
        $WorkflowType = isset($WorkflowType["WorkflowTypeList"]) ? $WorkflowType["WorkflowTypeList"] : $WorkflowType;
        $WorkflowType = isset($WorkflowType["WorkflowTypeEdo"]) ? $WorkflowType["WorkflowTypeEdo"] : $WorkflowType;
        //print_r($output) ; exit;
        return $this->render('create',['types' => $WorkflowType, 'users' => $user ,'departments'=>$department]);
       
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
