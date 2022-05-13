CREATE TABLE `books` (
   `id` INT NOT NULL AUTO_INCREMENT,
   `sku` varchar(45) NOT NULL,
   `name` varchar(45) NOT NULL,
   `price` int(11) NOT NULL,
   `productType` varchar(45) NOT NULL,
   `weight` varchar(45) DEFAULT NULL,
      PRIMARY KEY (`id`),
    UNIQUE INDEX `id_UNIQUE` (`id` ASC)  
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
 CREATE TABLE `dvds` (
   `id` INT NOT NULL AUTO_INCREMENT,
   `sku` varchar(45) NOT NULL,
   `name` varchar(45) NOT NULL,
   `price` int(11) NOT NULL,
   `productType` varchar(45) NOT NULL,
   `size` varchar(45) DEFAULT NULL,
      PRIMARY KEY (`id`),
   UNIQUE INDEX `id_UNIQUE` (`id` ASC)  
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
 CREATE TABLE `furniture` (
   `id` INT NOT NULL AUTO_INCREMENT,
   `sku` varchar(45) NOT NULL,
   `name` varchar(45) NOT NULL,
   `price` int(11) NOT NULL,
   `productType` varchar(45) NOT NULL,
   `height` varchar(45) DEFAULT NULL,
   `width` varchar(45) DEFAULT NULL,
   `length` varchar(45) DEFAULT NULL,
      PRIMARY KEY (`id`),
   UNIQUE INDEX `id_UNIQUE` (`id` ASC) 
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;