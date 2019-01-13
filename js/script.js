$(document).on('click', '.nav_button', function() {
    //$(".row").toggleClass('hoops');
    $(".row").toggleClass('row_appear');
  });





  $(document).on('click', '#add', function() {
    //$(".row").toggleClass('hoops');
    console.log($(".textarea").val());

    if (ch_post()){
      $.ajax({
        url: "../php/post_pd.php",
        method: "POST",
        data:{title: $("#title").val() ,text: $("#text").val()},
        success: function(data){
          console.log(data);
        }
      });
    }
    
});

function ch_post(){

  var title = $("#title").val();
  var text  = $("#text").val();
  if(title == null || title == "" , text == null || text == ""){
    return false;
  }else{
    return true;
  }
}


