(function() {
  Date.prototype.stdTimezoneOffset = function () {
    var jan = new Date(this.getFullYear(), 0, 1);
    var jul = new Date(this.getFullYear(), 6, 1);
    return Math.max(jan.getTimezoneOffset(), jul.getTimezoneOffset());
  }
  
  Date.prototype.isDstObserved = function () {
    return this.getTimezoneOffset() < this.stdTimezoneOffset();
  }
  
  var offset = new Date().getTimezoneOffset()/60 * -1;
    document.cookie = "timezoneOffset"+"=" + offset;
  
  
    var today = new Date();
  
    if (today.isDstObserved()) { 
      document.cookie = "timezoneDst"+"=" + 1;
    }else{
      document.cookie = "timezoneDst"+"=" + 0;
  
    }
        
}());



  



  









     
   