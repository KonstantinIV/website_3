<?php 
namespace src\Model;
use \src\core;
class SessionModel extends core\Model{

    
   
    function __construct(){
       parent::__construct();
    }



    function userExists($username){
        $stmt = $this->pdo->prepare('select username from user WHERE username=? LIMIT 1');
        $stmt->execute([$username]);
        //Exists user
        if(!$stmt->fetchColumn()){
            
            return false;
        }
        return true;
    }
    function checkPassword($username,$password){
        $stmt = $this->pdo->prepare('SELECT password  from user WHERE username=? LIMIT 1');
        $stmt->execute([$username]);

        if(!$this->verifyHashPassword($password,$stmt->fetchColumn())){
            return false;
        }
       /* if(  != $password){
            return false;
        }*/
        return true;
    }
   
    function verifyHashPassword($password,$hash){
        return password_verify($password, $hash);
    }



}
?>