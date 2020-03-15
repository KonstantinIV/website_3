import React from "react";
import parse from 'html-react-parser';


export default class Post extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      username: "",
    };
  
  }

timeElapsed(date){
  


  let seconds = ((new Date() - new Date(date)) / 1000); 

  let bool = seconds >= 0 ? 1 : 0;
  seconds = seconds >= 0 ? seconds : -1*seconds  ;

  let interval = Math.floor(seconds / 31556952); //year


 //console.log((new Date() / 1000));

  
  
  

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



  render() {
    
    
   
     var elapsedReleaseDate = 1;
    
     

    return (
        
        <div className="post_cont" data-id = {this.props.post.postID}>
            <div className="post_header">{this.props.post.title}</div> 
            <div className="post_user">By 
                <a href={"profile/"+this.props.post.username}> {this.props.post.username}</a>
                <span className="usernameDot" >&nbsp;&nbsp;&nbsp;  </span>
                <span className="createdDate" date={this.props.post.createdDate}>{this.timeElapsed(this.props.post.createdDate)} </span>
            </div> 

            <div className="column_2">
                    <div className="text_cont">
                      
                        {parse(this.props.post.text)}
                    </div>
                    <div className="date_cont">
                            <div className="post_date_2">
                            <span className="releaseDate" date={this.props.post.releaseDate}>{this.timeElapsed(this.props.post.releaseDate)} </span> 
                            </div>
                    </div>
        </div>

      <div className="post_buttons">
          <div className="like_button" id="likeButton">
              <img className="likeImage" src="content/img/greenEmpty.svg" alt="arrow" />
          </div> 
                    
          <div className="di_li_cont">
              <div className="likes">{this.props.post.likes}</div>
              <div className="">&#9679;</div>
              <div className="dislikes" >{this.props.post.dislikes}</div>
          </div>


              <div className="dislike_button" id="dislikeButton">
                <img className="dislikeImage" src="content/img/redEmpty.svg" alt="arrow" />
              </div>
      
                
                <a className="commentLinkButton" href={"comment/"+this.props.post.ID} >
                    <div className="comment_button">COMMENTS</div>
                </a>
        </div>

        <div className="starVoteContainer">
            <div className="">
            </div>


            <div className="starVoteStats">
                <div className="starVoteCount">{this.props.post.starVoteCount}</div>&nbsp; votes
            </div>

            <div class="starVoteWall"> 
                <div className="starVoteWallLock">
                  <div className="starVoteWallImage"><img  src="content/img/lock.svg" alt="icon" /></div>
               </div>
            </div>

        </div>
</div>


    );
  }
}

