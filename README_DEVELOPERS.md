
# Software

The project uses the following software:

* Python
* Apache
* Mysql
* Php

# Architecture

The software consists of two parts. The first part is responsible to turn on and off the lights. The second part is responsible for measuring and sending to a central server some air-quality measurements.

The part that is responsible to turn on and off te lights consists of two parts. A coordinator (web server) that is responsible to store the status of all the traffic lights and change the current status of the traffic lights. The status is stored in a mysql database. It can be configure through a web interface that is written in php. The transition between the status states is made through a python program. In each traffic light a client application written in python is installed. It connects to the coordinator, downloads the current status and turns on of off the lights that correspond to the trafic light.

The part that is responsible for collecting the air quality measurements consists of two parts. The first part is a central server which is based on mysql and php. It provides the web API in order to stere and retrieve the measurements. The other part is a python program that runs on a raspberry pi that has the airpi on top of it. It collects some measurements and sents them to the central server through http requests.

# Installation

The installation instructions can be found in the doc folder: [doc/README.md](doc/README.md)

# Instructions

In order to download the source code, run:

    git clone https://github.com/ellak-monades-aristeias/system-of-traffic-lights-and-raspberry-pi-for-air-quality-estimation.git

Instructions on the code parts are given in the [wiki page](https://github.com/ellak-monades-aristeias/system-of-traffic-lights-and-raspberry-pi-for-air-quality-estimation/wiki).
