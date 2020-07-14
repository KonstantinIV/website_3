import React from 'react';
import ReactDOM from 'react-dom';
import ajaxApi from "./helpers/ajaxApi";

import  {BrowserRouter as Router}  from 'react-router-dom';

import Switch   from 'react-router-dom/Switch';
//import  Router from 'react-router-dom/Router';
import   Route from 'react-router-dom/Route';

//import Header from './head/Header';
import CommunityPosts from './communityPosts/communityPosts';
import User from './user/user';
import CommentSection from './commentSection/commentSection';
import ErrorPage from './error/errorPage';
import * as serviceWorker from './serviceWorker';

class Main extends React.Component{
    constructor(props) {
        super(props);
        
    this.state = {
      userLoggedIn : false,
      username : ""
      };
      this.loginUser = this.loginUser.bind(this);
      this.clientData(() => {});

    }
    clientData(){
        let params = {};
    ajaxApi("/Session","GET",params, (result,status) => {
      //console.log(status);
      if(status){
      if(!result.isLoggedIn){
        this.setState({
          userLoggedIn : false

        })
    
      }else{
        this.setState({
          userLoggedIn : true,
          username     : result.username
        })

      }
    }
    
  })
    }
    loginUser(username){
      this.setState({
        userLoggedIn : !this.state.userLoggedIn,
        username : username
      })
    }
    render(){
     console.log(this.state.username);
      return(
      <Router>
      <div>
        

        {/* A <Switch> looks through its children <Route>s and
            renders the first one that matches the current URL. */}
        <Switch>
        <Route  path="/comments/:id/:title?" render={(props) => (<CommentSection  {...props} loginUser={this.loginUser} userLoggedIn={this.state.userLoggedIn} username={this.state.username}/>)}>
        
 </Route>
            
          <Route path="/user/:username" render={(props) =>   (<User {...props} key={this.state.username} username={this.state.username}  loginUser={this.loginUser} userLoggedIn={this.state.userLoggedIn} />)} >
            
           
          </Route>
          <Route path="/users">
          <div></div>
          </Route>

          
          <Route path="/:t?/:threadName?" render={(props) => (<CommunityPosts {...props} loginUser={this.loginUser}  userLoggedIn={this.state.userLoggedIn} username={this.state.username}/>)} />
          
          
         
        </Switch>
      </div>
    </Router>




        
        
        )
    }
}

//ReactDOM.render(<Header />, document.getElementById('header'));
ReactDOM.render(<Main />, document.getElementById('root'));


// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
serviceWorker.unregister();
