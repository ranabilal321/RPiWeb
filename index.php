<!Doctype html>
<html>
  <head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- JQuery-->
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script type="text/javascript">
    /*
      Getting Button ids and sending it to gpio.php, where gpio handles the value related to pins bot controls, head movements and other stuff.
    */
      $(document).ready(function(){
        $(".forwardStart, .backwardStart, .turnLeft, .turnRight, .moveUp, .moveDown, .halt").click(function(){
          var getId = $(this).attr('id');
          var a     = new XMLHttpRequest();
          a.open("GET", "gpio.php?getID="+getId);
          a.onreadystatechange=function(){
            if(a.readyState==4){
              if(a.status == 200){
              }else alert("HTTP ERROR");
            }
          }
          a.send();
        });
      });
    </script>
    
    <title>Optimus|The WatchBot LiveStream</title>
  </head>
  <body>
    <?php
      /*
        IP Configurations and Server Address, Live stream on public ip, and default port is 8160, for live stream, streaming server must be running,
        to run streaming server go to terminal and locate home directory and then find raspivid_server.sh file and in terminal run bash raspivid_server.sh
        to start streaming server
        Streming port will not be changed.
      */
        $serverAddress = $_SERVER['HTTP_HOST'];
        $ipAddressArray= explode(':',$serverAddress);
        $ipAddressPi   = $ipAddressArray[0]; 
        $portPi        = 8081;
        $url           = "http://".$ipAddressPi.":".$portPi."/";

      /*
        Getting users ip address, will store in the database later and let user know that the server connected with that ip address.
      */
        $userIp        = $_SERVER['REMOTE_ADDR'];
    ?>
    <?php
      /*
        User Authentication, default username and password would be optimus, however user can change default username and password later,
        haven't created the configuration file yet.
      */
        $loginSuccessful = false;
        if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){
          $username = $_SERVER['PHP_AUTH_USER'];
          $password = $_SERVER['PHP_AUTH_PW'];
          if($username == 'optimus' && $password == 'optimus'){
            $loginSuccessful = true;
          }
        }
        if(!$loginSuccessful){
          header('WWW-Authenticate: Basic realm="OptimusWebInterface"');
          header('HTTP/1.0 401 Unauthorized');
          print 'you need valid login details to access optimus web stream. ';
          print 'contact optimusDevOps for more details';
        }else{
          $username = 'optimus';
          echo '<b>' . 'Hi: ' . '</b>' . '<b>'.$username. ' | '."You're connected from ".'<b>'.$userIp.'</b>';
    ?>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <center><h5 style="color:blue;"">Optimus Live Camera Stream</h5></center>
            <img class="img-responsive center-block" width = "800" height = '520' src = "<?php echo $url ?>">
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-sm-16">
          <div class="text-center">
            <h6 style="color:green;">Robot Controls</h6>
            <button type="button" class="btn btn-success btn-lg turnLeft"       id="turnLeft">LFT</button>
            <button type="button" class="btn btn-success btn-lg forwardStart"   id="forwardStart">FWD</button> 
            <button type="button" class="btn btn-danger  btn-lg halt"            id="halt">HLT</button>
            <button type="button" class="btn btn-success btn-lg backwardStart"  id="backwardStart">BWD</button> 
            <button type="button" class="btn btn-success btn-lg turnRight"      id="turnRight">RGT</button>
            <hr>
            <h6 style="color:green;">Robot Head Movement Controls</h6>
            <button type="button" class="btn btn-primary btn-lg moveUp"         id="moveUp">UP</button> 
            <button type="button" class="btn btn-primary btn-lg moveDown"       id="moveDown">DWN</button>
          </div>
        </div>
      </div>
    </div>

    <!--Disclaimer-->
    <hr>
    <center><h6 style="color:red;">Made with Love From Team Optimus, All Rights Reserved</h6></center>
    <?php } ?>
  </body>
</html>