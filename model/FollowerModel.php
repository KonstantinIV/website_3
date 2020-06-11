<?php 
namespace src\Model;
use \src\controller\core;
class followerModel extends core\Model{

    
   
    function __construct(){
       parent::__construct();
    }

function followingUser($username,$targetUser){
    $stmt = $this->pdo->prepare("SELECT * from  userFollowers WHERE USER_ID = (select ID from user where username = :username ) AND TARGET_USER_ID = (select ID from user where username = :targetUser) LIMIT 1");
    
    
    
    $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
    $stmt->bindParam(':targetUser', $targetUser, \PDO::PARAM_STR);
    $stmt->execute();
    if(!$stmt->fetchColumn()){
            
        return false;
    }else{
        return true;
    }
}

    function followUser($username,$targetUser){
        $stmt = $this->pdo->prepare("INSERT into userFollowers (USER_ID, TARGET_USER_ID,followDate) VALUES ((select ID from user where username = :username ),(select ID from user where username = :targetUser ),now())");
            
       
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':targetUser', $targetUser, \PDO::PARAM_STR);

        if(!$stmt->execute()){
            return false;
        }else{
            return true;
        }
    }
    function unfollowUser($username,$targetUser){
        $stmt = $this->pdo->prepare("DELETE FROM userFollowers  WHERE USER_ID = (select ID from user where username = :username ) AND TARGET_USER_ID = (select ID from user where username = :targetUser) LIMIT 1");
            
       
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':targetUser', $targetUser, \PDO::PARAM_STR);
        $stmt->execute();
        if(!$stmt->rowCount()){
            return false;
        }else{
            return true;
        }
    }



    
}
