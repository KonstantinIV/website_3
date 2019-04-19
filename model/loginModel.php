<?php 
namespace src\model;
use \src\controller\core;
class loginModel extends core\modelController{

   
    function __construct(){
       parent::__construct();
    }

    //Login 
    function userAuth(){
        $stmt = $this->pdo->prepare('SELECT pass  from user WHERE username=? LIMIT 1');
        $stmt->execute([$this->inputData['username']]);
        if(!$stmt->fetchColumn()){
            $this->UserExistsErrorCode = 1;
        }else if($stmt->fetchColumn() != $this->inputData['password']){
            $this->UserExistsErrorCode = 2;
        }
        return true;
    }


    //Register
    function usernameValidation(){
        if( $this->data['username'] > 24 || $this->data['username'] < 3 || !is_string($this->data['username']))  {
            return false;
        }else if(!preg_match("/^[a-zA-Z0-9_-]{3,24}$/",$this->data['username'])){
            return false;
        }
        return true;
    }

    function passwordValidation(){
        if($this->data['password'] < 8 || !is_string($this->data['password'] ))  {
          return false;
        }
        return true;
    }
    function emailValidation(){
        if(!preg_match("/^[\p{L}0-9_]+[\p{L}0-9_]+([-_+.'][\p{L}0-9_]+)*@[\p{L}0-9_]+([-_.][\p{L}0-9_]+)*\.[\p{L}0-9_]+([-._][\p{L}0-9_]+)*$/",$this->data['email'] ) || !is_string($this->data['email']))  {
            return false;
        }
        return true;
    }
    function birthdayValidation(){
        if(!is_numeric($this->data['birthday']) || !(strlen((string)$this->data['birthday']) == 8 ) )  {
            return false;
        }
        return true;
    }

    
    function usernameVerification(){
        $stmt = $this->pdo->prepare('select username from user WHERE username=? LIMIT 1');
        $stmt->execute([$this->data['username']]);
        //Exists user
        if(!$stmt->fetchColumn()){
            
            return false;
        }else{
            return true;
        }

    }


    function emailVerification(){
         //Exists Email
         $stmt = $this->pdo->prepare('select email from user WHERE email=? LIMIT 1');
         $stmt->execute([$this->data['email']]);
         if(!$stmt->fetchColumn()){
             return false;
         }else{
             return true;
         } 
       
         

    }

       

    

        function userCreate(){
            $stmt = $this->pdo->prepare('insert into user (username, password,email,join_date,birthday) VALUES (?,?,?,now(),now())');
         if( !$stmt->execute([$this->data['username'],$this->data['password'],$this->data['email']])){
            $this->UserExistsErrorCode = 9;
            }
                
        }





}

?>
