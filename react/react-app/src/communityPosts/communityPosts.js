import React, { useState } from "react";


import Post from "./post";
import Threads from "./threads";
import $ from 'jquery';


function  restApi(requestType, URL, callBack) {
  var data;
  var request = new XMLHttpRequest();

  request.open(requestType, URL, true);
  request.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded; charset=UTF-8"
  );
  request.send();
  request.onreadystatechange = function() {
    if (request.readyState === XMLHttpRequest.DONE) {
      data = JSON.parse(request.response);
      callBack(data);
    }
  }
}

function ajaxApi(params,callBack){
  $.ajax({
    
    url: "indexPage",
    method: "GET",
    success : callBack,
    data : params
  });
}

export default class communityPosts extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      posts: []
    };
  this.getUsers("","hot","",0,"");

  }

  // sortType = hot,new, top
  // thread   = thread
  // filterVote = star/upvotes
  // search   = search
  
  getUsers(thread,sortType,filterVote,limit,search ) {
    let params = {
      thread : thread,
      sortType : sortType,
      filterVote : filterVote,
      limit    : limit,
      search   : search
            };
    ajaxApi(params, posts => {
       

        this.setState({
          posts : JSON.parse(posts)
        });

       // console.log(this.state.posts)
     
      
    });
  }



  render() {
    return (

<div id="mn_cont" class="main_cont" >
      <div class="pop_post_cont">
{this.state.posts.map(item => (
  
   <Post post={item} />
  
))}
     
      </div>
<Threads />



</div>
    );
  }
}

