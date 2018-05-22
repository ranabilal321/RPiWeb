# OptimusBot | WebUI
OptimusBot WebUI, Live Stream, Bot Controls, Bot Head Movements.

## Getting Started
Follow these instructions in order to get the Bot up and running.

### Prerequisites
- XUbuntu For Raspberry Pi [Ubuntu Flavours](https://ubuntu-pi-flavour-maker.org/download)

- Before Installing Packages
```
$ sudo apt-get update
$ sudo apt-get upgrade
```
- Install Apache Web Server
```
$ sudo apt-get install apache2
$ sudo systemctl start apache2.service
```
- Install PHP
```
$ sudo apt-get install php
$ sudo apt-get install libapache2-mod-php
$ sudo systemctl restart apache2.service
```
- Install Python Packages
```
$ sudo apt-get install python-pip python-dev
$ sudo apt-get install python-smbus
```
- Enable I2C Interface
```
$ sudo apt-get install raspi-config
$ sudo raspi-config
- Select I2C And Enable It
- Reboot Pi
```
- Add Permissions
```
$ sudo adduser www-data i2c
$ sudo visudo
- Add %www-data   ALL=NOPASSWD: /sbin/shutdown, /sbin/reboot
- So that www-data has SUDO access, This is only if you want to Shutdown Bot from WebUI
```

### Clone
- Clone the OptimusBot Repo
```
$ sudo apt-get install git-core
$ cd var/www/html
$ git clone https://github.com/ranabilal321/RPiWeb.git
$ sudo chown -R www-data:www-data /var/www
```
### Live Stream Configuration
- Run the commands below in order to enable live stream
```
$ sudo apt-get install motion
$ sudo nano /etc/motion/motion.conf
- DAEMON = OFF (change to ON)
- Webcam_localhost = ON (Change to OFF)
$ sudo nano /etc/default/motion
- start_motion_daemon = no (change to yes)
- Plug the camera in to Pi
$ sudo service motion start
```

### Additonal
- In case you want to run GPIO as PHP
```
$ git clone git://git.drogon.net/wiringPi
$ cd wiringPi
$ ./build
```
- Modify Arduino code against your hardware, This might not work on your designed hardware
```
src/arduino/arduino.ino
```

### UserConfigs
- Default Username and Password optimus
- In case you want to modify the default username and password
```
configs/config.json
```

### Authors
- Bilal Faisal
