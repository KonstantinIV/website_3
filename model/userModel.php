<?php 
namespace src\model;
use \src\controller\core;
class userModel extends core\modelController{

    
   
    function __construct(){
       parent::__construct();
    }

    //posts : title likes dislikes
    function getUserPosts($username){
        
        $stmt = $this->pdo->prepare('SELECT 
        post.ID as postID, 
        post.title, 
        LIKETABLE.likes, 
        DISLIKETABLE.dislikes, 
        COMMENTTABLE.comments 
        
        from post 
        INNER JOIN 
            (select 
            post.ID AS POSTID, 
            count(likes.POST_ID) AS likes 
            from post 
            INNER JOIN user ON user.ID = post.USER_ID 
            left JOIN likes ON post.ID =likes.POST_ID  
            group by post.ID) AS LIKETABLE 
        ON post.id = LIKETABLE.POSTID

        INNER JOIN 
            (select 
            post.ID AS POSTID, 
            count(dislikes.POST_ID) AS dislikes 
            from post 
            INNER JOIN user ON user.ID = post.USER_ID 
            left JOIN dislikes ON post.ID =dislikes.POST_ID  
            group by post.ID) AS DISLIKETABLE 
        ON post.id = DISLIKETABLE.POSTID

        INNER JOIN 
            (select 
            post.ID AS POSTID, 
            count(comment.POST_ID) AS comments 
            from post 
            INNER JOIN user ON user.ID = post.USER_ID 
            left JOIN comment ON post.ID =comment.POST_ID  
            group by post.ID) AS COMMENTTABLE 
        ON post.id = COMMENTTABLE.POSTID 
        
        left JOIN user ON user.ID = post.USER_ID 
        
        where username = ? ORDER BY post.ID DESC');
        $stmt->execute([$username]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

   
    function userExists($username){
        $stmt = $this->pdo->prepare('select username from user WHERE username=? LIMIT 1');
        $stmt->execute([$username]);
        //Exists user
        if(!$stmt->fetchColumn()){
            
            return false;
        }
        return true;
    }

    function userTotalPosts($username){
        $stmt = $this->pdo->prepare('SELECT count(post.ID) from post INNER JOIN user ON user.ID = post.USER_ID where username = ?');
        $stmt->execute([$username]);
        return $stmt->fetchColumn();
    }

    function userTotalLikesReceived($username){
        $stmt = $this->pdo->prepare('SELECT count(likes.POST_ID) from likes INNER JOIN post on post.ID = likes.POST_ID INNER JOIN user ON user.ID = post.USER_ID where username= ?');
        $stmt->execute([$username]);
        return $stmt->fetchColumn();
    }
//SELECT post.ID from post inner join likes on likes.POST_ID = post.ID inner join user on user.ID = likes.USER_ID where username="sfdds";
    function userTotalComments($username){
        $stmt = $this->pdo->prepare('SELECT count(comment.ID) from comment INNER JOIN post on post.ID = comment.POST_ID INNER JOIN user ON user.ID = post.USER_ID where username = ?');
        $stmt->execute([$username]);
        return $stmt->fetchColumn();
    }

    function userJoinDate($username){
        $stmt = $this->pdo->prepare('select DATE_FORMAT(join_date, "%d %M %Y") from user where username = ?');
        $stmt->execute([$username]);
        return $stmt->fetchColumn();
    }

    function saveAvatar($image,$username,$imageExtension){
        
        
        //$image=file_get_contents($link);

        move_uploaded_file($_FILES["image"]["tmp_name"],"/var/www/html/i/".$username.".".$imageExtension);
        //file_put_contents("/var/www/html/i/".$username.".".$imageExtension, $image);  basename($_FILES['image']['name'])
    }



    

}
?>
