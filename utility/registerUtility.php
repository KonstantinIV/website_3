<?php
class registerUtility extends mainLoginUtility{
    

    function __construct($data){
        parent::__construct();
        $this->model->data = $data; 
        $this->userCreated();
        

    }

    function userCreated(){
        if($this->model->userExists() == true){
            if($this->model->userValidate() == true){
                if($this->model->userCreate() == true){
                    return true;
                } 
            }   
        }
        return $this->model->errorCode;
            
        

       
    }


    

       
    



    
}



?>