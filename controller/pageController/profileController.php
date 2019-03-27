<?php
namespace src\pageController\controller;
class profileController extends mainController implements pageInterface{
    
    function __construct($input){
        parent::__construct("profileModel");
         $this->setPageDataVariables("Profile", "profile" , $input  );

         $this->pageData['inputData']['username']     = $_SESSION['user'];
         $this->setModelInputData("username",$this->pageData['inputData']['username'] );
        $this->pageData['outputData']['posts']     = $this->model->getUserPosts();
        $this->pageData['outputData']['postCount'] = $this->model->postCount();
        $this->pageData['outputData']['likeCount'] = $this->model->likeCount();
        $this->pageData['outputData']['commentCount'] = $this->model->commentCount();
        $this->pageData['outputData']['joinDate'] = $this->model->getUserJoinDate();
        print_r($this->pageData);
        
        $this->renderView();
        
    }

    



}


?>
