# System of traffic lights and raspberry pi for air quality estimation

This project contains the code and the instructions in order to make a system of four trafic lights that coexist in a crossroad. Every trafic light has three directions (left, straight, right) and two directions for the walking people (left-right, up-down). One of the trafic light acts as a server. All trafic lights (including the server) get the current status from the server and change their light configuration. The communication between the trafic light is done through the http protocol. The timings and the coordination of the trafic lights is done through a web interface. Moreover, the server has attached an airpi, which measures the airquality and sends these information to a central server.

What is needed

* 4 * raspberry pi
* 1 * airpi

The software stack is based on LAMP (Linux, Apache, Mysql, Php).

[Installation instructions](doc/README.md)
