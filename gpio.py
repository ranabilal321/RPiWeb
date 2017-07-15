import cgi
import RPi.GPIO as GPIO
import time
GPIO.setmode(GPIO.BOARD)

form = cgi.FieldStorage();
getId = form.getvalue('getId')

#Function for Halt Operations

def haltAll():

	GPIO.setup(18,GPIO.OUT)
	GPIO.setup(22,GPIO.OUT)
	GPIO.setup(24,GPIO.OUT)
	GPIO.setup(25,GPIO.OUT)
	GPIO.setup(18,False)
	GPIO.setup(22,False)
	GPIO.setup(24,False)
	GPIO.setup(25,False)

if getId == 'forwardStart'

	#Before Forward Start All Pins Should Halt
	haltAll()

	print "Forward Pins : 18,24"

	#Forward Start Pin Operations
	GPIO.setup(18,GPIO.OUT)
	GPIO.setup(24,GPIO.OUT)
	GPIO.setup(18,True)
	GPIO.setup(24,True)

elif getId == 'backwardStart'

	#Before Backward Start All Pins Should Halt
	haltAll()

	print "Backward Pins : 22,25"

	#Backward Start Pin Operations
	GPIO.setup(22,GPIO.OUT)
	GPIO.setup(25,GPIO.OUT)
	GPIO.setup(22,True)
	GPIO.setup(25,True)

elif getId == 'turnLeft'

	#Before Backward Start All Pins Should Halt
	haltAll()

	print "Left Pins : 22,24"

	#Turn Left Pin Operations
	GPIO.setup(22,GPIO.OUT)
	GPIO.setup(24,GPIO.OUT)
	GPIO.setup(22,True)
	GPIO.setup(24,True)

elif getId == 'turnRight'

	#Before Backward Start All Pins Should Halt
	haltAll()

	print "Right Pins : 18,25"

	#Turn Right Pin Operations

	GPIO.setup(18,GPIO.OUT)
	GPIO.setup(25,GPIO.OUT)
	GPIO.setup(18,True)
	GPIO.setup(25,True)

elif getId == 'halt'

	#Halt All Function Call Here.
	haltAll()

else
	#If there is an exception
	print "There is an error with your selection"