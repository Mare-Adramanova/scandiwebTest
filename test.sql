CREATE TABLE `books` (
   `sku` varchar(45) NOT NULL,
   `name` varchar(45) NOT NULL,
   `price` int(11) NOT NULL,
   `productType` varchar(45) NOT NULL,
   `weight` varchar(45) DEFAULT NULL,
      PRIMARY KEY (`sku`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
 CREATE TABLE `dvds` (
   `sku` varchar(45) NOT NULL,
   `name` varchar(45) NOT NULL,
   `price` int(11) NOT NULL,
   `productType` varchar(45) NOT NULL,
   `size` varchar(45) DEFAULT NULL,
      PRIMARY KEY (`sku`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
 CREATE TABLE `furniture` (
   `sku` varchar(45) NOT NULL,
   `name` varchar(45) NOT NULL,
   `price` int(11) NOT NULL,
   `productType` varchar(45) NOT NULL,
   `height` varchar(45) DEFAULT NULL,
   `width` varchar(45) DEFAULT NULL,
   `length` varchar(45) DEFAULT NULL,
      PRIMARY KEY (`sku`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;