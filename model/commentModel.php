<?php 
namespace src\model;
use \src\controller\core;
class commentModel extends core\modelController{

    
    public $inputData;

    function __construct(){
       parent::__construct();
    }

    
    function getSinglePost($postID){
        $stmt = $this->pdo->prepare('SELECT post.ID, post.title, user.username, post.text, count(distinct dislikes.USER_ID) as dislikes, count(distinct likes.USER_ID) as likes, DATE_FORMAT(creation_date,"%d/%m/%Y") as createdDate, DATE_FORMAT(rel_date,"%d/%m/%Y") as releaseDate   from post INNER JOIN user ON user.ID = post.USER_ID LEFT JOIN dislikes on post.ID = dislikes.POST_ID left JOIN likes on post.ID = likes.POST_ID  where post.ID = ? group by post.ID' );
        $stmt->execute([$postID]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

   
    function getComments($postID){
        $stmt = $this->pdo->prepare(' SELECT comment.ID, comment.parent_id, comment.text, user.username, count(distinct cdislikes.USER_ID) as dislikes, count(distinct clikes.USER_ID) as likes from comment INNER JOIN user on comment.USER_ID= user.ID  INNER JOIN post ON post.ID = comment.POST_ID 
        LEFT JOIN cdislikes on comment.ID = cdislikes.COMMENT_ID left JOIN clikes on comment.ID = clikes.COMMENT_ID  where post.ID = ?  group by comment.ID ');
        $stmt->execute([$postID]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC|\PDO::FETCH_UNIQUE);
    }

  
    function editComment($postID,$parentID,$username, $text){
      
        $stmt = $this->pdo->prepare("insert into comment    (USER_ID,POST_ID,parent_id,text ) VALUES ((SELECT ID from user where username = :username),:post_id, :parent_id, :text) ");
        $stmt->bindParam(':text', $text, \PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':post_id', $postID, \PDO::PARAM_INT);
        $stmt->bindParam(':parent_id', $parentID, \PDO::PARAM_INT);
        $stmt->execute();
    }






    

}
?>
