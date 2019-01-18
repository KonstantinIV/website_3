$.ajax({
    url: "../php/get_right.php",
    method: "GET",
    success: function(data){
        var object_data = JSON.parse(data);



      console.log(object_data[1].id);

      for(var row in object_data){
        
        var html = [
            '<li>'+data+'</li>'
            ].join("\n");
        $(".pop_post_cont").append(html);//Add to parent element
      }
    }
  });