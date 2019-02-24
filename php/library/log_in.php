<?php 
class usr_session{
    private $user;
    private $pass;
    private $session_id;
    private $pdo;




    function set_usr($user, $pass){
        $this->user = $user;
        $this->pass = $pass;
        $database   = new database;
        $this->pdo  = $database->retPdo();
    }

    function check_usr(){
        $stmt = $this->pdo->prepare('SELECT pass  from user WHERE username=? LIMIT 1');
        $stmt->execute([$this->user]);
        
        if(!$stmt->fetchColumn()){
            return 1;
        }else if($stmt->fetchColumn() != $this->pass){
            return 2;
        }
    }

    function sess_start(){
        session_start();
        $this->session_id = session_id();
        $_SESSION['user'] = $this->user;
    }


    

    function ret_sess_id(){
        return $this->session_id;
    }


    


    /*function session_valid_id(){
        return preg_match('/^[-,a-zA-Z0-9]{1,128}$/', $this->session_id) > 0;
    }*/


}


//echo $_SESSION['user'];


?>