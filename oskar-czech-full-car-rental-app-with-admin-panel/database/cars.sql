-- cars

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Struktura dla `admin`

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- Dodawanie danych do `admin`

INSERT INTO `admin` (`admin_id`, `uname`, `pass`) VALUES
(1, 'admin', 'admin');

-- Struktura dla `cars`

CREATE TABLE IF NOT EXISTS `cars` (
  `car_id` int(11) NOT NULL AUTO_INCREMENT,
  `car_name` varchar(255) NOT NULL,
  `car_type` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `hire_cost` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`car_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- Dodawanie danych do `cars`

INSERT INTO `cars` (`car_id`, `car_name`, `car_type`, `image`, `hire_cost`, `capacity`, `status`) VALUES
(1, 'Mercedes Benz', 'Mercedes Benz', 'car1.jpg', 2200, 5, 'Available'),
(2, 'Range Rover', 'Land Rover', 'car2.jpg', 1850, 6, 'Available'),
(3, 'Harrier', 'Toyota', 'car3.jpg', 1900, 6, 'Available'),
(5, 'Land Cruiser V8', 'Land Cruiser ', 'images (2).jpg', 1800, 5, 'Available'),
(6, 'Security Vehicles', 'Hammer Cars', 'sonkort2.png', 2000, 8, 'Available'),
(7, 'Wedding Limousine', 'Wedding Limousine', 'images (3).jpg', 2100, 10, 'Available');

-- Struktura dla `client`

CREATE TABLE IF NOT EXISTS `client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_no` int(11) NOT NULL,
  `phone` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `car_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `mpesa` varchar(255) NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- Dodawanie danych do `client`

INSERT INTO `client` (`client_id`, `fname`, `email`, `id_no`, `phone`, `location`, `gender`, `car_id`, `status`, `mpesa`) VALUES
(2, 'Oskar Czech', 'oskus@yahoo.com', 30073147, 705053484, 'oskus', 'Male', 1, 'Approved', 'GTD45H7H6'),
(3, 'Janina Bednarska', 'janina@gmail.com', 27695131, 707403614, 'jania', 'Female', 2, 'Approved', 'DJFL870FDK9'),
(4, 'zwykly troll', 'hehehe@gmail.com', 1234567, 717056766, 'yyyyy', 'Male', 2, 'Approved', 'HJHK678X');

-- Struktrua dla `hire`

CREATE TABLE IF NOT EXISTS `hire` (
  `hire_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`hire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- Struktura dla `message`

CREATE TABLE IF NOT EXISTS `message` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- Dodawanie danych do `message`

INSERT INTO `message` (`msg_id`, `client_id`, `message`, `status`, `time`) VALUES
(2, 0, 'Dziala to w ogole?', 'Unread', '0000-00-00 00:00:00'),
(3, 0, 'ooo widze, ze przychodza wiadomosci?', 'Unread', '0000-00-00 00:00:00'),
(5, 0, 'Huuuura :)', 'Unread', '2023-01-04 21:45:33');