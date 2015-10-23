
# Harware

What is needed

* 4 * raspberry pi
* 1 * airpi
* one [relay](https://www.sparkfun.com/products/11042) for each light
* cables

The software stack is based on LAMP (Linux, Apache, Mysql, Php).

# Update

Run the following commands to every raspberry pi:

    sudo apt-get update
    sudo apt-get -y upgrade
    sudo reboot

# Connections of the lights

Each light has 13 lights, as shown in the [image](lights.png).
The raspberry pi 2 has 40 pins, as shown in the [image](http://www.open-electronics.org/wp-content/uploads/2014/12/Raspberry-Pi-GPIO-Layout-Worksheet.png).
In order to operate correctly, the connections that must be used are hihglighted in the [image](schematic.png).
For reference, these are the correct connections:

* GPIO17 - straight green
* GPIO18 - straight yellow
* GPIO27 - straight red
* GPIO22 - left green
* GPIO23 - left green
* GPIO24 - left red
* GPIO25 - right green
* GPIO5 - right yellow
* GPIO6 - right red
* GPIO12 - walk left right green
* GPIO13 - walk left right red
* GPIO19 - walk up down green
* GPIO16 - walk up down red

The above connection must go first to a relay, and then the output of the relay must go the the actual lights.
If a trafic light has no light for one side of the road (for example, if no road to the right is presented), then the corresponding connections must be left unwired.
If a trafic light contains more than on light in one connection, connect these lights in parralel after the relay.
For better performance, the 5.5V and GRD wire of the relays can be provided through other circuit and not the raspberry pi.

The trafic lights must be connected with each other in a local network.
As the raspberry pi has an ethernet port, the idial connection is through a switch with 4 ports.


# Software configuration

## Server

Install the following packages:

    sudo apt-get -y install mysql-server mysql-client apache2 libapache2-mod-auth-mysql php5-cli php5-mysql php5 libapache2-mod-php5
    sudo apt-get install python-mysqldb
    sudo a2enmod auth_mysql
    sudo service apache2 restart

Connect to the database:

    mysql -p -u root

In the mysql cliend, copy and paste the commands that are located in the [create_tables_raspberry_server](create_tables_raspberry_server).

Copy the files from the folder `src/raspberryServer/var/www` to the folder `/var/www`:

    sudo cp src/raspberryServer/var/www/* /var/www

Copy the file `src/raspberryServer/opt/trafficLight/traficLightServer.py` to `/opt/trafficLight/traficLightServer.py`:

    sudo mkdir /opt/trafficLight/
    sudo cp src/raspberryServer/opt/trafficLight/traficLightServer.py /opt/trafficLight/traficLightServer.py

In order to run this script on boot time, add the following line to `/etc/rc.local`:

     sudo python /opt/trafficLight/traficLightServer.py 2>&1 > /var/log/traficLightServer.log &

In order connect to the web interface, use the url `serverip/statusConfiguration.php`. The default username and password are both `admin`. After sucessfull login, you can change the password.

Edit the file `/etc/network/interfaces` in order to give the server the ip `192.168.1.1`. Replace the lines that correspont to eth0 with the following:

    iface eth0 inet static
    address 192.168.1.1
    netmask 255.255.255.0
    network 192.168.1.0
    broadcast 192.168.1.255
    gateway 192.168.1.254

### Airpi configuration.

First, we myst install the [airpi software](https://github.com/haydnw/AirPi). Run:

    git clone http://github.com/haydnw/airpi AirPi
    cd AirPi
    sudo /bin/bash install.sh

add the following line in the end of `~/.profile`

    PATH=/home/pi/AirPi:$PATH

Copy the file `src/raspberryServer/opt/trafficAirpi/sendMeasurements.py` to `/opt/trafficAirpi/sendMeasurements.py`:

    sudo mkdir /opt/trafficAirpi/
    sudo cp src/raspberryServer/opt/trafficAirpi/sendMeasurements.py /opt/trafficAirpi/sendMeasurements.py

In order to run this script on boot time, add the following line to `/etc/rc.local`:

     sudo python /opt/trafficAirpi/sendMeasurements.py 2>&1 > /var/log/sendMeasurements.log &

The file `/opt/trafficAirpi/sendMeasurements.py` have the variables `basUrl`, `userU` and `passU` which can be changed. The `baseUrl` is the url of the remote server.

## Trafic lights

The trafic light client must run on every raspberry (it must also run in the rusberry that acts as a server).

Install the packages:

    sudo apt-get install python-mysqldb

Copy the file `src/raspberryClient/opt/trafficLight/traficLightClient.py` to `/opt/trafficLight/traficLightClient.py`:

    mkdir /opt/trafficLight/
    sudo cp src/raspberryClient/opt/trafficLight/traficLightClient.py /opt/trafficLight/traficLightClient.py

Edit the file `/opt/trafficLight/traficLightClient.py`. Change the lines:

    myId = 1;
    url = "http://192.168.1.1/getStatus.php"

with the sesired values. The `myId` variable must be 1 or 2 or 3 or 4 and it identifies the raspberry.
The `url` holds the ip of the server.

Edit the file `/etc/network/interfaces` in order to give the client the ip `192.168.1.?`. Replace the lines that correspont to eth0 with the following:

    iface eth0 inet static
    address 192.168.1.?
    netmask 255.255.255.0
    network 192.168.1.0
    broadcast 192.168.1.255

Note the `?`. This myst be replaced with the actual id of the rasperry (1 or 2 or 3 or 4).
    
In order to run this script on boot time, add the following line to `/etc/rc.local`:

    sudo python /opt/trafficLight/traficLightClient.py 2>&1 > /var/log/traficLightClient.log &

# Remote Server configuration.

The files in the directory `src/openshift/` are designed to be used out of the box with the [openshift](https://www.openshift.com) platform. However, they can be used with any LAMP server.

Copy the files `src/openshift/*` the public accesible dicertory. Run the mysql commands that are in the file [doc/create_tables_openshift.sql](doc/create_tables_openshift.sql). If needed, change the username and the password. The remote server is ready.
