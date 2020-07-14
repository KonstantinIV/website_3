<?php 
namespace src\Model;
use \src\core;
class VoteModel extends core\Model{

    
    public $inputData;

    function __construct(){
       parent::__construct();
    }

    
  
    function voteExistsComment($username,$postID,$action){
        switch($action){
            case "dislikes":
            
                $stmt = $this->pdo->prepare('select COMMENT_ID from cdislikes inner join user on user.ID = cdislikes.USER_ID WHERE username= :username and COMMENT_ID = :postID LIMIT 1');
                break;
            case"likes":
                $stmt = $this->pdo->prepare('select COMMENT_ID from clikes inner join user on user.ID = clikes.USER_ID WHERE username= :username and COMMENT_ID = :postID LIMIT 1');
                break;
            }
     
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':postID', $postID, \PDO::PARAM_INT);
        $stmt->execute();
        if(!$stmt->fetchColumn()){
            
            return false;
        }else{
            return true;
        }
    }


    function voteExistsPost($username,$postID,$action){
        switch($action){
            case "dislikes":
            
                $stmt = $this->pdo->prepare('select POST_ID from dislikes inner join user on user.ID = dislikes.USER_ID WHERE username= :username and POST_ID =:postID LIMIT 1');
                break;
            case"likes":

                $stmt = $this->pdo->prepare('select POST_ID from likes inner join user on user.ID = likes.USER_ID WHERE username= :username and POST_ID = :postID LIMIT 1');
                break;
            }
     
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':postID', $postID, \PDO::PARAM_INT);
        $stmt->execute();
        if(!$stmt->fetchColumn()){
            
            return false;
        }else{
            return true;
        }
    }
    function votePost($postID,$username, $action){
        switch($action){
            case "dislikes":
                $stmt = $this->pdo->prepare("insert into dislikes    (POST_ID, USER_ID) VALUES (:id,(SELECT ID from user where username = :username)) ");
                break;
            case"likes":

                 $stmt = $this->pdo->prepare("insert into likes    (POST_ID, USER_ID) VALUES (:id,(SELECT ID from user where username = :username)) ");
                break;
                }

        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':id', $postID, \PDO::PARAM_INT);
        $stmt->execute();
    }

    function voteComment($postID,$username, $action){
        switch($action){
            case "dislikes":
                $stmt = $this->pdo->prepare("insert into cdislikes    (COMMENT_ID, USER_ID) VALUES (:id,(SELECT ID from user where username = :username)) ");
                break;
            case"likes":
                 $stmt = $this->pdo->prepare("insert into clikes    (COMMENT_ID, USER_ID) VALUES (:id,(SELECT ID from user where username = :username)) ");
                break;
                }

        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':id', $postID, \PDO::PARAM_INT);
        $stmt->execute();
    }
    function unvotePost($postID,$username, $action){

        switch($action){
            case "dislikes":
                $stmt = $this->pdo->prepare("DELETE FROM dislikes WHERE POST_ID = :id and USER_ID = (SELECT ID from user where username = :username) ");
                break;
            case"likes":

                 $stmt = $this->pdo->prepare("DELETE FROM likes WHERE POST_ID = :id and USER_ID = (SELECT ID from user where username = :username)  ");
                break;
                }

        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':id', $postID, \PDO::PARAM_INT);
        $stmt->execute();
    }
    
    function unvoteComment($postID,$username, $action){
        switch($action){
            case "dislikes":
                $stmt = $this->pdo->prepare("DELETE FROM cdislikes WHERE COMMENT_ID = :id and USER_ID = (SELECT ID from user where username = :username) ");
                break;
            case"likes":
                 $stmt = $this->pdo->prepare("DELETE FROM clikes WHERE COMMENT_ID = :id and USER_ID = (SELECT ID from user where username = :username)  ");
                break;
                }

        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':id', $postID, \PDO::PARAM_INT);
        $stmt->execute();
    }

}
?>
