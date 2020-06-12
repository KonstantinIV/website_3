<?php
namespace src\controller;

use \src\model;
use \src\core;
use \src\validation;
abstract class MainController{

    protected $sessionModel;

    protected $validation;
    protected $errors = array( 
        405 => "Method Not Allowed",
        422  => "Unprocessable Entity", //Correct syntax, but wrong params that fail to follow instructions
        
        
       

    );



    protected $errorMessage;
    protected $httpCode;
    protected $result;


    protected $model;
    protected $userSession;

    function __construct(core\Model $model, core\UserSession $userSession, validation\Validation $validation){
        $this->model   = $model;
        $this->userSession = $userSession;
        $this->validation  = $validation;
        
       

    }
  

    protected function setErrorMesssage($errorMessage){
        $this->errorMessage = $errorMessage;
    }
    protected function setHttpCode($httpCode){
        $this->httpCode = $httpCode;
    }
    protected function setResult($result){
        $this->result = $result;
    }

    protected function getErrorMessage($errorCode){
        return $this->errors[$errorCode] ;
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
