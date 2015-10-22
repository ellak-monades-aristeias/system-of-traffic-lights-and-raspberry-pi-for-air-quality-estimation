import os
import subprocess
import urllib2

basUrl = "https://central-isto.rhcloud.com/insert.php"
userU  = "admin"
passU  = "admin"


def execute(command):    
  p = subprocess.Popen(command, stdout=subprocess.PIPE, stderr=subprocess.STDOUT)
  time = ""
  no2  = ""
  co   = ""
  vol  = ""
  while(True):
    retcode = p.poll()
    if(retcode is not None):
        print("exit...")
        break
    line = p.stdout.readline()
    #print(line)
    if line.startswith("=========="):
        if time and no2 and co and vol:
            param="time=" + time + "&no2=" + no2 + "&co=" + co + "&volume=" + vol
            url = basUrl+"?userU="+userU+"&passU="+passU+"&"+param
            try:
              urllib2.urlopen(url).read()
              print("send: " + url)
            except: 
              pass
        time = ""
        no2  = ""
        co   = ""
        vol  = ""
    if line.startswith("Time"):
        time = line[line.find(":")+1:].strip().replace(" ","T")
    if line.startswith("Nitrogen Dioxide"):
        no2 = line[line.find(":")+1:].replace("(sample)","").replace("Ohms","").replace("mV","").strip()
    if line.startswith("Carbon Monoxide"):
        co = line[line.find(":")+1:].replace("(sample)","").replace("Ohms","").replace("mV","").strip()
    if line.startswith("Volume"):
        vol = line[line.find(":")+1:].replace("(sample)","").replace("Ohms","").replace("mV","").strip()

os.chdir("/home/pi/AirPi")
execute(["airpictl.sh", "normal"])

