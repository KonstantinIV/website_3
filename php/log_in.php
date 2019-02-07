<?php 
session_start();
class usr_session{
    private $user;
    private $pass;
    private $session_id;

    function set_usr(){
        $this->user = $user;
        $this->pass = $pass;
    }

    function check_usr(){
        $stmt = $pdo->prepare('SELECT pass  from user WHERE username=? LIMIT 1');
        $stmt->execute([$user]);
        if(!$stmt->fetchColumn()){
            return 1;
        }else if($stmt->fetchColumn() != $this->pass){
            return 2;
        }
    }

    function sess_start(){
        $this->session_id = session_id();
        $_SESSION['user'] = $this->user;
    }

    function ret_sess_id(){
        return $this->session_id;
    }


    


    function session_valid_id(){
        return preg_match('/^[-,a-zA-Z0-9]{1,128}$/', $this->session_id) > 0;
    }


}
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    //echo "ssdsda1";
    /*$user = mysqli_real_escape_string($_POST['user']);
    $pass = mysqli_real_escape_string($_POST['pass']);
    valid($user,$pass);*/
}




?>