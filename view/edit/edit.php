<div class="textarea_ct">
        
                
                <textarea class="textarea p_header" type="text" id="title" placeholder="Title" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' ><?php echo $this->output['title'] ?></textarea>
                <div class="da_cont">
                        <div class="datepicker">
                                <select list="year" class="textarea year" type="text" id="year" placeholder="yyyy" ><?php echo $this->output['releaseDate'][0] ?>
                                <?php
                                $date = (int)date("Y");
                                if($this->output['releaseDate'][0]){
                                        echo '<option value="" disabled selected>'.$this->output['releaseDate'][0].'</option>';
                                }else{
                                        echo '<option value="" disabled selected>yyyy</option>';
                                }
                                        for ($x = 1; $x <= 80; $x++) {
                                                $year = $date + $x;

                                                echo "<option value=".$year.">".$year."</option>";
                                                
                                            } 

                                ?>

                                </select>
                                <select list="month" class="textarea date" type="text" id="month" placeholder="mm" >
                                <?php
                                if($this->output['releaseDate'][1]){
                                        echo '<option value="" disabled selected>'.$this->output['releaseDate'][1].'</option>';
                                }else{
                                        echo '<option value="" disabled selected>mm</option>';
                                }
                                
                                        for ($x = 1; $x <= 12; $x++) {


                                                echo "<option value=".$x.">".$x."</option>";
                                            } 

                                ?>

                                </select>
                                <select list="day" class="textarea date" type="text" id="day" placeholder="dd" ><?php echo $this->output['releaseDate'][2] ?>
                                <?php
                                if($this->output['releaseDate'][2]){
                                        echo '<option value="" disabled selected>'.$this->output['releaseDate'][2].'</option>';
                                }else{
                                        echo '<option value="" disabled selected>dd</option>';
                                }
                                        for ($x = 1; $x <= 31; $x++) {


                                                echo "<option value=".$x.">".$x."</option>";
                                            } 

                                ?>

                                </select>
                                <div class="dat_text">Date of the release</div>
                        </div>
                </div>
                        

                <textarea class="textarea postText" type="text"          id="text"  placeholder="Your prediction..." oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'><?php echo $this->output['text'] ?></textarea>
                <div class="button_ct"> 
                        <div class="add_post" id="editPost">POST</div>
                </div>
                <div id="editError"> 
                        <br>
                </div>


     

 
        
</div>