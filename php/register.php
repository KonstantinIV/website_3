<?php 
class user{
    
    private $username;
    private $password;
    private $email;
    private $join_date;
    private $birthday;

    function set_user($username,$password,$email,$join_date,$birthday){
        $this->username = $username;
        $this->password = $password;
        $this->email    = $email;
        $this->join_date= $join_date;
        $this->birthday = $birthday;
    }

    function validate_user(){
        $u_lenght = strlen($this->username);

        //Username valid
        if( $u_lenght > 24 || $u_lenght < 3)  {
            return 1;
        }else if(!preg_match("/^[a-zA-Z0-9_-]{3,24}$/",$this->username)){
            return 2;
        }
        //Password valid
        if($this->password < 8)  {
            return 3;
        }
        //Email valid
        if(!preg_match("/^[\p{L}0-9_]+[\p{L}0-9_]+([-_+.'][\p{L}0-9_]+)*@[\p{L}0-9_]+([-_.][\p{L}0-9_]+)*\.[\p{L}0-9_]+([-._][\p{L}0-9_]+)*$/",$this->email))  {
            return 3;
        }


    }



    function test(){
        echo $this->email;
    }
}


//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Start
    $user = new user;
    /*$user->set_user($_POST['username'],
                    $_POST['password'],
                    $_POST['email'],
                    $_POST['join_date'],
                    $_POST['birthday']
                    );*/
    $user->set_user("_a_",
    "aaaa", 
    "aaaaaaaa", 
    "aaaa", 
    "aaaa");                
    $user->test();
    $user->validate_user();
/*}else{

}*/






?>