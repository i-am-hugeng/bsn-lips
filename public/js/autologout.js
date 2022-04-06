var idleMax = 30; // Logout after 30 minutes of IDLE
var idleTime = 0;

var idleInterval = setInterval("timerIncrement()", 60000);  // 1 minute interval
$( "body" ).mousemove(function( event ) {
    idleTime = 0; // reset to zero
});

// count minutes
function timerIncrement() {
  idleTime = idleTime + 1;
  if (idleTime == idleMax) {
    document.getElementById('logout-form').submit();
  }
}
