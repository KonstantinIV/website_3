<?php
namespace src\controller;

use src\model;
use \src\core;
abstract class MainController{

    protected $sessionModel;
    protected $validation;




    protected $errorMessage;
    protected $httpCode;
    protected $result;


    protected $model;
    protected $userSession;

    function __construct(core\Model $model, core\UserSession $userSession, validation\Validation $validation){
        $this->model   = $model;
        $this->userSession = $userSession;
        $this->validation  = $validation;
        
        $this->sessionModel = new model\sessionModel();
        

        $this->loggedIn     = isset($_SESSION['user']) ? true : false;
        $this->username = isset($_SESSION['user']) ? $_SESSION['user'] : false;

    }
    private function setValidationClass(){

    }

    protected function setErrorMessage($errorMessage){
        $this->errorMessage = $errorMessage;
    }
    protected function setHttpCode($httpCode){
        $this->httpCode = $httpCode;
    }
    protected function setResult($result){
        $this->result = $result;
    }

    protected function getErrorMessage(){
        return $this->errorMessage ;
    }
    protected function getHttpCode(){
        return  $this->httpCode ;
    }
    public function getResult(){
        return  $this->result ;
    }





    abstract protected function get($arr);
    abstract protected function post($arr);
    abstract protected function delete($arr);
    abstract protected function put($arr);

}


?>
