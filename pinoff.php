<?php
	/*
		Sending the off request to pins
	*/
		//Getting the button id and storing it in $getId
		$getId = $_GET['getID'];

		//Temporarily selecting the pins.
		if($getId == 'clickOFF'){
			echo "hey i am pin 4 mode off";
			system("gpio -g mode 4 out");
			system("gpio -g write 4 0");

		}elseif($getId == 'forwardStop'){
			echo "hey i am pin 17, I'll be forward stop pin.";
			system("gpio -g mode 17 out");
			system("gpio -g write 17 0");

		}elseif($getId == 'backwardStop'){
			echo "hey i am pin 22, I'll be backward stop pin.";
			system("gpio -g mode 22 out");
			system("gpio -g write 22 0");

		}elseif($getId == 'stopLeft'){
			echo "hey i am pin 27, I'll be turnLeft stop pin.";
			system("gpio -g mode 27 out");
			system("gpio -g write 27 0");

		}elseif($getId == 'stopRight'){
			echo "hey i am pin 26, I'll be turnRight stop pin.";
			system("gpio -g mode 26 out");
			system("gpio -g write 26 0");

		}else{
			echo "There is an error with your selection";
		}
?>