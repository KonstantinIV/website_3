$(document).on('click', '.deletePost', function(){
    var ID = $(this).attr("data-deleteID");
    $("#deletePopup").css("visibility", "visible");
    $("#deleteLink").attr("href", "delete/"+ID)
    console.log("sss");

    });
