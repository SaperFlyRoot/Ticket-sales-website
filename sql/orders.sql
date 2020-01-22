﻿
DROP TABLE IF EXISTS orders;
CREATE TABLE orders (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  client_id INT(10) UNSIGNED NOT NULL,
  address VARCHAR(255) DEFAULT NULL,
  message VARCHAR(255) DEFAULT NULL,
  dt_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 7
AVG_ROW_LENGTH = 2730
CHARACTER SET utf8
COLLATE utf8_general_ci;
