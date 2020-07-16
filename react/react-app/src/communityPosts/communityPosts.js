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
      thread       : this.props.match.params.threadName ? this.props.match.params.threadName : "",     //Thread
      search       : "",
      interval : "DAY",
      intervalInt : 24,
      endOfResults : false,
      searchType   : "posts",
      searchBool   : false
    };
  this.getPosts( ()=>{});


    this.changeOrder = this.changeOrder.bind(this);
    this.changeStatus = this.changeStatus.bind(this);
    this.searchPosts = this.searchPosts.bind(this);
    this.changeInterval = this.changeInterval.bind(this);
    this.changeSearchType = this.changeSearchType.bind(this);
    
    
    //this.isLoggedIn();
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

        
    ajaxApi("/Post","GET",params, (result,status) => {
      if(status){
        if(result.length < 10){
          this.setState( {
            endOfResults : true
          });
        }
       let postsCopy = this.state.posts.concat(result);

        this.setState( {
          posts : postsCopy,
          limit: this.state.limit + 10
        });
        
        callback();
        //console.log(typeof(this.state.posts[0].likes))
      }else{
        this.setState( {
          endOfResults : true
        });
      }
      
    });
  }   
  }
  getThreads( callback) {
    this.setState({
      posts : [{title:"name", followers:0},{title:"name", followers:0},{title:"name", followers:0},{title:"name", followers:0},{title:"name", followers:0},{title:"name", followers:0}]
    })
    return false;
    let params = {
      limit    : this.state.limit,
      search   : this.state.search
      
            };

     if(!this.state.endOfResults){

        
    ajaxApi("threads","GET",params, threads => {
      if(threads.length < 10){
        this.setState( {
          endOfResults : true
        });
      }
       let threadsCopy = this.state.threads.concat(threads);

        this.setState( {
          threads : threadsCopy,
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

changeSearchType(searchType){
  if(searchType.toLowerCase() !== this.state.searchType){

  
  this.setState({
    searchType : searchType.toLowerCase(),
    status: false,
    order: "hot",
    posts : [],
    endOfResults : false,
    limit : 0
  },
  () => ( this.state.searchType === "threads" ? this.getThreads(()=>{}) :  this.getPosts(()=>{})   ))
  ;
}
}

searchPosts(search){
  if(search !== ""){

  
  this.setState({
    search: search,
    searchBool : true,
    status: false,
    order: "hot",
    posts : [],
    endOfResults : false,
    limit : 0
  },() => this.getPosts(()=>{}));
  }
}


  render() {
    return (
<div>
  <Header 
  userLoggedIn={this.props.userLoggedIn} 
  loginUser={this.props.loginUser}
  username = {this.props.username} 
  order={this.state.order} 
  status={this.state.status} 
  interval={this.state.interval}
  searchType={this.state.searchType}
  searchBool={this.state.searchBool}

  changeInterval={this.changeInterval}
  changeOrder={ this.changeOrder} 
  changeStatus={this.changeStatus} 
  changeSearchType={this.changeSearchType}

  searchPosts={this.searchPosts}
  
  />


<div id="mn_cont" class="main_cont" onWheel={ () => this.onScroll()}>
      <div class="pop_post_cont">
{console.log(this.state.posts)}

{this.state.searchType === "posts" ? <ThreadTitle key={this.state.thread} threadName={this.state.thread}/> :""}

{ this.state.posts.map(item => (
  
  this.state.searchType === "posts" ? <Post post={item} /> : <Thread thread={item} />
 
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


class ThreadTitle extends React.Component {
  constructor(props) {
    super(props);
  }
  render(){
    return(
      <div class="indexPageThreadTitleContainer">
          
          <div class="indexPageThreadTitle">
          {this.props.threadName ? this.props.threadName : "All"}

      </div>
      </div>
    )
  }
}
class Thread extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      username: "",
      

    };
  

  }


redirectToThread(ID){
    window.location.href = "/thread/"+this.props.thread.title;
}

  render() {
      return (
        <div class="mainThreadcontainer" onClick={() => this.redirectToThread(this.props.threadID)}>
          <div className="mainThreadTitleContainer">
          <div className="mainThreadTitle">  
              {this.props.thread.title}

            </div>
    
          </div>
           
            <div className="mainThreadFollwers">
            {this.props.thread.followers} followers
            </div>
       </div>

  
      )
    }
}