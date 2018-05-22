$(document).ready(function () {
  $(".forward, .backward, .left, .right, .up, .down, .halt").click(function () {
    var command = $(this).attr('id');
    $.ajax({
      url: "src/libraries/GPIO.php?command=" + command,
      type: "GET",
      success: function (data) {
        console.log(data)
      },
      error: function(data) {
        console.log(data)
      }
    });
  });

  $(".shutdown, .reboot").click(function () {
    var command = $(this).attr('id');
    $.ajax({
      url: "src/libraries/ShutdownAndRestart.php?command=" + command,
      type: "GET",
      success: function (data) {
        console.log(data)
      },
      error: function(data) {
        console.log(data)
      }
    });
  });
  
});