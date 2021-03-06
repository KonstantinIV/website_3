<?php 
namespace src\Model;
use \src\core;
class userModel extends core\Model{

    
   
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

  

   

  

    function replaceEmail($username,$email){
        $stmt = $this->pdo->prepare('UPDATE user SET  email = :email  WHERE username = :username ');
            
        $filename = $imageExtension;
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);


        if(!$stmt->execute()){
            return false;
        }else{
            return true;
        }
    }
    function replacePassword($username,$password){
        $stmt = $this->pdo->prepare('UPDATE user SET  password = :password  WHERE username = :username ');
            
        $filename = $imageExtension;
        $stmt->bindParam(':password', $password, \PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);


        if(!$stmt->execute()){
            return false;
        }else{
            return true;
        }
    }


 

    //Register
    function usernameValidation($username){
        
        if( strlen($username) > 24 || strlen($username) < 3 || !is_string($username))  {
            return false;
        }else if(!preg_match("/^[a-zA-Z0-9_-]{3,24}$/",$username)){

            return false;
        }

        return true;
    }

  
   
    function birthdayValidation($birthday){
        if(!is_numeric($birthday) || !(strlen((string)$birthday) == 8 ) )  {
            return false;
        }
        return true;
    }

    
    function usernameExists($username){
        $stmt = $this->pdo->prepare('select username from user WHERE username=? LIMIT 1');
        $stmt->execute([$username]);
        //Exists user
       
        if($stmt->fetchColumn()){

            return false;
        }else{

            return true;
        }

    }
    function emailExists($email){
        $stmt = $this->pdo->prepare('select email from user WHERE email=? LIMIT 1');
        $stmt->execute([$email]);
        //Exists user
       
        if($stmt->fetchColumn()){

            return false;
        }else{

            return true;
        }

    }


    function emailVerification($email){
         //Exists Email
         $stmt = $this->pdo->prepare('select email from user WHERE email=? LIMIT 1');
         $stmt->execute([$email]);
         if($stmt->fetchColumn()){
             return false;
         }else{
             return true;
         } 
       
         

    }
    


       

        function userCreate($username, $password, $email){
            $stmt = $this->pdo->prepare('insert into user (username, password,email,join_date,birthday) VALUES (?,?,?,now(),now())');
         if( !$stmt->execute([$username,$password,$email])){
            return false;
            }
            return true;
                
        }

        function encryptPass($password){
            return password_hash($password, PASSWORD_DEFAULT);
        }



    

}
?>
