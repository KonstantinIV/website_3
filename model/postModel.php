<?php 
namespace src\model;
use src\controller\core;
class postModel extends core\modelController{
    public $inputData;

    function __construct(){
       parent::__construct();
    }


    

     //iNDEX next 10 pages
     function getPopularPosts( $nextCount,$loggedIn, $username,$search){
        if($loggedIn){
            if($search){
                $stmt = $this->pdo->prepare('SELECT post.ID,if((SELECT likes.USER_ID from likes inner join user on user.ID = likes.USER_ID WHERE likes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS livoted, if((SELECT dislikes.USER_ID from dislikes inner join user on user.ID = dislikes.USER_ID WHERE dislikes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS divoted, post.title, user.username, post.text, count(distinct dislikes.USER_ID) as dislikes, count(distinct likes.USER_ID) as likes, DATE_FORMAT(creation_date,"%d/%m/%Y") as createdDate, DATE_FORMAT(rel_date,"%d/%m/%Y") as releaseDate   from post INNER JOIN user ON user.ID = post.USER_ID LEFT JOIN dislikes on post.ID = dislikes.POST_ID left JOIN likes on post.ID = likes.POST_ID where post.title like :search  group by post.ID limit :nextCount , 10');
                $searchstr = "%".$search."%";
                $stmt->bindParam(':username',$username , \PDO::PARAM_STR);
                $stmt->bindParam(':search', $searchstr , \PDO::PARAM_STR);

            }else{
                $stmt = $this->pdo->prepare('SELECT post.ID,if((SELECT likes.USER_ID from likes inner join user on user.ID = likes.USER_ID WHERE likes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS livoted, if((SELECT dislikes.USER_ID from dislikes inner join user on user.ID = dislikes.USER_ID WHERE dislikes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS divoted, post.title, user.username, post.text, count(distinct dislikes.USER_ID) as dislikes, count(distinct likes.USER_ID) as likes, DATE_FORMAT(creation_date,"%d/%m/%Y") as createdDate, DATE_FORMAT(rel_date,"%d/%m/%Y") as releaseDate   from post INNER JOIN user ON user.ID = post.USER_ID LEFT JOIN dislikes on post.ID = dislikes.POST_ID left JOIN likes on post.ID = likes.POST_ID  group by post.ID limit :nextCount , 10');
                $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
            }
            
        }else{
            if($search){
                $stmt = $this->pdo->prepare('SELECT post.ID, 0 as livoted,0 as divoted, post.title, user.username, post.text, count(distinct dislikes.USER_ID) as dislikes, count(distinct likes.USER_ID) as likes, DATE_FORMAT(creation_date,"%d/%m/%Y") as createdDate, DATE_FORMAT(rel_date,"%d/%m/%Y") as releaseDate   from post INNER JOIN user ON user.ID = post.USER_ID LEFT JOIN dislikes on post.ID = dislikes.POST_ID left JOIN likes on post.ID = likes.POST_ID  where post.title = :search group by post.ID limit :nextCount , 10');
                $searchstr = "%".$search."%";
                $stmt->bindParam(':search', $searchstr, \PDO::PARAM_STR);

            }else{
                $stmt = $this->pdo->prepare('SELECT post.ID, 0 as livoted,0 as divoted, post.title, user.username, post.text, count(distinct dislikes.USER_ID) as dislikes, count(distinct likes.USER_ID) as likes, DATE_FORMAT(creation_date,"%d/%m/%Y") as createdDate, DATE_FORMAT(rel_date,"%d/%m/%Y") as releaseDate   from post INNER JOIN user ON user.ID = post.USER_ID LEFT JOIN dislikes on post.ID = dislikes.POST_ID left JOIN likes on post.ID = likes.POST_ID  group by post.ID limit :nextCount , 10');
        
            }
            
        }
        
        
        $stmt->bindParam(':nextCount', $nextCount, \PDO::PARAM_INT);
        $stmt->execute();
       
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

    function getNewPosts( $nextCount,$loggedIn, $username, $search){
        
        if($loggedIn){

            if($search){
                $stmt = $this->pdo->prepare('SELECT post.ID,if((SELECT likes.USER_ID from likes inner join user on user.ID = likes.USER_ID WHERE likes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS livoted, if((SELECT dislikes.USER_ID from dislikes inner join user on user.ID = dislikes.USER_ID WHERE dislikes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS divoted, post.title, user.username, post.text, count(distinct dislikes.USER_ID) as dislikes, count(distinct likes.USER_ID) as likes, DATE_FORMAT(creation_date,"%d/%m/%Y") as createdDate, DATE_FORMAT(rel_date,"%d/%m/%Y") as releaseDate   from post INNER JOIN user ON user.ID = post.USER_ID LEFT JOIN dislikes on post.ID = dislikes.POST_ID left JOIN likes on post.ID = likes.POST_ID where post.title like :search group by post.ID order by createdDate  limit :nextCount , 10');
                $searchstr = "%".$search."%";
                $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
                $stmt->bindParam(':search', $searchstr, \PDO::PARAM_STR);

            }else{
                $stmt = $this->pdo->prepare('SELECT post.ID,if((SELECT likes.USER_ID from likes inner join user on user.ID = likes.USER_ID WHERE likes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS livoted, if((SELECT dislikes.USER_ID from dislikes inner join user on user.ID = dislikes.USER_ID WHERE dislikes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS divoted, post.title, user.username, post.text, count(distinct dislikes.USER_ID) as dislikes, count(distinct likes.USER_ID) as likes, DATE_FORMAT(creation_date,"%d/%m/%Y") as createdDate, DATE_FORMAT(rel_date,"%d/%m/%Y") as releaseDate   from post INNER JOIN user ON user.ID = post.USER_ID LEFT JOIN dislikes on post.ID = dislikes.POST_ID left JOIN likes on post.ID = likes.POST_ID group by post.ID order by createdDate  limit :nextCount , 10');
                $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
            }


      
        }else{
            if($search){
                $stmt = $this->pdo->prepare('SELECT post.ID, 0 as livoted,0 as divoted, post.title, user.username, post.text, count(distinct dislikes.USER_ID) as dislikes, count(distinct likes.USER_ID) as likes, DATE_FORMAT(creation_date,"%d/%m/%Y") as createdDate, DATE_FORMAT(rel_date,"%d/%m/%Y") as releaseDate   from post INNER JOIN user ON user.ID = post.USER_ID LEFT JOIN dislikes on post.ID = dislikes.POST_ID left JOIN likes on post.ID = likes.POST_ID where post.title = :search group by post.ID order by createdDate  limit :nextCount , 10');
                $searchstr = "%".$search."%";
                $stmt->bindParam(':search', $searchstr, \PDO::PARAM_STR);
              

            }else{
                $stmt = $this->pdo->prepare('SELECT post.ID, 0 as livoted,0 as divoted, post.title, user.username, post.text, count(distinct dislikes.USER_ID) as dislikes, count(distinct likes.USER_ID) as likes, DATE_FORMAT(creation_date,"%d/%m/%Y") as createdDate, DATE_FORMAT(rel_date,"%d/%m/%Y") as releaseDate   from post INNER JOIN user ON user.ID = post.USER_ID LEFT JOIN dislikes on post.ID = dislikes.POST_ID left JOIN likes on post.ID = likes.POST_ID  group by post.ID order by createdDate  limit :nextCount , 10');
            }



    
        }
        
        
        $stmt->bindParam(':nextCount', $nextCount, \PDO::PARAM_INT);
        $stmt->execute();
       
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }



    function getNewPostsCategory($categoryName, $nextCount, $loggedIn,$username,$search){
        if($loggedIn){
            if($search){
                $stmt = $this->pdo->prepare('SELECT post.ID, if((SELECT likes.USER_ID from likes inner join user on user.ID = likes.USER_ID WHERE likes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS livoted, if((SELECT dislikes.USER_ID from dislikes inner join user on user.ID = dislikes.USER_ID WHERE dislikes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS divoted , post.title, user.username, post.text, count(distinct dislikes.USER_ID) as dislikes, count(distinct likes.USER_ID) as likes, DATE_FORMAT(creation_date,"%d/%m/%Y") as createdDate, DATE_FORMAT(rel_date,"%d/%m/%Y") as releaseDate from post inner join user on user.ID = post.USER_ID inner join category on category.ID = post.TOPIC_ID  LEFT JOIN dislikes on post.ID = dislikes.POST_ID left JOIN likes on post.ID = likes.POST_ID   where category.category = :cat and post.title like :search group by post.ID order by createdDate  limit limit :nextCount , 10');
              
                $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
                $searchstr = "%".$search."%";
                $stmt->bindParam(':search', $searchstr, \PDO::PARAM_STR);

            }else{
                 $stmt = $this->pdo->prepare('SELECT post.ID, if((SELECT likes.USER_ID from likes inner join user on user.ID = likes.USER_ID WHERE likes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS livoted, if((SELECT dislikes.USER_ID from dislikes inner join user on user.ID = dislikes.USER_ID WHERE dislikes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS divoted , post.title, user.username, post.text, count(distinct dislikes.USER_ID) as dislikes, count(distinct likes.USER_ID) as likes, DATE_FORMAT(creation_date,"%d/%m/%Y") as createdDate, DATE_FORMAT(rel_date,"%d/%m/%Y") as releaseDate from post inner join user on user.ID = post.USER_ID inner join category on category.ID = post.TOPIC_ID  LEFT JOIN dislikes on post.ID = dislikes.POST_ID left JOIN likes on post.ID = likes.POST_ID   where category.category = :cat group by post.ID order by createdDate  limit limit :nextCount , 10');
                 $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
            }

        }else{

            if($search){
                $stmt = $this->pdo->prepare('SELECT post.ID, 0 as livoted,0 as divoted, post.title, user.username, post.text, count(distinct dislikes.USER_ID) as dislikes, count(distinct likes.USER_ID) as likes, DATE_FORMAT(creation_date,"%d/%m/%Y") as createdDate, DATE_FORMAT(rel_date,"%d/%m/%Y") as releaseDate from post inner join user on user.ID = post.USER_ID inner join category on category.ID = post.TOPIC_ID  LEFT JOIN dislikes on post.ID = dislikes.POST_ID left JOIN likes on post.ID = likes.POST_ID   where category.category = :cat and post.title = :search group by post.ID order by createdDate  limit :nextCount , 10');
                $searchstr = "%".$search."%";
                $stmt->bindParam(':search', $searchstr, \PDO::PARAM_STR);

            }else{

                $stmt = $this->pdo->prepare('SELECT post.ID, 0 as livoted,0 as divoted, post.title, user.username, post.text, count(distinct dislikes.USER_ID) as dislikes, count(distinct likes.USER_ID) as likes, DATE_FORMAT(creation_date,"%d/%m/%Y") as createdDate, DATE_FORMAT(rel_date,"%d/%m/%Y") as releaseDate from post inner join user on user.ID = post.USER_ID inner join category on category.ID = post.TOPIC_ID  LEFT JOIN dislikes on post.ID = dislikes.POST_ID left JOIN likes on post.ID = likes.POST_ID   where category.category = :cat group by post.ID order by createdDate  limit :nextCount , 10');
            }



        }
        $stmt->bindParam(':cat', $categoryName, \PDO::PARAM_STR);
        $stmt->bindParam(':nextCount', $nextCount, \PDO::PARAM_INT);
        
        
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

     //Index page by category next page
     function getPopularPostsCategory($categoryName, $nextCount, $loggedIn,$username,$search){
        if($loggedIn){
            if($search){
                $stmt = $this->pdo->prepare('SELECT post.ID, if((SELECT likes.USER_ID from likes inner join user on user.ID = likes.USER_ID WHERE likes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS livoted, if((SELECT dislikes.USER_ID from dislikes inner join user on user.ID = dislikes.USER_ID WHERE dislikes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS divoted , post.title, user.username, post.text, count(distinct dislikes.USER_ID) as dislikes, count(distinct likes.USER_ID) as likes, DATE_FORMAT(creation_date,"%d/%m/%Y") as createdDate, DATE_FORMAT(rel_date,"%d/%m/%Y") as releaseDate from post inner join user on user.ID = post.USER_ID inner join category on category.ID = post.TOPIC_ID  LEFT JOIN dislikes on post.ID = dislikes.POST_ID left JOIN likes on post.ID = likes.POST_ID   where category.category = :cat and post.title like :search group by post.ID limit :nextCount , 10');

                $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
                $searchstr = "%".$search."%";
                $stmt->bindParam(':search', $searchstr, \PDO::PARAM_STR);

            }else{
                $stmt = $this->pdo->prepare('SELECT post.ID, if((SELECT likes.USER_ID from likes inner join user on user.ID = likes.USER_ID WHERE likes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS livoted, if((SELECT dislikes.USER_ID from dislikes inner join user on user.ID = dislikes.USER_ID WHERE dislikes.POST_ID = post.ID and user.username = :username limit 1 ) IS NOT NULL, 1, 0 ) AS divoted , post.title, user.username, post.text, count(distinct dislikes.USER_ID) as dislikes, count(distinct likes.USER_ID) as likes, DATE_FORMAT(creation_date,"%d/%m/%Y") as createdDate, DATE_FORMAT(rel_date,"%d/%m/%Y") as releaseDate from post inner join user on user.ID = post.USER_ID inner join category on category.ID = post.TOPIC_ID  LEFT JOIN dislikes on post.ID = dislikes.POST_ID left JOIN likes on post.ID = likes.POST_ID   where category.category = :cat group by post.ID limit :nextCount , 10');

                $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
            }

          
        }else{
            if($search){
                $stmt = $this->pdo->prepare('SELECT post.ID, 0 as livoted,0 as divoted, post.title, user.username, post.text, count(distinct dislikes.USER_ID) as dislikes, count(distinct likes.USER_ID) as likes, DATE_FORMAT(creation_date,"%d/%m/%Y") as createdDate, DATE_FORMAT(rel_date,"%d/%m/%Y") as releaseDate from post inner join user on user.ID = post.USER_ID inner join category on category.ID = post.TOPIC_ID  LEFT JOIN dislikes on post.ID = dislikes.POST_ID left JOIN likes on post.ID = likes.POST_ID   where category.category = :cat and post.title = :search group by post.ID limit :nextCount , 10');
                $searchstr = "%".$search."%";
                $stmt->bindParam(':search', $searchstr, \PDO::PARAM_STR);

            }else{

                $stmt = $this->pdo->prepare('SELECT post.ID, 0 as livoted,0 as divoted, post.title, user.username, post.text, count(distinct dislikes.USER_ID) as dislikes, count(distinct likes.USER_ID) as likes, DATE_FORMAT(creation_date,"%d/%m/%Y") as createdDate, DATE_FORMAT(rel_date,"%d/%m/%Y") as releaseDate from post inner join user on user.ID = post.USER_ID inner join category on category.ID = post.TOPIC_ID  LEFT JOIN dislikes on post.ID = dislikes.POST_ID left JOIN likes on post.ID = likes.POST_ID   where category.category = :cat group by post.ID limit :nextCount , 10');

            }
            
           
        }


        
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
        $stmt = $this->pdo->prepare('select COMMENT_ID from cdislikes inner join user on user.ID = cdislikes.USER_ID WHERE username= :username and COMMENT_ID = :postID LIMIT 1');
    

        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':postID', $postID, \PDO::PARAM_INT);
        $stmt->execute();
    }


























    


}




?>