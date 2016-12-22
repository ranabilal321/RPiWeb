<!Doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#clickON').click(function(){
					var a=new XMLHttpRequest();
                                        a.open("GET", "pinon.php");
                                        a.onreadystatechange=function(){
                                                if(a.readyState==4){
                                                        if(a.status == 200){
                                                        }else alert("HTTP ERROR");

                                                }
                                        }
                                        a.send();
                                });
                                $('#clickOFF').click(function(){
					var a=new XMLHttpRequest();
                                        a.open("GET", "pinoff.php");
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
      */
        $serverAddress = $_SERVER['HTTP_HOST'];
        $ipAddressArray= explode(':',$serverAddress);
        $ipAddressPi   = $ipAddressArray[0]; 
	      $portPi = 8160;
	      $url = "http://".$ipAddressPi.":".$portPi."/";
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
          print '<center> Welcome to Optimus Webstream </center>';?>
        <center>
          <h1>OptimusLiveStream</h1>
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

            if($browser!= 'Mozilla Firefox'){
              print '<h3 style="color:red;">'.'<p>Sorry youre using a browser that stream doesnt work,</p> <p>please switch to Firefox for stream to work, and you must have vlc plugin installed for firefox.</p>'.'</h3>';
            }
          ?>
          <!--Streaming Interface | Using Vlc Plugin Right Now-->
          <OBJECT classid="clsid:9BE31822-FDAD-461B-AD51-BE1D1C159921" codebase="http://downloads.videolan.org/pub/videolan/vlc/latest/win32/axvlc.cab"
			             width="800" height="600" id="vlc" events="True">
          <param name="ShowDisplay" value="True" />
          <param name="AutoLoop" value="False" />
          <param name="AutoPlay" value="True" />
          <embed id="vlcEmb" type="application/x-google-vlc-plugin" version="VideoLAN.VLCPlugin.2" autoplay="yes" loop="no" width="640" height="320"
			             target="<?php echo $url; ?>"></embed>
          </OBJECT>
          <!--Coders Name Just Temporary-->
          <p>Coded By <b>Bilal Faisal</b> (TeamOptimus)</p>
		    </center>
		    <center>
          <h2>**************</h2>
          <!--LED Functionality | Test Run-->
          <h1>LED Turn On And Turn Off</h1>
		      <label style = "color:red;">Turn ON(Pin 4):</label><button type="button" id="clickON">ON</button><br>
		      <label style = "color:red;">Turn OFF(Pin 4):</label><button type="button" id="clickOFF">OFF</button><br></center>
          <?php } ?>
          <!--BOT Controls Here-->
          <center><h1 style="color:green;">BOT Controls | Coming Soon Under Development</h1></center>

          <!--Disclaimer-->
          <center><h5 style="color:red;">Made with Love From Team Optimus, All Right Reserved</h5></center>
	</body>
</html>