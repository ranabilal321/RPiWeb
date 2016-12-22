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
	<?php //$ipAddressPi = $_SERVER['SERVER_ADDR'];
              $serverAddress = $_SERVER['HTTP_HOST'];
              $ipAddressArray= explode(':',$serverAddress);
              $ipAddressPi   = $ipAddressArray[0];
              //Public ip should be provided here, have to do it manually :/
              //$ipAddressPi = "publicIp";
	      $portPi = 8160;
	      $url = "http://".$ipAddressPi.":".$portPi."/";
              //die($url);
	?>
        <?php
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
               print 'welcome to optimus webstream';?>
               <center>
			<h1>OptimusLiveStream</h1>
			<OBJECT classid="clsid:9BE31822-FDAD-461B-AD51-BE1D1C159921" codebase="http://downloads.videolan.org/pub/videolan/vlc/latest/win32/axvlc.cab"
			 width="800" height="600" id="vlc" events="True">
			 <param name="Src" value="http://PI_IP_ADDRESS:8080/" />
			 <param name="ShowDisplay" value="True" />
			 <param name="AutoLoop" value="False" />
			 <param name="AutoPlay" value="True" />
			 <embed id="vlcEmb" type="application/x-google-vlc-plugin" version="VideoLAN.VLCPlugin.2" autoplay="yes" loop="no" width="640" height="320"
			 target="<?php echo $url; ?>"></embed>
			</OBJECT>
			<p>Coded By Bilal Faisal (TeamOptimus)</p>
		</center>
		<center><h1>LED Turn On And Turn Off</h1>
		<label>Turn ON:</label><button type="button" id="clickON">ON</button><br>
		<label>Turn OFF:</label><button type="button" id="clickOFF">OFF</button><br></center>
           <?php } ?>
	</body>
</html>