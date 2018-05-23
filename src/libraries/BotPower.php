<?php

class BotPower
{
    const SHUTDOWN = 'shutdown';
    const SHUTDOWN_COMMAND = 'sudo shutdown -h now';
    const REBOOT = 'reboot';
    const REBOOT_COMMAND = 'sudo reboot';
    const UNKNOWN = 'Command Unknown';

    public function index($command)
    {
        return $this->execute($command);
    }

    private function execute($command)
    {
        switch ($command) {
            case self::SHUTDOWN:
                echo "Shutting down...";
                system(self::SHUTDOWN_COMMAND);
                return true;
                break;
            case self::REBOOT:
                echo "Rebooting...";
                system(self::REBOOT_COMMAND);
                return true;
                break;
            default:
                echo self::UNKNOWN;
                return false;
                break;
        }
    }
}