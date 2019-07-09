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

require_once 'XML/Serializer.php';


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
        unset(\Yii::$app->session['logedInfo']);
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
        
        //$serializer = new XML_Serializer($options);
        
        //$result = $serializer->serialize(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, ]);
        
        $result = simplexml_load_string("<WorkflowEdo>
   <id>3</id>
   <workflowTypeId>1</workflowTypeId>
   <currentStep>1</currentStep>
   <controller>1</controller>
   <createdBy>1</createdBy>
   <title>New Workflow from type 1</title>
   <comments>kommentar 1</comments>
   <status>1</status>
   <version>2</version>
   <files>
      <files>
         <id>2</id>
         <workflowId>3</workflowId>
         <createdBy>1</createdBy>
         <title>New file for Workflow 2</title>
         <activeFilePath>path/to/new/file2</activeFilePath>
         <comments>kommentar 2</comments>
         <activeFileVersion>1</activeFileVersion>
         <status>1</status>
         <version>0</version>
         <fileVersions/>
      </files>
      <files>
         <id>1</id>
         <workflowId>3</workflowId>
         <createdBy>1</createdBy>
         <title>New file for Workflow 1</title>
         <activeFilePath>path/to/new/file1</activeFilePath>
         <comments>kommentar 1</comments>
         <activeFileVersion>1</activeFileVersion>
         <status>1</status>
         <version>2</version>
         <fileVersions/>
      </files>
      <files>
         <id>3</id>
         <workflowId>3</workflowId>
         <createdBy>1</createdBy>
         <title>New file for Workflow 3</title>
         <activeFilePath>path/to/new/file3</activeFilePath>
         <comments>kommentar 3</comments>
         <activeFileVersion>1</activeFileVersion>
         <status>1</status>
         <version>2</version>
         <fileVersions/>
      </files>
   </files>
   <actions>
      <actions>
         <id>1</id>
         <workflowId>3</workflowId>
         <createdBy>1</createdBy>
         <action>New action for Workflow 1</action>
         <oldStep>1</oldStep>
         <newStep>2</newStep>
         <comments>kommentar 1</comments>
         <status>1</status>
         <version>2</version>
      </actions>
   </actions>
</WorkflowEdo>");
        
        $json = json_encode($result);
        $array = json_decode($json,TRUE);
        
        print_r($array); exit;
        
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
        
        //print_r($output) ; exit; 
        
        $output = isset($output["item"]) ? $output["item"] : $output;
        
        return $this->render('testreadlist',['types' => $output]);
    }
}
