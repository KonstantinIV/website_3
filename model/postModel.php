<?php 
namespace src\model;
use src\controller\core;
class postModel extends core\modelController{
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
    inner join category on category.ID = post.TOPIC_ID  
    LEFT JOIN starVote ON post.ID = starVote.POST_ID
    LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
    left JOIN likes on post.ID = likes.POST_ID  

    where category.category = if("" = :cat,category.category, :cat) 
    AND   post.rel_date <= if("false" = :voteType ,post.rel_date, NOW()) 
    AND   post.creation_date >= if( "" = :topType ,post.creation_date ,DATE_SUB( NOW(), INTERVAL :interval DAY) )
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
    inner join category on category.ID = post.TOPIC_ID  
    LEFT JOIN starVote ON post.ID = starVote.POST_ID
    LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
    left JOIN likes on post.ID = likes.POST_ID  
    
    where category.category = if("" = :cat ,category.category, :cat) 
    AND   post.rel_date <= if("" = :voteType ,post.rel_date, NOW()) 
    AND   post.creation_date >= if( "" = :topType ,post.creation_date ,DATE_SUB( NOW(), INTERVAL :interval DAY) )
    AND   post.title like IF("%%" = :search , "%" ,:search ) group by post.ID ';

    function __construct(){
       parent::__construct();
       
    }


    function hotPosts($nextCount,$loggedIn, $username,$search,$categoryName,$voteType,$topType){

        $selectVariables = ",(( count(distinct dislikes.USER_ID) -  count(distinct likes.USER_ID)) /  TIMESTAMPDIFF(MINUTE, post.creation_date, now()) ) as hotPoints";
        $order =  " order by hotPoints limit :nextCount , 10";
        //echo $this->baseQueryAnon.$order;

        if($loggedIn){
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

                $interval = self::INTERVAL;
                $stmt->bindParam(':interval', $interval, \PDO::PARAM_INT);


                $stmt->bindParam(':cat', $categoryName, \PDO::PARAM_STR);
                $stmt->bindParam(':voteType', $voteType, \PDO::PARAM_STR);
                $stmt->bindParam(':topType', $topType, \PDO::PARAM_STR);
                if($stmt->execute()){
                    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
                }else{
                    return $stmt->errorInfo();
                }
               

        //$points   =  ", ((likes-dislikes) /  TIMESTAMPDIFF(MINUTE, creation_date, now()) ) as points ";




    }
    function getTopPosts($nextCount,$loggedIn, $username,$search,$voteType,$topType){
       // $points   =  ", (likes - dislikes ) as points ";
       $selectVariables = ", 
       (likes - dislikes ) as topPoints";
        $order =  "order by topPoints limit :nextCount , 10'";
        if($loggedIn){
            $stmt = $this->pdo->prepare($this->baseQueryUser.$order);
            $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        }else{
            $stmt = $this->pdo->prepare($this->baseQueryAnon.$order);

        }
        $interval = self::INTERVAL;
        $searchstr = "%".$search."%";
        $stmt->bindParam(':search', $searchstr, \PDO::PARAM_STR);


        $timezoneOffset = $_COOKIE['timezoneOffset'];
        $stmt->bindParam(':timezoneOffset', $timezoneOffset, \PDO::PARAM_INT);


                $stmt->bindParam(':nextCount', $nextCount, \PDO::PARAM_INT);

                $interval = self::INTERVAL;
                $stmt->bindParam(':interval', $interval, \PDO::PARAM_INT);


                $stmt->bindParam(':cat', $categoryName, \PDO::PARAM_STR);
                $stmt->bindParam(':voteType', $voteType, \PDO::PARAM_STR);
                $stmt->bindParam(':topType', $topType, \PDO::PARAM_STR);
       

    }


     function getNewPoststest($nextCount,$loggedIn, $username,$search,$voteType,$topType){
        $order =  " order by creation_date desc limit :nextCount , 10'";

        if($loggedIn){
            $stmt = $this->pdo->prepare($this->baseQueryUser.$order);
            $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        }else{
            $stmt = $this->pdo->prepare($this->baseQueryAnon.$order);

        }
        $interval = self::INTERVAL;
        $searchstr = "%".$search."%";
        $stmt->bindParam(':search', $searchstr, \PDO::PARAM_STR);


        $timezoneOffset = $_COOKIE['timezoneOffset'];
        $stmt->bindParam(':timezoneOffset', $timezoneOffset, \PDO::PARAM_INT);


                $stmt->bindParam(':nextCount', $nextCount, \PDO::PARAM_INT);

                $interval = self::INTERVAL;
                $stmt->bindParam(':interval', $interval, \PDO::PARAM_INT);


                $stmt->bindParam(':cat', $categoryName, \PDO::PARAM_STR);
                $stmt->bindParam(':voteType', $voteType, \PDO::PARAM_STR);
                $stmt->bindParam(':topType', $topType, \PDO::PARAM_STR);

    }





    function getSinglePost($postID,$username){
       
        if($username){
            $stmt = $this->pdo->prepare('SELECT post.ID,
                if((SELECT likes.USER_ID from likes 
                inner join user on user.ID = likes.USER_ID 
                WHERE likes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS livoted,
                 if((SELECT dislikes.USER_ID from dislikes 
                 inner join user on user.ID = dislikes.USER_ID 
                 WHERE dislikes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS divoted,
                post.title, 
                user.username, 
                post.text, 

                count(distinct dislikes.USER_ID) as dislikes, 
                count(distinct likes.USER_ID) as likes, 

                ROUND(avg(starVote.points),2) as points ,
                count(distinct starVote.USER_ID) as starVotes,

                if((SELECT starVote.USER_ID from starVote 
                inner join user on user.ID = starVote.USER_ID 
                WHERE starVote.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS starVoted,

                DATE_FORMAT(DATE_ADD(creation_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d %H:%i:%S") as createdDate, 
                DATE_FORMAT(DATE_ADD(rel_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d") as releaseDate     
                from post 
                INNER JOIN user ON user.ID = post.USER_ID 
                LEFT JOIN starVote ON post.ID = starVote.POST_ID
                LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
                left JOIN likes on post.ID = likes.POST_ID 
                where post.ID = :postID group by post.ID ');

            $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        }else{
           // print_r($postID);
            $stmt = $this->pdo->prepare('SELECT 
            post.ID, 
            0 as livoted,
            0 as divoted, 
            post.title, 
            user.username, 
            post.text, 
            count(distinct dislikes.USER_ID) as dislikes, 
            count(distinct likes.USER_ID) as likes, 

            ROUND(avg(starVote.points),2) as points ,
                count(distinct starVote.USER_ID) as starVotes,
            
            DATE_FORMAT(DATE_ADD(creation_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d %H:%i:%S") as createdDate, 
            DATE_FORMAT(DATE_ADD(rel_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d") as releaseDate      
            from post 
            INNER JOIN user ON user.ID = post.USER_ID 
            LEFT JOIN starVote ON post.ID = starVote.POST_ID
            LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
            left JOIN likes on post.ID = likes.POST_ID  
            where post.ID = :postID group by post.ID ');
        
        }

        $timezoneOffset = $_COOKIE['timezoneOffset'];
        $stmt->bindParam(':timezoneOffset', $timezoneOffset, \PDO::PARAM_INT);
     


        
        $stmt->bindParam(':postID', $postID, \PDO::PARAM_INT);
        
       if($stmt->execute()){
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }else{
            return $stmt->errorInfo();
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);





/*
        $stmt = $this->pdo->prepare('SELECT post.ID,if((SELECT likes.USER_ID from likes inner join user on user.ID = likes.USER_ID WHERE likes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS livoted, if((SELECT dislikes.USER_ID from dislikes inner join user on user.ID = dislikes.USER_ID WHERE dislikes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS divoted, post.title, user.username, post.text, count(distinct dislikes.USER_ID) as dislikes, count(distinct likes.USER_ID) as likes, DATE_FORMAT(creation_date,"%Y-%m-%d %H:%i:%S") as createdDate, DATE_FORMAT(rel_date,"%Y-%m-%d") as releaseDate   from post INNER JOIN user ON user.ID = post.USER_ID LEFT JOIN dislikes on post.ID = dislikes.POST_ID left JOIN likes on post.ID = likes.POST_ID  where post.ID = :post_id group by post.ID' );
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':post_id', $postID, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);*/

    }

     //iNDEX next 10 pages DATE_FORMAT(DATE_ADD(rel_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d") as releaseDate 
     //DATE_FORMAT(DATE_ADD(creation_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d %H:%i:%S") as createdDate
     //DATE_FORMAT(DATE_ADD(now(),INTERVAL :timezoneOffset HOUR),"%d/%m/%Y %H:%i:%S %H:%i:%S")

     function getPopularPosts( $nextCount,$loggedIn, $username,$search){
        
        if($loggedIn){
            if($search){
                $stmt = $this->pdo->prepare('SELECT 
                post.ID,
                
                if((
                    SELECT likes.USER_ID from likes 
                    inner join user on user.ID = likes.USER_ID 
                    WHERE likes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS livoted, 
                
                if((
                    SELECT dislikes.USER_ID from dislikes 
                    inner join user on user.ID = dislikes.USER_ID 
                    WHERE dislikes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS divoted, 
                
                post.title, 
                user.username, 
                post.text, 
                count(distinct dislikes.USER_ID) as dislikes, 
                count(distinct likes.USER_ID) as likes,

                ROUND(avg(starVote.points),2) as points ,
                count(distinct starVote.USER_ID) as starVotes,
                if((SELECT starVote.USER_ID from starVote 
                inner join user on user.ID = starVote.USER_ID 
                WHERE starVote.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS starVoted,

                DATE_FORMAT(DATE_ADD(creation_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d %H:%i:%S") as createdDate, 
                DATE_FORMAT(DATE_ADD(rel_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d") as releaseDate   
                
                from post INNER JOIN user ON user.ID = post.USER_ID 
                LEFT JOIN starVote ON post.ID = starVote.POST_ID
                LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
                left JOIN likes on post.ID = likes.POST_ID 
                
                where post.title like :search 
                AND post.creation_date > DATE_SUB( NOW(), INTERVAL :interval DAY)  
                group by post.ID order by likes desc  limit :nextCount , 10');


                $searchstr = "%".$search."%";
                $stmt->bindParam(':username',$username , \PDO::PARAM_STR);
                $stmt->bindParam(':search', $searchstr , \PDO::PARAM_STR);

            }else{
                $stmt = $this->pdo->prepare('SELECT 
                post.ID,
                if((
                    SELECT likes.USER_ID from likes 
                    inner join user on user.ID = likes.USER_ID 
                    WHERE likes.POST_ID = post.ID 
                    and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS livoted, 
                if((
                    SELECT dislikes.USER_ID from dislikes 
                    inner join user on user.ID = dislikes.USER_ID 
                    WHERE dislikes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS divoted, 
                
                post.title, 
                user.username, 
                post.text, 

                count(distinct dislikes.USER_ID) as dislikes, 
                count(distinct likes.USER_ID) as likes, 
                if((SELECT starVote.USER_ID from starVote 
                inner join user on user.ID = starVote.USER_ID 
                WHERE starVote.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS starVoted,

                ROUND(avg(starVote.points),2) as points ,
                count(distinct starVote.USER_ID) as starVotes,
                if((SELECT starVote.USER_ID from starVote 
                inner join user on user.ID = starVote.USER_ID 
                WHERE starVote.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS starVoted,
            
                DATE_FORMAT(DATE_ADD(rel_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d") as releaseDate, 
                DATE_FORMAT(DATE_ADD(creation_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d %H:%i:%S") as createdDate   
                
                from post INNER JOIN user ON user.ID = post.USER_ID 

                LEFT JOIN starVote ON post.ID = starVote.POST_ID 

                LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
                left JOIN likes on post.ID = likes.POST_ID  
                
                where post.creation_date > DATE_SUB( NOW(), INTERVAL :interval DAY)
                group by post.ID order by likes desc limit :nextCount , 10');
                
                $stmt->bindParam(':username', $username, \PDO::PARAM_STR);

            }
            
        }else{
            if($search){
                
                $stmt = $this->pdo->prepare('SELECT 
                post.ID, 
                0 as livoted,
                0 as divoted, 
                post.title, 
                user.username, 
                post.text, 
                count(distinct dislikes.USER_ID) as dislikes, 
                count(distinct likes.USER_ID) as likes, 

                ROUND(avg(starVote.points),2) as points ,
                count(distinct starVote.USER_ID) as starVotes,
                
                DATE_FORMAT(DATE_ADD(creation_date,INTERVAL :timezoneOffset HOUR), "%Y-%m-%d %H:%i:%S") as createdDate, 
                DATE_FORMAT(DATE_ADD(rel_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d") as releaseDate   
                
                from post INNER JOIN user ON user.ID = post.USER_ID 
                LEFT JOIN starVote ON post.ID = starVote.POST_ID
                LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
                left JOIN likes on post.ID = likes.POST_ID  
                where  post.creation_date > DATE_SUB( NOW(), INTERVAL :interval DAY) and 
                post.title LIKE :search  group by post.ID order by likes desc limit  :nextCount , 10');


                $searchstr = "%".$search."%";
                $stmt->bindParam(':search', $searchstr, \PDO::PARAM_STR);

            }else{
                
                $stmt = $this->pdo->prepare('SELECT 
                post.ID, 
                0 as livoted,
                0 as divoted, 
                post.title, 
                user.username, 
                post.text, 
                count(distinct dislikes.USER_ID) as dislikes, 
                count(distinct likes.USER_ID) as likes, 

                ROUND(avg(starVote.points),2) as points ,
                count(distinct starVote.USER_ID) as starVotes,

                DATE_FORMAT(DATE_ADD(creation_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d %H:%i:%S") as createdDate, 
                DATE_FORMAT(DATE_ADD(rel_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d") as releaseDate   
                
                from post INNER JOIN user ON user.ID = post.USER_ID 
                LEFT JOIN starVote ON post.ID = starVote.POST_ID
                LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
                left JOIN likes on post.ID = likes.POST_ID  
                
                where post.creation_date > DATE_SUB( NOW(), INTERVAL :interval DAY)
                 
                group by post.ID order by likes desc limit :nextCount , 10');

            }/*
            SELECT 
                post.ID, 
                0 as livoted,
                0 as divoted, 
                post.title, 
                user.username, 
                post.text, 
                count(distinct dislikes.USER_ID) as dislikes, 
                count(distinct likes.USER_ID) as likes, 
                DATE_FORMAT(DATE_ADD(creation_date,INTERVAL 5 HOUR),"%Y-%m-%d %H:%i:%S") as createdDate, 
                DATE_FORMAT(DATE_ADD(rel_date,INTERVAL 5 HOUR),"%Y-%m-%d") as releaseDate   
                
                from post INNER JOIN user ON user.ID = post.USER_ID 
                LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
                left JOIN likes on post.ID = likes.POST_ID  
                
                where post.creation_date > DATE_SUB( NOW(), INTERVAL :interval DAY)
                group by post.ID order by likes desc limit 0 , 10'
            
            
            */ 
            
        }
        
        $timezoneOffset = $_COOKIE['timezoneOffset'];

        $stmt->bindParam(':timezoneOffset', $timezoneOffset, \PDO::PARAM_INT);
        $stmt->bindParam(':nextCount', $nextCount, \PDO::PARAM_INT);
        $interval = self::INTERVAL;
        $stmt->bindParam(':interval', $interval, \PDO::PARAM_INT);
        /*if($stmt->execute()){
            return true;
        }else{
            return $stmt->errorInfo();
        }*/



        $stmt->execute();
       
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

    function getNewPosts( $nextCount,$loggedIn, $username, $search){

        if($loggedIn){

            if($search){
                $stmt = $this->pdo->prepare('
                SELECT post.ID,
                
                if((SELECT likes.USER_ID from likes 
                inner join user on user.ID = likes.USER_ID 
                WHERE likes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS livoted,

                if((SELECT dislikes.USER_ID from dislikes 
                inner join user on user.ID = dislikes.USER_ID 
                WHERE dislikes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS divoted,

                post.title, 
                user.username, 
                post.text, 
                count(distinct dislikes.USER_ID) as dislikes, 
                count(distinct likes.USER_ID) as likes, 

                ROUND(avg(starVote.points),2) as points ,
                count(distinct starVote.USER_ID) as starVotes,
                
                if((SELECT starVote.USER_ID from starVote 
                inner join user on user.ID = starVote.USER_ID 
                WHERE starVote.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS starVoted,

                DATE_FORMAT(DATE_ADD(creation_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d %H:%i:%S") as createdDate, 
                DATE_FORMAT(DATE_ADD(rel_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d") as releaseDate  

                from post INNER JOIN user ON user.ID = post.USER_ID 
                LEFT JOIN starVote ON post.ID = starVote.POST_ID
                LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
                left JOIN likes on post.ID = likes.POST_ID 
                
                where post.title like :search group by post.ID order by createdDate desc limit :nextCount , 10');

                $searchstr = "%".$search."%";
                $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
                $stmt->bindParam(':search', $searchstr, \PDO::PARAM_STR);

            }else{
                $stmt = $this->pdo->prepare('
                SELECT post.ID,

                if((SELECT likes.USER_ID from likes inner join user on user.ID = likes.USER_ID 
                WHERE likes.POST_ID = post.ID and 
                user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS livoted, 
                
                if((SELECT dislikes.USER_ID from dislikes inner join user on user.ID = dislikes.USER_ID 
                WHERE dislikes.POST_ID = post.ID and 
                user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS divoted, 
                
                post.title, 
                user.username, 
                post.text, 
                count(distinct dislikes.USER_ID) as dislikes, 
                count(distinct likes.USER_ID) as likes, 

                ROUND(avg(starVote.points),2) as points ,
                count(distinct starVote.USER_ID) as starVotes,
                if((SELECT starVote.USER_ID from starVote 
                inner join user on user.ID = starVote.USER_ID 
                WHERE starVote.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS starVoted,

                DATE_FORMAT(DATE_ADD(creation_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d %H:%i:%S") as createdDate, 
                DATE_FORMAT(DATE_ADD(rel_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d") as releaseDate   
                
                from post INNER JOIN user ON user.ID = post.USER_ID 
                LEFT JOIN starVote ON post.ID = starVote.POST_ID
                LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
                left JOIN likes on post.ID = likes.POST_ID 
                
                group by post.ID order by createdDate DESC  limit :nextCount , 10');
                $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
               
            }


      
        }else{
            if($search){

                $stmt = $this->pdo->prepare('
                SELECT post.ID,
                0 as livoted,
                0 as divoted, 
                post.title, 
                user.username, 
                post.text, 
                count(distinct dislikes.USER_ID) as dislikes, 
                count(distinct likes.USER_ID) as likes, 

                ROUND(avg(starVote.points),2) as points ,
                count(distinct starVote.USER_ID) as starVotes,

                DATE_FORMAT(DATE_ADD(creation_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d %H:%i:%S") as createdDate, 
                DATE_FORMAT(DATE_ADD(rel_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d") as releaseDate   
                
                from post INNER JOIN user ON user.ID = post.USER_ID
                LEFT JOIN starVote ON post.ID = starVote.POST_ID 
                LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
                left JOIN likes on post.ID = likes.POST_ID where post.title 
                
                LIKE :search group by post.ID order by createdDate DESC  limit :nextCount , 10');
                $searchstr = "%".$search."%";
                $stmt->bindParam(':search', $searchstr, \PDO::PARAM_STR);
              

            }else{
                
                $stmt = $this->pdo->prepare('SELECT post.ID, 
                0 as livoted,
                0 as divoted, 
                post.title, 
                user.username, 
                post.text, 
                count(distinct dislikes.USER_ID) as dislikes, 
                count(distinct likes.USER_ID) as likes, 

                ROUND(avg(starVote.points),2) as points ,
                count(distinct starVote.USER_ID) as starVotes,

                DATE_FORMAT(DATE_ADD(creation_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d %H:%i:%S") as createdDate, 
                DATE_FORMAT(DATE_ADD(rel_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d") as releaseDate   
                
                from post INNER JOIN user ON user.ID = post.USER_ID 
                LEFT JOIN starVote ON post.ID = starVote.POST_ID
                LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
                left JOIN likes on post.ID = likes.POST_ID  
                group by post.ID order by createdDate DESC limit :nextCount , 10');
            }



    
        }
        
        $timezoneOffset = $_COOKIE['timezoneOffset'];
       // echo $timezoneOffset;

        $stmt->bindParam(':timezoneOffset', $timezoneOffset, \PDO::PARAM_INT);
        $stmt->bindParam(':nextCount', $nextCount, \PDO::PARAM_INT);
        $interval = self::INTERVAL;
        $stmt->bindParam(':interval', $interval, \PDO::PARAM_INT);

        $stmt->execute();
       //echo $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }



    function getNewPostsCategory($categoryName, $nextCount, $loggedIn,$username,$search){
        if($loggedIn){
            if($search){
                $stmt = $this->pdo->prepare('
                SELECT post.ID, 
                
                if((
                    SELECT likes.USER_ID from likes 
                    inner join user on user.ID = likes.USER_ID 
                    WHERE likes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS livoted, 
                    
                if((
                    SELECT dislikes.USER_ID from dislikes 
                    inner join user on user.ID = dislikes.USER_ID 
                    WHERE dislikes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS divoted , 
                    
                post.title, 
                user.username, 
                post.text, 
                count(distinct dislikes.USER_ID) as dislikes, 
                count(distinct likes.USER_ID) as likes, 

                ROUND(avg(starVote.points),2) as points ,
                count(distinct starVote.USER_ID) as starVotes,
                if((SELECT starVote.USER_ID from starVote 
                inner join user on user.ID = starVote.USER_ID 
                WHERE starVote.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS starVoted,
                
                DATE_FORMAT(DATE_ADD(creation_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d %H:%i:%S") as createdDate, 
                DATE_FORMAT(DATE_ADD(rel_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d") as releaseDate 
                
                from post inner join user on user.ID = post.USER_ID 

                inner join category on category.ID = post.TOPIC_ID  
                LEFT JOIN starVote ON post.ID = starVote.POST_ID
                LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
                left JOIN likes on post.ID = likes.POST_ID   
                
                where category.category = :cat and post.title like :search 
                group by post.ID order by createdDate desc  limit :nextCount , 10');
              
                $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
                $searchstr = "%".$search."%";
                $stmt->bindParam(':search', $searchstr, \PDO::PARAM_STR);

            }else{
                 $stmt = $this->pdo->prepare('
                 SELECT post.ID, 

                 if((
                     SELECT likes.USER_ID from likes 
                     inner join user on user.ID = likes.USER_ID 
                     WHERE likes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS livoted, 
                     
                if((
                    SELECT dislikes.USER_ID from dislikes 
                    inner join user on user.ID = dislikes.USER_ID 
                    WHERE dislikes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS divoted , 
                    
                post.title, 
                user.username, 
                post.text, 
                count(distinct dislikes.USER_ID) as dislikes, 
                count(distinct likes.USER_ID) as likes, 
                

                ROUND(avg(starVote.points),2) as points ,
                count(distinct starVote.USER_ID) as starVotes,
                if((SELECT starVote.USER_ID from starVote 
                inner join user on user.ID = starVote.USER_ID 
                WHERE starVote.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS starVoted,

                DATE_FORMAT(DATE_ADD(creation_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d %H:%i:%S") as createdDate, 
                DATE_FORMAT(DATE_ADD(rel_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d") as releaseDate 
                
                from post inner join user on user.ID = post.USER_ID 
                inner join category on category.ID = post.TOPIC_ID  
                LEFT JOIN starVote ON post.ID = starVote.POST_ID
                LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
                left JOIN likes on post.ID = likes.POST_ID   
                
                where category.category = :cat group by post.ID order by createdDate DESC limit :nextCount , 10');

                 $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
            }

        }else{

            if($search){
                $stmt = $this->pdo->prepare('
                SELECT post.ID, 
                0 as livoted,
                0 as divoted, 
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
                inner join category on category.ID = post.TOPIC_ID  
                LEFT JOIN starVote ON post.ID = starVote.POST_ID
                LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
                left JOIN likes on post.ID = likes.POST_ID   
                
                where category.category = :cat and post.title like :search 
                group by post.ID order by createdDate desc limit :nextCount , 10');

                $searchstr = "%".$search."%";
                $stmt->bindParam(':search', $searchstr, \PDO::PARAM_STR);

            }else{

                $stmt = $this->pdo->prepare("SELECT post.ID, 
                0 as livoted,
                0 as divoted, 
                post.title, 
                user.username, 
                post.text, 
                count(distinct dislikes.USER_ID) as dislikes, 
                count(distinct likes.USER_ID) as likes, 

                ROUND(avg(starVote.points),2) as points ,
                count(distinct starVote.USER_ID) as starVotes,
                
                DATE_FORMAT(DATE_ADD(creation_date,INTERVAL :timezoneOffset HOUR),'%Y-%m-%d %H:%i:%S') as createdDate, 
                DATE_FORMAT(DATE_ADD(rel_date,INTERVAL :timezoneOffset HOUR),'%Y-%m-%d') as releaseDate 
                
                from post inner join user on user.ID = post.USER_ID 
                inner join category on category.ID = post.TOPIC_ID  
                LEFT JOIN starVote ON post.ID = starVote.POST_ID
                LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
                left JOIN likes on post.ID = likes.POST_ID   
                
                where category.category = :cat group by post.ID order by createdDate DESC limit :nextCount , 10");

            }



        }
        $timezoneOffset = $_COOKIE['timezoneOffset'];
        $stmt->bindParam(':timezoneOffset', $timezoneOffset, \PDO::PARAM_INT);
        $stmt->bindParam(':cat', $categoryName, \PDO::PARAM_STR);
        $stmt->bindParam(':nextCount', $nextCount, \PDO::PARAM_INT);
        $interval = self::INTERVAL;
        $stmt->bindParam(':interval', $interval, \PDO::PARAM_INT);

        
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

     //Index page by category next page
     function getPopularPostsCategory($categoryName, $nextCount, $loggedIn,$username,$search){
        if($loggedIn){
            if($search){
                $stmt = $this->pdo->prepare('SELECT 
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
                if((SELECT starVote.USER_ID from starVote 
                inner join user on user.ID = starVote.USER_ID 
                WHERE starVote.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS starVoted,

                DATE_FORMAT(DATE_ADD(creation_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d %H:%i:%S") as createdDate, 
                DATE_FORMAT(DATE_ADD(rel_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d") as releaseDate 
                
                from post inner join user on user.ID = post.USER_ID 
                inner join category on category.ID = post.TOPIC_ID  
                LEFT JOIN starVote ON post.ID = starVote.POST_ID
                LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
                left JOIN likes on post.ID = likes.POST_ID   
                
                where  post.creation_date > DATE_SUB( NOW(), INTERVAL :interval DAY) 
                AND category.category = :cat and post.title like :search group by post.ID order by likes desc limit :nextCount , 10');

                $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
                $searchstr = "%".$search."%";
                $stmt->bindParam(':search', $searchstr, \PDO::PARAM_STR);

            }else{
                $stmt = $this->pdo->prepare('SELECT 
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
                if((SELECT starVote.USER_ID from starVote 
                inner join user on user.ID = starVote.USER_ID 
                WHERE starVote.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS starVoted,
                
                DATE_FORMAT(DATE_ADD(creation_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d %H:%i:%S") as createdDate, 
                DATE_FORMAT(DATE_ADD(rel_date,INTERVAL :timezoneOffset HOUR),"%Y-%m-%d") as releaseDate 
                
                from post inner join user on user.ID = post.USER_ID 
                inner join category on category.ID = post.TOPIC_ID  
                LEFT JOIN starVote ON post.ID = starVote.POST_ID
                LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
                left JOIN likes on post.ID = likes.POST_ID   
                
                where category.category = :cat AND post.creation_date > DATE_SUB( NOW(), INTERVAL :interval DAY) group by post.ID order by likes desc limit :nextCount , 10');
                
                $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
            }

          
        }else{
            if($search){
                $stmt = $this->pdo->prepare('SELECT 
                post.ID, 
                0 as livoted,
                0 as divoted, 
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
                inner join category on category.ID = post.TOPIC_ID  
                LEFT JOIN starVote ON post.ID = starVote.POST_ID
                LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
                left JOIN likes on post.ID = likes.POST_ID   
                
                where category.category = :cat 
                AND post.creation_date > DATE_SUB( NOW(), INTERVAL :interval DAY) 
                and post.title LIKE :search group by post.ID order by likes desc limit :nextCount , 10');
                $searchstr = "%".$search."%";
                $stmt->bindParam(':search', $searchstr, \PDO::PARAM_STR);

            }else{

                $stmt = $this->pdo->prepare('SELECT 
                post.ID, 
                0 as livoted,
                0 as divoted, 
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
                inner join category on category.ID = post.TOPIC_ID  
                LEFT JOIN starVote ON post.ID = starVote.POST_ID
                LEFT JOIN dislikes on post.ID = dislikes.POST_ID 
                left JOIN likes on post.ID = likes.POST_ID   

                where category.category = :cat 
                AND post.creation_date > DATE_SUB( NOW(), INTERVAL :interval DAY) 
                group by post.ID order by likes desc limit :nextCount , 10');

            }
            
           
        }


        
        //print_r($this->data);
        $timezoneOffset = $_COOKIE['timezoneOffset'];
        $stmt->bindParam(':timezoneOffset', $timezoneOffset, \PDO::PARAM_INT);
        $stmt->bindParam(':cat', $categoryName, \PDO::PARAM_STR);
        $stmt->bindParam(':nextCount', $nextCount, \PDO::PARAM_INT);
        $interval = self::INTERVAL;
        $stmt->bindParam(':interval', $interval, \PDO::PARAM_INT);

        
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }



    //Edit
    function getPost($username,$postID){
        //echo"asdasd";
        $stmt = $this->pdo->prepare("SELECT post.TOPIC_ID as category, post.title, post.text, DATE_FORMAT(rel_date,'%d/%m/%Y') as releaseDate from post INNER JOIN user ON user.ID = post.USER_ID where username = ? AND post.ID = ?");
        $stmt->execute([$username,$postID]);
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

    function editPost($title, $text, $postID,$category){
        $stmt = $this->pdo->prepare("UPDATE post SET  text = :postText , title = :title, TOPIC_ID = :category WHERE ID = :id");
        $stmt->bindParam(':postText', $text, \PDO::PARAM_STR);
        $stmt->bindParam(':title', $title, \PDO::PARAM_STR);
        $stmt->bindParam(':id', $postID, \PDO::PARAM_INT);
        $stmt->bindParam(':category', $category, \PDO::PARAM_INT);
        $stmt->execute();
        
        if($stmt->execute()){
            return true;
        }else{
           return false;
            //return $stmt->errorInfo();
        }
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    function createPost($title, $text,$user,$date,$category){
        $stmt = $this->pdo->prepare("INSERT INTO post (USER_ID,title,text,rel_date,creation_date,TOPIC_ID) VALUES ((select ID from user where username = :user),:title,:postText,:date , now(),:category)");
        $stmt->bindParam(':postText', $text, \PDO::PARAM_STR);
        $stmt->bindParam(':user', $user, \PDO::PARAM_STR);

        $stmt->bindParam(':title', $title, \PDO::PARAM_STR);
        $stmt->bindParam(':category', $category, \PDO::PARAM_INT);

        //$timezoneOffset = $_COOKIE['timezoneOffset'] ;
       // $stmt->bindParam(':timezoneOffset', $timezoneOffset, \PDO::PARAM_INT);
        $stmt->bindParam(':date', $date, \PDO::PARAM_STR);


        if($stmt->execute()){
            return true;
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

    function unvotePost($postID,$username, $action){

        switch($action){
            case "dislikes":
                $stmt = $this->pdo->prepare("DELETE FROM dislikes WHERE POST_ID = :id and USER_ID = (SELECT ID from user where username = :username) ");
                break;
            case"likes":

                 $stmt = $this->pdo->prepare("DELETE FROM likes WHERE POST_ID = :id and USER_ID = (SELECT ID from user where username = :username)  ");
                break;
                }

        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':id', $postID, \PDO::PARAM_INT);
        $stmt->execute();
    }
    
    function unvoteComment($postID,$username, $action){
        switch($action){
            case "dislikes":
                $stmt = $this->pdo->prepare("DELETE FROM cdislikes WHERE COMMENT_ID = :id and USER_ID = (SELECT ID from user where username = :username) ");
                break;
            case"likes":
                 $stmt = $this->pdo->prepare("DELETE FROM clikes WHERE COMMENT_ID = :id and USER_ID = (SELECT ID from user where username = :username)  ");
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
            
                $stmt = $this->pdo->prepare('select POST_ID from dislikes inner join user on user.ID = dislikes.USER_ID WHERE username= :username and POST_ID =:postID LIMIT 1');
                break;
            case"likes":

                $stmt = $this->pdo->prepare('select POST_ID from likes inner join user on user.ID = likes.USER_ID WHERE username= :username and POST_ID = :postID LIMIT 1');
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
            
                $stmt = $this->pdo->prepare('select COMMENT_ID from cdislikes inner join user on user.ID = cdislikes.USER_ID WHERE username= :username and COMMENT_ID = :postID LIMIT 1');
                break;
            case"likes":
                $stmt = $this->pdo->prepare('select COMMENT_ID from clikes inner join user on user.ID = clikes.USER_ID WHERE username= :username and COMMENT_ID = :postID LIMIT 1');
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

    function deletePost($postID, $username){
        $stmt = $this->pdo->prepare('DELETE post.* FROM post inner join user on user.ID = post.USER_ID where post.ID = :postID AND user.username = :username ');
    

        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':postID', $postID, \PDO::PARAM_INT);
        $stmt->execute();
    }

    function starVote($postID,$points,$username){

        $stmt = $this->pdo->prepare('insert into starVote    (POST_ID,USER_ID, points) VALUES (:postID,(SELECT ID from user where username = :username),:points) ');
    

        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);

        $stmt->bindParam(':postID', $postID, \PDO::PARAM_INT);
        $stmt->bindParam(':points', $points, \PDO::PARAM_INT);
        if(!$stmt->execute()){
            
            return false;
        }else{
            return true;
        }

    }
    function checkStarVoteExists($postID,$username){
      
        $stmt = $this->pdo->prepare('select starVote.POST_ID FROM starVote inner join user on user.ID = starVote.USER_ID WHERE username= :username and starVote.POST_ID = :postID LIMIT 1 ');
            
     
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':postID', $postID, \PDO::PARAM_INT);
        $stmt->execute();
        if(!$stmt->fetchColumn()){
            
            return false;
        }else{
            return true;
        }

    }
    function replaceStarVote($postID,$points, $username){
      
        $stmt = $this->pdo->prepare('UPDATE starVote SET  points = :points  WHERE POST_ID = :postID AND USER_ID = (select ID from user where username = :username) ');
            
     
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':postID', $postID, \PDO::PARAM_INT);
        $stmt->bindParam(':points', $points, \PDO::PARAM_INT);

        if(!$stmt->execute()){
            return false;
        }else{
            return true;
        }

    }

    function checkStarVoteDate($postID){
        $stmt = $this->pdo->prepare('select post.ID FROM post where ID = :postID and post.rel_date < UTC_TIMESTAMP()  LIMIT 1 ');
            
     
        $stmt->bindParam(':postID', $postID, \PDO::PARAM_INT);
        $stmt->execute();
        if(!$stmt->fetchColumn()){
            
            return false;
        }else{
            return true;
        }
    }

























    


}




?>