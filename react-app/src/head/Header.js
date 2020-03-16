
import React from 'react';
import logo from '../img/papirus.svg';
import search from '../img/search.svg';
import popular from '../img/popular.svg';
import newsort from '../img/new.svg';
import arrowDown from '../img/dsign.svg';

//import arrowDown from '../img/icons8-menu.svg';







function Header() {
  return (
    
<header>


<div className="main_box">      
<div className="navMainBar">
        <a className="logoLinkContainer" href="/hot/"><div className="logo"><img  className="headerIcon" src={logo} alt="icon" />
            <div className="logoText">METHOPHY</div></div>
        </a>
        <div className="search_bar">
            <input className="search" id='searchInput' type="text" placeholder="Search.." />
                <div className="search_button">
                    <img src={search} alt="icon" />
                </div> 
        </div>

        <ul className="row">   
                <li className="  row_child sortDropdownButton" id="sortDropdownButton" tabindex="1" >
                    <div className="sortIconText">Sort</div> 
                    <img  className="navicon sortIcon" src={arrowDown} alt="icon" /> 
                        <div id="sortDropdown" className="sortDropdown-content row_child ">
                                          <a className="sortDropdownLink" href="a">
                                              <div className="buttonContainerSort">
                                                  <div className="buttonContainerSortText">Popular</div> 
                                                  <img  className="navicon popIcon" src={popular} alt="icon" />
                                              </div>
                                           </a>

                                          <a className="sortDropdownLink" href="a">
                                              <div className="buttonContainerSort">
                                                  <div className="buttonContainerSortText">New</div> 
                                                  <img  className="navicon popIcon" src={newsort} alt="icon" />
                                              </div>
                                          </a>
                                
                        </div>
                </li>
                <li className="row_child singleButtonNav" >
                    <a href="login">
                        <div className="buttonContainerNav">
                            <div className="buttonContainerNavText">Log In</div> 
                        </div>
                    </a>
                </li>
                <li className="row_child singleButtonNav"><a href="register"><div className="buttonContainerNav"><div className="buttonContainerNavText">Sign Up</div> </div></a></li>
          
        </ul>


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

</div>  


</header>
  );
}

export default Header;
