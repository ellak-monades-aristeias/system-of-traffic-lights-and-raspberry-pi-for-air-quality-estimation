# Update

Run the following commands to every raspberry pi:

    sudo apt-get update
    sudo apt-get -y upgrade
    sudo reboot

# Connections of the lights

Each light has 13 lights, as shown in the [image](lights.png)
In order to operate correctly, each light must be wires as shown in [image](schematic.png).
If a trafic light has no light for one side of the road (for example, if no road to the right is presented), then the corresponding connections must be left unwired.
If a trafic light contains more than on light in one connection, connect these lights after the relay.
For better performance, the 5.5V and GRD wire of the relays can be provided through other circuit and not the raspberry pi.

TODO

# Software configuration

## Server

Install the following packages:

    sudo apt-get -y install mysql-server mysql-client apache2 libapache2-mod-auth-mysql php5-cli php5-mysql php5 libapache2-mod-php5
    sudo a2enmod auth_mysql
    sudo service apache2 restart

    TODO

## Trafic lights

    TODO