<?php 
require_once 'database.php';
class score{
    private $total_posts;
    private $total_likes;
    private $total_comments;
    private $total_dislikes;

    private $user;
    private $join_date;
    private $pdo;

    function __construct($pdo){
        $this->pdo = $pdo;
    }

    function setScores($user){
        $this->user                = $user;
        $this->total_posts         = $this->get_total_posts();
        $this->total_likes         = $this->get_total_likes();
        $this->total_comments      = $this->get_total_comments();
        $this->total_dislikes      = $this->get_total_dislikes();
        $this->join_date           = $this->get_join_date();

    }

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

    function retTotalposts(){
        return $this->total_posts;

    }
    function retTotallikes(){
        return $this->total_likes;

    }
    function retTotalcomments(){
        return $this->total_comments;

    }
    function retTotaldislikes(){
        return $this->total_dislikes;

    }

    function retUsername(){
        return $this->user;
    }

    function retUserjoindate(){
        return $this->join_date;
    }

}


class us_posts{
    public $posts;
    private $user;
    private $pdo;


    function __construct($pdo){
        $this->pdo = $pdo;
    }

    function setPosts($user){
        $this->user     = $user;
        $this->posts    = $this->getPosts();
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


    //Single 
    function getTitle($id){
        $stmt = $this->pdo->prepare('');
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }
    function getText($id){
        $stmt = $this->pdo->prepare('');
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











}


?>