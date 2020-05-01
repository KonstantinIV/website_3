import React from "react";
import ProfileHeader from "../head/firstBar/navFirstBar";


export default class Profile extends React.Component {
  constructor(props) {
    super(props);
 

    this.state = {
      username: "",
      activeTab : "Stats"
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
      tab = <ProfileStats  username={this.props.username} />
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
        username: "",
      };
    
  
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
        <div class="other_inf">Joindate</div>

    </div>            
</div>

<div class="user_stats">
    <div class="total_user_post">
        <div class="exp">Total posts</div>
        <div class="val">2</div>
    </div>
    <div class="total_user_comment">
        <div class="exp">Total comments</div>
        <div class="val">2</div>
    </div>
    <div class="total_user_like">
        <div class="exp">Total likes</div>
        <div class="val">2</div>
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

  render() {
      return (
 

<div class="dash_stats">

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