<?php 
namespace src\Model;
use \src\core;
class NotfificationsModel extends core\Model{

   
    function __construct(){
       parent::__construct();
    }

    //Login 



    function setUserFollowMessage($username, $targetUsername){
        $stmt = $this->pdo->prepare("INSERT into userFollowers (USER_ID, TARGET_USER_ID,followDate) VALUES ((select ID from user where username = :username ),(select ID from user where username = :targetUser ),now())");
                
           
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':targetUser', $targetUser, \PDO::PARAM_STR);
    
        if(!$stmt->execute()){
            return false;
        }else{
            return true;
        }
    }

    function readUserFollowMessages($username){

        $stmt = $this->pdo->prepare('UPDATE userFollowers SET  isRead = 1   WHERE USER_TARGET_ID =  (SELECT ID from user where username = :username) ');
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return true;
         } else {
            return false;
         }
    }

    function userFollowMessages($username){
        $stmt = $this->pdo->prepare("SELECT user.username, userFollowers.followDate, userFollowers.isRead from  userFollowers  
        INNER JOIN user ON user.ID = userFollowers.USER_ID 
        
        WHERE userFollowers.TARGET_USER_ID = (select ID from user where username = :username ) LIMIT 20");

        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
          
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}

?>
