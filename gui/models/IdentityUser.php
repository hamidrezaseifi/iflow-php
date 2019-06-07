<?php

namespace app\models;

use yii\web\IdentityInterface;

class IdentityUser implements IdentityInterface
{
    private $user = false;
    private $company = false;
    private $sessionId = "";
    private $accessToken = "";
    
    /**
     * @return \app\models\LoggedCompany
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @return \app\models\LoggedUser user
     */
    public function getUser()
    {
        return $this->user;
    }


    public function __construct($user, $company, $tocken, $sessionId)
    {
        $this->user = new LoggedUser($user);
        $this->company = new LoggedCompany($company);
        $this->sessionId = $sessionId;
        $this->accessToken = $tocken;
     }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public static function findIdentity($id)
    {
        if(isset(\Yii::$app->session['logedInfo']) && isset(\Yii::$app->session['logedInfo']['user']))
        {
            $logedUser = \Yii::$app->session['logedInfo']['user'];
            if($logedUser->user->getId() == $id)
            {
                return $logedUser;
            }
        }       
        
        return null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        if(isset(\Yii::$app->session['logedInfo']) && isset(\Yii::$app->session['logedInfo']['user']))
        {
            $logedUser = \Yii::$app->session['logedInfo']['user'];
            if($logedUser->accessToken == $token)
            {
                return $logedUser;
            }
        }
        
        return null;
    }
    public function validateAuthKey($authKey)
    {
        $this->sessionId = $authKey;
    }

    public function getAuthKey()
    {
        return $this->sessionId;
    }

    public function getId()
    {
        return $this->user->id;
    }
    
    
}
