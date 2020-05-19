import React from "react";
import parse from 'html-react-parser';
import ajaxApi from "../helpers/ajaxApi";
import $ from 'jquery';


export default class Post extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      upvoted: (this.props.post.livoted === "1") ? true : false,
      downvoted : (this.props.post.divoted === "1") ? true : false,

      upvotes : parseInt(this.props.post.likes),
      downvotes : parseInt(this.props.post.dislikes),

      createdDateHover : false,
      releaseDateHover : false,

      expandText : false,
      starVoteHover : false,

      starVotedPoints : this.props.post.starVoted,
      starVotes : this.props.post.starVotes
    };
    console.log(this.props.post);
  
  }

timeElapsed(date){
  let seconds = ((new Date() - new Date(date)) / 1000); 

  let bool = seconds >= 0 ? 1 : 0;
  seconds = seconds >= 0 ? seconds : -1*seconds  ;
  //console.log(this.props.post);
  let interval = Math.floor(seconds / 31556952); //year
  if (interval > 1) {
    return bool ? interval + " years ago" : "in " + interval + " years";
  }
  interval = Math.floor(seconds / 2592000);
  if (interval > 1) {
    return bool ? interval + " months ago" : "in " + interval + "months";
    
  }
  interval = Math.floor(seconds / 86400);
  if (interval > 1) {
    return bool ? interval + " days ago" : "in " + interval + "days";
  }
  interval = Math.floor(seconds / 3600);
  if (interval > 1) {
    return bool ? interval + " hours ago" : "in " + interval + "hours";
  }
  interval = Math.floor(seconds / 60);
  if (interval > 1) {
    return bool ? interval + " minutes ago" : "in " + interval + "minutes";
  }
  return bool ? interval + " seconds ago" : "in " + interval + "seconds";

}

vote(ID,postType,e){
let boolVoted ;
let element = e.target;
let type    = (element.classList.contains("like_button") || element.classList.contains("likeImage")) ? true : false;
 
if(type){
    boolVoted = this.state.upvoted;
}else{
     boolVoted = this.state.downvoted;

}
  
  let voteType = type ? "likes" : "dislikes";

  let params = {
                ID : ID,
                voteType : voteType,
                postType : postType, //comment/post
                boolVoted   : this.state.class
  };

 ajaxApi("vote",boolVoted ? "DELETE" : "POST",params, result => {

  if(result){
    if(type){
      this.setState({
        upvoted: boolVoted ? false : true ,
        upvotes :  (boolVoted ? this.state.upvotes -1 : this.state.upvotes + 1)
      })
    }else{
      this.setState({
        downvoted: boolVoted ? false : true,
        downvotes :  (boolVoted ? this.state.downvotes  -1 : this.state.downvotes  + 1)

      })
    }
  }else{ 
    $("#loginPopupCont").css("visibility", "visible");
    console.log("aaa");
  }
  
});
       




}
toggleReleaseDate(){
  this.setState({
    releaseDateHover : !this.state.releaseDateHover
  });
  //e.target.append(' <div class="box">   '  +new Date(date)+'   </div>');
}
toggleCreatedDate(){
  this.setState({
    createdDateHover : !this.state.createdDateHover
  });
  //e.target.append(' <div class="box">   '  +new Date(date)+'   </div>');
}


preciseDate(date){
  let preciseDate = new Date(date).toString();;
  return preciseDate;
}
expandText(){
  this.setState({
    expandText : true
  })
}




sendStarVote(ID,points){
  console.log("dds");
  let params = {ID : ID,
                points : points}
  ajaxApi("starVote","POST",params, result => {
    if(result.flag){
      this.setState({
        starVotedPoints : points
      })
      if(!result.voted){
        this.setState({
          starVotes : this.state.starVotes+1
        })
      }
    }   
  
    
 
  
});
}




  render() {
    return (
        
        <div className={this.state.expandText ? "post_cont expand_text " : "post_cont"}  data-id = {this.props.post.postID}>
            <div className="post_header">{this.props.post.title}</div> 
            <div className="post_user">By 
                <a href={"/profile/"+this.props.post.username}> {this.props.post.username}</a>
                <span className="usernameDot" >&nbsp;&nbsp;&nbsp;  </span>
    <span className="createdDate" date={this.props.post.createdDate} onMouseEnter={ () => this.toggleCreatedDate()} onMouseLeave={ () => this.toggleCreatedDate()}>  <div class={this.state.createdDateHover ? "box show" : "box"}> { this.preciseDate(this.props.post.createdDate)}  </div> {this.timeElapsed(this.props.post.createdDate)} </span>
            </div> 

            <div className="column_2">
                    <div className={this.state.expandText ? "text_cont expand_text " : "text_cont text_contHover"} onClick={() => this.expandText()}>
                      
                        {this.props.post.text ? parse(this.props.post.text) : ""}
                    </div>
                    <div className="date_cont">
                            <div className="post_date_2">
                            <span className="releaseDate" date={this.props.post.releaseDate} onMouseEnter={ () => this.toggleReleaseDate()} onMouseLeave={ () => this.toggleReleaseDate()}> <div class={this.state.releaseDateHover ? "box show" : "box"}> {this.preciseDate(this.props.post.releaseDate)}  </div> {this.timeElapsed(this.props.post.releaseDate)} </span> 
                            </div>
                    </div>
        </div>

      <div className="post_buttons">

        {!(this.props.post.releaseDate > new Date()) ? 
          <div className={"like_button"} id="likeButton" onClick={(e) => this.vote(this.props.post.ID,"post",e)}>
              <img className="likeImage" src={this.state.upvoted  ?  "/content/img/greenFull.svg" : "/content/img/greenEmpty.svg" } alt="arrow" />
            </div>

        : 

            <div class="upvoteWall"> 
                <div className="upvoteWallLock">
                  <div className="upvoteWallImage"><img  src="/content/img/lock.svg" alt="icon" /></div>
               </div>
             </div> 

        }

          
                    
          <div className="di_li_cont_main">

            <div className="di_li_cont">
              <div className="likes">{this.state.upvotes}</div>
              <div className="">&#9679;</div>
              <div className="dislikes" >{this.state.downvotes}</div>
            </div>
            
            <div className="di_li_bar">
                <div className="di_li_bar_green" style={{width : ((this.state.upvotes*100) /(this.state.upvotes + this.state.downvotes))+"%"}}></div>
                <div className="di_li_bar_red"></div>
            </div>

          </div>

          {!(this.props.post.releaseDate > new Date()) ? 
              <div className="dislike_button" id="dislikeButton" onClick={(e) => this.vote(this.props.post.ID,"post",e)}>
                <img className="dislikeImage" src={this.state.downvoted  ?  "/content/img/redFull.svg" : "/content/img/redEmpty.svg"} alt="arrow" />
              </div>

            : 

            <div class="upvoteWall"> 
                <div className="upvoteWallLock">
                  <div className="upvoteWallImage"><img  src="/content/img/lock.svg" alt="icon" /></div>
              </div>
            </div> 

            } 
      
                
                <a className="commentLinkButton" href={"/comment/"+this.props.post.ID} >
                    <div className="comment_button">COMMENTS</div>
                </a>
        </div>

        <div className="starVoteContainer">
        <div class="starVoteBar">
          
          {[1,2,3,4,5].map(element => (
          <StarVote 
          ID={this.props.post.ID} 
          avgPoints={this.props.post.points} 
          starVotes={this.props.post.starVotes} 
          
          starVoted={(Math.floor(this.props.post.points) >= element) ? true : false} 
          starVoteSingle={((Math.floor(this.props.post.points)+1) === element) ? true : false} 
          userVoted={(this.state.starVotedPoints >= element) ? true : false}
          voteInteger={element}
          onClick={() =>this.sendStarVote(this.props.post.ID,element)}
          />       
))}
        

              
            </div>


            <div className="starVoteStats">
                <div className="starVoteCount">{this.state.starVotes}</div>&nbsp; votes
            </div>


            {(this.props.post.releaseDate > new Date()) ? "" : 
            
            <div class="starVoteWall"> 
                <div className="starVoteWallLock">
                  <div className="starVoteWallImage"><img  src="/content/img/lock.svg" alt="icon" /></div>
               </div>
              
            </div>
          }
        </div>
</div>


    );
  }
}

class StarVote extends React.Component {
constructor(props) {
  super(props);


  this.state = {
    starVoteHover : false

  };
  //console.log();
}


toggleStarvote(){

  this.setState({
    starVoteHover : !this.state.starVoteHover
  })

}
starVoteDescription(i){
  let messages = [
'Most of it was wrong',
'Some  of it was true',
'Half of it was true',
'More than half of it was true',
'Most of it was true'

  ]
  return messages[i-1];
}

render(){
  let classList = "starVote "+(this.props.starVoted ? "starVoteGreen ": "starVoteDarkGreen ")+(this.props.userVoted ? "starVoted ": " ");
  let background = 'linear-gradient(to right, #21d251 '+( 20 * (this.props.avgPoints - Math.floor(this.props.avgPoints)))+'px, #2e5639 0px)';
  let styleVote       =  {background: background};
  
  return (

<div class={classList} 
  style={this.props.starVoteSingle ? styleVote:{} }
  onMouseEnter={ () => this.toggleStarvote()} 
  onMouseLeave={ () => this.toggleStarvote()}
  onClick={this.props.onClick}
  >
  
      <div class={this.state.starVoteHover ?"starVoteTextBox show" :"starVoteTextBox"}>
      {this.starVoteDescription(this.props.voteInteger)}
      </div> 
 </div>

  )
}
}