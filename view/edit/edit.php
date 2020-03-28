<div class="textarea_ct">

                
                <textarea class="textarea p_header" type="text" id="title" placeholder="Title" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' ><?php echo $this->output['title'] ?></textarea>
                <div class="da_cont">
                        <div class="datepicker">
                        <select list="day" class="textarea date" type="text" id="day" placeholder="dd" ><?php echo $this->output['releaseDate'][0] ?>
                                <?php
                                if($this->output['releaseDate'][0]){
                                        echo '<option value="'.$this->output['releaseDate'][0].'"  selected>'.$this->output['releaseDate'][0].'</option>';
                                }else{
                                        echo '<option value="" disabled selected>dd</option>';
                                }
                                        for ($x = 1; $x <= 31; $x++) {


                                                echo "<option value=".$x.">".$x."</option>";
                                            } 

                                ?>

                                </select>
                                <select list="month" class="textarea date" type="text" id="month" placeholder="mm" >
                                <?php
                                if($this->output['releaseDate'][1]){
                                        echo '<option value="'.$this->output['releaseDate'][1].'"  selected>'.$this->output['releaseDate'][1].'</option>';
                                }else{
                                        echo '<option value="" disabled selected>mm</option>';
                                }
                                
                                        for ($x = 1; $x <= 12; $x++) {


                                                echo "<option value=".$x.">".$x."</option>";
                                            } 

                                ?>

                                </select>
                                

                                <select list="year" class="textarea year" type="text" id="year" placeholder="yyyy" ><?php echo $this->output['releaseDate'][2] ?>
                                
                                <?php
                                $date = (int)date("Y");
                                if($this->output['releaseDate'][2]){
                                        echo '<option value="'.$this->output['releaseDate'][2].'"  selected>'.$this->output['releaseDate'][2].'</option>';
                                }else{
                                        echo '<option value="" disabled selected>yyyy</option>';
                                }
                                        for ($x = 1; $x <= 80; $x++) {
                                                $year = $date + $x;

                                                echo "<option value=".$year.">".$year."</option>";
                                                
                                            } 

                                ?>

                                </select>
                                <div class="dat_text">Date of the release</div>
                        </div>
                </div>

                


                <div class="cateoryPickerCont da_cont">

                        <select list="Category" class="textarea date categoryPicker" type="text" id="category" placeholder="category" >
                        <?php
                         $arrayCat = array("Anime/Manga","Books","Tv show","Movies","Events","Gaming","Sport");
                                if($this->output['category']){
                                        echo '<option value='.$this->output['category'].' selected>'.$arrayCat[$this->output['category'] - 1].'</option>';
                                }else{
                                        echo '<option value="" disabled selected>Category</option>';
                                }
                                       
                                        for ($x = 0; $x <= 6; $x++) {
                                                $v = $x + 1;

                                                 echo "<option value=".$v.">".$arrayCat[$x]."</option>";
                                         } 

                          ?>

                         </select>

                </div>


























                <!--<textarea class="textarea postText" type="text"          id="text"  placeholder="Your prediction..." oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>-->
                <div id="quillText">
                <?php echo $this->output['text'] ?></div>
              
                <div class="button_ct"> 
                        <div class="add_post" id="editPost">POST</div>
                </div>
                <div id="editError"> 
                        <br>
                </div>


                
 
        
</div>