# System of traffic lights and raspberry pi for air quality estimation

This project contains the code and the instructions in order to make a system of four trafic lights that coexist in a crossroad. Every trafic light has three directions (left, straight, right) and two directions for the walking people (left-right, up-down). One of the trafic light acts as a server. All trafic lights (including the server) get the current status from the server and change their light configuration. The communication between the trafic light is done through the http protocol. The timings and the coordination of the trafic lights is done through a web interface. Moreover, the server has attached an airpi, which measures the airquality and sends these information to a central server.

What is needed

* 4 * raspberry pi
* 1 * airpi
* one [relay](https://www.sparkfun.com/products/11042) for each light
* cables

The software stack is based on LAMP (Linux, Apache, Mysql, Php).

[Installation instructions](doc/README.md)

Documentation for [users](README_USERS.md).

Documentation for [developers](README_DEVELOPERS.md).

# License

See: [LICENSE.md](LICENSE.md)

# Παραδωτέα

| Παραδοτέο | Σύντομη περιγραφή | URL |
|-----------|-------------------|-----|
| 1 | Αγορά υλικού: Raspberry pi, ρελέ, λάμπες, airpi.,αισθητήρες. |  https://github.com/ellak-monades-aristeias/system-of-traffic-lights-and-raspberry-pi-for-air-quality-estimation/blob/master/README.md |
| 2 | Το raspberry pi θα μπορεί να ανάψει τις λάμπες με κάποιο ρυθμιζόμενο τρόπο (πχ το πράσινο για 1 λεπτό, το κίτρινο για 5 δευτερόλεπτα, το κόκκινο για 1 λεπτό). Θα μπορούν να ορισθούν διάφορες λάμπες πάνω στο φανάρι (πχ πράσινο για μπροστά, κίτρινο για μπροστά, κόκκινο για μπροστά, πράσινο για δεξιά, κίτρινο για δεξιά, κόκκινο για δεξιά, πράσινο για πεζούς, κόκκινο για πεζούς, κλπ). Θα μπορούν να οριστούν συσχετίσεις πάνω στις λάμπες (για παράδειγμα όταν το κόκκινο είναι αναμμένο να ανάβει το πράσινο για τους πεζούς, κλπ). | https://github.com/ellak-monades-aristeias/thermostatPI/blob/master/doc/README.md, https://github.com/ellak-monades-aristeias/system-of-traffic-lights-and-raspberry-pi-for-air-quality-estimation/blob/master/src/raspberryClient/opt/trafficLight/traficLightClient.py |
| 3 | 4 raspberry pi θα μπορούν να συνεργαστούν σε μια διασταύρωση. Θα επικοινωνούν μεταξύ τους ώστε να μην ανοίγουν ταυτόχρονα διαδρομές που μπορεί να υπάρξει σύγκρουση. Αν συμβεί κάποιο λάθος, θα ανάβει μόνο το κίτρινο σε όλα. | https://github.com/ellak-monades-aristeias/thermostatPI/blob/master/doc/CreateAccessPoint.md,   https://github.com/ellak-monades-aristeias/thermostatPI/blob/master/doc/create_tables.sql,  https://github.com/ellak-monades-aristeias/system-of-traffic-lights-and-raspberry-pi-for-air-quality-estimation/blob/master/src/raspberryServer/opt/trafficLight/traficLightServer.py,  https://github.com/ellak-monades-aristeias/system-of-traffic-lights-and-raspberry-pi-for-air-quality-estimation/blob/master/src/raspberryServer/var/www/changePassword.php,  https://github.com/ellak-monades-aristeias/system-of-traffic-lights-and-raspberry-pi-for-air-quality-estimation/blob/master/src/raspberryServer/var/www/config.php,  https://github.com/ellak-monades-aristeias/system-of-traffic-lights-and-raspberry-pi-for-air-quality-estimation/blob/master/src/raspberryServer/var/www/getStatus.php,  https://github.com/ellak-monades-aristeias/system-of-traffic-lights-and-raspberry-pi-for-air-quality-estimation/blob/master/src/raspberryServer/var/www/index.html,  https://github.com/ellak-monades-aristeias/system-of-traffic-lights-and-raspberry-pi-for-air-quality-estimation/blob/master/src/raspberryServer/var/www/statusConfiguration.php,  https://github.com/ellak-monades-aristeias/system-of-traffic-lights-and-raspberry-pi-for-air-quality-estimation/blob/master/src/raspberryServer/var/www/viewStatus.php,  https://github.com/ellak-monades-aristeias/system-of-traffic-lights-and-raspberry-pi-for-air-quality-estimation/blob/master/src/raspberryServer/var/www/viewStatusChain.php |
| 4 | Ένα airpi ανά διασταύρωση (ομάδα raspberry) θα στέλνει μετρήσεις θορύβου και CO κλπ σε έναν κεντρικό server. Εδώ θα υλοποιηθεί και το κομμάτι του server που θα αποθηκεύει τα δεδομένα και θα τα παρουσιάζει σαν μια λίστα. |  https://github.com/ellak-monades-aristeias/system-of-traffic-lights-and-raspberry-pi-for-air-quality-estimation/blob/master/src/openshift/config.php,  https://github.com/ellak-monades-aristeias/system-of-traffic-lights-and-raspberry-pi-for-air-quality-estimation/blob/master/src/openshift/get.php,  https://github.com/ellak-monades-aristeias/system-of-traffic-lights-and-raspberry-pi-for-air-quality-estimation/blob/master/src/openshift/index.php,  https://github.com/ellak-monades-aristeias/system-of-traffic-lights-and-raspberry-pi-for-air-quality-estimation/blob/master/src/openshift/insert.php,  https://github.com/ellak-monades-aristeias/system-of-traffic-lights-and-raspberry-pi-for-air-quality-estimation/blob/master/src/raspberryServer/opt/trafficAirpi/sendMeasurements.py |
