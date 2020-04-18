(function() {
   
  
  




    //comment
    $(document).on('click', '.starVote', function(){


      var points = $( this ).index()+1 ;
      var ID = $(this).closest("div[data-id]").attr('data-id');
      var starVoteContainer = $(this).closest(".starVoteContainer").find(".starVoteCount");
      var starVoteCount = parseInt(starVoteContainer.text());
      var data = JSON.parse(starVote(ID,points));

      console.log( data);

      if(data.flag ){

       for (var i = 0; i <= 4; i++) {
        $(this).closest('.starVoteBar').children('.starVote').eq(i).removeClass("starVoted");
        }
       for (var i = 0; i <= $( this ).index(); i++) {
        $(this).closest('.starVoteBar').children('.starVote').eq(i).addClass("starVoted");
         // $( ".starVote" ).eq(i).addClass("starVoteGreen");
        }

        if(!data.voted ){
          starVoteContainer.text( starVoteCount + 1);

        }








      }else if(data.message =="username"){
        $("#loginPopupCont").css("visibility", "visible");

      }
        

        });

       function starVote(ID,points){
          return  $.ajax({
             url: "starVote",
             method:    "POST" ,
             data:{ ID : ID , points : points},
             async:false,
         }).responseText;
         
       }
          
  }());
  
  
  