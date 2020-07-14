<?php
namespace src\controller;

use \src\model;
use \src\core;
use \src\validation;
abstract class MainController{

    protected $sessionModel;

    protected $validation;
    protected $errors = array( 
        401  => "Unauthorized",
        405 => "Method Not Allowed",
        422  => "Unprocessable Entity", //Correct syntax, but wrong params that fail to follow instructions

        
        
       

    );


    protected $error = array("errorMessage" => "" );
    protected $errorMessage;
    protected $httpCode = 200;
    protected $result;


    protected $model;
    protected $userSession;

    function __construct(core\Model $model, core\UserSession $userSession, validation\Validation $validation){
        $this->model   = $model;
        $this->userSession = $userSession;
        $this->validation  = $validation;
        
       

    }
  

    protected function setErrorMessage($errorMessage){
        $this->errorMessage['errorMessage'] = $errorMessage;
    }
    protected function setHttpCode($httpCode){
        $this->httpCode = $httpCode;
    }
    protected function setResult($result){
        $this->result = $result;
    }

    public function getErrorMessage(){
        return $this->errorMessage;
    }
    public function getHttpCode(){
        return  $this->httpCode ;
    }
    public function getResult(){
        return  $this->result ;
    }
    public function getError(){
        return  $this->error ;
    }

    abstract protected function get($arr);
    abstract protected function post($arr);
    abstract protected function delete($arr);
    abstract protected function put($arr);

}


?>
