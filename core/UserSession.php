<?php
namespace src\core;

class UserSession {
   private $username;

    function __construct(){
        session_start();
        $this->username = $_SESSION['username'] ? $_SESSION['username'] : "";
        
    }

    public function getUsername(){
        return $this->username;
    }
    protected function isAuthenticated(){
        return empty($this->username) ? false : true;
    }

    protected function sessionEnd(){

        
    }

    public function authorizedReqMethod($reqMethod){
        if($reqMethod !=  "GET" && !$this->isAuthenticated()){
            return false;
        }
        return true;
    }

    

}


?>