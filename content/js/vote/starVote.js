(function() {
   
  
  




    //comment
    $(document).on('click', '.starVote', function(){


      var points = $( this ).index()+1 ;
      var ID = $(this).closest("div[data-id]").attr('data-id');
      var starVoteContainer = $(this).closest(".starVoteContainer").find(".starVoteCount");
      var starVoteCount = parseInt(starVoteContainer.text());
      var data = JSON.parse(starVote(ID,points));
      if(data ){
       starVoteContainer.text( starVoteCount + 1);
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
  
  
  