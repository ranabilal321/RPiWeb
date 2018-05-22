<?php
const SHUTDOWN = 'shutdown';
const SHUTDOWN_COMMAND = 'sudo shutdown -h now';
const REBOOT = 'reboot';
const REBOOT_COMMAND = 'sudo reboot';

function execute($command) {
	switch ($command) {
		case SHUTDOWN:
			echo "Shutting down...";
			system(SHUTDOWN_COMMAND);
			break;
		case REBOOT:
			echo "Rebooting...";
			system(REBOOT_COMMAND);
			break;
		default:
			echo "Unknown Command";
			break;
	}
}

if (!empty($_GET['command'])) {
	return execute($_GET['command']);
}
die(json_encode(['message' => 'Invalid Parameter, command not found in GET request']));