<?php
	/*
		Sending the on request to pins
	*/
		//Getting the button id and storing it in $getId
		$getId = $_GET['getID'];

		//Function for Halt Operations

		function haltAll(){
			//Halt All Pin Operations
			echo "Halt All";

			system("gpio -g mode 18 out");
			system("gpio -g mode 22 out");
			system("gpio -g mode 24 out");
			system("gpio -g mode 25 out");
			system("gpio -g write 18 0");
			system("gpio -g write 22 0");
			system("gpio -g write 24 0");
			system("gpio -g write 25 0");
		}

		if($getId == 'forwardStart'){

			//Before Forward Start All Pins Should Halt
			haltAll();

			echo "Forward Pins : 18,24";

			//Forward Start Pin Operations
			system("gpio -g mode 18 out");
			system("gpio -g mode 24 out");
			system("gpio -g write 18 1");
			system("gpio -g write 24 1");

		}elseif($getId == 'backwardStart'){

			//Before Backward Start All Pins Should Halt
			haltAll();

			echo "Backward Pins : 22,25";

			//Backward Start Pin Operations
			system("gpio -g mode 22 out");
			system("gpio -g mode 25 out");
			system("gpio -g write 22 1");
			system("gpio -g write 25 1");

		}elseif($getId == 'turnLeft'){

			//Before Backward Start All Pins Should Halt
			haltAll();

			echo "Left Pins : 22,24";

			//Turn Left Pin Operations
			system("gpio -g mode 22 out");
			system("gpio -g mode 24 out");
			system("gpio -g write 22 1");
			system("gpio -g write 24 1");

		}elseif($getId == 'turnRight'){

			//Before Backward Start All Pins Should Halt
			haltAll();

			echo "Right Pins : 18,25";

			//Turn Right Pin Operations
			system("gpio -g mode 18 out");
			system("gpio -g mode 25 out");
			system("gpio -g write 18 1");
			system("gpio -g write 25 1");
			
		}elseif($getId == 'halt'){
			//Halt All Function Call Here.
			haltAll();
						
		}
		else{
			//If there is an exception
			echo "There is an error with your selection";
		}
?>