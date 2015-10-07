CREATE DATABASE `trafficlightdb`;
USE `trafficlightdb`;

CREATE TABLE IF NOT EXISTS `users` (
  `username` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY(`username`)
) ENGINE=InnoDB;

INSERT INTO `users` (`username`, `password`) VALUES ('admin', 'admin');

CREATE TABLE IF NOT EXISTS `status` (
  -- The id of the status
  `id` VARCHAR(255) NOT NULL,
  
  -- The information bellow contain the status for the 4 trafic lights.
  -- Each light has the following lights:
  -- straightGreen, straightYellow, straightRed : for the cars that go straight.
  -- leftGreen, leftYellow, leftRed : fot the cars that go left.
  -- rightGreen, rightYellow, rightRed: for the cars that go right.
  -- walkLrGreen, walkLrRed: for the people that cross the road left to right.
  -- walkUdGreen, walkUdRed: for the people that cross the road up to down.
  
  -- Traffic light 1
  `straightGreen1`  BOOLEAN NOT NULL,
  `straightYellow1` BOOLEAN NOT NULL,
  `straightRed1`    BOOLEAN NOT NULL,
  `leftGreen1`      BOOLEAN NOT NULL,
  `leftYellow1`     BOOLEAN NOT NULL,
  `leftRed1`        BOOLEAN NOT NULL,
  `rightGreen1`     BOOLEAN NOT NULL,
  `rightYellow1`    BOOLEAN NOT NULL,
  `rightRed1`       BOOLEAN NOT NULL,
  `walkLrGreen1`    BOOLEAN NOT NULL,
  `walkLrRed1`      BOOLEAN NOT NULL,
  `walkUdGreen1`    BOOLEAN NOT NULL,
  `walkUdRed1`      BOOLEAN NOT NULL,
  
  -- Traffic light 2
  `straightGreen2`  BOOLEAN NOT NULL,
  `straightYellow2` BOOLEAN NOT NULL,
  `straightRed2`    BOOLEAN NOT NULL,
  `leftGreen2`      BOOLEAN NOT NULL,
  `leftYellow2`     BOOLEAN NOT NULL,
  `leftRed2`        BOOLEAN NOT NULL,
  `rightGreen2`     BOOLEAN NOT NULL,
  `rightYellow2`    BOOLEAN NOT NULL,
  `rightRed2`       BOOLEAN NOT NULL,
  `walkLrGreen2`    BOOLEAN NOT NULL,
  `walkLrRed2`      BOOLEAN NOT NULL,
  `walkUdGreen2`    BOOLEAN NOT NULL,
  `walkUdRed2`      BOOLEAN NOT NULL,
  
  -- Traffic light 3
  `straightGreen3`  BOOLEAN NOT NULL,
  `straightYellow3` BOOLEAN NOT NULL,
  `straightRed3`    BOOLEAN NOT NULL,
  `leftGreen3`      BOOLEAN NOT NULL,
  `leftYellow3`     BOOLEAN NOT NULL,
  `leftRed3`        BOOLEAN NOT NULL,
  `rightGreen3`     BOOLEAN NOT NULL,
  `rightYellow3`    BOOLEAN NOT NULL,
  `rightRed3`       BOOLEAN NOT NULL,
  `walkLrGreen3`    BOOLEAN NOT NULL,
  `walkLrRed3`      BOOLEAN NOT NULL,
  `walkUdGreen3`    BOOLEAN NOT NULL,
  `walkUdRed3`      BOOLEAN NOT NULL,
  
  -- Traffic light 4
  `straightGreen4`  BOOLEAN NOT NULL,
  `straightYellow4` BOOLEAN NOT NULL,
  `straightRed4`    BOOLEAN NOT NULL,
  `leftGreen4`      BOOLEAN NOT NULL,
  `leftYellow4`     BOOLEAN NOT NULL,
  `leftRed4`        BOOLEAN NOT NULL,
  `rightGreen4`     BOOLEAN NOT NULL,
  `rightYellow4`    BOOLEAN NOT NULL,
  `rightRed4`       BOOLEAN NOT NULL,
  `walkLrGreen4`    BOOLEAN NOT NULL,
  `walkLrRed4`      BOOLEAN NOT NULL,
  `walkUdGreen4`    BOOLEAN NOT NULL,
  `walkUdRed4`      BOOLEAN NOT NULL,
  
  PRIMARY KEY(`id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `statusChain` (
  -- which status is after the current one.
  `statusIdNow`  VARCHAR(255) NOT NULL,
  `statusIdNext` VARCHAR(255) NOT NULL,
  PRIMARY KEY(`statusIdNow`),
  FOREIGN KEY (`statusIdNow`)  REFERENCES `status`(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (`statusIdNext`) REFERENCES `status`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `statusNow` (
  -- The curent status.
  `statusIdNow`  VARCHAR(255) NOT NULL,
  FOREIGN KEY (`statusIdNow`)  REFERENCES `status`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

