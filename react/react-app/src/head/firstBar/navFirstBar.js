import React from 'react';
import search from '../../img/search.svg';
import arrowDown from '../../img/dsign.svg';
import ajaxApi from "../../helpers/ajaxApi";
import notifications from '../../img/notifications.svg';
import iconSite from '../../img/iconSite.svg';

export default class NavFirstBar extends React.Component {
    constructor(props) {
        super(props);
     
        this.state = {
                searchText : "",
                

        };
   
      }


searchInput(event){
 this.setState({
     searchText  : event.target.value
 })
}



render(){

    return(
        <div className="navMainBar">
            
            <div className="navIconContainer">
                <div className="navIconImageContainer">
                    <img className="navIcon" src={iconSite} alt="icon" />
                </div>
                <a className="navIconText" href="/">
                    NAVICONTEXT
                </a>
            </div>
            <div className="navSearchContainer">
                    <input className="navSearchInput" type="text" name="name" autocomplete="off"  value={this.state.searchText} onInput={(e) => this.searchInput(e)}/>
                <div className="navSearchButton" onClick={() => this.props.searchPosts(this.state.searchText)}>
                    <img className="navSearchIcon" src={search} alt="icon"/>
                </div>

            </div>
            
            {!this.props.userLoggedIn ?  <LoginContainer loginUser={this.props.loginUser}/>: <UserDropdownMenu username={this.props.username} loginUser={this.props.loginUser}/> }
           



        </div>
    )
}




}

class LoginContainer extends React.Component{
    constructor(props) {
        super(props);
     
        this.state = {
                showLoginForm      : false,
                showRegisterForm      : false

        };
   this.showLoginForm = this.showLoginForm.bind(this);
   this.showRegisterForm = this.showRegisterForm.bind(this);

      }
      showLoginForm(){
        this.setState({
            showLoginForm : !this.state.showLoginForm
        })
    }
    showRegisterForm(){
        this.setState({
            showRegisterForm : !this.state.showRegisterForm
        })
    }

    render(){
        return(
            <div className="navLoginContainer">
                <div className="navLoginButton" onClick={() => {this.showLoginForm(); this.setState({showRegisterForm : false})} } >
                LOGIN
                </div>
                {this.state.showLoginForm ? <LoginForm closeForm={this.showLoginForm} loginUser={this.props.loginUser}/> : ""}
                <div className="navRegisterButton" onClick={() => {this.showRegisterForm() ; this.setState({showLoginForm : false})} }>
                    SIGN UP
                </div>
                {this.state.showRegisterForm ? <RegisterForm closeForm={this.showRegisterForm} loginUser={this.props.loginUser}/> : ""}



            </div>
        )
    }

}

class LoginForm extends React.Component{
    constructor(props) {
        super(props);
     
        this.state = {
                usernameText : "",
                passwordText : "",
                loginErrorMessage : ""

        };
        
      }
      usernameInput(event){
        this.setState({
            usernameText  : event.target.value
        })
       }
       passwordInput(event){
        this.setState({
            passwordText  : event.target.value
        })
       }
       onLogin(){
        let params = {
            username : this.state.usernameText,
            password : this.state.passwordText
           };
        ajaxApi("/Session","POST",params, (result,status) => {
          //  console.log( result);
        if(status){
                this.props.loginUser(this.state.usernameText);
                this.props.closeForm();
                window.location.href = "/";
        }else{
            
            this.setState({
                loginErrorMessage : result.errorMessage
            })
            
        }
          
        })
            
        
       }




    render(){
        return(
            <div className="formContainerBorder">
                <div className="formContainer">
                    <div className="closeLoginForm">
                        <div className="closeButton" onClick={()=> this.props.closeForm()}>
                                x
                        </div>
                    </div>
                    <div className="formTitle">
                        LOGIN
                    </div>
                    <div class="loginErrorMessage">
                            {this.state.loginErrorMessage}
                    </div>
                    <div className="formLogin">
                        <div className="usernameInputContainer">
                            <input className="usernameInput" placeholder="Username" value={this.state.usernameText} onInput={(e) => this.usernameInput(e)}></input>
                        </div>
                        <div className="passwordInputContainer">
                            <input type="password" className="passwordInput" placeholder="Password" value={this.state.passwordText} onInput={(e) => this.passwordInput(e)}></input>

                        </div>
                        <div className="loginButtonContainer">
                            <div className="loginButton" onClick={() => this.onLogin()}>
                                    LOGIN
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        )
    }

}

class RegisterForm extends React.Component{
    constructor(props) {
        super(props);
     
        this.state = {
                emailText     : "", 
                usernameText : "",
                passwordText : "",
                passwordTextSecond : "",
                registerErrorMessage : ""

        };
   
      }
      usernameInput(event){
        this.setState({
            usernameText  : event.target.value
        })
       }
       passwordInput(event){
        this.setState({
            passwordText  : event.target.value
        })
       }
       passwordInputSecond(event){
        this.setState({
            passwordTextSecond  : event.target.value
        })
       }
       emailInput(event){
        this.setState({
             emailText : event.target.value
        })
       }

       onRegister(){
           if(!this.validateUsername(this.state.usernameText)){
               this.setState({
                   registerErrorMessage : "Invalid username"
               })

           }else if(!this.validateEmail(this.state.emailText)){
            this.setState({
                registerErrorMessage : "Invalid email"
            })
           }else if(!this.validatePassword(this.state.passwordText)){
            this.setState({
                registerErrorMessage : "Password must be atleast 8 characters long"
            })
           }else if(this.state.passwordText !== this.state.passwordTextSecond){
            this.setState({
                registerErrorMessage : "Passwords do not match"
            })
        }else{
            let params = {
                username : this.state.usernameText,
                password : this.state.passwordText,
                email    : this.state.emailText
            }
            ajaxApi("/registerU","POST",params, result => {
                if(!result.flag){
                    this.setState({
                        registerErrorMessage : result.message
                    })
                }else{
                    this.props.loginUser(this.state.usernameText);
                    this.props.closeForm()
                }
              
            })
        }

       }

       validateEmail(email){
        if(email.includes("@") || email !== ""){
            return true
        }
        return false
       }
       validatePassword(password){
        if(  password.length < 8 || typeof password != 'string' || password === "")  {
            return false;
         }
         return true;
    }
    validateUsername(username){
        if( username.length > 24 || username.length < 3 || typeof username != 'string')  {
            return false;
        }
        return true;
       
    }

    
   


    render(){
        return(
            <div className="formContainerBorder">
                <div className="formContainer">
                    <div className="closeLoginForm">
                        <div className="closeButton" onClick={()=> this.props.closeForm()}>
                                x
                        </div>
                    </div>
                    <div className="formTitle">
                        REGISTER
                    </div>
                    <div class="loginErrorMessage">
                            {this.state.registerErrorMessage}
                    </div>
                    <div className="formLogin">
                        <div className="usernameInputContainer">
                            <input className="usernameInput" placeholder="Username" value={this.state.usernameText} onInput={(e) => this.usernameInput(e)}></input>
                        </div>
                        <div className="usernameInputContainer">
                            <input className="usernameInput" placeholder="Email" value={this.state.emailText} onInput={(e) => this.emailInput(e)}></input>

                        </div>
                        <div className="passwordInputContainer">
                            <input className="passwordInput" type="password" placeholder="Password" value={this.state.passwordText} onInput={(e) => this.passwordInput(e)}></input>

                        </div>
                        <div className="passwordInputContainer">
                            <input className="passwordInput" type="password" placeholder="Password" value={this.state.passwordTextSecond} onInput={(e) => this.passwordInputSecond(e)}></input>

                        </div>
                        <div className="loginButtonContainer">
                            <div className="loginButton" onClick={ () => this.onRegister()}>
                                    SIGN UP
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        )
    }

}
class UserDropdownMenu extends React.Component{
    constructor(props) {
        super(props);
     
        this.state = {
              userDropdownMenu : false,
              messages : [],
              isRead  : true
        };
        this.getMessages();
      }
      getMessages(){
        let params = {
          
        }
        ajaxApi("/userMessage","GET",params, result => {
         
            let isRead = result[0].isRead === 1 ? true : false ;
          this.setState( {
            
            isRead : isRead,
             messages : result
            
          });
         
         
       });
      }

      dropdown(){
          this.setState({
              userDropdownMenu : !this.state.userDropdownMenu
          })
      }
  
    render(){
        return(
            
           <div className="userOptionsContainer">
            <div className="navNotifications">
                {this.state.isRead ? <div className="navNotificationDOT"></div> : ""}
                <img src={notifications} alt="" />
            </div>

               <div className="userOptionsUsernameContainer" onClick={() => this.dropdown()}>
                    <div className="userOptionsUsername">{this.props.username}
                    </div>
                    <img className="arrowDown arrowOptions" src={arrowDown} alt="icon"/>
               </div>



               {this.state.userDropdownMenu ? <UserDropdownMenuList username={this.props.username} loginUser={this.props.loginUser}/>: ""}

              
           </div>
        )
    }

}
class UserDropdownMenuList extends React.Component{



    logoutUser(){
        let params = {};
        ajaxApi("/Session","DELETE",params, (result,status) => {
            if(status){
                document.cookie = "PHPSESSID" +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                this.props.loginUser("");
                
                window.location.href = "/";
            }
          
        })
    }


    render(){
        return(
        <div className="userOptionsList">
            <div className="userOption"><a href={"/user/" + this.props.username}>Profile</a></div>
            <div className="userOption">Create Post</div>
            <div className="userOption" onClick={() => this.logoutUser()}>Log Out</div>
       </div>
        )
    }
}