/*
  Optimus | The WatchBot
  Code to run on Arduino
*/

#include <Servo.h>
#include <LiquidCrystal.h>
#include <Wire.h>

#define LED_PIN 13 //Setting LED Pin 13
Servo head;  // create servo object to control a servo

int pos = 0; //Servo Motor Starting Position
int A = 6; //Pin Submotor
int B = 7; //Pin Submotor
int C = 8; //Pin Submotor
int D = 9; //Pin Submotor

byte slave_address = 7; //Setting Slave Address at 7
int echonum = 0;

//Setup function
void setup() {
  head.attach(11); //Head attach at pin 11
  pinMode(A, OUTPUT); //Setting A to Output
  pinMode(C, OUTPUT); //Setting B to Output
  pinMode(B, OUTPUT); //Setting C to Output
  pinMode(D, OUTPUT); //Setting D to Output
  Serial.begin(9600);
  Serial.println("setup");
  digitalWrite(LED_PIN, HIGH); //Digital LED High

  head.write(pos); //Writing Servo position
  Wire.begin(slave_address); //Begin to perform
  Wire.onReceive(receiveEvent); //Recieving event
  Wire.onRequest(requestEvent); //Requsting event
}

void loop() {
    Serial.println(pos); //Servo Position
    
}

//Request Event
void requestEvent() {
  Wire.write(echonum);
  toggleLED();
}

//Recieve Event
void receiveEvent(int howMany) {
  int numOfBytes = Wire.available();
  byte b = Wire.read();  //cmd
  for (int i = 0; i < numOfBytes - 1; i++) {
    char data = Wire.read(); //Reading the data and storing it in data var
    if (data == 'f')
    {
      forward(); //If f forward function
    }
    else if (data == 'b')
    {
      backward(); //If b backward function
    }
    else if (data == 'l')
    {
      left(); //If l turnLeft function
    }
    else if (data == 'r')
    {
      right(); //If r turn Right function
    }
    else if (data == 'h') {
      halt(); //If h Halt function
    }
    else if (data == 'u') {
      up(); //Head movement up function
    }
    else if (data == 'd') {
      down(); //Head movement down function
    }
  }
}
//Backward fucntion
void backward()
{
  halt(); //Halting every operation
  digitalWrite(A, HIGH); //Writing A as High
  digitalWrite(D, HIGH); //Writing B as High

}
//Forward function
void forward()
{
  halt(); //Halting every operation
  digitalWrite(C, HIGH); //Writing C as High
  digitalWrite(B, HIGH); //Writing B as High
}

//Left function
void left()
{
  halt(); //Halting every operation
  digitalWrite(A, HIGH); //Writing A as High
  digitalWrite(C, HIGH); //Writing C as High
}

//Right function
void right() {
  halt(); //Halting every operation
  digitalWrite(D, HIGH); //Writing D as High
  digitalWrite(B, HIGH); //Writing B as High
}

//Halt function
void halt()
{
  digitalWrite(A, LOW); //Writing A as Low
  digitalWrite(B, LOW); //Writing B as Low
  digitalWrite(C, LOW); //Writing C as Low
  digitalWrite(D, LOW); //Writing D as Low
}

//Head uo function
void up() {
  if (pos < 180)
  {
    pos += 15;
    head.write(pos);
  }
}

//Head down function
void down()
{
  if (pos > 0)
  {
    pos -= 15;
    head.write(pos);
  }
}