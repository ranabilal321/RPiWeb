# OptimusBot | WebUI
OptimusBot WebUI, Live Stream, Bot Controls, Bot Head Movements.

## Getting Started
Follow these instructions in order to get the Bot up and running.

### Prerequisites
- XUbuntu For Raspberry Pi
```
https://ubuntu-pi-flavour-maker.org/download/
```
- Install Apache Web Server
```
$ sudo apt-get update -y
$ sudo apt-get install apache2
$ sudo systemctl start apache2.service
```
- Install PHP
```
$ sudo apt-get install php -y
$ sudo apt-get install -y php-{bcmath,bz2,intl,gd,mbstring,mcrypt,mysql,zip} && sudo apt-get install libapache2-mod-php  -y
$ systemctl restart apache2.service
```
- Install Python Packages
```
$ sudo apt-get update
$ sudo apt-get upgrade
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

### Additonal
- In case you want to run GPIO as PHP
```
$ git clone git://git.drogon.net/wiringPi
$ cd wiringPi
$ ./build
```

### Authors
- Bilal Faisal
