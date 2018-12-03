--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
    `Fname` varchar(20) NOT NULL,
    `Minit` varchar(1) NOT NULL,
    `Lname` varchar(20) NOT NULL,
    `SSN` varchar(11) NOT NULL,
    `PhoneNumber` varchar(10) NOT NULL,
    `DateOfBirth` date NOT NULL,
    `Address` varchar(50) NOT NULL,
    `State` varchar(2) NOT NULL,
    `Sex` varchar(1) NOT NULL,
    PRIMARY KEY (`SSN`)
);

--
-- Inserting users into user table
--

INSERT INTO `Users` (`Fname`, `Minit`, `Lname`, `SSN`, `PhoneNumber`, `DateOfBirth`, `Address`, `State`, `Sex`) VALUES
('John', 'B', 'Smith', '123-45-6789', '4245930274', '1965-01-09', '731 Fondren', 'TX', 'M'),
('Bella', 'T', 'Smith', '333-44-5555', '4247604858', '1966-12-08', '731 Fondren', 'TX', 'F'),
('Marthena', 'E', 'Smith', '369-66-0605', '4349727690', '1994-12-26', '731 Fondren', 'TX', 'F'),
('Joyce', 'A', 'English', '453-45-3453', '2167954402', '1972-07-10', '5631 Rice', 'MO', 'F'),
('James', 'E', 'English', '888-66-5555', '3749574739', '1999-11-10', '5631 Rice', 'MO', 'M'),
('Ramesh', 'K', 'Narayan', '666-88-4444', '4603447747', '1962-09-15', '975 Fire Oak', 'NY', 'M'),
('Taber', 'P', 'Narayan', '846-76-7711', '4601990071', '2004-03-28', '975 Fire Oak', 'NY', 'M'),
('Jennifer', 'S', 'Wallace', '987-65-4321', '7039781660', '1956-06-20', '291 Berry', 'TX', 'F'),
('Ahmad', 'V', 'Jabbar', '987-98-7987', '8099641153', '1969-03-29', '980 Dallas', 'TX', 'M'),
('Alicia', 'J', 'Zelaya', '999-88-7777', '4909127789', '1968-01-19', '3321 Castle', 'TX', 'F'),
('Amie', 'L', 'Bearblock', '865-06-9004', '6564600755', '1977-02-19', '150 3rd Trail', 'CO', 'F'),
('Bowie', 'D', 'Colter', '203-91-2929', '6196946996', '1961-10-24', '1 Gateway Circle', 'CA', 'M'),
('Abdul', 'G', 'Colter', '191-73-8121', '6198089453', '1993-12-01', '1 Gateway Circle', 'CA', 'M'),
('Aloysia', 'M', 'Gee', '182-29-3088', '6015122951', '1979-03-23', '6 Derek Point', 'WA', 'F'),
('Ragnar', 'F', 'Gee', '524-84-9872', '6018918135', '1986-04-02', '824 Bartelt Alley', 'OR', 'M'),
('Lorne', 'B', 'Rodden', '480-68-1388', '4106609123', '1991-04-27', '7474 Anniversary Road', 'MD', 'F'),
('Mikael', 'W', 'Grishakin', '562-79-9262', '6022867904', '1990-06-19', '3 Swallow Lane', 'AZ', 'M'),
('Karney', 'O', 'Dome', '230-09-2339', '3142176503', '1977-05-26', '70 Sage Center', 'MO', 'M');

--
-- Table structure for table `Authorized User`
--

CREATE TABLE `AuthorizedUser` (
  `SSN` varchar(11),
  `CustomerID` varchar(20) NOT NULL,
  PRIMARY KEY (`SSN`),
  FOREIGN KEY (`SSN`) REFERENCES `Users` (`SSN`)
);

--
-- Inserting Authorized Users
--

INSERT INTO `AuthorizedUser` (`SSN`, `CustomerID`) VALUES
('123-45-6789', 1234),
('453-45-3453', 2345),
('666-88-4444', 3456),
('987-65-4321', 4321),
('987-98-7987', 0101),
('999-88-7777', 1111),
('865-06-9004', 6789),
('203-91-2929', 5489),
('182-29-3088', 7829),
('480-68-1388', 3729),
('562-79-9262', 7399),
('230-09-2339', 7890);

--
-- Table structure for table `Secondary User`
--

CREATE TABLE `SecondaryUser` (
  `SSN` varchar(11),
  `AuthUserSSN` varchar(11),
  `RelationshipToAuthUser` varchar(20),
  PRIMARY KEY (`SSN`),
  FOREIGN KEY (`AuthUserSSN`) REFERENCES `AuthorizedUser` (`SSN`),
  FOREIGN KEY (`SSN`) REFERENCES `Users` (`SSN`)
);

--
-- Inserting Secondary Users
--

INSERT INTO `SecondaryUser` (`SSN`, `AuthUserSSN`, `RelationshipToAuthUser`) VALUES
('333-44-5555', '123-45-6789', 'Spouse'),
('369-66-0605', '123-45-6789', 'Child'),
('888-66-5555', '453-45-3453', 'Child'),
('191-73-8121', '203-91-2929', 'Child'),
('846-76-7711', '666-88-4444', 'Child'),
('524-84-9872', '182-29-3088', 'Spouse');


--
-- Table structure for table `Data`
--

CREATE TABLE `Data` (
  `UserSSN` varchar(11),
  `Location` varchar(50),
  `Amount` float,
  `Time` varchar(5),
  `Date` date,
  PRIMARY KEY (`UserSSN`, `Location`, `Amount`, `Time`, `Date`),
  FOREIGN KEY (`UserSSN`) REFERENCES `Users` (`SSN`)
);

--
-- Inserting data
--

INSERT INTO `Data` (`UserSSN`, `Location`, `Amount`, `Time`, `Date`) VALUES
('123-45-6789', 'TX', 35.89, '07:28', '2018-11-12'),
('333-44-5555', 'TX', 55.92, '13:78', '2018-11-17'),
('369-66-0605', 'TX', 21.78, '08:57', '2018-11-15'),
('453-45-3453', 'MO', 65.08, '10:34', '2018-11-09'),
('888-66-5555', 'MO', 33.84, '10:42', '2018-11-16'),
('666-88-4444', 'NY', 69.57, '03:14', '2018-11-12'),
('846-76-7711', 'NY', 64.75, '01:26', '2018-11-20'),
('987-65-4321', 'TX', 80.64, '00:29', '2018-10-22'),
('987-98-7987', 'TX', 89.58, '08:09', '2018-11-08'),
('999-88-7777', 'TX', 54.71, '17:47', '2018-11-21'),
('865-06-9004', 'CO', 18.92, '04:00', '2018-10-25'),
('865-06-9004', 'KS', 63.74, '09:29', '2018-11-08'),
('203-91-2929', 'CA', 17.12, '10:37', '2018-11-21'),
('191-73-8121', 'CA', 50.83, '01:13', '2018-11-14'),
('182-29-3088', 'WA', 20.31, '06:05', '2018-10-20'),
('182-29-3088', 'OR', 36.96, '02:08', '2018-11-22'),
('524-84-9872', 'WA', 45.53, '12:49', '2018-10-17'),
('480-68-1388', 'MD', 57.22, '07:46', '2018-12-10'),
('562-79-9262', 'AZ', 90.86, '19:53', '2018-10-01'),
('562-79-9262', 'NM', 72.04, '17:52', '2018-10-31'),
('230-09-2339', 'MO', 61.53, '17:43', '2018-11-27'),
('230-09-2339', 'AL', 99.35, '23:10', '2018-04-27');

--
-- Table structure for table `Device`
--

CREATE TABLE `Device` (
  `Manufacturer` varchar(20),
  `DeviceName` varchar(20),
  `Type` varchar(20) NOT NULL,
  `AccessTime` varchar(20) NOT NULL,
  PRIMARY KEY (`Manufacturer`, `DeviceName`)
);

--
-- Inserting Device data
--

INSERT INTO `Device` (`Manufacturer`, `DeviceName`, `Type`, `AccessTime`) VALUES
('Nest Labs', 'Nest Thermostat', 'Home Component', 'Weekdays'),
('Apple', 'iPhone', 'Smartphone', 'Every Day'),
('Apple', 'Apple Watch', 'Smartwatch', 'Every Day'),
('Samsung', 'Galaxy Note', 'Smartphone', 'Every Day'),
('LG', 'InstaView', 'Refrigerator', 'Evenings'),
('Apple', 'MacBook', 'Laptop', 'Every Day'),
('Nokia', '7.1', 'Smartphone', 'Every Day');

--
-- Table structure for table `Device2`
--

CREATE TABLE `Device2` (
  `Manufacturer` varchar(20),
  `DeviceName` varchar(20),
  `Functionality` varchar(20),
  FOREIGN KEY (`Manufacturer`, `DeviceName`) REFERENCES `Device` (`Manufacturer`, `DeviceName`),
  PRIMARY KEY (`Manufacturer`, `DeviceName`, `Functionality`)
);

--
-- Inserting Device2 data
--

INSERT INTO `Device2` (`Manufacturer`, `DeviceName`, `Functionality`) Values
('Nest Labs', 'Nest Thermostat', 'Thermostat'),
('Nest Labs', 'Nest Thermostat', 'Internet Access'),
('Apple', 'iPhone', 'Phone'),
('Apple', 'iPhone', 'Camera'),
('Apple', 'iPhone', 'Internet Access'),
('Apple', 'Apple Watch', 'Watch'),
('Apple', 'Apple Watch', 'Activity Tracker'),
('Apple', 'Apple Watch', 'Internet Access'),
('Samsung', 'Galaxy Note', 'Phone'),
('Samsung', 'Galaxy Note', 'Camera'),
('Samsung', 'Galaxy Note', 'Internet Access'),
('LG', 'InstaView', 'Internet Access'),
('LG', 'InstaView', 'Refrigerator'),
('Apple', 'MacBook', 'Computer'),
('Apple', 'MacBook', 'Internet Access'),
('Apple', 'MacBook', 'Camera'),
('Nokia', '7.1', 'Phone'),
('Nokia', '7.1', 'Camera'),
('Nokia', '7.1', 'Internet Access');

--
-- Table structure for table `Device3`
--

CREATE TABLE `Device3` (
  `Manufacturer` varchar(20),
  `DeviceName` varchar(20),
  `SerialNumber` varchar(30),
  PRIMARY KEY (`Manufacturer`, `DeviceName`, `SerialNumber`),
  FOREIGN KEY (`Manufacturer`, `DeviceName`) REFERENCES `Device` (`Manufacturer`, `DeviceName`)
);

--
-- Inserting Device3 data
--

INSERT INTO `Device3` (`Manufacturer`, `DeviceName`, `SerialNumber`) VALUES
('Nest Labs', 'Nest Thermostat', 'N6372829474838'),
('Nest Labs', 'Nest Thermostat', 'N2939474736655'),
('Apple', 'iPhone', 'A483929-99'),
('Apple', 'iPhone', 'A838929-88'),
('Apple', 'iPhone', 'A293848-89'),
('Apple', 'iPhone', 'A738294-77'),
('Apple', 'iPhone', 'A883211-11'),
('Apple', 'iPhone', 'A229348-93'),
('Apple', 'iPhone', 'A488920-22'),
('Apple', 'iPhone', 'A283844-88'),
('Apple', 'Apple Watch', 'A594448-77'),
('Apple', 'Apple Watch', 'A790384-78'),
('Apple', 'Apple Watch', 'A637274-22'),
('Samsung', 'Galaxy Note', 'SM-74929'),
('Samsung', 'Galaxy Note', 'SM-93920'),
('Samsung', 'Galaxy Note', 'SM-49389'),
('Samsung', 'Galaxy Note', 'SM-77282'),
('Samsung', 'Galaxy Note', 'SM-28229'),
('Samsung', 'Galaxy Note', 'SM-28803'),
('LG', 'InstaView', '52729LG'),
('LG', 'InstaView', '72903LG'),
('Apple', 'MacBook', 'A239292-B5'),
('Apple', 'MacBook', 'A638822-U5'),
('Apple', 'MacBook', 'A820184-E3'),
('Apple', 'MacBook', 'A662791-E7'),
('Nokia', '7.1', '435-N020'),
('Nokia', '7.1', '828-N922'),
('Nokia', '7.1', '119-N455');

--
-- Table structure for table `Owns`
--

CREATE TABLE `Owns` (
  `UserSSN` varchar(11),
  `Manufacturer` varchar(20),
  `DeviceName` varchar(20),
  `SerialNumber` varchar(30),
  PRIMARY KEY (`UserSSN`, `Manufacturer`, `SerialNumber`),
  FOREIGN KEY (`UserSSN`) REFERENCES `Users` (`SSN`),
  FOREIGN KEY (`Manufacturer`, `DeviceName`, `SerialNumber`) REFERENCES `Device3` (`Manufacturer`, `DeviceName`, `SerialNumber`),
  UNIQUE (`Manufacturer`, `SerialNumber`)
);

--
-- Inserting Owns data
--

INSERT INTO `Owns` (`UserSSN`, `Manufacturer`, `DeviceName`, `SerialNumber`) VALUES
('123-45-6789', 'Nest Labs', 'Nest Thermostat', 'N6372829474838'),
('562-79-9262', 'Nest Labs', 'Nest Thermostat', 'N2939474736655'),
('666-88-4444', 'Apple', 'iPhone', 'A483929-99'),
('191-73-8121', 'Apple', 'iPhone', 'A838929-88'),
('987-65-4321', 'Apple', 'iPhone', 'A293848-89'),
('230-09-2339', 'Apple', 'iPhone', 'A738294-77'),
('123-45-6789', 'Apple', 'iPhone', 'A883211-11'),
('453-45-3453', 'Apple', 'iPhone', 'A229348-93'),
('453-45-3453', 'Apple', 'iPhone', 'A488920-22'),
('480-68-1388', 'Apple', 'iPhone', 'A283844-88'),
('666-88-4444', 'Apple', 'Apple Watch', 'A594448-77'),
('191-73-8121', 'Apple', 'Apple Watch', 'A790384-78'),
('987-65-4321', 'Apple', 'Apple Watch', 'A637274-22'),
('182-29-3088', 'Samsung', 'Galaxy Note', 'SM-74929'),
('524-84-9872', 'Samsung', 'Galaxy Note', 'SM-93920'),
('203-91-2929', 'Samsung', 'Galaxy Note', 'SM-49389'),
('123-45-6789', 'Samsung', 'Galaxy Note', 'SM-77282'),
('123-45-6789', 'Samsung', 'Galaxy Note', 'SM-28229'),
('562-79-9262', 'Samsung', 'Galaxy Note', 'SM-28803'),
('123-45-6789', 'LG', 'InstaView', '52729LG'),
('480-68-1388', 'LG', 'InstaView', '72903LG'),
('888-66-5555', 'Apple', 'MacBook', 'A239292-B5'),
('453-45-3453', 'Apple', 'MacBook', 'A638822-U5'),
('562-79-9262', 'Apple', 'MacBook', 'A820184-E3'),
('480-68-1388', 'Apple', 'MacBook', 'A662791-E7'),
('865-06-9004', 'Nokia', '7.1', '435-N020'),
('987-98-7987', 'Nokia', '7.1', '828-N922'),
('999-88-7777', 'Nokia', '7.1', '119-N455');

--
-- Table structure for table `HasAccessTo`
--

CREATE TABLE `HasAccessTo` (
  `UserSSN` varchar(11),
  `Manufacturer` varchar(20),
  `DeviceName` varchar (20),
  `SerialNumber` varchar(30),
  PRIMARY KEY (`UserSSN`, `Manufacturer`, `DeviceName`, `SerialNumber`),
  FOREIGN KEY (`UserSSN`) REFERENCES `Users` (`SSN`),
  FOREIGN KEY (`Manufacturer`, `DeviceName`, `SerialNumber`) REFERENCES `Owns` (`Manufacturer`, `DeviceName`, `SerialNumber`)
);

--
-- Inserting HasAccessTo data
--

INSERT INTO `HasAccessTo` (`UserSSN`, `Manufacturer`, `DeviceName`, `SerialNumber`) VALUES
('123-45-6789', 'Nest Labs', 'Nest Thermostat', 'N6372829474838'),
('333-44-5555', 'Nest Labs', 'Nest Thermostat', 'N6372829474838'),
('369-66-0605', 'Nest Labs', 'Nest Thermostat', 'N6372829474838'),
('562-79-9262', 'Nest Labs', 'Nest Thermostat', 'N2939474736655'),
('846-76-7711', 'Apple', 'iPhone', 'A483929-99'),
('666-88-4444', 'Apple', 'iPhone', 'A483929-99'),
('191-73-8121', 'Apple', 'iPhone', 'A838929-88'),
('987-65-4321', 'Apple', 'iPhone', 'A293848-89'),
('230-09-2339', 'Apple', 'iPhone', 'A738294-77'),
('369-66-0605', 'Apple', 'iPhone', 'A883211-11'),
('453-45-3453', 'Apple', 'iPhone', 'A229348-93'),
('888-66-5555', 'Apple', 'iPhone', 'A488920-22'),
('480-68-1388', 'Apple', 'iPhone', 'A283844-88'),
('846-76-7711', 'Apple', 'Apple Watch', 'A594448-77'),
('191-73-8121', 'Apple', 'Apple Watch', 'A790384-78'),
('987-65-4321', 'Apple', 'Apple Watch', 'A637274-22'),
('182-29-3088', 'Samsung', 'Galaxy Note', 'SM-74929'),
('524-84-9872', 'Samsung', 'Galaxy Note', 'SM-93920'),
('203-91-2929', 'Samsung', 'Galaxy Note', 'SM-49389'),
('123-45-6789', 'Samsung', 'Galaxy Note', 'SM-77282'),
('333-44-5555', 'Samsung', 'Galaxy Note', 'SM-28229'),
('562-79-9262', 'Samsung', 'Galaxy Note', 'SM-28803'),
('123-45-6789', 'LG', 'InstaView', '52729LG'),
('333-44-5555', 'LG', 'InstaView', '52729LG'),
('369-66-0605', 'LG', 'InstaView', '52729LG'),
('480-68-1388', 'LG', 'InstaView', '72903LG'),
('888-66-5555', 'Apple', 'MacBook', 'A239292-B5'),
('453-45-3453', 'Apple', 'MacBook', 'A638822-U5'),
('888-66-5555', 'Apple', 'MacBook', 'A638822-U5'),
('562-79-9262', 'Apple', 'MacBook', 'A820184-E3'),
('480-68-1388', 'Apple', 'MacBook', 'A662791-E7'),
('865-06-9004', 'Nokia', '7.1', '435-N020'),
('987-98-7987', 'Nokia', '7.1', '828-N922'),
('999-88-7777', 'Nokia', '7.1', '119-N455');

--
-- Table structure for table `Regions`
--

CREATE TABLE `Regions` (
  `RegionName` varchar(20),
  `State` char(2),
  PRIMARY KEY (`RegionName`, `State`)
);

--
-- Inserting Regions Data
--

INSERT INTO `Regions` (`RegionName`, `State`) VALUES
('New England', 'CT'),
('New England', 'ME'),
('New England', 'MA'),
('New England', 'NH'),
('New England', 'RI'),
('New England', 'VT'),
('Mid-Atlantic', 'NJ'),
('Mid-Atlantic', 'NY'),
('Mid-Atlantic', 'PA'),
('East Midwest', 'IL'),
('East Midwest', 'IN'),
('East Midwest', 'MI'),
('East Midwest', 'OH'),
('East Midwest', 'WI'),
('West Midwest', 'IA'),
('West Midwest', 'KS'),
('West Midwest', 'MN'),
('West Midwest', 'MO'),
('West Midwest', 'NE'),
('West Midwest', 'ND'),
('West Midwest', 'SD'),
('South Atlantic', 'DE'),
('South Atlantic', 'FL'),
('South Atlantic', 'GA'),
('South Atlantic', 'MD'),
('South Atlantic', 'NC'),
('South Atlantic', 'SC'),
('South Atlantic', 'VA'),
('South Atlantic', 'DC'),
('South Atlantic', 'WV'),
('East South', 'AL'),
('East South', 'KY'),
('East South', 'MS'),
('East South', 'TN'),
('West South', 'AR'),
('West South', 'LA'),
('West South', 'OK'),
('West South', 'TX'),
('Mountain', 'AZ'),
('Mountain', 'CO'),
('Mountain', 'ID'),
('Mountain', 'MT'),
('Mountain', 'NV'),
('Mountain', 'NM'),
('Mountain', 'UT'),
('Mountain', 'WY'),
('Pacific', 'CA'),
('Pacific', 'OR'),
('Pacific', 'WA'),
('Non Continental', 'AK'),
('Non Continental', 'HI');

--
-- Table structure for table `Provider`
--

CREATE TABLE `Provider` (
  `ProviderName` varchar(20),
  `PhoneNumber` varchar(10),
  PRIMARY KEY (`ProviderName`)
);

--
-- Inserting Provider Data
--

INSERT INTO `Provider` (`ProviderName`, `PhoneNumber`) VALUES
('AT&T', '8003310500'),
('Verizon', '8009220204'),
('T-Mobile', '8008662453'),
('Sprint', '8882114727');

--
-- Table structure for table `Provider2`
--

CREATE TABLE `Provider2` (
  `ProviderName` varchar(20),
  `RegionServed` varchar(20),
  PRIMARY KEY (`ProviderName`, `RegionServed`),
  FOREIGN KEY (`ProviderName`) REFERENCES `Provider` (`ProviderName`),
  FOREIGN KEY (`RegionServed`) REFERENCES `Regions` (`RegionName`)
);

--
-- Inserting Provider2 Data
--

INSERT INTO `Provider2` (`ProviderName`, `RegionServed`) VALUES
('AT&T', 'New England'),
('AT&T', 'Mid-Atlantic'),
('AT&T', 'East Midwest'),
('AT&T', 'West Midwest'),
('AT&T', 'South Atlantic'),
('AT&T', 'East South'),
('AT&T', 'West South'),
('AT&T', 'Mountain'),
('AT&T', 'Pacific'),
('AT&T', 'Non Continental'),
('Verizon', 'New England'),
('Verizon', 'Mid-Atlantic'),
('Verizon', 'East Midwest'),
('Verizon', 'West Midwest'),
('Verizon', 'South Atlantic'),
('Verizon', 'East South'),
('Verizon', 'West South'),
('Verizon', 'Pacific'),
('Verizon', 'Non Continental'),
('T-Mobile', 'New England'),
('T-Mobile', 'Mid-Atlantic'),
('T-Mobile', 'East Midwest'),
('T-Mobile', 'South Atlantic'),
('T-Mobile', 'West South'),
('T-Mobile', 'Pacific'),
('Sprint', 'New England'),
('Sprint', 'Mid-Atlantic'),
('Sprint', 'South Atlantic'),
('Sprint', 'Pacific');

--
-- Table structure for table `Provider3`
--

CREATE TABLE `Provider3` (
  `ProviderName` varchar(20),
  `ServicesOffered` varchar(50),
  PRIMARY KEY (`ProviderName`, `ServicesOffered`),
  FOREIGN KEY (`ProviderName`) REFERENCES `Provider` (`ProviderName`)
);

--
-- Inserting Provider3 Data
--

INSERT INTO `Provider3` (`ProviderName`, `ServicesOffered`) VALUES
('AT&T', 'Home Telephone'),
('AT&T', 'Wired Internet'),
('AT&T', 'Wireless Internet'),
('AT&T', 'Television - DIRECTV'),
('AT&T', 'Television - U-verse'),
('Verizon', 'Home Telephone'),
('Verizon', 'Limited Wireless Internet'),
('Verizon', 'Basic Unlimited Wireless Internet'),
('Verizon', 'Beyond Unlimited Wireless Internet'),
('Verizon', 'Television'),
('T-Mobile', 'Home Telephone'),
('T-Mobile', 'Wireless Internet'),
('Sprint', 'Home Telephone'),
('Sprint', 'Wireless Internet');

--
-- Table structure for table `Offers`
--

CREATE TABLE `Offers` (
  `ProviderName` varchar(20),
  `Manufacturer` varchar(20),
  `DeviceName` varchar(20),
  PRIMARY KEY (`ProviderName`, `Manufacturer`, `DeviceName`),
  FOREIGN KEY (`ProviderName`) REFERENCES `Provider` (`ProviderName`),
  FOREIGN KEY (`Manufacturer`, `DeviceName`) REFERENCES `Device` (`Manufacturer`, `DeviceName`)
);

--
-- Inserting Offers Data
--

INSERT INTO `Offers` (`ProviderName`, `Manufacturer`, `DeviceName`) VALUES
('AT&T', 'Apple', 'iPhone'),
('AT&T', 'Samsung', 'Galaxy Note'),
('AT&T', 'Nokia', '7.1'),
('Verizon', 'Apple', 'iPhone'),
('Verizon', 'Samsung', 'Galaxy Note'),
('Verizon', 'Nokia', '7.1'),
('T-Mobile', 'Apple', 'iPhone'),
('T-Mobile', 'Samsung', 'Galaxy Note'),
('Sprint', 'Apple', 'iPhone');

--
-- Table structure for table `Package`
--

CREATE TABLE `Package` (
  `PackageName` varchar(50),
  `ProviderName` varchar(20),
  PRIMARY KEY (`PackageName`, `ProviderName`),
  FOREIGN KEY (`ProviderName`) REFERENCES `Provider` (`ProviderName`)
);

--
-- Inserting Package Data
--

INSERT INTO `Package` (`PackageName`, `ProviderName`) VALUES
('Basic', 'AT&T'),
('DIRECTV + Internet', 'AT&T'),
('DIRECTV + Wireless', 'AT&T'),
('U-verse TV + Internet', 'AT&T'),
('TV + Internet + Phone', 'AT&T'),
('Basic', 'Verizon'),
('Unlimited', 'Verizon'),
('Unlimited+', 'Verizon'),
('Complete', 'Verizon'),
('Complete+', 'Verizon'),
('Unlimited', 'T-Mobile'),
('Unlimted+Home', 'T-Mobile'),
('Unlimted', 'Sprint');

--
-- Table structure for table `Package2`
--

CREATE TABLE `Package2` (
  `PackageName` varchar(50),
  `ProviderName` varchar(20),
  `Service` varchar(50),
  PRIMARY KEY (`PackageName`, `ProviderName`, `Service`),
  FOREIGN KEY (`PackageName`) REFERENCES `Package` (`PackageName`),
  FOREIGN KEY (`ProviderName`, `Service`) REFERENCES `Provider3` (`ProviderName`, `ServicesOffered`)
);

--
-- Inserting Package2 data
--

INSERT INTO `Package2` (`PackageName`, `ProviderName`, `Service`) VALUES
('Basic', 'AT&T', 'Wireless Internet'),
('DIRECTV + Internet', 'AT&T', 'Television - DIRECTV'),
('DIRECTV + Internet', 'AT&T', 'Wired Internet'),
('DIRECTV + Wireless', 'AT&T', 'Television - DIRECTV'),
('DIRECTV + Wireless', 'AT&T', 'Wireless Internet'),
('U-verse TV + Internet', 'AT&T', 'Television - U-verse'),
('U-verse TV + Internet', 'AT&T', 'Wired Internet'),
('TV + Internet + Phone', 'AT&T', 'Television - U-verse'),
('TV + Internet + Phone', 'AT&T', 'Wired Internet'),
('TV + Internet + Phone', 'AT&T', 'Wireless Internet'),
('Basic', 'Verizon', 'Limited Wireless Internet'),
('Unlimited', 'Verizon', 'Basic Unlimited Wireless Internet'),
('Unlimited+', 'Verizon', 'Beyond Unlimited Wireless Internet'),
('Complete', 'Verizon', 'Limited Wireless Internet'),
('Complete', 'Verizon', 'Television'),
('Complete+', 'Verizon', 'Basic Unlimited Wireless Internet'),
('Complete+', 'Verizon', 'Television'),
('Unlimited', 'T-Mobile', 'Wireless Internet'),
('Unlimted+Home', 'T-Mobile', 'Home Telephone'),
('Unlimted+Home', 'T-Mobile', 'Wireless Internet'),
('Unlimted', 'Sprint', 'Wireless Internet');

--
-- Table structure for table `Purchases`
--

CREATE TABLE `Purchases` (
  `UserSSN` varchar(11),
  `PackageName` varchar(50),
  `ProviderName` varchar(20),
  `PolicyBegin` date NOT NULL,
  `PolicyEnd` date NOT NULL,
  PRIMARY KEY (`UserSSN`, `PackageName`, `ProviderName`),
  FOREIGN KEY (`UserSSN`) REFERENCES `AuthorizedUser` (`SSN`),
  FOREIGN KEY (`PackageName`, `ProviderName`) REFERENCES `Package` (`PackageName`, `ProviderName`)
);

--
-- Inserting Purchases Data
--

INSERT INTO `Purchases` (`UserSSN`, `PackageName`, `ProviderName`, `PolicyBegin`, `PolicyEnd`) VALUES
('123-45-6789', 'TV + Internet + Phone', 'AT&T', '2012-01-01', '2020-01-01'),
('453-45-3453', 'DIRECTV + Wireless', 'AT&T', '2015-05-19', '2019-01-01'),
('666-88-4444', 'Unlimted+Home', 'T-Mobile', '2017-03-18', '2018-11-18'),
('987-65-4321', 'Basic', 'Verizon', '2017-06-28', '2020-04-01'),
('987-98-7987', 'Basic', 'Verizon', '2017-12-01', '2020-12-01'),
('999-88-7777', 'Unlimited', 'T-Mobile', '2018-11-15', '2021-11-15'),
('865-06-9004', 'TV + Internet + Phone', 'AT&T', '2015-04-15', '2018-10-15'),
('203-91-2929', 'Unlimted', 'Sprint', '2018-11-01', '2020-11-01'),
('182-29-3088', 'DIRECTV + Wireless', 'AT&T', '2015-01-01', '2020-01-01'),
('480-68-1388', 'Unlimited', 'T-Mobile', '2017-07-17', '2017-07-17'),
('562-79-9262', 'DIRECTV + Wireless', 'AT&T', '2018-03-18', '2019-03-18'),
('230-09-2339', 'Unlimted+Home', 'T-Mobile', '2017-12-10', '2019-12-10');
