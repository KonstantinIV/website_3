<div class="textarea_ct">
        
                
                <textarea class="textarea p_header" type="text" id="title" placeholder="Title" ><?php echo $this->output['title'] ?></textarea>
                <div class="da_cont">
                        <div class="datepicker">
                                <textarea class="textarea year" type="text" id="year" placeholder="yyyy" ><?php echo $this->output['releaseDate'][0] ?></textarea>
                                <textarea class="textarea date" type="text" id="month" placeholder="mm" ><?php echo $this->output['releaseDate'][1] ?></textarea>
                                <textarea class="textarea date" type="text" id="day" placeholder="dd" ><?php echo $this->output['releaseDate'][2] ?></textarea>
                                <div class="dat_text">Insert the date of the release</div>
                        </div>
                </div>
                        

                <textarea class="textarea" type="text"          id="text"  placeholder="Your prediction..." ><?php echo $this->output['text'] ?></textarea>
                <div class="button_ct"> 
                        <div class="add_post" id="editPost">POST</div>
                </div>


     

 
        
</div>