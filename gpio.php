<?php
	//Getting the button id and storing it in $getId
	$getId = $_GET['getID'];

	if($getId == 'backwardStart'){
		echo "Backward functionality to operate";

		//Executing the python code in terminal for backward request
		system("python pyphp.py b");
		echo "Done! Backward";

	}elseif($getId == 'forwardStart'){
		echo "Forward functionality to operate";

		//Executing the python code in terminal for forward request
		system("python pyphp.py f");
		echo "Done! Forward";

	}elseif($getId == 'turnLeft'){
		echo "Turn left functionality to operate";

		//Executing the python code in terminal for left request
		system("python pyphp.py l");
		echo "Done! Left";

	}elseif($getId == 'turnRight'){
		echo "Turn right functionality to operate";

		//Executing the python code in terminal for right request
		system("python pyphp.py r");
		echo "Done! Right";
		
	}elseif($getId == 'halt'){
		echo "Halting every operations";

		//Executing the python code in terminal for halt request
		system("python pyphp.py h");
		echo "Done! Halt";

	}elseif($getId == 'moveUp'){
		echo "Head move up functionality to operate";
		//Executing the python code in terminal for head up request
		system("python pyphp.py u");
		echo "Done! Head up";

	}elseif($getId == 'moveDown'){
		echo "Head move down functionality to operate";

		//Executing the python code in terminal for head down request
		system("python pyphp.py d");
		echo "Done! Head down";

	}else{
		//If there is an exception
		echo "There is an error with your selection";
	}
?>
