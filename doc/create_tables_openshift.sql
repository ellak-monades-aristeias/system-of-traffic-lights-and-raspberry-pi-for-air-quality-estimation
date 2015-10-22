CREATE TABLE IF NOT EXISTS `users` (
  `username` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY(`username`)
) ENGINE=InnoDB;

INSERT INTO `users` (`username`, `password`) VALUES ('admin', 'admin');

CREATE TABLE IF NOT EXISTS `measurements` (
  `time`   DATETIME NOT NULL,
  `no2`    FLOAT NOT NULL,
  `co`     FLOAT NOT NULL,
  `volume` FLOAT NOT NULL,
  PRIMARY KEY(`time`)
) ENGINE=InnoDB;
