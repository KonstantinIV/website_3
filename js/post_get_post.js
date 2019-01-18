

$.ajax({
    url: "../php/get_post.php",
    method: "GET",
    success: function(data){
        var object_data = JSON.parse(data);



      console.log(object_data[1].id);

      for(var row in object_data){
        
        var html = [
            '<div class="post_cont">',
            '<div class="post_header">'+object_data[row].title+'</div> ',
            '<div class="post_user">'+object_data[row].username+'</div> ',
            '<div class="column_2">',
                    '<div class="text_cont">',
                            '<p class="post_text">'+object_data[row].text+'</p>',
                            '<div class="expand_post"><div>&#10225;</div></div>',
                    '</div>',
                   '<div class="date_cont">',
                            '<div class="post_date_1">Post date:<br><span class="date_f"> '+object_data[row].post_date+'</span></div>',
                            '<br>',
                            '<div class="post_date_2">Rs date:<br><span class="date_f">'+object_data[row].rel_date+' </span></div>',
                            '<br>',
                            '<div class="post_date_3">Database Rs date: <br><span class="date_f">'+object_data[row].da_date+' </span></div>',
                            '<br>',                    
                    '</div>',
            '</div>',
            '<div class="post_buttons">',
                    '<div class="like_button">LI</div>',
                    '<div class="di_li_cont">',
                        '<div class="likes">44</div>',
                        '<div class="">&#9679</div>',
                        '<div class="dislikes">22</div>',
                    '</div> ',
                    '<div class="dislike_button">DI</div>',
                    '<div class="comment_button">COMMENTS &#10095</div>',
            '</div>',
'</div>'].join("\n");
        $(".pop_post_cont").append(html);//Add to parent element
      }
    }
  });