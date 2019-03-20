<header>
<div class="main_box">      
        <div class="logo">PRED</div>
        <ul class="row">        
        <li class="row_child"><a href="../">Main</a></li>
                <li class="row_child"><a href="profile">Profile</a></li>
                <?php
                    if($this->logged_in) {
                ?>        
                        <li class="row_child"><a href="logout">Log out</a></li>
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