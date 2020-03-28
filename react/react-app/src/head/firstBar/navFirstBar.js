import React from 'react';
import arrowDown from '../../img/dsign.svg';



export default class NavFirstBar extends React.Component {
    constructor(props) {
        super(props);
     
        this.state = {
      
        };
   
      }


render(){

    return(
        <div className="navMainBar">
      

        <div  className="nav_button_ct" > 
        
                <div  className="nav_button" onclick="navDropdown()"> 
                    <img  className="navDropdownButton" src={arrowDown} alt="icon" />
                        <div id="navDropdown" className="dropdown-contentNav row_child ">
                                <a href="login">LOG IN</a>
                                <a href="register">SIGN UP</a>
                        </div>
                </div>
        </div>
</div>
    )
}




}