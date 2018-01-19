function loadIt() {
    jQuery('#notifications_response').empty();
    $.get(url_global+"cms/notification", function( notifications_response ) {
        $( "#notifications_response" ).html( notifications_response );
      });
  }
setInterval(loadIt, 20000);