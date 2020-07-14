
window.onclick = function(event) {
    if (!event.target.matches('#userDropdownButton') 
    && !event.target.matches('#sortDropdownButton')                  
    
    
    ) {
        if(document.getElementById("userDropdown")){
            document.getElementById("userDropdown").classList.remove("show");
        }
     
      document.getElementById("sortDropdown").classList.remove("show");
    }
  }
  

  
    $("#userDropdownButton").click(function () {
    document.getElementById("userDropdown").classList.toggle("show");
     
    });
  

  
    $("#sortDropdownButton").click(function () {
    document.getElementById("sortDropdown").classList.toggle("show");
     
    });
  