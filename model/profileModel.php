<?php 
namespace src\model;
class profileModel extends modelController{

    
    public $inputData;

    function __construct(){
       parent::__construct();
    }

    //posts : title likes dislikes
    function getUserPosts(){
        $stmt = $this->pdo->prepare('SELECT post.ID as postID, post.title, LIKETABLE.likes, DISLIKETABLE.dislikes, COMMENTTABLE.comments from post INNER JOIN
        (select post.ID AS POSTID, count(likes.POST_ID) AS likes from post INNER JOIN user ON user.ID = post.USER_ID left JOIN likes ON
        post.ID =likes.POST_ID  group by post.ID) AS LIKETABLE ON post.id = LIKETABLE.POSTID
        INNER JOIN (select post.ID AS POSTID, count(dislikes.POST_ID) AS dislikes from post INNER JOIN user ON user.ID = post.USER_ID left JOIN dislikes ON
        post.ID =dislikes.POST_ID  group by post.ID) AS DISLIKETABLE ON post.id = DISLIKETABLE.POSTID 
        INNER JOIN (select post.ID AS POSTID, count(comment.POST_ID) AS comments from post INNER JOIN user ON user.ID = post.USER_ID left JOIN comment ON
        post.ID =comment.POST_ID  group by post.ID) AS COMMENTTABLE ON post.id = COMMENTTABLE.POSTID 
        left JOIN user ON user.ID = post.USER_ID where username = ?');
        $stmt->execute([$this->inputData['username']]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

    function postCount(){
        $stmt = $this->pdo->prepare('SELECT count(post.ID) from post INNER JOIN user ON user.ID = post.USER_ID where username = ?');
        $stmt->execute([$this->inputData['username']]);
        return $stmt->fetchColumn();
    }

    function likeCount(){
        $stmt = $this->pdo->prepare('SELECT count(likes.POST_ID) from likes INNER JOIN post on post.ID = likes.POST_ID INNER JOIN user ON user.ID = post.USER_ID where username= ?');
        $stmt->execute([$this->inputData['username']]);
        return $stmt->fetchColumn();
    }

    function commentCount(){
        $stmt = $this->pdo->prepare('SELECT count(comment.ID) from comment INNER JOIN post on post.ID = comment.POST_ID INNER JOIN user ON user.ID = post.USER_ID where username = ?');
        $stmt->execute([$this->inputData['username']]);
        return $stmt->fetchColumn();
    }

    function getUserJoinDate(){
        $stmt = $this->pdo->prepare('select join_date from user where username = ?');
        $stmt->execute([$this->inputData['username']]);
        return $stmt->fetchColumn();
    }



    

}
?>
