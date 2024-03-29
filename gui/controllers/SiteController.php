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



class SiteController extends Controller
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

    /**
     * Reset action.
     *
     * @return 
     */
    public function actionReset(){
        //die('You are here');
        return $this->render('reset');
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        unset($_SESSION['logedInfo']);
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
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
