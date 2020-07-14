
import $ from 'jquery';




/*function  restApi(requestType, URL, callBack) {
    var data;
    var request = new XMLHttpRequest();
  
    request.open(requestType, URL, true);
    request.setRequestHeader(
      "Content-Type",
      "application/x-www-form-urlencoded; charset=UTF-8"
    );
    request.send();
    request.onreadystatechange = function() {
      if (request.readyState === XMLHttpRequest.DONE) {
        data = JSON.parse(request.response);
        callBack(data);
      }
    }
  }*/

export default function ajaxApi(url,requestType,params,callback){
    $.ajax({
      
      url: url,
      method: requestType,
      data : params,
     // headers: {'Accept':'application/json'},
      success : function(result){
        callback(JSON.parse(result),true);
      },
      
      error: function (jqXHR, textStatus, errorThrown) {
       
        callback(JSON.parse(jqXHR.responseText), false);
    },
     
    });
  }