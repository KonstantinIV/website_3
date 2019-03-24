<?php 
namespace src\model;
class loginModel extends modelController{

    public $errorCode;
    public $inputData;

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
    function userValidate(){
        //Username valid
        if( $this->data['username'] > 24 || $this->data['username'] < 3 || !is_string($this->data['username']))  {
            $this->UserExistsErrorCode = 1;
        }else if(!preg_match("/^[a-zA-Z0-9_-]{3,24}$/",$this->data['username'])){
            $this->UserExistsErrorCode = 2;
        }
        //Password valid
        if($this->data['password'] < 8 || !is_string($this->data['password'] ))  {
            $this->UserExistsErrorCode = 3;
        }
        //Email valid
        if(!preg_match("/^[\p{L}0-9_]+[\p{L}0-9_]+([-_+.'][\p{L}0-9_]+)*@[\p{L}0-9_]+([-_.][\p{L}0-9_]+)*\.[\p{L}0-9_]+([-._][\p{L}0-9_]+)*$/",$this->data['email'] ) || !is_string($this->data['email']))  {
            $this->UserExistsErrorCode = 4;
        }
        //Birthday
        if(!is_numeric($this->data['birthday']) || !(strlen((string)$this->data['birthday']) == 8 ) )  {
            $this->UserExistsErrorCode = 5;
        }
        return true;
    }

    
    function userExists(){
        $stmt = $this->pdo->prepare('select username from user WHERE username=? LIMIT 1');
        $stmt->execute([$this->data['username']]);
        //Exists user
        if(!$stmt->fetchColumn()){
            
            $this->UserExistsErrorCode = 7;
        }
        //Exists Email
        $stmt = $this->pdo->prepare('select email from user WHERE email=? LIMIT 1');
        $stmt->execute([$this->data['email']]);
        if(!$stmt->fetchColumn()){
            $this->UserExistsErrorCode = 8;
        } 
        return true;
        
        }

    

        function userCreate(){
            $stmt = $this->pdo->prepare('insert into user (username, password,email,join_date,birthday) VALUES (?,?,?,now(),now())');
         if( !$stmt->execute([$this->data['username'],$this->data['password'],$this->data['email']])){
            $this->UserExistsErrorCode = 9;
            }
                
        }





}

?>
