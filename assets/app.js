$(document).ready(function () {
  $(".forward, .backward, .left, .right, .up, .down, .halt").click(function () {
    var command = $(this).attr('id');
    $.ajax({
      url: "index.php?commandControl=" + command,
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
      url: "index.php?commandPower=" + command,
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