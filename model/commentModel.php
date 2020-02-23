<?php 
namespace src\model;
use \src\controller\core;
class commentModel extends core\modelController{

    
    public $inputData;

    function __construct(){
       parent::__construct();
    }

    
  

   
    function getComments($postID,$username){
        $stmt = $this->pdo->prepare(' SELECT 
        comment.ID,
        if((SELECT clikes.USER_ID from clikes inner join user on user.ID = clikes.USER_ID WHERE clikes.COMMENT_ID = comment.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS livoted,
        if((SELECT cdislikes.USER_ID from cdislikes inner join user on user.ID = cdislikes.USER_ID WHERE cdislikes.COMMENT_ID = comment.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS divoted,
        comment.parent_id,
        comment.text,
        user.username,
        count(distinct cdislikes.USER_ID) as dislikes,
        count(distinct clikes.USER_ID) as likes,
        DATE_FORMAT(DATE_ADD(comment.creation_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d %H:%i:%S") as createdDate
        from comment INNER JOIN user on
        comment.USER_ID= user.ID  INNER JOIN
        post ON post.ID = comment.POST_ID 
        LEFT JOIN cdislikes on comment.ID = cdislikes.COMMENT_ID
        left JOIN clikes on comment.ID = clikes.COMMENT_ID  
        where post.ID = :post_id  group by comment.ID ');

         $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
         $stmt->bindParam(':post_id', $postID, \PDO::PARAM_INT);

         $timezoneOffset = $_COOKIE['timezoneOffset'] + $_COOKIE['timezoneDst'];
        $stmt->bindParam(':timezoneOffset', $timezoneOffset, \PDO::PARAM_INT);


        $stmt->execute() ;//? print_r("true") : print_r($stmt->errorInfo());
        return $stmt->fetchAll(\PDO::FETCH_ASSOC|\PDO::FETCH_UNIQUE);
    }

  
    function editComment($postID,$parentID,$username, $text){
        
        $stmt = $this->pdo->prepare("insert into comment    
        (USER_ID,POST_ID,parent_id,text,creation_date ) 
        VALUES 
        ((SELECT ID from user where username = :username),
        :post_id, 
        :parent_id, 
        :text,
        now() );
        SELECT LAST_INSERT_ID(); ");
        $stmt->bindParam(':text', $text, \PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':post_id', $postID, \PDO::PARAM_INT);
        $stmt->bindParam(':parent_id', $parentID, \PDO::PARAM_INT);

        
        $stmt->execute();
        return  $this->pdo->lastInsertId();
    }






    

}
?>
