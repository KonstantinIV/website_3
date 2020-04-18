import React from "react";
import ajaxApi from "../helpers/ajaxApi";

import Post from "./post";
import Threads from "./threads";
import Header from "../head/Header";






export default class communityPosts extends React.Component {
  constructor(props) {
    super(props);
 
    this.myRef = React.createRef();
    this.state = {
      posts: [],
      scrolled:false,

      order : "hot",     //hot,new,top
      limit :0,

      status : false,    //show posts only that have released
      thread       : "",     //Thread
      search       : "",
      interval : "DAY",
      intervalInt : 24,
      endOfResults : false,




      userLoggedIn : false,
      username     : ""
    };
  this.getPosts( ()=>{});


    this.changeOrder = this.changeOrder.bind(this);
    this.changeStatus = this.changeStatus.bind(this);
    this.searchPosts = this.searchPosts.bind(this);
    this.changeInterval = this.changeInterval.bind(this);

    this.loginUser = this.loginUser.bind(this);
    
    this.isLoggedIn();
  }
  isLoggedIn(){
    let params = {};
    ajaxApi("islogged","GET",params, result => {
      if(!result.flag){
        this.setState({
          userLoggedIn : false

        })
      }else{
        this.setState({
          userLoggedIn : true,
          username     : result.username
        })
      }
    
  })
  }

  loginUser(username){
    this.setState({
      userLoggedIn : !this.state.userLoggenIn,
      username : username
    })
  }
  

  // sortType = hot,new, top
  // thread   = thread
  // filterVote = star/upvotes
  // search   = search
  
  getPosts( callback) {
    let params = {
      thread : this.state.thread,
      sortType : this.state.order,
      status : this.state.status,
      limit    : this.state.limit,
      search   : this.state.search,
      interval : this.state.intervalInt
            };

     if(!this.state.endOfResults){

        
    ajaxApi("indexPage","GET",params, posts => {
      if(posts.length < 10){
        this.setState( {
          endOfResults : true
        });
      }
       let postsCopy = this.state.posts.concat(posts);

        this.setState( {
          posts : postsCopy,
          limit: this.state.limit + 10
        });
        
        callback();
        //console.log(typeof(this.state.posts[0].likes))
     
      
    });
  }   
  }

onScroll(){
  if(!this.state.scrolled ){
    if ((window.innerHeight + window.scrollY+20) >= document.body.offsetHeight) {
      console.log(this.state.scrolled);
        this.setState({
      scrolled : !this.state.scrolled
    })
    
      
      console.log(window.innerHeight + window.scrollY);
      console.log(document.body.offsetHeight);
      
      this.getPosts( () => {
         console.log(2);
          this.setState({
            scrolled : !this.state.scrolled
          })

       
    

    });
}
}
}

changeStatus(element){
  let status = (element === "RELEASED") ? true : false; 
  console.log(status);

  if(this.state.status !== status){
  


  this.setState({
    status : status,
    posts : [],
    endOfResults : false,
    limit : 0
  },
  
  () => this.getPosts(()=>{}));

}
  
  //console.log(this.state.order);s
}


changeOrder(order){
  if(this.state.order !== order.toLowerCase()){

 
  this.setState({
    order : order.toLowerCase(),
    posts : [],
    endOfResults : false,
    limit : 0
  },() => this.getPosts(()=>{}))
  ;
}
  //console.log(this.state.order);
}

changeInterval(interval){
  let intervalInt ;

  switch (interval) {
    case "DAY":
      intervalInt = 24;
      break;
    case "WEEK":
      intervalInt = 168;
      break;
    case "MONTH":
      intervalInt = 730;
      break;
    case "YEAR":
      intervalInt = 8760;
      break;
    case "ALL":
      intervalInt = 20000;
      break;
    
  }

  
 
  this.setState({
    interval : interval,
    intervalInt : intervalInt,
    posts : [],
    endOfResults : false,
    limit : 0
  },() => this.getPosts(()=>{}))
  ;
  //console.log(this.state.order);
}

searchPosts(search){
  this.setState({
    search: search,
    status: false,
    order: "hot",
    posts : [],
    endOfResults : false,
    limit : 0
  },() => this.getPosts(()=>{}));

}


  render() {
    return (
<div>
  <Header 
  userLoggedIn={this.state.userLoggedIn} 
  loginUser={this.loginUser}
  username = {this.state.username} 
  order={this.state.order} 
  status={this.state.status} 
  interval={this.state.interval}
  changeInterval={this.changeInterval}
  changeOrder={ this.changeOrder} 
  changeStatus={this.changeStatus} 
  searchPosts={this.searchPosts}
  
  />


<div id="mn_cont" class="main_cont" onWheel={ () => this.onScroll()}>
      <div class="pop_post_cont">
{console.log(this.state.posts)}
{ this.state.posts.map(item => (
  
  <Post post={item} />
 
))}
{this.state.endOfResults ? <NoResults /> : ""}
     
      </div>
<Threads />



</div>
</div>

    );
  }
}

class NoResults extends React.Component {



  render(){
    return(
      <div class="post_cont">
          <div class="finalResult">
            No more resuslts
          </div>
        </div>
    )
  }
}

