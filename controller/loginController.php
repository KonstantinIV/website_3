<?php 
class loginController extends mainController{


    function __construct($param){
       parent::__construct("",$param);
       $this->loginMetaData();
    }

    function loginMetaData(){
        $this->view->name      = "Log in" ;
        $this->view->logged_in =  false ;
        $this->view->body      = "login";
        $this->view->render()           ;
    }




    static function login(){
        $model = new userModel();
        

    }

    function register(){

    }

    



}
    
?>