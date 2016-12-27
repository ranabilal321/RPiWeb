<!Doctype html>
<html>
  <head>
    <meta charset="UTF-8">

    <!-- JQuery-->
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        /*$(".clickON, .forwardStart, .backwardStart, .turnLeft, .turnRight").click(function(){
          var getId = $(this).attr('id');
          var a     = new XMLHttpRequest();
          a.open("GET", "pinon.php?getID="+getId);
          a.onreadystatechange=function(){
            if(a.readyState==4){
              if(a.status == 200){
              }else alert("HTTP ERROR");
            }
          }
          a.send();
        });
        $(".clickOFF, .forwardStop, .backwardStop, .stopLeft, .stopRight").click(function(){
          var getId = $(this).attr('id');
          var a     = new XMLHttpRequest();
          a.open("GET", "pinoff.php?getID="+getId);
          a.onreadystatechange=function(){
            if(a.readyState==4){
              if(a.status == 200){
              }else alert("HTTP ERROR");
            }
          }
          a.send();
        });*/

        //Just everything in one file no need to create multiple code files, Sending everything in gpio.php, related gpio
        $(".clickON, .forwardStart, .backwardStart, .turnLeft, .turnRight, .clickOFF, .forwardStop, .backwardStop, .stopLeft, .stopRight").click(function(){
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
    <title>OptimusLiveStream</title>
  </head>
  <body>
  <?php
      /*
      IP Configurations and Server Address, Live stream on public ip, and default port is 8160, for live stream, streaming server must be running,
      to run streaming server go to terminal and locate home directory and then find raspivid_server.sh file and in terminal run bash raspivid_server.sh
      to start streaming server
      STreming port will not be changed.
      */
        $serverAddress = $_SERVER['HTTP_HOST'];
        $ipAddressArray= explode(':',$serverAddress);
        $ipAddressPi   = $ipAddressArray[0]; 
        $portPi        = 8160;
        $url           = "http://".$ipAddressPi.":".$portPi."/";

        //Getting users ip address, will store in the database later and let user know that the server connected with that ip address.
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
          echo 'Hi: ' . '<b>'.$username.'</b>';
          echo '<br>'."You're connected from ".'<b>'.$userIp.'</b>';
          print '<center> Welcome to Optimus Webstream </center>';?>
        <center>
          <h2 style="color:blue;"">OptimusLiveStream</h2>
          <?php
            /*
            Browser details, getting the details for users browser
            */
            if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE) {
              $browser = 'Internet Explorer';
            }
            elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE){
              $browser = 'Mozilla Firefox';
            }
            elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE){
              $browser = 'Google Chrome';
            }
            else{
              $browser = "Ummm, We dont know which browser youre using";
            }

            //Displaying error messages to user if his browser is not firefox and vlc installed.
            if($browser!= 'Mozilla Firefox'){
              print '<h4 style="color:red;">'.'<p>Sorry youre using a browser that stream doesnt work,</p> <p>please switch to Firefox for stream to work, and you must have vlc plugin installed for firefox.</p>'.'</h4>';
              echo '<h5>' . '<b>In the meanwhile learn something about raspberry pi, here is a youtube video for you.</b>' . '</h5>';
              ?>
              <iframe width="640" height="360"
                src="https://www.youtube.com/embed/5jA8wYqQLBU">
              </iframe>
            <?php }elseif($browser == 'Mozilla Firefox'){?>
              <!-- Check to see if it works and will remove custom code. -->
              <embed id="vlcEmb" type="application/x-google-vlc-plugin" version="VideoLAN.VLCPlugin.2" autoplay="yes" loop="no" width="640" height="320" target="<?php echo $url; ?>"></embed>
              <?php } ?>
          </br>
          <!--Streaming Interface | Using Vlc Plugin Right Now-->
          <!-- <OBJECT classid="clsid:9BE31822-FDAD-461B-AD51-BE1D1C159921" codebase="http://downloads.videolan.org/pub/videolan/vlc/latest/win32/axvlc.cab"
                     width="800" height="600" id="vlc" events="True">
            <param name="ShowDisplay" value="True" />
            <param name="AutoLoop" value="False" />
            <param name="AutoPlay" value="True" />
            <embed id="vlcEmb" type="application/x-google-vlc-plugin" version="VideoLAN.VLCPlugin.2" autoplay="yes" loop="no" width="640" height="320"
                   target="<?php echo $url; ?>"></embed>
          </OBJECT>-->

          <!--Coders Name Just Temporary-->
          <p>Coded By <b>Bilal Faisal</b> (TeamOptimus)</p>
        </center>
        <center>
          <!--LED Functionality | Test Run-->
          <h1 style="color:grey;"">RPi GPIO Checking</h1>
          <p>Default Led at pin 4</p>
          <button type="button" class="btn btn-success btn-sm clickON" id="clickON">ON</button>
          <button type="button" class="btn btn-danger btn-sm clickOFF" id="clickOFF">OFF</button>

          <!-- BOT Controls -->
          <h1 style="color:green;">BOT Controls</h1>
          <button type="button" class="btn btn-success btn-sm forwardStart"   id="forwardStart">Forward</button>
          <button type="button" class="btn btn-danger btn-sm forwardStop"     id="forwardStop">ForwardStop</button> | 
          <button type="button" class="btn btn-success btn-sm backwardStart"  id="backwardStart">Backward</button>
          <button type="button" class="btn btn-danger btn-sm backwardStop"    id="backwardStop">BackwardStop</button> | 
          <button type="button" class="btn btn-success btn-sm turnLeft"       id="turnLeft">Left</button>
          <button type="button" class="btn btn-danger btn-sm stopLeft"        id="stopLeft">LeftStop</button> |
          <button type="button" class="btn btn-success btn-sm turnRight"      id="turnRight">Right</button>
          <button type="button" class="btn btn-danger btn-sm stopRight"       id="stopRight">RightStop</button>
          </center>

          <!--Upcoming Updates-->
          <center><h1 style="color:red;">Head Movement Controls | Coming Soon | Under Development</h1></center>
          <hr>
          <!--Disclaimer-->
          <center><h5 style="color:red;">Made with Love From Team Optimus, All Rights Reserved</h5></center>
          <?php } ?>
  </body>
</html>