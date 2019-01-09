$(document).on('click', '.nav_button', function() {
    //$(".row").toggleClass('hoops');
    $(".row").toggleClass('row_appear');
  });


  $(document).on('click', '#add', function() {
    //$(".row").toggleClass('hoops');
    console.log($(".textarea").val());
    $.ajax({
     
      url: "../php/post.php",
      method: "POST",
      data:{text: $(".textarea").val()},
      success: function(data){
        console.log(data);

      }

    });
});



