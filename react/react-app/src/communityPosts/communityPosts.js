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
      timeInterval : "",
      endOfResults : false
    };
  this.getPosts( ()=>{});


    this.changeOrder = this.changeOrder.bind(this);
    this.changeStatus = this.changeStatus.bind(this);

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
      search   : this.state.search
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


  render() {
    return (
<div>
  <Header  order={this.state.order} status={this.state.status} changeOrder={ this.changeOrder} changeStatus={this.changeStatus}/>


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

