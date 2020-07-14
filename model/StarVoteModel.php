<?php 
namespace src\Model;
use \src\core;
class StarVoteModel extends core\Model{

    
    public $inputData;

    function __construct(){
       parent::__construct();
    }

    
  

    function starVote($postID,$points,$username){

        $stmt = $this->pdo->prepare('insert into starVote    (POST_ID,USER_ID, points) VALUES (:postID,(SELECT ID from user where username = :username),:points) ');
    

        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);

        $stmt->bindParam(':postID', $postID, \PDO::PARAM_INT);
        $stmt->bindParam(':points', $points, \PDO::PARAM_INT);
        if(!$stmt->execute()){
            
            return false;
        }else{
            return true;
        }

    }
    function checkStarVoteExists($postID,$username){
      
        $stmt = $this->pdo->prepare('select starVote.POST_ID FROM starVote inner join user on user.ID = starVote.USER_ID WHERE username= :username and starVote.POST_ID = :postID LIMIT 1 ');
            
     
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':postID', $postID, \PDO::PARAM_INT);
        $stmt->execute();
        if(!$stmt->fetchColumn()){
            
            return false;
        }else{
            return true;
        }

    }
    function replaceStarVote($postID,$points, $username){
      
        $stmt = $this->pdo->prepare('UPDATE starVote SET  points = :points  WHERE POST_ID = :postID AND USER_ID = (select ID from user where username = :username) ');
            
     
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':postID', $postID, \PDO::PARAM_INT);
        $stmt->bindParam(':points', $points, \PDO::PARAM_INT);

        if(!$stmt->execute()){
            return false;
        }else{
            return true;
        }

    }

    function checkStarVoteDate($postID){
        $stmt = $this->pdo->prepare('select post.ID FROM post where ID = :postID and post.rel_date < UTC_TIMESTAMP()  LIMIT 1 ');
            
     
        $stmt->bindParam(':postID', $postID, \PDO::PARAM_INT);
        $stmt->execute();
        if(!$stmt->fetchColumn()){
            
            return false;
        }else{
            return true;
        }
    }


    

}
?>
