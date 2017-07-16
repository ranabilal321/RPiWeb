#!/usr/bin/env python
#have to run 'sudo apt-get install python-smbus'
#in Terminal to install smbus
import smbus
import time
import os
import sys

#Display system info
print os.uname()

bus = smbus.SMBus(1)
print("hello")

#Setting I2C address of Arduino Slave
i2c_address = 0x07
i2c_cmd = 0x01

#Converting string to bytes
def ConvertStringToBytes(src):
    converted = []
    for b in src:
        converted.append(ord(b))
    return converted

exit = False
r = str(sys.argv[1])
print(r)
bytesToSend = ConvertStringToBytes(r)
bus.write_i2c_block_data(i2c_address, i2c_cmd, bytesToSend)
time.sleep(0.1)
number = bus.read_byte(i2c_address)
print('echo: ' + str(number))