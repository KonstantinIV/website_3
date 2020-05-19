import React from "react";
import  useParams from "react";
import ProfileHeader from "../head/firstBar/navFirstBar";
import Post from "../communityPosts/post";
import ajaxApi from "../helpers/ajaxApi";
export default class CommentSection extends React.Component {
    constructor(props) {
      super(props);
      //let { id } = useParams();
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
        console.log(this.state.post[0]);
        return(

            <div>
<ProfileHeader loginUser={this.props.loginUser} />
<div id="mn_cont" class="main_cont" >
      <div class="pop_post_cont">



      { this.state.post.map(item => (
  
  <Post post={item} />  
 
))}

  
 
 




     
      </div>




</div>
           



            </div>
        )
    }
}