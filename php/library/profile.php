<?php 
class score{
    private total_posts;
    private total_likes;
    private total_comments;
    private total_comment_likes;

    function setScores(){
        $this->total_posts         = get_total_posts();
        $this->total_likes         = get_total_likes();
        $this->total_comments      = get_total_comments();
        $this->total_comment_likes = get_total_comment_likes();

    }

    function get_total_posts(){
        $stmt = $pdo->prepare('SELECT total_posts  from user WHERE username=? LIMIT 1');
        $stmt->execute(/*   *************** */);
        return $stmt->fetchColumn();
    }

    function get_total_likes(){
        $stmt = $pdo->prepare('SELECT total_posts  from user WHERE username=? LIMIT 1');
        $stmt->execute(/*   *************** */);
        return $stmt->fetchColumn();
    }

    function get_total_comments(){
        $stmt = $pdo->prepare('SELECT total_posts  from user WHERE username=? LIMIT 1');
        $stmt->execute(/*   *************** */);
        return $stmt->fetchColumn();
    }

    function get_total_comment_likes(){
        $stmt = $pdo->prepare('SELECT total_posts  from user WHERE username=? LIMIT 1');
        $stmt->execute(/*   *************** */);
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
    function retTotalcommentlikes(){
        return $this->total_comment_likes;

    }

}


class us_posts{
    private $data;

    private $title;
    private $likes;
    private $dislikes;
    private $comments;


    function __construct(){
        //pdo
        

    }

    function setPosts(){
        $this->title    = getTitle();
        $this->likes    = getLikes();
        $this->dislikes = getDislikes();
        $this->comments = getComments();
    }

    function getTitle(){

    }

    function getLikes(){

    }

    function getDislikes(){

    
    }

    function getComments(){

    }





}


?>