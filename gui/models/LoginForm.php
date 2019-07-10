<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\modules\RestTemplate;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        $rest = new RestTemplate();
        
        $request = ["email" => $this->username, "password" => $this->password, "companyIdentity" => ''];
        $url = \Yii::$app->params['services']['profile']['urls']['auth'];
        $output = $rest->postData($url, $request);
        
     // print_r($output) ; exit; 
        
        if (isset($output['sessionid'])) {
            
            $_SESSION['logedInfo'] = ['token' => $output['token'], 'sessionid' => $output['sessionid'], ];
            
            $email = ["email" => $output['email'], "token"=>$output['token']];
           //print_r($email) ; exit; 
            $url= "http://localhost:1020/profile/read/authinfo";
            $profile=$rest->postData($url, $email);
            
             print_r($profile) ; exit; 
           
          // $user = $rest->getData(\Yii::$app->params['services']['core']['urls']['readuserbyemail'] . $this->username);

            if(is_array($request) && isset($request['companyId'])){
               // $company = $rest->getData(\Yii::$app->params['services']['core']['urls']['companyinfo'] . $user['companyId']);
                //print_r($company) ; exit; 
                $user = ?;
                $company = ?;
                
                $logedUser = new IdentityUser($user, $company, $output['token'], $output['sessionid']);
                $_SESSION['logedInfo']['user'] = $logedUser;
                return Yii::$app->user->login($logedUser, \Yii::$app->params['loginSettings']['sessionTimeOut']);
            }
            
        }
        return false;
    } 

    /**
     * Finds user by [[username]]
     *
     * @return IdentityUser|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = IdentityUser::findByUsername($this->username);
        }

        return $this->_user;
    }
    
    
}
