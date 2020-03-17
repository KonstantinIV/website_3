import React from "react";
import ajaxApi from "../helpers/ajaxApi";

import Post from "./post";
import Threads from "./threads";







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
    ajaxApi("indexPage","GET",params, posts => {
       

        this.setState({
          posts : JSON.parse(posts)
        });

        console.log(typeof(this.state.posts[0].likes))
     
      
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

