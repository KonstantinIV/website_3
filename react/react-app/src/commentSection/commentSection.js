import React from "react";
import  useParams from "react";
import CommentHeader from "../head/firstBar/navFirstBar";
import Post from "../communityPosts/post";
import ajaxApi from "../helpers/ajaxApi";
export default class CommentSection extends React.Component {
    constructor(props) {
      super(props);
      //let { id } = useParams();a
      this.state = {
       post : []
      };

      this.getPost( ()=>{});
      
    }

    getPost(){
        let params = {
           postID: this.props.match.params.id
                  };
        ajaxApi("/indexPage","GET",params, post => {
            this.setState({
                post : post
            })
        })
    }
    render(){
        //console.log(this.state.post[0]);
        return(

          <div>
            <CommentHeader loginUser={this.props.loginUser} userLoggedIn={this.props.userLoggedIn}
              searchPosts={this.props.searchPosts}
              username={this.props.username} />

            <div id="mn_cont" class="comment_main_cont" >
              <div class="pop_post_cont">



                {this.state.post.map(item => (

                  <Post post={item} />

                ))}



              </div>
             
             

              <Comments username={this.props.username} postID={this.props.match.params.id} />


            </div>




          </div>
        )
    }
}




class Comments extends React.Component {
    constructor(props) {
        super(props);
        //let { id } = useParams();a
        this.state = {
         comments : [],
         commentsSorted : [],
        };
  
        this.getComments( ()=>{

        });
       // this.commentRecursive = this.commentRecursive.bind(this);
       // this.rec(5);
       this.addComment = this.addComment.bind(this);
      }
      
          rec(int){
              console.log("its " + int) 
              if(0 < int){
                 this.rec(int - 1)
    
              }
          }
        
     
      getComments(){
          let params = {
            postID : this.props.postID,
          };
        ajaxApi("/commentutility","GET",params, comments => {
           
            this.commentRecursive(0,0,comments);
               
                this.setState({
                    commentsSorted :this.commentsSorted
                })
                //console.log(this.state.commentsSorted);
            
        })
      }
commentsSorted = [];
commentsSorted2 = [];
color = false;
commentRecursive(parentID,leftMargin,assoArray){
    for (var ID in assoArray) {
        
        if(parseInt(  assoArray[ID]["parent_id"]) === parentID){
            //console.log("match");
           
            //console.log(assoArray[ID]["parent_id"]);
            this.commentsSorted[ID] = assoArray[ID];

            let comment = assoArray[ID];
            comment["marginLeft"] = leftMargin*20;
            comment["color"] = !this.color;
            this.color = !this.color;
            comment["ID"] = ID;
            if( parentID === 0){
             comment["newLine"] = true;
          }else{
             comment["newLine"] = false;

          }
            this.commentsSorted.push(comment);
            
            //this.commentsSorted[ID]["marginLeft"] = leftMargin*20;
            //this.commentsSorted[ID]["color"] = !color;
            //this.commentsSorted2.push(comment);
           // console.log(this.commentsSorted2);

            //console.log("leftMargin " + leftMargin*20);
            //commentsSorted[ID] =  assoArray[ID];
            //console.log(ID);
            this.commentRecursive(parseInt(ID),leftMargin+1,assoArray);
           // return commentsSorted;
          
        }

    }


}
addComment(ID,text,postID,username,color,marginLeft,newLine,parentID,newComment){
  let comment = 
    {ID: ID,
      color : !color,
      createdDate : new Date(),
      dislikes : "0",
      divoted: "0",
      likes:"0",
      livoted:"0",
      marginLeft: 20 + marginLeft,
      newLine : newLine,
      parent_id : parentID,
      text      : text,
      username  : this.props.username,
      postID    : this.props.postID
      }
  ;


 
  this.setState(prevstate => {
    let commentsCopy = prevstate.commentsSorted;
    {newComment ?     commentsCopy.splice(this.state.commentsSorted.indexOf(newComment ) + 1,0,comment) :    commentsCopy.splice(0,0,comment) }
    return commentsCopy;
})
}  
render(){
        //console.log(this.state.commentsSorted);
          return (
            <div class="comment_section">
              {console.log(this.state.commentsSorted)}
  {this.props.username ? 
              <CommentPost  
              
              addComment={this.addComment} 
              username={this.props.username} 
              
              postID={this.props.postID}/> : ""}

            {this.state.commentsSorted.map(comment => (
          

     <Comment key={comment.ID} addComment={this.addComment} comment={comment} ID={comment.ID} postID={this.props.postID}/>
 )
 )}
            
       
 
              </div>
          )
      }

}
class CommentPost extends React.Component {
  constructor(props) {
      super(props);
      //let { id } = useParams();a
      this.state = {
       text : "",
       commentsSorted : [],
      };

    

      };
      postCommentReply(){
        let params = {
           postID: this.props.postID,
           parentID : 0,
           usernmae : this.props.username,
           text     : this.state.text
                  };
        ajaxApi("/commentutility","POST",params, result => {
          if(result.flag){
    
            this.props.addComment(result.commentID,this.state.text,this.props.postID,this.props.username,true,-20,true,0);
            this.setState({
              text  : ""
    
            })
          }
        })
    }
      textInput(event){
        this.setState({
            text  : event.target.value
        })
       }
      render(){
        return (
          <div class="commentReplyContainer">
          <div class="replyText">
              <textarea class="replyTextarea" value={this.state.text} onInput={(e) => this.textInput(e)}> </textarea>
          </div>
          <div class="commentReplyButton" onClick={() => this.postCommentReply()}>
                Reply
          </div>
      </div>
        )
      }
    }

class Comment extends React.Component{
    constructor(props) {
        super(props);
        //let { id } = useParams();a
        this.state = {
            upvoted: (this.props.comment.livoted === "1") ? true : false,
            downvoted : (this.props.comment.divoted === "1") ? true : false,

            createdDateHover : false,
            commentReply : false,

            upvotes : parseInt(this.props.comment.likes),
            downvotes :  parseInt(this.props.comment.dislikes),

        };
  
       
        this.toggleCommentReply = this.toggleCommentReply.bind(this);
        
      }

      vote(ID,postType,e){
        let boolVoted ;
        let element = e.target;
        let type    = (element.classList.contains("comment_like_button") || element.classList.contains("likeImage")) ? true : false;
         
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
        
         ajaxApi("/vote",boolVoted ? "DELETE" : "POST",params, result => {
        
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
            console.log("aaa");
          }
          
        });
               
        
        
        
        
        }
        timeElapsed(date){
          let seconds = ((new Date() - new Date(date)) / 1000); 
        
          let bool = seconds >= 0 ? 1 : 0;
          seconds = seconds >= 0 ? seconds : -1*seconds  ;
          //console.log(this.props.comment);
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
          return "now";
        
        }
        preciseDate(date){
          let preciseDate = new Date(date).toString();;
          return preciseDate;
        }
        toggleCreatedDate(){
          this.setState({
            createdDateHover : !this.state.createdDateHover
          });
          //e.target.append(' <div class="box">   '  +new Date(date)+'   </div>');
        } 
        toggleCommentReply(){
          this.setState({
            commentReply : !this.state.commentReply
          });
          //e.target.append(' <div class="box">   '  +new Date(date)+'   </div>');
        } 

      
      render(){
        let styleMargin = {"margin-left" : this.props.comment.marginLeft + "px",
                           "background-color" : (!this.props.comment.color ? "#22143c" : ""),
                            "margin-top"     :   (this.props.comment["newLine"] ? "20px": ""),};
        
          return(
              
                  <div class="comment" style={styleMargin} >

                      <div class="comment_user">
                          <div class="user">
                              <a href="">{this.props.comment.username}</a>
                          </div>
                    
                    <span className="createdDate" date={this.props.comment.createdDate} onMouseEnter={() => this.toggleCreatedDate()} onMouseLeave={() => this.toggleCreatedDate()}>
            <div class={this.state.createdDateHover ? "box show" : "box"}> {this.preciseDate(this.props.comment.createdDate)}  </div> {this.timeElapsed(this.props.comment.createdDate)} 
            </span>


                      </div>

                      <div class="comment_text">{this.props.comment.text}</div>
                      <div class="comment_buttons">

                          <div class="comment_like_button" id="clikeButton" onClick={(e) => this.vote(this.props.ID,"comment",e)}><img class="likeImage" src={this.state.upvoted  ?  "/content/img/greenFull.svg" : "/content/img/greenEmpty.svg" } /></div>





                              <div class="comment_di_li_cont">
                                  <div class="comment_likes">{this.state.upvotes}</div>
                                  <div class="">&#9679;</div>
                                  <div class="comment_dislikes">{this.state.downvotes}</div>
                              </div>
                              <div class="comment_dislike_button" id="cdislikeButton" onClick={(e) => this.vote(this.props.ID,"comment",e)}><img class="dislikeImage" src={this.state.downvoted  ?  "/content/img/redFull.svg" : "/content/img/redEmpty.svg"} /></div>


                                  <div class="comment_comment_button" id="replyComment" onClick={() => this.toggleCommentReply()}>REPLY &#10095;</div>
                              </div>

                          {this.state.commentReply ? <CommentReply toggleCommentReply={this.toggleCommentReply} comment={this.props.comment} addComment={this.props.addComment} username={this.props.username} ID={this.props.ID} postID={this.props.postID}/>: ""}
                          </div>

                    
                      
                      
          )
      }
}

class CommentReply extends React.Component {
  constructor(props) {
    super(props);
    //let { id } = useParams();a
    this.state = {
     text : ""
    };

    //console.log(this.props.postID)
  }
  postCommentReply(){
    let params = {
       postID: this.props.postID,
       parentID : this.props.ID,
       usernmae : this.props.username,
       text     : this.state.text
              };
    ajaxApi("/commentutility","POST",params, result => {
      if(result.flag){

        this.props.addComment(result.commentID,this.state.text,this.props.postID,this.props.username,this.props.comment.color,this.props.comment.marginLeft,false,this.props.comment.ID,this.props.comment);
        this.setState({
          text  : ""

        })
        this.props.toggleCommentReply();
      }
    })
}
textInput(event){
  this.setState({
      text  : event.target.value
  })
 }
  render(){
    return (
      <div class="commentReplyContainer">
          <div class="replyText">
              <textarea class="replyTextarea" onInput={(e) => this.textInput(e)}> </textarea>
          </div>
          <div class="commentReplyButton" onClick={() => this.postCommentReply()}>
                Reply
          </div>
      </div>
    )
  }
}