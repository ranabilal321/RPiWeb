<?php
const SCRIPT = 'python I2C.py ';
const BACKWARD = 'backward';
const FORWARD = 'forward';
const LEFT = 'left';
const RIGHT = 'right';
const HALT = 'halt';
const UP = 'up';
const DOWN = 'down';

function execute($command) {
	switch ($command) {
		case BACKWARD:
			system(SCRIPT.'b');
			echo "Backward Done!";
			break;
		case FORWARD:
			system(SCRIPT.'f');
			echo "Forward Done!";
			break;
		case LEFT:
			system(SCRIPT.'l');
			echo "Left Done!";
			break;
		case RIGHT:
			system(SCRIPT.'r');
			echo "Right Done!";
			break;
		case HALT:
			system(SCRIPT.'h');
			echo "Halt Done!";
			break;
		case UP:
			system(SCRIPT.'u');
			echo "Up Done!";
			break;
		case DOWN:
			system(SCRIPT.'d');
			echo "Down Done!";
			break;
		default:
			echo "ERROR";
			break;
	}
}

if (!empty($_GET['command'])) {
	return execute($_GET['command']);
}
die(json_encode(['message' => 'Invalid Parameter, command not found in GET request']));