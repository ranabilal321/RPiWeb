<?php
require_once __DIR__ . "/src/libraries/ClassLoader.php";

$userInformationClient = new AuthUser();
$controlClient = new GPIOControls();
$powerClient = new BotPower();

$userInformation = $userInformationClient->index();
$url = $userInformation['url'];
$helloMessage = $userInformation['message'];

if (!empty($_GET['commandControl'])) {
  return $controlClient->index($_GET['commandControl']);
}
if (!empty($_GET['commandPower'])) {
  return $powerClient->index($_GET['commandPower']);
}
?>
<!Doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="assets/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap-theme.min.css">
    <script src="assets/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/app.js"></script>
    
    <title>Optimus|The WatchBot LiveStream</title>
  </head>

  <body>
  <?php
    echo $helloMessage;
  ?>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <center><h5 style="color:blue">Optimus Live Camera Stream</h5></center>
            <img class="img-responsive center-block" width = "800" height = '520' src = "<?php echo $url; ?>">
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-sm-16">
          <div class="text-center">
            <h6 style="color:green">Robot Controls</h6>
            <button type="button" class="btn btn-success btn-md left" id="left">LFT</button>
            <button type="button" class="btn btn-success btn-md forward" id="forward">FWD</button> 
            <button type="button" class="btn btn-danger  btn-md halt" id="halt">HLT</button>
            <button type="button" class="btn btn-success btn-md backward" id="backward">BWD</button> 
            <button type="button" class="btn btn-success btn-md right" id="right">RGT</button>
            <hr>
            <h6 style="color:green">Robot Head Movement Controls</h6>
            <button type="button" class="btn btn-primary btn-md up" id="up">UP</button> 
            <button type="button" class="btn btn-primary btn-md down" id="down">DWN</button>
            <hr>
            <h6 style="color:red">Shutdown|Reboot Robot</h6>
            <button type="button" class="btn btn-danger btn-md shutdown" id="shutdown">Off</button> 
            <button type="button" class="btn btn-warning btn-md reboot" id="reboot">Reboot</button>
          </div>
        </div>
      </div>
    </div>

    <hr>
    <center><h6 style="color:red">Made with Love From Team Optimus, All Rights Reserved</h6></center>
  </body>
</html>