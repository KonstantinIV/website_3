<?php 
class postModel extends modelController{
    public $data;

    function __construct(){
       parent::__construct();
    }



    //index first 10 pages
    function getPopularPosts(){
        $stmt = $this->pdo->prepare('SELECT post.ID, post.title, user.username, post.text from post INNER JOIN user ON user.ID = post.USER_ID  limit 10');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

     //iNDEX next 10 pages
     function getPopularPostsSerial(){
        $stmt = $this->pdo->prepare('SELECT post.ID, post.title, user.username, post.text from post INNER JOIN user ON user.ID = post.USER_ID LIMIT :nextCount , 10');
        $stmt->bindParam(':nextCount', $this->data['nextCount'], PDO::PARAM_INT);
        $stmt->execute();
       
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    
     //Index page by category
     function getPopularPostsCategory(){
        $stmt = $this->pdo->prepare('select  post.ID, post.title, user.username, post.text from post inner join user on user.ID = post.USER_ID inner join category on category.ID = post.TOPIC_ID where category.category = ? limit 10');
        $stmt->execute([$this->data['categoryName']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

     //Index page by category next page
     function getPopularPostsCategoryNext(){
        $stmt = $this->pdo->prepare('select  post.ID, post.title, user.username, post.text from post inner join user on user.ID = post.USER_ID inner join category on category.ID = post.TOPIC_ID where category.category = :cat LIMIT :nextCount , 10');
        
        //print_r($this->data);
        $stmt->bindParam(':nextCount', $this->data['nextCount'], PDO::PARAM_INT);
        $stmt->bindParam(':cat', $this->data['categoryName'], PDO::PARAM_STR);
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }



    //Edit
    function getPost(){
        $stmt = $this->pdo->prepare("SELECT post.title, post.text, DATE_FORMAT(rel_date,'%d/%m/%Y') as releaseDate from post INNER JOIN user ON user.ID = post.USER_ID where username = ? AND post.ID = ?");
        $stmt->execute([$this->data['username'],$this->data['postID']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    function createPost(){
        $stmt = $this->pdo->prepare("UPDATE post SET title = :title, text = :text WHERE ID = :id");
        $stmt->bindParam(':title', $this->data['title'], PDO::PARAM_INT);
        $stmt->bindParam(':text', $this->data['text'], PDO::PARAM_INT);
        $stmt->bindParam(':id', $this->data['id'], PDO::PARAM_INT);
        $stmt->execute();
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    function editPost(){
        $stmt = $this->pdo->prepare("UPDATE post SET  text = :postText WHERE ID = :id");
        $stmt->bindParam(':postText', $this->data['text'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->data['id'], PDO::PARAM_INT);
        print_r($this->data);

        $stmt->execute();
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


    function splitDate($date){
        return explode("/" ,$date);

    }



    function likePost(){
        $stmt = $this->pdo->prepare("insert into likes    (POST_ID, USER_ID) VALUES (:id,(SELECT ID from user where username = :username)) ");
        $stmt->bindParam(':username', $this->data['username'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->data['id'], PDO::PARAM_INT);
        print_r($this->data);

        $stmt->execute();
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    function dislikePost(){
        $stmt = $this->pdo->prepare("insert into dislikes   (POST_ID, USER_ID) VALUES (:id,(SELECT ID from user where username = :username)) ");
        $stmt->bindParam(':username', $this->data['username'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->data['id'], PDO::PARAM_INT);
        print_r($this->data);

        $stmt->execute();
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    function deletePost(){
        $stmt = $this->pdo->prepare('UPDATE post inner join user on user.ID = post.USER_ID SET post.text = "REMOVED BY USER" WHERE post.ID = :id and user.username = :username ');
        $stmt->bindParam(':username', $this->data['username'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->data['id'], PDO::PARAM_INT);
        print_r($this->data);

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