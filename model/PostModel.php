<?php 
namespace src\Model;
use src\core;
class PostModel extends core\Model{
    public $inputData;
    const INTERVAL = 3000 ; 
    private $baseQueryVariables = 'SELECT 
    post.ID, 
    if((
        SELECT likes.USER_ID from likes inner join user on user.ID = likes.USER_ID 
        WHERE likes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS livoted, 
    if((
        SELECT dislikes.USER_ID from dislikes inner join user on user.ID = dislikes.USER_ID 
        WHERE dislikes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS divoted , 
    
    post.title, 
    user.username, 
    post.text, 
    count(distinct dislikes.USER_ID) as dislikes, 
    count(distinct likes.USER_ID) as likes, 

    ROUND(avg(starVote.points),2) as points ,
    count(distinct starVote.USER_ID) as starVotes,

    (SELECT starVote.points from starVote 
    inner join user on user.ID = starVote.USER_ID 
    WHERE starVote.POST_ID = post.ID and user.username = :username limit 1 )  AS starVoted,

    DATE_FORMAT(DATE_ADD(creation_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d %H:%i:%S") as createdDate, 
    DATE_FORMAT(DATE_ADD(rel_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d") as releaseDate ';

    private $baseQueryTables =  '
    from post inner join user on user.ID = post.USER_ID 
    inner join threads on threads.ID = post.THREAD_ID  
    LEFT JOIN starVote ON post.ID = starVote.POST_ID
    LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
    left JOIN likes on post.ID = likes.POST_ID  

    where threads.title = if("" = :thread,threads.title, :thread) 
    AND   post.rel_date <= if("false" = :voteType ,post.rel_date, NOW()) 
    AND   post.creation_date >= if( "" = :topType ,post.creation_date ,DATE_SUB( NOW(), INTERVAL :interval HOUR) )
    AND   post.title like IF("" = :search , "%" ,:search ) group by post.ID ';

// 1 cate, 2 vote type, top, search
    private $baseQueryAnonVariables = 'SELECT 
    post.ID, 
    post.title, 
    user.username, 
    post.text, 
    count(distinct dislikes.USER_ID) as dislikes, 
    count(distinct likes.USER_ID) as likes, 

    ROUND(avg(starVote.points),2) as points ,
    count(distinct starVote.USER_ID) as starVotes,

    DATE_FORMAT(DATE_ADD(creation_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d %H:%i:%S") as createdDate, 
    DATE_FORMAT(DATE_ADD(rel_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d") as releaseDate ';

    
    private $baseQueryAnonTables = '
    from post INNER JOIN user ON user.ID = post.USER_ID 
    inner join threads on threads.ID = post.THREAD_ID  
    LEFT JOIN starVote ON post.ID = starVote.POST_ID
    LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
    left JOIN likes on post.ID = likes.POST_ID  
    
    where threads.title = if("" = :thread ,threads.title, :thread) 
    AND   post.rel_date <= if("false" = :voteType ,post.rel_date, NOW()) 
    AND   post.creation_date >= if( "" = :topType ,post.creation_date ,DATE_SUB( NOW(), INTERVAL :interval HOUR) )
    AND   post.title like IF("" = :search , "%" ,:search ) group by post.ID ';

    function __construct(){
       parent::__construct();
       
    }


    function hotPosts($nextCount, $username,$search,$threadTitle,$voteType,$topType){
        $selectVariables = ",(( count(distinct dislikes.USER_ID) -  count(distinct likes.USER_ID)) /  TIMESTAMPDIFF(MINUTE, post.creation_date, now()) ) as hotPoints";
        $order =  " order by hotPoints limit :nextCount , 10";
        //echo $this->baseQueryAnon.$order;
        if($username){
            $stmt = $this->pdo->prepare($this->baseQueryVariables.$selectVariables.$this->baseQueryTables.$order);
            $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        }else{
            $stmt = $this->pdo->prepare($this->baseQueryAnonVariables.$selectVariables.$this->baseQueryAnonTables.$order);

        }
        $searchstr = "%".$search."%";
        $stmt->bindParam(':search', $searchstr, \PDO::PARAM_STR);

        $timezoneOffset = 2;
        $stmt->bindParam(':timezoneOffset', $timezoneOffset, \PDO::PARAM_INT);

        $stmt->bindParam(':nextCount', $nextCount, \PDO::PARAM_INT);

        $interval = 0;
        $stmt->bindParam(':interval', $interval, \PDO::PARAM_INT);


                $stmt->bindParam(':thread', $threadTitle, \PDO::PARAM_STR);
                $stmt->bindParam(':voteType', $voteType, \PDO::PARAM_STR);
                $stmt->bindParam(':topType', $topType, \PDO::PARAM_STR);
                if($stmt->execute()){
                    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
                }else{
                    return $stmt->errorInfo();
                }
               

        //$points   =  ", ((likes-dislikes) /  TIMESTAMPDIFF(MINUTE, creation_date, now()) ) as points ";




    }
    function topPosts($nextCount,$username,$search,$threadTitle,$voteType,$topType,$interval){
       // $points   =  ", (likes - dislikes ) as points ";
       $selectVariables = ", ( count(distinct dislikes.USER_ID) -  count(distinct likes.USER_ID)) as topPoints ";
        $order =  " order by topPoints limit :nextCount , 10 ";
        if($username){
            $stmt = $this->pdo->prepare($this->baseQueryVariables.$selectVariables.$this->baseQueryTables.$order);
            $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        }else{
            $stmt = $this->pdo->prepare($this->baseQueryAnonVariables.$selectVariables.$this->baseQueryAnonTables.$order);

        }
        
        $searchstr = "%".$search."%";
        $stmt->bindParam(':search', $searchstr, \PDO::PARAM_STR);


        $timezoneOffset = 2;
        $stmt->bindParam(':timezoneOffset', $timezoneOffset, \PDO::PARAM_INT);


                $stmt->bindParam(':nextCount', $nextCount, \PDO::PARAM_INT);

                
                $stmt->bindParam(':interval', $interval, \PDO::PARAM_INT);


                $stmt->bindParam(':thread', $threadTitle, \PDO::PARAM_STR);
                $stmt->bindParam(':voteType', $voteType, \PDO::PARAM_STR);
                $stmt->bindParam(':topType', $topType, \PDO::PARAM_STR);
                
                if($stmt->execute()){
                    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
                }else{
                    return $stmt->errorInfo();
                }

    }


     function newPosts($nextCount,$username,$search,$threadTitle,$voteType,$topType){
        $order =  " order by creation_date desc limit :nextCount , 10";

        if($username){
            $stmt = $this->pdo->prepare($this->baseQueryVariables.$selectVariables.$this->baseQueryTables.$order);
            $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        }else{
            $stmt = $this->pdo->prepare($this->baseQueryAnonVariables.$selectVariables.$this->baseQueryAnonTables.$order);

        }
        $interval = self::INTERVAL;
        $searchstr = "%".$search."%";
        $stmt->bindParam(':search', $searchstr, \PDO::PARAM_STR);


        $timezoneOffset = 2;
        $stmt->bindParam(':timezoneOffset', $timezoneOffset, \PDO::PARAM_INT);


                $stmt->bindParam(':nextCount', $nextCount, \PDO::PARAM_INT);

                $interval = 0;
                $stmt->bindParam(':interval', $interval, \PDO::PARAM_INT);


                $stmt->bindParam(':thread', $threadTitle, \PDO::PARAM_STR);
                $stmt->bindParam(':voteType', $voteType, \PDO::PARAM_STR);
                $stmt->bindParam(':topType', $topType, \PDO::PARAM_STR);
                if($stmt->execute()){
                    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
                }else{
                    return $stmt->errorInfo();
                }
    }




    //Edit
    function getPost($username,$postID){
        if($username){
            $stmt = $this->pdo->prepare("SELECT 
            post.ID, 
            if((
                SELECT likes.USER_ID from likes inner join user on user.ID = likes.USER_ID 
                WHERE likes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS livoted, 
            if((
                SELECT dislikes.USER_ID from dislikes inner join user on user.ID = dislikes.USER_ID 
                WHERE dislikes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS divoted , 
            
            post.title, 
            user.username, 
            post.text, 
            count(distinct dislikes.USER_ID) as dislikes, 
            count(distinct likes.USER_ID) as likes, 
        
            ROUND(avg(starVote.points),2) as points ,
            count(distinct starVote.USER_ID) as starVotes,
        
            (SELECT starVote.points from starVote 
            inner join user on user.ID = starVote.USER_ID 
            WHERE starVote.POST_ID = post.ID and user.username = :username limit 1 )  AS starVoted,
        
            DATE_FORMAT(DATE_ADD(creation_date,INTERVAL :timezoneOffset HOUR),'%Y-%m-%d %H:%i:%S') as createdDate, 
            DATE_FORMAT(DATE_ADD(rel_date,INTERVAL :timezoneOffset HOUR),'%Y-%m-%d') as releaseDate 
            
            
            from post inner join user on user.ID = post.USER_ID 
            inner join threads on threads.ID = post.THREAD_ID  
            LEFT JOIN starVote ON post.ID = starVote.POST_ID
            LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
            left JOIN likes on post.ID = likes.POST_ID 
            
            where username = :username AND post.ID = :postID");
            
            $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        }else{
            $stmt = $this->pdo->prepare('SELECT 
    post.ID, 
    post.title, 
    user.username, 
    post.text, 
    count(distinct dislikes.USER_ID) as dislikes, 
    count(distinct likes.USER_ID) as likes, 

    ROUND(avg(starVote.points),2) as points ,
    count(distinct starVote.USER_ID) as starVotes,

    DATE_FORMAT(DATE_ADD(creation_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d %H:%i:%S") as createdDate, 
    DATE_FORMAT(DATE_ADD(rel_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d") as releaseDate
    
    from post inner join user on user.ID = post.USER_ID 
            inner join threads on threads.ID = post.THREAD_ID  
            LEFT JOIN starVote ON post.ID = starVote.POST_ID
            LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
            left JOIN likes on post.ID = likes.POST_ID 
            
            where  post.ID = :postID
    ');
        }
        //echo"asdasd";
        $timezoneOffset = 2;
        $stmt->bindParam(':timezoneOffset', $timezoneOffset, \PDO::PARAM_INT);
        $stmt->bindParam(':postID', $postID, \PDO::PARAM_INT);
        
        if($stmt->execute()){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }else{
            return $stmt->errorInfo();
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }
/*
    function createPost(){
        $stmt = $this->pdo->prepare("UPDATE post SET title = :title, text = :text WHERE ID = :id");
        $stmt->bindParam(':title', $this->data['title'], PDO::PARAM_INT);
        $stmt->bindParam(':text', $this->data['text'], PDO::PARAM_INT);
        $stmt->bindParam(':id', $this->data['id'], PDO::PARAM_INT);
        $stmt->execute();
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }*/

    function editPost($title, $text, $postID,$threads){
        $stmt = $this->pdo->prepare("UPDATE post SET  text = :postText , title = :title, TOPIC_ID = :threads WHERE ID = :id");
        $stmt->bindParam(':postText', $text, \PDO::PARAM_STR);
        $stmt->bindParam(':title', $title, \PDO::PARAM_STR);
        $stmt->bindParam(':id', $postID, \PDO::PARAM_INT);
        $stmt->bindParam(':threads', $threads, \PDO::PARAM_INT);
        $stmt->execute();
        
        if($stmt->execute()){
            return true;
        }else{
           return false;
            //return $stmt->errorInfo();
        }
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    function createPost($title, $text,$user,$date,$thread){
        $stmt = $this->pdo->prepare("INSERT INTO post (USER_ID,title,text,rel_date,creation_date,THREAD_ID) VALUES ((select ID from user where username = :user),:title,:postText,:date , now(),(select ID from threads where title = :thread))");
        $stmt->bindParam(':postText', $text, \PDO::PARAM_STR);
        $stmt->bindParam(':user', $user, \PDO::PARAM_STR);

        $stmt->bindParam(':title', $title, \PDO::PARAM_STR);
        $stmt->bindParam(':thread', $thread, \PDO::PARAM_INT);

        //$timezoneOffset = $_COOKIE['timezoneOffset'] ;
       // $stmt->bindParam(':timezoneOffset', $timezoneOffset, \PDO::PARAM_INT);
        $stmt->bindParam(':date', $date, \PDO::PARAM_STR);


        if($stmt->execute()){
            return  $this->pdo->lastInsertId();
        }else{
            return $stmt->errorInfo();
            //return $stmt->errorInfo();
        }
        
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

 
   

   


 
    

    

    function deletePost($postID, $username){
        //$stmt = $this->pdo->prepare('DELETE post.* FROM post inner join user on user.ID = post.USER_ID where post.ID = :postID AND user.username = :username ');
    
        $stmt = $this->pdo->prepare('UPDATE post SET  isDeleted = 1   WHERE ID = :postID AND USER_ID = (SELECT ID from user where username = :username) ');
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':postID', $postID, \PDO::PARAM_INT);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return true;
         } else {
            return false;
         }
    }

    function userPosts($username,$nextCount){
        
        $stmt = $this->pdo->prepare('SELECT 
        post.ID as ID, 
        post.title, 
        LIKETABLE.likes as upvotes, 
        DISLIKETABLE.dislikes as downvotes, 
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
        
        where username = :username and isDeleted = 0 ORDER BY post.ID DESC limit :nextCount , 5');
        $stmt->bindParam(':nextCount', $nextCount, \PDO::PARAM_INT);
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }























    


}




?>