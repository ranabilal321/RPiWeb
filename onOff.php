<?php

/**
	Author : Bilal Faisal
	Date   : 08:00 AM
	Script to shutdown and reboot Raspberry Pi
**/

/**
	Add permissions before running this script.
	exec(whoami) eg www-data
	sudu visudo => %www-data   ALL=NOPASSWD: /sbin/shutdown, /sbin/reboot
**/

$command = $_GET['command'];
if(isset($command) && !empty($command)){
	if($command == "shutdown"){
		echo "Shutting Down Raspberry Pi";
		//echo system("sudo shutdown -h now");
	}elseif($command == "reboot"){
		echo "Rebooting Raspberry Pi";
		//echo system("sudo reboot");
	}else{
		echo json_encode(['response' => 'Invalid Argument, Command must be shutdown or reboot']);
	}
}else{
	echo json_encode(['response' => 'Invalid Parameter, command not found in GET request']);
}
