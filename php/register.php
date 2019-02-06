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
        

        //Username valid
        if( $this->username > 24 || $this->username < 3 || !is_string($this->username))  {
            return 1;
        }else if(!preg_match("/^[a-zA-Z0-9_-]{3,24}$/",$this->username)){
            return 2;
        }
        //Password valid
        if($this->password < 8 || !is_string($this->password))  {
            return 3;
        }
        //Email valid
        if(!preg_match("/^[\p{L}0-9_]+[\p{L}0-9_]+([-_+.'][\p{L}0-9_]+)*@[\p{L}0-9_]+([-_.][\p{L}0-9_]+)*\.[\p{L}0-9_]+([-._][\p{L}0-9_]+)*$/",$this->email) || !is_string($this->email))  {
            return 4;
        }
        //Birthday
        if(!is_numeric($this->birthday) || !(strlen((string)$this->birthday) == 8 ) )  {
            return 5;
        }
    }

    function pdo(){
            //data
            require_once "conf/conf.php";
            $dsn = "mysql:host=".DBHOST.";dbname=".DBNAME;
            $pdo = new PDO($dsn, DBUSER, DBPWD);
            if($pdo ){
                return $pdo;
            }else{
                return 6;
            }


           /* try{
                //Pdo object check if connection is success
                 $pdo = new PDO($dsn, DBUSER, DBPWD);
                 //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 return $pdo;
            }catch(\PDOException $e) {
                //throw new \PDOException($e->getMessage(), (int)$e->getCode());
                return 6;
            }*/
        }

    
    function validate_existing($pdo){
        $qr_exists = $pdo->prepare('select username from user WHERE username=? LIMIT 1');
        $qr_exists->execute([$this->username]);
        //Exists user
        if(!$qr_exists->fetchColumn()){
            return 7;
        }
        //Exists Email
        $qr_exists = $pdo->prepare('select email from user WHERE email=? LIMIT 1');
        $qr_exists->execute([$this->email]);
        if(!$qr_exists->fetchColumn()){
            return 8;
        } 
        
        
        }

    function create_user($pdo){
        
        $qr_insert = $pdo->prepare('insert into user 
        (
        username, 
        password,
        email,
        join_date,
        birthday
        )
        VALUES (
        ?,
        ?,
        ?,
        now(),
        now())
        ');

     if( !$qr_insert->execute([
            $this->username,
            $this->password,
            $this->email])){
                return 9;
            }
    $pdo = null;


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
    "aaa34a", 
    "aaa@aaa'a'a.com", 
    "12342890", 
    "12342891");                
    $user->validate_user();

    $pdo = $user->pdo();
    $user->validate_existing($pdo);
    $user->create_user($pdo);

    //$user->test();

/*}else{

}*/






?>