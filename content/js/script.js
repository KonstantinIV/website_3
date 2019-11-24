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

  var today = new Date();
  
  if (today.isDstObserved()) { 
    offset = offset  + 1;
  }


    document.cookie = "timezoneOffset"+"=" + offset;
  
  
    
//TEEEEEEEST








function timeSince(date) {

  var seconds = Math.floor((new Date() - date) / 1000);

  var interval = Math.floor(seconds / 31536000);

  if (interval > 1) {
    return interval + " years";
  }
  interval = Math.floor(seconds / 2592000);
  if (interval > 1) {
    return interval + " months";
  }
  interval = Math.floor(seconds / 86400);
  if (interval > 1) {
    return interval + " days";
  }
  interval = Math.floor(seconds / 3600);
  if (interval > 1) {
    return interval + " hours";
  }
  interval = Math.floor(seconds / 60);
  if (interval > 1) {
    return interval + " minutes";
  }
  return Math.floor(seconds) + " seconds";
}
var aDay = 24*60*60*1000
/*
console.log(aDay);

console.log(timeSince(new Date(Date.now()-aDay)));
console.log(timeSince(new Date(Date.now()-aDay*2)));

*/














        
}());



  



  









     
   