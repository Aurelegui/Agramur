(function() {
  
    var filter = null;
    var download = null;
    var flag = 0;
    var t = null;

    function startup() {
      download = document.getElementById('download');
      filter = window.location.href.slice(43);
      t = window.location.href.indexOf('filter');
      flag = 0;
      
      if(t > 0){
        flag = 1;
      }
      download.addEventListener('click', function(ev){
        if (flag == 1){
          myAjax();
          ev.preventDefault();
        }
      }, false);
    }
    
  
    // Fill the photo with an indication that none has been
    // captured.
  
  
    function myAjax() {
        if (!confirm("Do you want to upload this picture?")) {
            return ;
        }
        var http = new XMLHttpRequest();
        var url = 'saveImage.php';
        var params = 'filter=' + filter;
        http.open('POST', url, true);
  
        //Send the proper header information along with the request
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  
        http.onreadystatechange = function() {//Call a function when the state changes.
            if(http.readyState == 4 && http.status == 200) {
            }
        }
        http.send(params);
  }
    // Set up our event listener to run the startup process
    // once loading is complete.
    window.addEventListener('load', startup, false);
  })();