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
      cursorStatusNow = db.cursor()
      cursorStatusNow.execute("""SELECT `statusIdNow` FROM `statusNow` LIMIT 1""")
      db.commit()
      if cursorStatusNow.rowcount == 0:
        #If no status is provided, then try to find one.
        cursorStatusNow.close()
        cursorStatusChain = db.cursor()
        cursorStatusChain.execute("""SELECT `statusIdNow` FROM `statusChain` LIMIT 1""")
        db.commit()
        if cursorStatusChain.rowcount == 1:
          #Insert it into the database
          statusIdNow = cursorStatusChain.fetchone()[0]
          cursorStatusNow = db.cursor()
          cursorStatusNow.execute("""INSERT INTO `statusNow` (`statusIdNow`) VALUES (%s) """, (statusIdNow));
          db.commit()
          cursorStatusNow.close()
        cursorStatusChain.close()
        #Continue in the begining of the while, in order to read it.
        continue
      #Cursor has one row.
      statusIdNow = cursorStatusNow.fetchone()[0]
      cursorStatusNow.close()
      print("StatusIdNow=%s" % (statusIdNow))
      
      cursorStatusChain = db.cursor()
      cursorStatusChain.execute("""SELECT `statusIdNext` FROM `statusChain` WHERE `statusIdNow`=%s LIMIT 1""", (statusIdNow));
      db.commit()
      if cursorStatusChain.rowcount == 1:
        statusIdNext = cursorStatusChain.fetchone()[0]
        cursorStatusChain.close
        cursorStatusNow = db.cursor()
        cursorStatusNow.execute("""UPDATE `statusNow` SET `statusIdNow`=%s """, (statusIdNext));
        db.commit()
        cursorStatusNow.close()
      cursorStatusChain.close()
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
