<?php 
namespace src\model;
use src\controller\core;
class postModel extends core\modelController{
    public $inputData;

    function __construct(){
       parent::__construct();
    }




     //iNDEX next 10 pages
     function getPopularPosts( $nextCount){
        $stmt = $this->pdo->prepare('SELECT post.ID, post.title, user.username, post.text, count(distinct dislikes.USER_ID) as dislikes, count(distinct likes.USER_ID) as likes, DATE_FORMAT(creation_date,"%d/%m/%Y") as createdDate, DATE_FORMAT(rel_date,"%d/%m/%Y") as releaseDate   from post INNER JOIN user ON user.ID = post.USER_ID LEFT JOIN dislikes on post.ID = dislikes.POST_ID left JOIN likes on post.ID = likes.POST_ID  group by post.ID limit :nextCount , 10');
        $stmt->bindParam(':nextCount', $nextCount, \PDO::PARAM_INT);
        $stmt->execute();
       
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }


     //Index page by category next page
     function getPopularPostsCategory($categoryName, $nextCount){
        $stmt = $this->pdo->prepare('SELECT post.ID, post.title, user.username, post.text, count(distinct dislikes.USER_ID) as dislikes, count(distinct likes.USER_ID) as likes, DATE_FORMAT(creation_date,"%d/%m/%Y") as createdDate, DATE_FORMAT(rel_date,"%d/%m/%Y") as releaseDate from post inner join user on user.ID = post.USER_ID inner join category on category.ID = post.TOPIC_ID  LEFT JOIN dislikes on post.ID = dislikes.POST_ID left JOIN likes on post.ID = likes.POST_ID   where category.category = :cat group by post.ID limit :nextCount , 10');
        
        //print_r($this->data);
        $stmt->bindParam(':cat', $categoryName, \PDO::PARAM_STR);
        $stmt->bindParam(':nextCount', $nextCount, \PDO::PARAM_INT);
        
        
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }



    //Edit
    function getPost($username,$postID){
        echo"asdasd";
        $stmt = $this->pdo->prepare("SELECT post.title, post.text, DATE_FORMAT(rel_date,'%d/%m/%Y') as releaseDate from post INNER JOIN user ON user.ID = post.USER_ID where username = ? AND post.ID = ?");
        $stmt->execute([$username,$postID]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

    function createPost(){
        $stmt = $this->pdo->prepare("UPDATE post SET title = :title, text = :text WHERE ID = :id");
        $stmt->bindParam(':title', $this->data['title'], PDO::PARAM_INT);
        $stmt->bindParam(':text', $this->data['text'], PDO::PARAM_INT);
        $stmt->bindParam(':id', $this->data['id'], PDO::PARAM_INT);
        $stmt->execute();
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    function editPost($title, $text, $postID){
        $stmt = $this->pdo->prepare("UPDATE post SET  text = :postText , title = :title WHERE ID = :id");
        $stmt->bindParam(':postText', $text, \PDO::PARAM_STR);
        $stmt->bindParam(':title', $title, \PDO::PARAM_STR);
        $stmt->bindParam(':id', $postID, \PDO::PARAM_INT);
        $stmt->execute();
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


    function splitDate($date){
        return explode("/" ,$date);

    }



    function likePost($postID,$username){
        $stmt = $this->pdo->prepare("insert into likes    (POST_ID, USER_ID) VALUES (:id,(SELECT ID from user where username = :username)) ");
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':id', $postID, \PDO::PARAM_INT);
 //       print_r($this->data);

        $stmt->execute();
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);

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


    function voteExistsPost($username,$postID,$action){
        switch($action){
            case "dislikes":
                $stmt = $this->pdo->prepare('select POST_ID from dislikes WHERE username= :username and POST_ID =:postID LIMIT 1');
                break;
            case"likes":
                $stmt = $this->pdo->prepare('select POST_ID from likes WHERE username= :username and POST_ID = :postID LIMIT 1');
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

    function voteExistsComment($username,$postID,$action){
        switch($action){
            case "dislikes":
                $stmt = $this->pdo->prepare('select POST_ID from cdislikes WHERE username= :username and COMMENT_ID = :postID LIMIT 1');
                break;
            case"likes":
                $stmt = $this->pdo->prepare('select POST_ID from clikes WHERE username= :username and COMMENT_ID = :postID LIMIT 1');
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




    function likeExists($username,$postID){
        $stmt = $this->pdo->prepare('select POST_ID from like WHERE username= :username and :postID LIMIT 1');
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':postID', $postID, \PDO::PARAM_INT);
        $stmt->execute();
        
        if(!$stmt->fetchColumn()){
            
            return false;
        }else{
            return true;
        }
    }

    function dislikeExists($username,$postID){
        $stmt = $this->pdo->prepare('select POST_ID from like WHERE username= :username and :postID LIMIT 1');
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':postID', $postID, \PDO::PARAM_INT);
        $stmt->execute();


        if(!$stmt->fetchColumn()){
            
            return false;
        }else{
            return true;
        }
    }












    function dislikePost($postID,$username){
        $stmt = $this->pdo->prepare("insert into dislikes   (POST_ID, USER_ID) VALUES (:id,(SELECT ID from user where username = :username)) ");
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':id', $postID, \PDO::PARAM_INT);
//        print_r($this->data);

        $stmt->execute();
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    function deletePost($postID,$username){
        $stmt = $this->pdo->prepare('UPDATE post inner join user on user.ID = post.USER_ID SET post.text = "REMOVED BY USER" WHERE post.ID = :id and user.username = :username ');
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':id', $postID, \PDO::PARAM_INT);
        //print_r($this->data);

        $stmt->execute();
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }













    function getPosts(){
        $stmt = $this->pdo->prepare('SELECT post.ID from post INNER JOIN user ON user.ID = post.USER_ID where username = ? ');
        $stmt->execute([$this->user]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    }
    function getTitles($id){
        $stmt = $this->pdo->prepare('select title from post where ID = ?');
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }

    function getLikes($id){
        $stmt = $this->pdo->prepare('select likes.POST_ID from likes  INNER JOIN post ON post.ID = likes.POST_ID INNER JOIN user ON user.ID = post.USER_ID where post.ID =?');
        $stmt->execute([$id]);
        $likes = $stmt->fetchColumn();
        if (!$likes){
            return 0;
        }
        return $likes;
    }

    function getDislikes($id){
        $stmt = $this->pdo->prepare('select  dislikes.POST_ID from dislikes  INNER JOIN post ON post.ID = dislikes.POST_ID INNER JOIN user ON user.ID = post.USER_ID where post.ID = ?');
        $stmt->execute([$id]);
        $dislikes = $stmt->fetchColumn();
        if (!$dislikes){
            return 0;
        }
        return $dislikes;
    
    }

    function getComments($id){
        $stmt = $this->pdo->prepare('select  count(comment.POST_ID) from comment  INNER JOIN post ON post.ID = comment.POST_ID INNER JOIN user ON user.ID = comment.USER_ID where post.ID =?');
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }


    //Single post data
    function getTitle($id){
        $stmt = $this->pdo->prepare('SELECT title from post where ID = ?');
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }
    function getText($id){
        $stmt = $this->pdo->prepare('SELECT text from post where ID = ?');
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }
    function getResdate($id){
        $stmt = $this->pdo->prepare('');
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }
    function getCreationdate($id){
        $stmt = $this->pdo->prepare('');
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }

    /**Comment section */
    function getCommentid($id){
        $stmt = $this->pdo->prepare('SELECT comment.ID, comment.parent_id from comment INNER JOIN post ON post.ID = comment.POST_ID where post.ID = ? ');
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }
    function getCommenttext($id){
        $stmt = $this->pdo->prepare('');
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }
    function getCommenttitle($id){
        $stmt = $this->pdo->prepare('');
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }
    //Score
    function get_total_posts(){
        $stmt = $this->pdo->prepare('SELECT count(post.ID) from post INNER JOIN user ON user.ID = post.USER_ID where username = ?');
        $stmt->execute([$this->user]);
        return $stmt->fetchColumn();
    }

    function get_total_likes(){
        $stmt = $this->pdo->prepare('SELECT count(likes.POST_ID) from likes INNER JOIN post on post.ID = likes.POST_ID INNER JOIN user ON user.ID = post.USER_ID where username= ?');
        $stmt->execute([$this->user]);
        return $stmt->fetchColumn();
    }

    function get_total_comments(){
        $stmt = $this->pdo->prepare('SELECT count(comment.ID) from comment INNER JOIN post on post.ID = comment.POST_ID INNER JOIN user ON user.ID = post.USER_ID where username = ?');
        $stmt->execute([$this->user]);
        return $stmt->fetchColumn();
    }

    function get_total_dislikes(){
        $stmt = $this->pdo->prepare('SELECT count(dislikes.POST_ID) from dislikes INNER JOIN post on post.ID = dislikes.POST_ID INNER JOIN user ON user.ID = post.USER_ID where username = ?');
        $stmt->execute([$this->user]);
        return $stmt->fetchColumn();
    }

    function get_join_date(){
        $stmt = $this->pdo->prepare('select join_date from user where username = ?');
        $stmt->execute([$this->user]);
        return $stmt->fetchColumn();
    }
    //Delete
    function delPost($id){
        $stmt = $this->pdo->prepare('UPDATE post SET text = "remove" WHERE ID = ?');
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }

    function getPopularPostss(){
        $stmt = $this->pdo->prepare('SELECT post.ID from post INNER JOIN user ON user.ID = post.USER_ID where username = ? ');
        $stmt->execute([$this->user]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

    }

   

    


}




?>