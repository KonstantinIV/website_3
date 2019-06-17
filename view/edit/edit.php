<div class="textarea_ct">
        
                
                <textarea class="textarea p_header" type="text" id="title" placeholder="Title" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' ><?php echo $this->output['title'] ?></textarea>
                <div class="da_cont">
                        <div class="datepicker">
                                <select list="year" class="textarea year" type="text" id="year" placeholder="yyyy" ><?php echo $this->output['releaseDate'][0] ?>
                                
                                        <option value="Chrome">Volvo</option>
                                        <option value="Firefox">Volvo</option>
                                        <option value="Internet Explorer">Volvo</option>
                                        <option value="Opera">Volvo</option>
                                        <option value="Safari">Volvo</option>
                                        <option value="Microsoft Edge">Volvo</option>
                                </select>

                                <textarea class="textarea date" type="text" id="month" placeholder="mm" ><?php echo $this->output['releaseDate'][1] ?></textarea>
                                <textarea class="textarea date" type="text" id="day" placeholder="dd" ><?php echo $this->output['releaseDate'][2] ?></textarea>
                                <div class="dat_text">Insert the date of the release</div>
                        </div>
                </div>
                        

                <textarea class="textarea" type="text"          id="text"  placeholder="Your prediction..." oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'><?php echo $this->output['text'] ?></textarea>
                <div class="button_ct"> 
                        <div class="add_post" id="editPost">POST</div>
                </div>


     

 
        
</div>