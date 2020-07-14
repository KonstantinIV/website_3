import React from "react";
import ProfileHeader from "../head/firstBar/navFirstBar";
import ajaxApi from "../helpers/ajaxApi";
import $ from 'jquery';
import { useState } from 'react';

import ReactQuill from 'react-quill';
import 'react-quill/dist/quill.snow.css';

export default class User extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      
      userAdmin : this.props.match.params.username === this.props.username ? true : false,
      activeTab : "Profile"
    };
  
    this.changeTab = this.changeTab.bind(this);
    //this.userAdmin.bind(this);
   
   
  }
 
  
changeTab(tab){
 
  this.setState({
    activeTab : tab
  })
}



  render() {
    
    
    let tab = "Stats";
    if(this.state.activeTab === "Profile"){
      tab = <UserProfile  username={this.props.match.params.username} userAdmin={this.state.userAdmin}/>
    }else if(this.state.activeTab === "Settings" ){
      tab = <UserSettings username={this.props.match.params.username } userAdmin={this.state.userAdmin}/>
    }else if(this.state.activeTab === "Posts"){
      tab = <UserPosts username={this.props.match.params.username} userAdmin={this.state.userAdmin}/>
    } else if(this.state.activeTab === "Notifications"){
      tab = <UserNotifications username={this.props.match.params.username} userAdmin={this.state.userAdmin}/> 
    } else if(this.state.activeTab === "Threads"){
      tab = <UserThreads username={this.props.match.params.username} userAdmin={this.state.userAdmin}/> 
    }
   
    return (
    <div>
<ProfileHeader loginUser={this.props.loginUser} 
userLoggedIn={this.props.userLoggedIn} 
username={this.props.username} />
<ProfileTabs activeTab={this.state.activeTab} userAdmin={this.state.userAdmin} changeTab={this.changeTab}/>

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
    let tabs = this.props.userAdmin ? ["Profile", "Posts","Threads","Notifications","Settings"] : ["Profile", "Posts","Threads"];
      return (
        <div className="profileMenuTabsContainer">

        {tabs.map(element => (
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


class UserProfile extends React.Component {
    constructor(props) {
      super(props);
   
  
      this.state = {
        avatarPath : "/content/img/defaultAvatar.jpg",
        joinDate: "",
        totalPosts : 0,
        totalComments : 0,
        totalLikesReceived : 0,

        


      };
      
      this.getProfileData(()=>{
        
      });
    
    this.getAvatarPath();
  }

  getAvatarPath(){
    let params = {username : this.props.username};
    ajaxApi("/Avatar","GET",params, (result,status) => {
        if(status ){
            if(result !== "0"){
              this.setState({
                avatarPath : "/i/"+this.props.username+"."+result
              })
            }
            
        }
      
    
  })
  }

    getProfileData(){
      let params = {user : this.props.username};
      ajaxApi("/User","GET",params, (result,status) => {
        
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
        <div class="picture"><img class="image" src={this.state.avatarPath} alt="owl" /></div>

    </div>
    <div class="username_cont">
        <div class="username">{this.props.username} 


       {!this.props.userAdmin ? <UserProfileFollowButton username={this.props.username}/> : ""}
        
        </div>

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
class UserProfileFollowButton extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      following : false,
        
        unfollowHover : false
    };
    this.getFollowerData(this.props.username);
    this.unfollowHover = this.unfollowHover.bind(this);
   
  }
  getFollowerData(username){
    let params = {username : username};
    ajaxApi("/Follower","GET",params, (result,status) => {
      if(status){
        this.setState({
          following : true
        })
      }
      
    
      
    
  })
  }
      followUser(username){
        let params = {username : username};
        ajaxApi("/Follower","POST",params, (result,status) => {
          if(status){
            this.setState({
              unfollowHover : true,
              following : true
            })
          }
          
        
          
        
      })
      }
  
      unfollowUser(username){
        let params = {username : username};
        ajaxApi("/follower","DELETE",params, (result,status) => {
          if(status){
            this.setState({
              following : false,
              unfollowHover : false,
            })
          }
          
        
          
        
      })
      }
   unfollowHover() {
     if(this.state.following){
      this.setState({
        unfollowHover : !this.state.unfollowHover
      })
     }
   
  }
  render() {
    return (




    <div className={"profileFollowButton "+ (this.state.following ?"profileFollowed"  :""  )}   
    onClick={this.state.following ? () => this.unfollowUser(this.props.username) : () => this.followUser(this.props.username)}
    onMouseEnter={this.unfollowHover}
    onMouseLeave={this.unfollowHover}>
      {this.state.unfollowHover ? "Unfollow?" : this.state.following ? "Following" : "Follow"}
      
      </div> 
   
    )
  }
}

class UserSettings extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      avatarPath : "/content/img/defaultAvatar.jpg",
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
    let params = {username : this.props.username};
    ajaxApi("/Avatar","GET",params, (result,status) => {
        if(status ){
            if(result !== "0"){
              this.setState({
                avatarPath : "/i/"+this.props.username+"."+result
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
        
        this.sendAvatar(formData,(result,status) => {
          if(!status){
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
      
      url: "/Avatar",
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
    ajaxApi("/User","PUT",params, (result,status) => {
      if(!status){
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
      ajaxApi("/User","PUT",params, (result,status) => {
        if(!status){
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
 

<div class="userSettingsContainer">

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
class UserPosts extends React.Component {
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
    this.createPost = this.createPost.bind(this);
    this.getUserPosts( ()=>{});
  }
  getUserPosts(){
    let params = {
 
      limit    : this.state.limit,
      profile  : 1
            };
    ajaxApi("/Post","GET",params, (posts,status) => {
      if(posts.length < 5){
        this.setState( {
          endOfResults : true
          
        });
      }
      let postsCopy = this.state.posts.concat(posts);

      this.setState( {
        posts : postsCopy ,
        limit: this.state.limit + 5
      });
    /*   let postsCopy = {};
      posts.map((post) =>{
        postsCopy[post.postID] = post;
      })
      
        this.setState( {
          posts : Object.assign({},this.state.posts, postsCopy) ,
          limit: this.state.limit + 5
        });
        */
        
        //console.log(typeof(this.state.posts[0].likes))
     
      
    });
  }

  deletePost(postID,index){
    let params = {postID : postID}
    console.log(postID);
    
    
    ajaxApi("/Post","DELETE",params, (result,status) => {
      if(status){
        this.setState(prevstate => {
          
          let objCopy = prevstate.posts;
          delete objCopy[index];
    
          return objCopy;
         
        });
      }
    });
  }
  onScroll(){
    if(!this.state.scrolled ){
      if ((window.innerHeight + window.scrollY+20) >= document.body.offsetHeight) {
        //console.log(this.state.scrolled);
          this.setState({
        scrolled : !this.state.scrolled
      })
      
        
      //  console.log(window.innerHeight + window.scrollY);
      //  console.log(document.body.offsetHeight);
        
        this.getUserPosts( () => {
           console.log(2);
            this.setState({
              scrolled : !this.state.scrolled
            })
  
         
      
  
      });
  }
  }
  }
  createPost(thread,title,text,day,month,year){
    let params = {
      thread : thread,
      title : title,
      text : text,
      day : day,
      month: month,
      year : year
    }
    ajaxApi("/Post","POST",params, (result,status) => {
     if(status){
      this.setState(prevstate => {
        
          
            
         
        let objCopy = prevstate.posts;
        objCopy.unshift({ID: result.ID,
          title: title,
          upvotes: 0,
          downvotes: 0,
          comments: 0});
        
  
        return objCopy;
       
      });
     }
   });


  }

  render() {
      return (
 

<div class="dash_post_cn" onWheel={ () => this.onScroll()}>

{this.props.userAdmin ? 

<CreatePost createPost={this.createPost} /> :""}
 

 {this.state.posts.map( (post,index) => (
  <ProfilePost key={post.ID} index={index} post={post} ID={post.ID} username={this.props.username} deletePost={this.deletePost}/>

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
        this.props.deletePost(this.props.ID,this.props.index);
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

class UserNotifications extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      username: "",
      messages: []
    };
  this.getMessages(()=>{});

  }
  getMessages(){
    let params = {
      
    }
    ajaxApi("/userMessage","GET",params, (result,status) => {
     
      this.setState( {
        
  
         messages : result
       
      });
     
     
   });
  }

  render() {
      return (
 

<div class="dash_post_cn">
    
      {this.state.messages.map(message => (
          <ProfileMessage key={message.ID} message={message} />
      ))}
   
</div>

  
      )
    }
}
class ProfileMessage extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      username: "",
    };
  

  }

  redirectToUserProfile(username){
    window.location.href = "/profile/"+username;
  }

  render() {
      return (
 
<div className={"profileMessageContainer" + (this.props.message.isRead === 1 ? "profileMessageIsRead" : "")}>

      <div className="profileMessage">
        <div className="profileMessageUsername" onClick={() => this.redirectToUserProfile(this.props.message.username)}>{this.props.message.username}</div> has followed you.
          
      </div>

</div>
      )
    }
}


















class UserThreads extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      username: "",
      limit :0,
      endOfResults : false,
      threads: [],
      scrolled:false,
    };
    //this.deletePost = this.deletePost.bind(this)
    //this.getUserThreads( ()=>{});
    this.createThread = this.createThread.bind(this);
    this.getUserThreads();
  }
  getUserThreads(){
    let params = {};
    ajaxApi("/thread","GET",params, threads => {
      this.setState( {
          threads : threads
          
        });
      
      
       
        //console.log(typeof(this.state.posts[0].likes))
     
      
    });
  }


  createThread(threadTitle,threadDescription){
    let params = {
      threadTitle : threadTitle,
      threadDescription : threadDescription
    };
   ajaxApi("/Thread","POST",params, (result,status) => {
     if(status){
      this.setState(prevstate => {
        
        let objCopy = prevstate.threads;
        objCopy.unshift({dateCreated: "2020-05-28 09:20:36",
        followers: 0,
        title: threadTitle});
        
  
        return objCopy;
       
      });
     }
   });
  }

  render() {
      return (
 

<div class="dash_post_cn">

{//this.props.username ? 

//<a href="edit">
     //<div class="dash_post">
        // <div class="add_post_plus">&#10010;</div>
    // </div>
 //</a> :""
}
 {this.props.userAdmin ? 

<CreateThread createThread={this.createThread}/> :""}
 {this.state.threads.map(thread => (
  <ProfileThread key={thread.title}  thread={thread}  username={this.props.username} />

 ))}

 
            
          

    
 
     
 </div>
 

      )
    }
}
class ProfileThread extends React.Component {
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
redirectToThread(ID){
    window.location.href = "/thread/"+ID;
}

  render() {
      return (
        <div class="dash_thread" onClick={() => this.redirectToThread(this.props.thread.title)}>
          <div className="profileThreadTitleContainer">
          <div className="profileThreadTitle">  
              {this.props.thread.title}

            </div>
            <div className="profileThreadDateCreated">
              {this.props.thread.dateCreated}
            </div>
          </div>
           
            <div className="profileThreadFollwers">
            {this.props.thread.followers} followers
            </div>
       </div>

  
      )
    }
}


class CreateThread extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      threadTitle : "",
      
      threadDescription : ""

    };
  
    
  }
  threadTitleInput(event){
    this.setState({
         threadTitle : event.target.value
    })
   }
   threadDescriptionInput(event){
    this.setState({
         threadDescription : event.target.value
    })
   }


   
  render() {
    return (
      <div class="profileCreateThread" >

          <div className="profileCreateThreadTitleContainer">
                <div className="profileCreateThreadTitleTag">
                      Title
                </div>
               
                 <input autocomplete="off" className="profileCreateThreadTitle" type="text" name="name"  onInput={(e) => this.threadTitleInput(e)}/>
                
          </div>
          

          <div className="profileCreateThreadDescriptionContainer">
                <div className="profileCreateThreadTitleTag">
                  Description
                </div>
                
           <textarea className="profileCreateThreadDescription" type="text" name="name" value={this.state.threadDescription} onInput={(e) => this.threadDescriptionInput(e)}/>
               
          </div>

          <div className="profileCreateThreadButtonContainer">
              
                <div className="profileCreateThreadButton" onClick={() => this.props.createThread(this.state.threadTitle,this.state.threadDescription)}>
                  Create
                </div>
          </div>

     </div>


    )
  }

}


class CreatePost extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      thread : "",
      postTitle : "",
      
      postText : "",

      day:1,
      month : 1,
      year   : 2019
    };
   // const [value, setValue] = useState('');
   this.handleQuillChange = this.handleQuillChange.bind(this);
    this.changeDay = this.changeDay.bind(this);
  }
  postTitleInput(event){
    this.setState({
         postTitle : event.target.value
    })
   }
   postThreadInput(event){
    this.setState({
         thread : event.target.value
    })
   }


   dateList(){

   }
   handleQuillChange(value) {
    this.setState({
      postText : value
 })
   } 

   changeDay(event) {
    this.setState({
     day : event.target.value
 })
   } 
   changeMonth(event) {
    this.setState({
     month : event.target.value
 })
   }
   changeYear(event) {
    this.setState({
     year : event.target.value
 })
   }
  

  render() {
   
    return (
      <div class="profileCreateThread" >
      <div className="profileCreateThreadTitleContainer">
            <div className="profileCreateThreadTitleTag">
                  Thread
            </div>
           
             <input autocomplete="off" className="profileCreateThreadTitle" type="text" name="name"  onInput={(e) => this.postThreadInput(e)}/>
            
      </div>
      <div className="profileCreateThreadTitleContainer">
            <div className="profileCreateThreadTitleTag">
                  Title
            </div>
           
             <input autocomplete="off" className="profileCreateThreadTitle" type="text" name="name"  onInput={(e) => this.postTitleInput(e)}/>
            
      </div>
      <div className="profileCreateThreadDateContainer">
            <div className="profileCreateThreadTitleTag">
                  Date of the event/release
            </div>
           
            <select  class=" date day" value={this.state.day} onChange={this.changeDay.bind(this)} > 
            {//this.dateList()
             Array.apply(null, Array(31)).map((item,index) => (
                <option key={index+1} value={index+1}>{index+1}</option>
            ))
            }
            
            
          </select>
          <select  class=" date month"  value={this.state.month} onChange={this.changeMonth.bind(this)} >
            {//this.dateList()
             Array.apply(null, Array(12)).map((item,index) => (
                <option value={index+1}>{index+1}</option>
            ))
            }
          
            
          </select>

          <select  class=" date year"  value={this.state.year} onChange={this.changeYear.bind(this)}>
          {//this.dateList()
             Array.apply(null, Array(100)).map((item,index) => (
              <option value={index+2019}>{index+2019}</option>
          ))
          }
           </select>
            
      </div>
      
      
      <div className="profileCreateThreadDescriptionContainer">
            <div className="profileCreateThreadTitleTag">
              Description
            </div>
            
            <ReactQuill theme="snow" value={this.state.postText} onChange={this.handleQuillChange} />           
      </div>

      <div className="profileCreateThreadButtonContainer">
          
            <div className="profileCreateThreadButton" onClick={() => this.props.createPost(this.state.thread,this.state.postTitle,this.state.postText,this.state.day,this.state.month,this.state.year)}>
              Create
            </div>
      </div>

 </div>
      



    )
  }

}