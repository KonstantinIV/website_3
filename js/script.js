$(document).on('click', '.nav_button', function() {
    //$(".row").toggleClass('hoops');
    $(".row").toggleClass('row_appear');
  });





  $(document).on('click', '#add', function() {
    //$(".row").toggleClass('hoops');

    var year  = $("#year").val();
    var month = $("#month").val();
    var day = $("#day").val();
    var datet = year+month+day;
    console.log(datet);

    if (ch_post()){
      $.ajax({
        url: "../php/post_pd.php",
        method: "POST",
        data:{title: $("#title").val() ,date: datet,text: $("#text").val()},
        success: function(data){
          console.log(data);
        }
      });
    }
    
});

function ch_post(){

  var title = $("#title").val();
  var text  = $("#text").val();

  var year  = $("#year").val();
  var month = $("#month").val();
  var day = $("#day").val();
  if(title == null || title == "" , text == null || text == ""){
    return false;

  }else if(year == null || year == "" ){
    return false;
  }else if(year == null || year == "" || month == null || month == "" && day == null || day == ""){
    return false;
  }else if(year == null || year == "" && month == null || month == ""){
    return false;
  }else{
    return true;
  }

}


