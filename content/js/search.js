$(document).on('click', '.search_button', function(){
    var thisButton = $(this);
    var searchInput = $('#searchInput').val();
    var url = window.location.href.split('search');
    
    window.location.href = url[0] + "search/" + searchInput;

    
    });
    //console.log(url);