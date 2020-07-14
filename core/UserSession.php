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
    public function setUsername($username){
        
        $_SESSION['username'] = $username;
        $this->username = $_SESSION['username'] ? $_SESSION['username'] : "";
    }
    public function isAuthenticated(){
        return empty($this->username) ? false : true;
    }

    public function deleteSession(){
        session_destroy();
        
    }

    public function authorizedReqMethod($reqMethod){
        if($reqMethod !=  "GET" && !$this->isAuthenticated()){
            return false;
        }
        return true;
    }

    

}


?>