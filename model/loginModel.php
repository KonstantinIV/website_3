<?php 
namespace src\model;
use \src\controller\core;
class loginModel extends core\modelController{

   
    function __construct(){
       parent::__construct();
    }

    //Login 
    function userAuth($username,$password){
        $stmt = $this->pdo->prepare('SELECT password  from user WHERE username=? LIMIT 1');
        $stmt->execute([$username]);
       
        if( $stmt->fetchColumn() != $password){
            return false;
        }
        return true;
    }


    //Register
    function usernameValidation($username){
   
        if( strlen($username) > 24 || strlen($username) < 3 || !is_string($username))  {

            return false;
        }else if(!preg_match("/^[a-zA-Z0-9_-]{3,24}$/",$username)){

            return false;
        }

        return true;
    }

    function passwordValidation($password){
        
       // echo strlen($password);
        if(strlen($password) < 8 || !is_string($password ))  {
            
          return false;
        }
        return true;
    }
    function emailValidation($email){
        // /^[\p{L}0-9_]+[\p{L}0-9_]+([-_+.'][\p{L}0-9_]+)*@[\p{L}0-9_]+([-_.][\p{L}0-9_]+)*\.[\p{L}0-9_]+([-._][\p{L}0-9_]+)*$/
        
        if(!preg_match("/^.+@.+$/",$email ) || !is_string($email))  {
            return false;
        }
        return true;
    }
    function birthdayValidation($birthday){
        if(!is_numeric($birthday) || !(strlen((string)$birthday) == 8 ) )  {
            return false;
        }
        return true;
    }

    
    function usernameVerification($username){
        $stmt = $this->pdo->prepare('select username from user WHERE username=? LIMIT 1');
        $stmt->execute([$username]);
        //Exists user
       
        if($stmt->fetchColumn()){
            
            return false;
        }else{
            return true;
        }

    }


    function emailVerification($email){
         //Exists Email
         $stmt = $this->pdo->prepare('select email from user WHERE email=? LIMIT 1');
         $stmt->execute([$email]);
         if($stmt->fetchColumn()){
             return false;
         }else{
             return true;
         } 
       
         

    }

       

        function userCreate($username, $password, $email){
            $stmt = $this->pdo->prepare('insert into user (username, password,email,join_date,birthday) VALUES (?,?,?,now(),now())');
         if( !$stmt->execute([$username,$password,$email])){
            return false;
            }
            return true;
                
        }





}

?>
