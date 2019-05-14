<header>
<div class="main_box">      
        <div class="logo">PRED</div>
        <div class="search_bar"><input class="search" type="text" placeholder="Search.."><div class="search_button"><img src="content/img/search.svg" alt="icon"></div> </div>
        <ul class="row">   
        


                <li class="  row_child sortDropdownButton" onclick="optionDropdown()" tabindex="1"><div class="sortIconText">Sort</div> <img  class="navicon sortIcon" src="content/img/dsign.svg" alt="icon"> 
                                <div id="sortDropdown" class="sortDropdown-content row_child ">
                                          <a class="sortDropdownLink" href="logOut"><div class="buttonContainerSort"><div class="buttonContainerSortText">Popular</div> <img  class="navicon popIcon" src="content/img/popular.svg" alt="icon"></div></a>
                                          <a class="sortDropdownLink" href="logOut"><div class="buttonContainerSort"><div class="buttonContainerSortText">New</div> <img  class="navicon popIcon" src="content/img/new.svg" alt="icon"></div></a>
                                
                                </div>


           
                <?php
                    if($this->pageData['metaData']['loggedIn']) {
                ?>        
                       
                                <li class="  row_child userDropdownButton" onclick="userDropdown()" tabindex="1"><img  class="navicon userIcon" src="content/img/settings.svg" alt="icon"> <img  class="navicon sortIcon" src="content/img/dsign.svg" alt="icon">
                                <div id="userDropdown" class="userDropdown-content row_child ">
                                        <a class="sortDropdownLink" href="profile<?php if(isset($_SESSION['user'])){ echo "/".$_SESSION['user'];  } ?>"><div class="buttonContainerSort"><div class="buttonContainerSortText">Profile </div> <img  class="navicon popIcon" src="content/img/profile.svg" alt="icon"></div></a>
                                        <a class="sortDropdownLink" href="logOut"><div class="buttonContainerSort"><div class="buttonContainerSortText">Log out</div> <img  class="navicon popIcon" src="content/img/logout.svg" alt="icon"></div></a>
                                
                                </div>
                    </li>
                       

                       
                <?php
                     }else{
                ?>
                        <li class="row_child singleButtonNav" ><a href="login"><div class="buttonContainerNav"><div class="buttonContainerNavText">Log In</div> </div></a></li>
                        <li class="row_child singleButtonNav"><a href="login"><div class="buttonContainerNav"><div class="buttonContainerNavText">Sign Up</div> </div></a></li>
                <?php        
                     }
                ?>
        </ul>
        <div  class="nav_button_ct" > 
        
                <div  class="nav_button" onclick="navDropdown()"> <img  class="navDropdownButton" src="content/img/icons8-menu.svg" alt="icon">
                        <div id="navDropdown" class="dropdown-contentNav row_child ">
                                <a href="login">LOG IN</a></li>
                                <a href="login">SIGN UP</a></li>
                        </div>
                </div>
        </div>
</div>  
<div class="options"></div>


</header>