
(function() {

  function validatePostTitle(postTitle){
    if(postTitle == null || postTitle == "" ){
      return false;
    }
      return true;
  }

  function validatePostText(postText){
    if(postText == null || postText == ""){
      return false;
    }
      return true;
  }

  function validateDate(year,month,day){
    
    if(year == null || year == "" ){
      return false;
    }else if(year == null || year == "" || month == null || month == "" && day == null || day == ""){
      return false;
    }else if(year == null || year == "" && month == null || month == ""){
      
      return false;
    }
      return true;
  }

  function validateCategory(category){

    if( category == 0){
      return false;
    }
   

    return true;
  }


  function sendPost(postTitle,postYear,postMonth,postDay,postText,postCat,postID){
   return $.ajax({
      url: "editutility",
      method: "POST",
      async:false,
      data:{title: postTitle , year: postYear ,month : postMonth, day : postDay, text:postText,category:postCat, postID : postID}
      
  }).responseText;
  }

  /*
  function ch_post(postTitle,postYear,postMonth,postDay,postText, postCat){

    var title = postTitle;
    var text  = postText;
    var year  = postYear;
    var month = postMonth;
    var day = postDay;
    var cat = postCat;
  
    if(title == null || title == "" || text == null || text == "" || cat == 0){
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
  
  }*/
  
  

  
        $(document).on('click', '#editPost', function(){
    
          //Check if empty
          var postTitle  = $('#title').val();
          var postYear  = $('#year').val();
          var postMonth     = $('#month').val();
          var postDay = $('#day').val();
          //var postText  = $('#text').val(); 
          var postText  = $('.ql-editor').html();
          var postCat  = $('#category').val();
          var postID = window.location.href.split('/')[4];
          console.log(JSON.stringify(quill.getContents()));
          //console.log();

          if(!validatePostText(postText)){
            $("#editError").text("Invalid characters in text");

            return false;

          }else if(!validateCategory(postCat)){
            $("#editError").text("Invalid category");

            return false;

          }else if( !validateDate(postYear,postMonth,postDay)){
            $("#editError").text("Invalid date");

            return false;

          }else if( !validatePostTitle(postTitle) ){
            $("#editError").text("Invalid title");

            return false;
          }

          var data = sendPost(postTitle,postYear,postMonth,postDay,postText,postCat,postID);
          console.log(data);

          if(JSON.parse(data).flag == false){
            $("#editError").text(JSON.parse(data).message);
            return false;
          }
         
  
          /*if(!ch_post(postTitle,postYear,postMonth,postDay,postText)){
            $("#editError").text("Somethign went wrong");
            return false;
          }*/
  
     
          });
          var colorValues = ["#000000",
          "#e60000", "#ff9900",
          "#ffff00", "#008a00", 
          "#0066cc", "#9933ff", 
          "#ffffff", "#facccc", 
          "#ffebcc", "#ffffcc", 
          "#cce8cc", "#cce0f5", 
          "#ebd6ff", "#bbbbbb", 
          "#f06666", "#ffc266", 
          "#ffff66", "#66b966", 
          "#66a3e0", "#c285ff", 
          "#888888", "#a10000", 
          "#b26b00", "#b2b200", 
          "#006100", "#0047b2", 
          "#6b24b2", "#444444", 
          "#5c0000", "#663d00", 
          "#666600", "#003700", 
          "#002966", "#3d1466"];
          if(document.getElementById("quillText")){
            var quill = new Quill('#quillText', {
              theme: 'snow',
              modules: {
                toolbar: [
                  [{ header: [1, 2, false] }],
                  ['bold', 'italic', 'underline','strike'],
                  [ 'link','code-block'],
                  [{'color': colorValues },
                   {'background': colorValues}],
                  ['blockquote','list']
                ]
              },
            });
        }
          
}());


  /////////////////
  
  
  
  
  
  
  
  