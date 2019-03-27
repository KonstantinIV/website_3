<?php 
namespace src\pageController\controller;
class loginController extends mainController implements pageInterface {


    function __construct($input){
       parent::__construct("");
       $this->setPageDataVariables("Login", "login" , $input  );
       $this->renderView();
    }

    function pageBody(){ 

    }

  




}
    
?>