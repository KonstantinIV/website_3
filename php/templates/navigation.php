<header>
<div class="main_box">      
        <div class="logo">PRED</div>
        <ul class="row">        
        <li class="row_child"><a href="main.html">Post</a></li>
                <li class="row_child"><a href="main.html">Search</a></li>
                <?php
                    if(isset($_SESSION['user']) ) {
                ?>        
                        <li class="row_child"><a href="logout.php">Log out</a></li>
                <?php
                     }else{
                ?>
                        <li class="row_child"><a href="log_in.php">Log in</a></li>
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