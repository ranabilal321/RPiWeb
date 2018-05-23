<?php

class AuthUser
{
    const USERNAME = 'optimus';
    const PASSWORD = 'optimus';
    const PORT = 8081;

    public function index()
    {
        $configs = $this->userConfigs();
        $auth = $this->userAuth($configs['username'], $configs['password']);
        if ($auth == false) {
            header('WWW-Authenticate: Basic realm="OptimusWebUI"');
            header('HTTP/1.0 401 Unauthorized');
            die('You need valid login details to access optimus web stream.');
        }
        $url = $this->streamUrl($configs['port']);
        $message = '<b>' . 'Hi: ' . '</b>' . '<b>'.$configs['username'].
            ' | '."You're connected from ".'<b>'.$_SERVER['REMOTE_ADDR'].'</b>';
        return ['url' => $url, 'message' => $message];
    }

    private function streamUrl($port)
    {
        $serverHost = $_SERVER['HTTP_HOST'];
        $serverAddress = explode(':',$serverHost);
        $ipAddressPi = $serverAddress[0];
        return "http://".$ipAddressPi.":".$port;
    }

    private function userAuth($userName, $userPass)
    {
        $loginSuccessful = false;
        if(isset($_SERVER['PHP_AUTH_USER']) && $_SERVER['PHP_AUTH_USER'] == $userName &&
            isset($_SERVER['PHP_AUTH_PW']) && $_SERVER['PHP_AUTH_PW'] == $userPass){
            $loginSuccessful = true;
        }
        return $loginSuccessful;
    }

    private function userConfigs()
    {
        $configFilePath = 'configs/config.json';
        if (!file_exists($configFilePath)) {
            return ['username' => self::USERNAME, 'password' => self::PASSWORD, 'port' => self::PORT];
        }
        $configs = json_decode(file_get_contents($configFilePath), true);
        return [
            'username' => $configs['username'],
            'password' => $configs['password'],
            'port' => isset($configs['port']) ? $configs['port'] : self::PORT
        ];
    }
}