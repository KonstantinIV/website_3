import React from 'react';
import ReactDOM from 'react-dom';
import ajaxApi from "./helpers/ajaxApi";

import { BrowserRouter as Router } from 'react-router-dom';
import {  Route, Switch } from 'react-router-dom';
//import Header from './head/Header';
import CommunityPosts from './communityPosts/communityPosts';
import Profile from './profile/profile';

import * as serviceWorker from './serviceWorker';

class Main extends React.Component{
    constructor(props) {
        super(props);
    this.state = {
      userLoggedIn : false,
      username : ""
      };
      this.loginUser = this.loginUser.bind(this);
      this.clientData();

    }
    clientData(){
        let params = {};
    ajaxApi("islogged","GET",params, result => {
      if(!result.flag){
        this.setState({
          userLoggedIn : false

        })
        document.cookie = "PHPSESSID" +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';

      }else{
        this.setState({
          userLoggedIn : true,
          username     : result.username
        })
      }
    
  })
    }
    loginUser(username){
      this.setState({
        userLoggedIn : !this.state.userLoggenIn,
        username : username
      })
    }
    render(){
      return(
      <Router>
      <div>
        

        {/* A <Switch> looks through its children <Route>s and
            renders the first one that matches the current URL. */}
        <Switch>
          <Route path="/profile">
            <Profile loginUser={this.loginUser} userLoggedIn={this.state.userLoggedIn} username={this.state.username}/>
          </Route>
          <Route path="/users">
          <div></div>
          </Route>
          <Route path="/">
          <CommunityPosts loginUser={this.loginUser} userLoggedIn={this.state.userLoggedIn} username={this.state.username}/>
          </Route>
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
