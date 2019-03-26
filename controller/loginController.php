<?php 
namespace src\controller;
class loginController extends mainController {


    function __construct($input){
       parent::__construct("");
       $this->setPageDataVariables("Login", "login" , $input  );
       $this->renderView();
    }

  




}
    
?>