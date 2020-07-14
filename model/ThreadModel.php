<?php 
namespace src\Model;
use \src\core;
class threadModel extends core\Model{}

    
   
    function __construct(){
       parent::__construct();
    }



    function getThreads($username){
        $stmt = $this->pdo->prepare('SELECT threads.title,threads.dateCreated, 0 as followers from threads 
        where USER_ID = (select ID from user where username = :username) ');
       $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
       $stmt->execute() ;

       return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

    function postThread($username,$title,$description){
        $stmt = $this->pdo->prepare("INSERT into threads (USER_ID, title, description,dateCreated) VALUES ((select ID from user where username = :username ),:title, :description,now())");
            
        $filename = $imageExtension;
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':title', $title, \PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, \PDO::PARAM_STR);

        if(!$stmt->execute()){
            return false;
        }else{
            return true;
        }
    }


}
