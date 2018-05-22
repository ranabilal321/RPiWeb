#!/usr/bin/env python
#Importing libraries
import smbus
import time
import os
import sys

#Display system info
print os.uname()

#Setting smBus Object
bus = smbus.SMBus(1)

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

#Applying Converted String
bytesToSend = ConvertStringToBytes(r)
bus.write_i2c_block_data(i2c_address, i2c_cmd, bytesToSend)
#Delaying
time.sleep(0.1)
number = bus.read_byte(i2c_address)
#End Result
print('echo: ' + str(number))
