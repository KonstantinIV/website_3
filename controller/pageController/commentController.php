<?php
namespace src\pageController\controller;

class commentController extends mainController implements pageInterface{
    
    function __construct($input){
        parent::__construct("commentModel");
        $this->setPageDataVariables("Comments", "comment" , $input  );

        print_r($this->pageData);
        $this->indexGetContent();
        print_r($this->pageData);
        $this->renderView();
    }

    function indexGetContent(){
        
        $this->model->inputData['postID']     = $this->pageData['inputData'];
        $this->pageData['outputData']['postData']      = $this->model->getSinglePost()[0];

        $this->pageData['outputData']['commentData']      = $this->model->getCommentid();
        
    }

    function indexBody(){
        
        
    }

    



}


?>
