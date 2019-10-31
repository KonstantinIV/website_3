var search = {
    init : function(){
        $(document).on('click', '.search_button', this.searchLink);

    },
    


    searchLink :function searchLink(){
        var searchInput = $('#searchInput').val();
        var url = window.location.href.split('search');
        window.location.href = url[0] + "search/" + searchInput;
    }
    

};
search.init();







        $("#searchInput").keypress(function(event) {
            if (event.which == 13) {
                event.preventDefault();
                
                $(".search_button").click();
            }
        });
    
  
    