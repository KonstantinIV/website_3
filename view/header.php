<header>
<div class="main_box">      
        <div class="logo">PRED</div>
        <div class="search_bar"><input class="search" type="text" placeholder="Search.."><div class="search_button"><img src="content/img/search.svg" alt="icon"></div> </div>
        <ul class="row">        
        <li class="row_child"><a href="../">Main</a></li>
               
                <?php
                    if($this->pageData['metaData']['loggedIn']) {
                ?>        
                       
                                <li class="  row_child dropbtn" onclick="userDropdown()" tabindex="1"><img class="settingsIcon" src="content/img/settings.svg" alt="icon">
                                <div id="userDropdown" class="dropdown-contentUser row_child ">
                                <a href="profile<?php if(isset($_SESSION['user'])){ echo "/".$_SESSION['user'];  } ?>">Profile</a>
                                <a href="logOut">Log out</a>
                                
                                </div>
                    </li>
                       

                       
                <?php
                     }else{
                ?>
                        <li class="row_child"><a href="login">LOG IN</a></li>
                        <li class="row_child"><a href="login">SIGN UP</a></li>
                <?php        
                     }
                ?>
        </ul>
        <div  class="nav_button_ct" > 
        
                <div  class="nav_button" onclick="navDropdown()"> <img src="content/img/icons8-menu.svg" alt="icon">
                        <div id="navDropdown" class="dropdown-contentNav row_child show ">
                                <a href="login">LOG IN</a></li>
                                <a href="login">SIGN UP</a></li>
                        </div>
                </div>
        </div>
</div>    
</header>