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
gpioWalkLrGreen    = 12
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
  #It doe not sleep, in order to be as quick as posible, becaus the status may change in any moment.
  #Make an http request to the server.
  resp = requests.get(url)
  print ("%s" % (resp))
  
  #Parse the json.
  data = json.loads(resp.text)

  print ("Myid=%d" % (myId))
  print("Straight:[%s, %s, %s]" % (data["straightGreen"+str(myId)], data["straightYellow"+str(myId)], data["straightRed"+str(myId)]))
  print("Left:[%s, %s, %s]" % (data["leftGreen"+str(myId)], data["leftYellow"+str(myId)], data["leftRed"+str(myId)]))
  print("Right:[%s, %s, %s]" % (data["rightGreen"+str(myId)], data["rightYellow"+str(myId)], data["rightRed"+str(myId)]))
  print("WalkLR:[%s, %s]" % (data["walkLrRed"+str(myId)], data["walkUdGreen"+str(myId)]))
  print("WalkUD:[%s, %s]" % (data["walkUdGreen"+str(myId)], data["walkUdRed"+str(myId)]))
  
  #Extract the values
  straightGreen  = data["straightGreen"+str(myId)]
  straightYellow = data["straightYellow"+str(myId)]
  straightRed    = data["straightRed"+str(myId)]
  leftGreen      = data["leftGreen"+str(myId)]
  leftYellow     = data["leftYellow"+str(myId)]
  leftRed        = data["leftRed"+str(myId)]
  rightGreen     = data["rightGreen"+str(myId)]
  rightYellow    = data["rightYellow"+str(myId)]
  rightRed       = data["rightRed"+str(myId)]
  walkLrGreen    = data["walkLrGreen"+str(myId)]
  walkLrRed      = data["walkLrRed"+str(myId)]
  walkUdGreen    = data["walkUdGreen"+str(myId)]
  walkUdRed      = data["walkUdRed"+str(myId)]
  
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
