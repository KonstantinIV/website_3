<?php 
namespace src\model;
class commentModel extends modelController{

    
    public $inputData;

    function __construct(){
       parent::__construct();
    }

    //posts : username title text likes dislikes 
    function getSinglePost(){
        $stmt = $this->pdo->prepare('SELECT user.username, post.title, post.text, LIKETABLE.likes, DISLIKETABLE.dislikes from post INNER JOIN
        (select post.ID AS POSTID, count(likes.POST_ID) AS likes from post INNER JOIN user ON user.ID = post.USER_ID left JOIN likes ON
        post.ID =likes.POST_ID  group by post.ID) AS LIKETABLE ON post.id = LIKETABLE.POSTID
        INNER JOIN (select post.ID AS POSTID, count(dislikes.POST_ID) AS dislikes from post INNER JOIN user ON user.ID = post.USER_ID left JOIN dislikes ON
        post.ID =dislikes.POST_ID  group by post.ID) AS DISLIKETABLE ON post.id = DISLIKETABLE.POSTID 
        INNER JOIN user ON user.ID = post.USER_ID where post.ID = ?');
        $stmt->execute([$this->inputData['postID']]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }



    /**Comment section */
    function getCommentid(){
        $stmt = $this->pdo->prepare('SELECT comment.ID, comment.parent_id, comment.text from comment INNER JOIN post ON post.ID = comment.POST_ID where post.ID = ? ');
        $stmt->execute([$this->inputData['postID']]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC|\PDO::FETCH_UNIQUE);
    }

    
    function getCommenttext($id){
        $stmt = $this->pdo->prepare('SELECT comment.ID, comment.parent_id from comment INNER JOIN post ON post.ID = comment.POST_ID where post.ID = ? ');
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }
    function getCommenttitle($id){
        $stmt = $this->pdo->prepare('SELECT comment.ID, comment.parent_id from comment INNER JOIN post ON post.ID = comment.POST_ID where post.ID = ? ');
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }




    

}
?>
