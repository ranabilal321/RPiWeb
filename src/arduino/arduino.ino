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

void setup() {
  head.attach(11);
  pinMode(A, OUTPUT);
  pinMode(C, OUTPUT);
  pinMode(B, OUTPUT);
  pinMode(D, OUTPUT);
  Serial.begin(9600);
  Serial.println("setup");
  digitalWrite(LED_PIN, HIGH);
  head.write(pos);
  Wire.begin(slave_address);
  Wire.onReceive(receiveEvent);
  Wire.onRequest(requestEvent);
}

void loop() {
  Serial.println(pos);
}

void requestEvent() {
  Wire.write(echonum);
  toggleLED();
}

void receiveEvent(int howMany) {
  int numOfBytes = Wire.available();
  byte b = Wire.read();
  for (int i = 0; i < numOfBytes - 1; i++) {
    char data = Wire.read(); 
    if (data == 'f') {
      forward();
    }
    else if (data == 'b') {
      backward();
    }
    else if (data == 'l') {
      left();
    }
    else if (data == 'r') {
      right();
    }
    else if (data == 'h') {
      halt();
    }
    else if (data == 'u') {
      up();
    }
    else if (data == 'd') {
      down();
    }
  }
}

void backward() {
  halt();
  digitalWrite(A, HIGH);
  digitalWrite(D, HIGH);
}

void forward() {
  halt();
  digitalWrite(C, HIGH);
  digitalWrite(B, HIGH);
}

void left() {
  halt();
  digitalWrite(A, HIGH);
  digitalWrite(C, HIGH);
}

void right() {
  halt();
  digitalWrite(D, HIGH);
  digitalWrite(B, HIGH);
}

void halt() {
  digitalWrite(A, LOW);
  digitalWrite(B, LOW);
  digitalWrite(C, LOW);
  digitalWrite(D, LOW);
}

void up() {
  if (pos < 180) {
    pos += 15;
    head.write(pos);
  }
}

void down() {
  if (pos > 0) {
    pos -= 15;
    head.write(pos);
  }
}