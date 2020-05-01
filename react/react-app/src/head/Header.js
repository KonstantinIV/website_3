
import React from 'react';
/*
import logo from '../img/papirus.svg';
import search from '../img/search.svg';
import hot from '../img/popular.svg';
import newsort from '../img/new.svg';
import arrowDown from '../img/dsign.svg';*/

//import arrowDown from '../img/icons8-menu.svg';
import NavFirstBar from "./firstBar/navFirstBar";
import NavSecondBar from "./secondBar/navSecondBar";






export default class Header extends React.Component {
    constructor(props) {
        super(props);
     
        this.state = {
      
        };
   
      }


    
    render(){
  return (
    
<header>


<div className="main_box">      


<NavFirstBar 
loginUser={this.props.loginUser} 
userLoggedIn={this.props.userLoggedIn} 
searchPosts={this.props.searchPosts}
username={this.props.username}
/>

<NavSecondBar 
userLoggedIn={this.props.userLoggedIn} 

order={this.props.order} 
changeOrder={this.props.changeOrder} 

interval={this.props.interval} 
changeInterval={this.props.changeInterval} 

changeStatus={this.props.changeStatus} 
status={this.props.status}

changeSearchType={this.props.changeSearchType}
searchType={this.props.searchType}
searchBool={this.props.searchBool}
/>
</div>  


</header>
  );
    }
}



