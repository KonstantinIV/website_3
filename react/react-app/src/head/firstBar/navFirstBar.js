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
            
            <div className="navIconContainer">
                <div className="navIconImageContainer">
                    <img className="navIcon" src={arrowDown} alt="icon" />
                </div>
                <div className="navIconText">
                    NAVICONTEXT
                </div>
            </div>
            <div className="navSearchContainer">
                    <input className="navSearchInput" type="text" name="name" />
                <div className="navSearchButton">
                    <img className="navSearchIcon" src={arrowDown} alt="icon"/>
                </div>

            </div>
            <div className="navLoginContainer">
                <div className="navLoginButton">

                </div>
                <div className="navRegisterButton">

                </div>


            </div>



        </div>
    )
}




}