#!/usr/bin/python

import time
import sys
import traceback
import warnings
import MySQLdb
from datetime import datetime

#Some settings.
mysqlPass = "raspberry"

#How often the lights change.
tick = 30

#Do not display warning of mysql.
warnings.filterwarnings("ignore", category = MySQLdb.Warning)

#Connect to mysql
db = MySQLdb.connect(host="localhost", user="root", passwd=mysqlPass, db="trafficlightdb")

#Run until ctrl^c is pressed
try:
  while True:
    a = datetime.now()
    
    #Read the curent state and go to the next.
    try:
      x = db.cursor()
      x.execute("""SELECT `statusIdNow` FROM `statusNow`""");
      db.commit()
      for (statusIdNow) in x:
        y = db.cursor()
        y.execute("""SELECT `statusIdNext` FROM `statusChain` WHERE `statusIdNow`=%s """, (statusIdNow));
        db.commit()
        for (statusIdNext) in y:
          z = db.cursor()
          z.execute("""UPDATE `statusNow` SET `statusIdNow`=%s """, (statusIdNext));
          db.commit()
          z.close()
        y.close()
      x.close()
    except:
      db.rollback()
      ex_type, ex, tb = sys.exc_info()
      traceback.print_tb(tb)
      print ex
    
    # Do not wait for the time that the above command consumed.
    b = datetime.now()
    c = b - a
    if tick - c.total_seconds() > 0:
      time.sleep(tick - c.total_seconds())
except KeyboardInterrupt:
  print "Exiting..."

#Close mysql connection
db.close()
