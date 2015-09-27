#!/usr/bin/python

import json
import requests
import RPi.GPIO as GPIO

#id 1 or 2 or 3 or 4.
myId = 1;
url = "http://192.168.1.1/getStatus.php"

#In which GPIO pin is each light.
gpioStraightGreen  = 17
gpioStraightYellow = 18
gpioSraightRed     = 27
gpioLeftGreen      = 22
gpioLeftYellow     = 23
gpioLeftRed        = 24
gpioRightGreen     = 25
gpioRightYellow    = 5
gpioRightRed       = 6
gpioWalkLrGreen    = 32
gpioWalkLrRed      = 13
gpioWalkUdGreen    = 19
gpioWalkUdRed      = 16

#Enable the output pin.
GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)
GPIO.setup(gpioStraightGreen, GPIO.OUT)
GPIO.setup(gpioStraightYellow, GPIO.OUT)
GPIO.setup(gpioSraightRed, GPIO.OUT)
GPIO.setup(gpioLeftGreen, GPIO.OUT)
GPIO.setup(gpioLeftYellow, GPIO.OUT)
GPIO.setup(gpioLeftRed, GPIO.OUT)
GPIO.setup(gpioRightGreen, GPIO.OUT)
GPIO.setup(gpioRightYellow, GPIO.OUT)
GPIO.setup(gpioRightRed, GPIO.OUT)
GPIO.setup(gpioWalkLrGreen, GPIO.OUT)
GPIO.setup(gpioWalkLrRed, GPIO.OUT)
GPIO.setup(gpioWalkUdGreen, GPIO.OUT)
GPIO.setup(gpioWalkUdRed, GPIO.OUT)

while True:
  #Make an http request to the server.
  resp = requests.get(url=url, params=params)
  
  #Parse the json.
  data = json.loads(resp.text)
  
  #Extract the values
  straightGreen  = data["straightGreen$myId"]
  straightYellow = data["straightYellow$myId"]
  straightRed    = data["straightRed$myId"]
  leftGreen      = data["leftGreen$myId"]
  leftYellow     = data["leftYellow$myId"]
  leftRed        = data["leftRed$myId"]
  rightGreen     = data["rightGreen$myId"]
  rightYellow    = data["rightYellow$myId"]
  rightRed       = data["rightRed$myId"]
  walkLrGreen    = data["walkLrGreen$myId"]
  walkLrRed      = data["walkLrRed$myId"]
  walkUdGreen    = data["walkUdGreen$myId"]
  walkUdRed      = data["walkUdRed$myId"]
  
  #Light the lamps according to the values.
  GPIO.output(gpioStraightGreen,  straightGreen)
  GPIO.output(gpioStraightYellow, straightYellow)
  GPIO.output(gpioSraightRed,     straightRed)
  GPIO.output(gpioLeftGreen,      leftGreen)
  GPIO.output(gpioLeftYellow,     leftYellow)
  GPIO.output(gpioLeftRed,        leftRed)
  GPIO.output(gpioRightGreen,     rightGreen)
  GPIO.output(gpioRightYellow,    rightYellow)
  GPIO.output(gpioRightRed,       rightRed)
  GPIO.output(gpioWalkLrGreen,    walkLrGreen)
  GPIO.output(gpioWalkLrRed,      walkLrRed)
  GPIO.output(gpioWalkUdGreen,    walkUdGreen)
  GPIO.output(gpioWalkUdRed,      walkUdRed)

