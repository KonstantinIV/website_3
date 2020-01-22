(function() {
    function unsetAllBorder(){
        var tabs = document.getElementsByClassName("tabSettings");

        for(var i = 0; i < tabs.length; i++){
            $(tabs[i]).css( "border-bottom", "none" );
        }


    }

    function getSettingsBlock(tabName){
            return $.ajax({
              async : false ,
              url: "settingsU",
              method: "POST",
              data:{tabName: tabName}
            }).responseText;
         
    }

    

    $( document ).on("change", "#inputImageSettings", function() {
     


        var input = this
        var url = $(this).val();
       // console.log(url+"asdad");
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0]&& ( ext == "png" || ext == "jpeg" || ext == "jpg")) 
         {
            var reader = new FileReader();
    
            reader.onload = function (e) {
               $('#outputImageSettings').attr('src', e.target.result);
            }
           reader.readAsDataURL(input.files[0]);
           
           
           
        }
        else
        {
          $('#outputImageSettings').attr('src', 'content/img/defaultAvatar.jpg');
        }

      });


 

    
    function switchSettings(thisTab){
        //console.log($(thisTab).text());
        window.history.replaceState(null, null, "settings/" + $(thisTab).text().toLowerCase());
        unsetAllBorder();

        $(thisTab).css( "border-bottom", "3px solid #5950ad" );
        var html = JSON.parse(getSettingsBlock($(thisTab).text().toLowerCase())).html ;
        $(".tabContainerSettings").html(html);

    }

    

     
      function saveAvatar(image){
        return $.ajax({
           url: "avatarSettings",
           method: "POST",
           data: image,
           contentType: false,
           processData: false,
           async:false}).responseText  ;
       }

       $(document).on('click', '.tabSettings', function() {
        switchSettings($(this));
        
      });

       //switchSettings((document.getElementsByClassName("tabSettings"))[0]);
      //console.log("ll")
       $(document).on('click', '#avatarButtonSettings', function() {
        var formData = new FormData();
        formData.append('image', $("#inputImageSettings")[0].files[0]);
        
         console.log(formData);
        console.log(saveAvatar(formData));
        
      });
       
  }());
  
  
  