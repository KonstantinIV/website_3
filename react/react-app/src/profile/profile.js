import React from "react";
import ProfileHeader from "../head/firstBar/navFirstBar";
import ajaxApi from "../helpers/ajaxApi";
import $ from 'jquery';
export default class Profile extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      username: "",
     
      activeTab : "Posts"
    };
  
    this.changeTab = this.changeTab.bind(this);
    
  }

changeTab(tab){
 
  this.setState({
    activeTab : tab
  })
}



  render() {
    let tab = "Stats";
    if(this.state.activeTab === "Stats"){
      tab = <ProfileStats  username={this.props.username}/>
    }else if(this.state.activeTab === "Profile"){
      tab = <ProfileProfile username={this.props.username} />
    }else if(this.state.activeTab === "Posts"){
      tab = <ProfilePosts username={this.props.username}/>
    } else if(this.state.activeTab === "Notifications"){
      tab = <ProfileNotifications /> 
    }

    return (
    <div>
<ProfileHeader loginUser={this.props.loginUser} 
userLoggedIn={this.props.userLoggedIn} 
username={this.props.username} />
<ProfileTabs activeTab={this.state.activeTab} changeTab={this.changeTab}/>

{tab}

</div>
    );
  }
}

class ProfileTabs extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      username: "",
    };
  

  }

  render() {
      return (
        <div className="profileMenuTabsContainer">

        {["Stats","Profile", "Posts","Notifications","Settings"].map(element => (
            <ProfileTab activeTab={this.props.activeTab === element ? true : false} changeTab={this.props.changeTab} tabName={element}/>
          ))}
     
          
        </div>
      )
  }
}

class ProfileTab extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      username: "",
    };
  

  }

  render() {
      return (
 
    <div className={this.props.activeTab ? "profileMenuTab profileMenuTabActive" : "profileMenuTab"   } onClick={() => this.props.changeTab(this.props.tabName)}>
                    {this.props.tabName}
              </div>

  
      )
    }
}


class ProfileStats extends React.Component {
    constructor(props) {
      super(props);
   
  
      this.state = {
        joinDate: "",
        totalPosts : 0,
        totalComments : 0,
        totalLikesReceived : 0

      };
    
      this.getProfileData();
    }

    getProfileData(){
      let params = {user : this.props.username};
      ajaxApi("user","GET",params, result => {
        
        this.setState({
          joinDate: result.joinDate,
          totalPosts : result.totalPosts,
          totalComments : result.totalComments,
          totalLikesReceived : result.totalLikesReceived
        })
        
      
    })
    }

    render() {
        return (
   

<div class="dash_stats">
<div class="user_profile">
    <div class="user_picture">
        <div class="picture"><img class="image" src="content/img/owl.PNG" alt="owl" /></div>

    </div>
    <div class="username_cont">
        <div class="username">{this.props.username}</div>
        <div class="other_inf">Joined {this.state.joinDate}</div>

    </div>            
</div>

<div class="user_stats">
    <div class="total_user_post">
        <div class="exp">Total posts</div>
        <div class="val">{this.state.totalPosts}</div> 
    </div>
    <div class="total_user_comment">
        <div class="exp">Total comments</div>
        <div class="val">{this.state.totalComments}</div>
    </div>
    <div class="total_user_like">
        <div class="exp">Total likes</div>
        <div class="val">{this.state.totalLikesReceived}</div>
    </div>


    


</div>


</div>

    
        )
      }
}


class ProfileProfile extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      avatarPath : "content/img/defaultAvatar.jpg",
      emailText : "",
      password1 : "",
      password2 : "",
      oldPassword : "",

      avatarMessage : "",
      emailMessage  : "",
      passwordMessage : ""
    };
  
    this.getAvatarPath();
  }

  getAvatarPath(){
    let params = {};
    ajaxApi("avatar","GET",params, result => {
        if(result ){
            if(result !== "0"){
              this.setState({
                avatarPath : "i/"+this.props.username+"."+result
              })
            }
            
        }
      
    
  })
  }

  changeAvatar(){
    var input = document.getElementById("inputImageSettings");
    var url = document.getElementById("inputImageSettings").value;
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& (ext == "PNG" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
     {
        var reader = new FileReader();

        reader.onload = function (e) {
          document.getElementById('outputImageSettings').src =  e.target.result;
        }
       reader.readAsDataURL(input.files[0]);
       
       
       
    }
    else
    {
      this.setState({
        avatarMessage:"Wrong extension"
      })
      //document.getElementById('outputImageSettings').src =  'content/img/defaultAvatar.jpg';
    }

  }
  
  saveAvatar(){
    
        let formData = new FormData();
        formData.append('image', document.getElementById("inputImageSettings").files[0]);
        
        this.sendAvatar(formData,result => {
          if(!result.flag){
            this.setState({
              avatarMessage: result.message
            })
          }
        });

        //console.log(formData);
        //console.log(document.getElementById("inputImageSettings").files[0]);
        


         
  }
  sendAvatar(formData, callback){
    $.ajax({
      
      url: "avatar",
      method: "POST",
      contentType: false,
      data : formData,
      processData: false,
      success : function(result){
        callback(JSON.parse(result));
        
      }
    });
  }

  changeEmail(){
    let params = {email : this.state.emailText};
    ajaxApi("user","PUT",params, result => {
      if(!result.flag){
        this.setState({
          emailMessage: result.message
        })
      }
    
  
})
  }
  changePassword(){
    if(this.state.password1 !== this.state.password2){
      this.setState({
        passwordMessage: "Passwords do not match"
      })
      return false;
    }else if(this.state.password1.length < 8 || this.state.oldPassword.length < 8){
      this.setState({
        passwordMessage: "The password is too short"
      })
      return false;
    }
    let params = {
      password1 : this.state.password1,
      password2 : this.state.password2,
      oldPassword :this.state.oldPassword,
      change      : "pass"  
    };
      ajaxApi("user","PUT",params, result => {
        if(!result.flag){
          this.setState({
            passwordMessage: result.message
          })
        }
    
      })
  }
   


  password1Input(event){
    this.setState({
         password1 : event.target.value
    })
   }
   password2Input(event){
    this.setState({
         password2 : event.target.value
    })
   }oldPasswordInput(event){
    this.setState({
         oldPassword : event.target.value
    })
   }emailInput(event){
    this.setState({
         emailText : event.target.value
    })
   }


  render() {
      return (
 

<div class="profileSettingsContainer">

<div class="blockContainerSettings">


    <div class="blockSettings avatarSettings">
    <div class="blockSettingsHeader">Avatar</div>

    <img class="outputImageSettings" id="outputImageSettings" src={this.state.avatarPath} alt=""/>

    <input type="file"  id="inputImageSettings" class="inputImageSettings" onChange={() => this.changeAvatar()}/>
    <div  class=" inputImageButtonSettings">
    <label for="inputImageSettings" class="buttonSettings " style={{"display" : "inline-block"}} >Change</label>
    <div class="buttonSettings " style={{"display" : "inline-block"}} id="avatarButtonSettings" onClick = {() => this.saveAvatar()}>Save</div>

</div>
      <div className="settingsErrorMessage">{this.state.avatarMessage}</div>

    </div>


    <div class="blockSettings avatarSettings">
    <div class="blockSettingsHeader">Email</div>
    <label class="labelSettings">Email:</label>
    <input type="text"  id="inputEmailSettings" class="inputSettings" value={this.state.emailText} onInput={(e) => this.emailInput(e)}/>
    <div class="buttonSettings" style={{"display" : "inline-block"}} id="emailButtonSettings" onClick={() => this.changeEmail()}>Save</div>
    <div className="settingsErrorMessage">{this.state.emailMessage}</div>
    </div>


    <div class="blockSettings">
    <div class="blockSettingsHeader">Password</div>

    <label class="labelSettings">Old password</label>
    <input type="text" type="password"  id="oldPasswordSettings" class="inputSettings" onInput={(e) => this.oldPasswordInput(e)}/>

    <label class="labelSettings">New password</label>
    <input type="text" type="password"  id="1newPasswordSettings" class="inputSettings" onInput={(e) => this.password1Input(e)}/>
    
    <label class="labelSettings">New password again</label>
    <input type="text" type="password"  id="2newPasswordSettings" class="inputSettings" onInput={(e) => this.password2Input(e)}/>

    <div class="buttonSettings" id="passwordButtonSettings" onClick={() => this.changePassword()}>Save</div>
    <div className="settingsErrorMessage">{this.state.passwordMessage}</div>
    </div>
 
</div>








</div>

  
      )
    }
}
class ProfilePosts extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      username: "",
      limit :0,
      endOfResults : false,
      posts: [],
      scrolled:false,
    };
    this.deletePost = this.deletePost.bind(this)
    this.getUserPosts( ()=>{});
  }
  getUserPosts(){
    let params = {
 
      limit    : this.state.limit,
      profile  : 1
            };
    ajaxApi("indexPage","GET",params, posts => {
      if(posts.length < 5){
        this.setState( {
          endOfResults : true
          
        });
      }
      
       
       let postsCopy = {};
      posts.map((post) =>{
        postsCopy[post.postID] = post;
      })
      
        this.setState( {
          posts : Object.assign({},this.state.posts, postsCopy) ,
          limit: this.state.limit + 5
        });
        
        
        //console.log(typeof(this.state.posts[0].likes))
     
      
    });
  }

  deletePost(postID){
    let params = {postID : postID}
    console.log(postID);
    
    
    ajaxApi("indexPage","DELETE",params, result => {
      if(result.flag){
        this.setState(prevstate => {
          
          let objCopy = prevstate.posts;
          delete objCopy[postID];
    
          return objCopy;
         
        });
      }
    });
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
        
        this.getUserPosts( () => {
           console.log(2);
            this.setState({
              scrolled : !this.state.scrolled
            })
  
         
      
  
      });
  }
  }
  }

  render() {
      return (
 

<div class="dash_post_cn" onWheel={ () => this.onScroll()}>

{this.props.username ? 

<a href="edit">
     <div class="dash_post">
         <div class="add_post_plus">&#10010;</div>
     </div>
 </a> :""}
 

 {Object.keys(this.state.posts).map((id,index) => (
  <ProfilePost key={id} post={this.state.posts[id]} postID={id} username={this.props.username} deletePost={this.deletePost}/>

 ))
            
          }

    
 
     
 </div>
 

      )
    }
}
class ProfilePost extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      username: "",
      delete : "Delete",

    };
  

  }

  deletePrompt(e){
    if(this.state.delete === "Sure?"){
        this.props.deletePost(this.props.postID);
    }else{
      this.setState({
        delete : "Sure?"
      })
      e.target.style.background = "#F44336";
      e.target.style.color        = "#36274b";
    }
    
}
  render() {
    console.log(((this.props.post.upvotes*100) /(this.props.post.upvotes + this.props.post.downvotes))+"%");
      return (
        <div class="dash_post">
        <div class="userPostContentContainer">
                <div class="dash_post_title">{this.props.post.title}</div>
                <div class="dash_post_score">
                <div class="userPostsScore">
                    <div class="green_score">{this.props.post.upvotes}</div>
                                <div class="userPostsDot">&#9679;</div>
              
                    <div class="red_score">{this.props.post.downvotes}</div>
                    </div>
         <div className="di_li_bar">
                <div className="di_li_bar_green" style={{width : (( parseInt(this.props.post.upvotes)*100) /(parseInt(this.props.post.upvotes) + parseInt(this.props.post.downvotes)))+"%"}}></div>
                <div className="di_li_bar_red"></div>
            </div>
                </div>
                
    
    
    
    
                <div class="settings">
         <div class="comments_score dashPostButton"><a href="" ><div class="buttonContainerProfile"><div class="buttonContainerProfileText">{this.props.post.comments} comments</div> </div></a></div>
                    
     
                    {this.props.username ? 
                        <div class="dashPostButton visit" onClick={(e) => this.deletePrompt(e)}>{this.state.delete}</div>
                    : ""}
                </div>
    
    
                
            </div>
    
    
      
    </div>

  
      )
    }
}

class ProfileNotifications extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      username: "",
    };
  

  }

  render() {
      return (
 

<div class="dash_stats">

</div>

  
      )
    }
}

