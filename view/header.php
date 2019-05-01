<header>
<div class="main_box">      
        <div class="logo">PRED</div>
        <ul class="row">        
        <li class="row_child"><a href="../">Main</a></li>
                <li class="row_child"><a href="profile<?php if(isset($_SESSION['user'])){ echo "/".$_SESSION['user'];  } ?>">Profile</a></li>
                <?php
                    if($this->pageData['metaData']['loggedIn']) {
                ?>        
                        <li class="row_child"><a href="logOut">Log out</a></li>
                <?php
                     }else{
                ?>
                        <li class="row_child"><a href="login">Log in</a></li>
                <?php        
                     }
                ?>
        </ul>
        <div class="nav_button_ct"> 
        <div class="nav_button"> <img src="img/icons8-menu.svg" alt="icon">
        </div>
        </div>

</div>    
</header>