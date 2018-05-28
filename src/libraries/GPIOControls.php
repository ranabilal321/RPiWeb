<?php

namespace Optimus\Libraries;

class GPIOControls
{
    const SCRIPT = 'python I2C.py ';
    const BACKWARD = 'backward';
    const FORWARD = 'forward';
    const LEFT = 'left';
    const RIGHT = 'right';
    const HALT = 'halt';
    const UP = 'up';
    const DOWN = 'down';
    const ERROR = 'ERROR';

    public function index($command)
    {
        return $this->execute($command);
    }

    private function execute($command)
    {
        switch ($command) {
            case self::BACKWARD:
                system(self::SCRIPT.'b');
                echo "Backward Done!";
                return true;
                break;
            case self::FORWARD:
                system(self::SCRIPT.'f');
                echo "Forward Done!";
                return true;
                break;
            case self::LEFT:
                system(self::SCRIPT.'l');
                echo "Left Done!";
                return true;
                break;
            case self::RIGHT:
                system(self::SCRIPT.'r');
                echo "Right Done!";
                return true;
                break;
            case self::HALT:
                system(self::SCRIPT.'h');
                echo "Halt Done!";
                return true;
                break;
            case self::UP:
                system(self::SCRIPT.'u');
                echo "Up Done!";
                return true;
                break;
            case self::DOWN:
                system(self::SCRIPT.'d');
                echo "Down Done!";
                return true;
                break;
            default:
                echo self::ERROR;
                return false;
                break;
        }
    }
}