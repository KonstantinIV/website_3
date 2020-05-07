import React from "react";
import ProfileHeader from "../head/firstBar/navFirstBar";
import ajaxApi from "../helpers/ajaxApi";
import $ from 'jquery';
export default class Profile extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      username: "",
     
      activeTab : "Profile"
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
      tab = <ProfileProfile />
    }else if(this.state.activeTab === "Posts"){
      tab = <ProfilePosts />
    } else if(this.state.activeTab === "Notifications"){
      tab = <ProfileNotifications /> 
    }else if(this.state.activeTab === "Settings"){
      tab = <ProfileSettings />
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
      username: "",
    };
  

  }
  changeAvatar(){
    var input = document.getElementById("inputImageSettings");
    var url = document.getElementById("inputImageSettings").value;
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& ( ext == "png" || ext == "jpeg" || ext == "jpg")) 
     {
        var reader = new FileReader();

        reader.onload = function (e) {
          document.getElementById('outputImageSettings').src =  e.target.result;
        }
       reader.readAsDataURL(input.files[0]);
       
       
       
    }
    else
    {
      document.getElementById('outputImageSettings').src =  'content/img/defaultAvatar.jpg';
    }

  }
  
  saveAvatar(){
    
        let formData = new FormData();
        formData.append('image', document.getElementById("inputImageSettings").files[0]);
        
        
        console.log(formData);
        console.log(document.getElementById("inputImageSettings").files[0]);
        $.ajax({
      
          url: "avatarSettings",
          method: "POST",
          contentType: false,
          data : formData,
          processData: false,
          success : function(result){
            console.log(result);
          }
        });


         
  }

  render() {
      return (
 

<div class="profileSettingsContainer">

<div class="blockContainerSettings">


    <div class="blockSettings avatarSettings">
    <div class="blockSettingsHeader">Avatar</div>

    <img class="outputImageSettings" id="outputImageSettings" src="content/img/defaultAvatar.jpg" alt=""/>

    <input type="file"  id="inputImageSettings" class="inputImageSettings" onChange={() => this.changeAvatar()}/>
    <div  class=" inputImageButtonSettings">
    <label for="inputImageSettings" class="buttonSettings " style={{"display" : "inline-block"}} >Change</label>
    <div class="buttonSettings " style={{"display" : "inline-block"}} id="avatarButtonSettings" onClick = {() => this.saveAvatar()}>Save</div>
</div>
    

    </div>


    <div class="blockSettings avatarSettings">
    <div class="blockSettingsHeader">Information</div>
    <label class="labelSettings">Email:</label>
    <input type="text"  id="inputEmailSettings" class="inputSettings" />
    <div class="buttonSettings" style={{"display" : "inline-block"}} id="emailButtonSettings">Save</div>
    </div>


    <div class="blockSettings">
    <div class="blockSettingsHeader">Password</div>

    <label class="labelSettings">Old password</label>
    <input type="text"  id="oldPasswordSettings" class="inputSettings" />

    <label class="labelSettings">New password</label>
    <input type="text"  id="1newPasswordSettings" class="inputSettings" />
    
    <label class="labelSettings">New password again</label>
    <input type="text"  id="2newPasswordSettings" class="inputSettings" />

    <div class="buttonSettings" id="passwordButtonSettings">Save</div>

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
    };
  

  }

  render() {
      return (
 

<div class="dash_stats">

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

class ProfileSettings extends React.Component {
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