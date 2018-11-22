--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
    `Fname` varchar(20) NOT NULL,
    `Minit` varchar(1) NOT NULL,
    `Lname` varchar(20) NOT NULL,
    `SSN` varchar(11) NOT NULL,
    `PhoneNumber` varchar(10) NOT NULL,
    `DateOfBirth` varchar(10) NOT NULL,
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
('Joyce', 'A', 'English', '453-45-3453', '2167954402', '1972-07-61', '5631 Rice', 'MO', 'F'),
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
  `AuthUserSSN` varchar(11) NOT NULL,
  `RelationshipToAuthUser` varchar(20) NOT NULL,
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
  `Date` varchar(10),
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
('Nest Labs', 'Nest Thermostat', 'Home Component', '00:00-24:00'),
('Apple', 'iPhone', 'Cell Phone', '00:00-24:00'),
('Apple', 'Apple Watch', 'Smartwatch', '00:00-24:00');

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
('Apple', 'iPhone', 'Phone'),
('Apple', 'iPhone', 'Camera'),
('Apple', 'iPhone', 'Internet Access'),
('Apple', 'Apple Watch', 'Watch'),
('Apple', 'Apple Watch', 'Activity Tracker'),
('Apple', 'Apple Watch', 'Internet Access');

--
-- Table structure for table `Device3`

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
('Nest Labs', 'Nest Thermostat', '6372829474838'),
('Apple', 'iPhone', 'A483929-99'),
('Apple', 'iPhone', 'A838929-88'),
('Apple', 'iPhone', 'A293848-89')
('Apple', 'Apple Watch', 'A594448-77'),
('Apple', 'Apple Watch', 'A790384-78'),
('Apple', 'Apple Watch', 'A274628-33'),
('Apple', 'Apple Watch', 'A637274-22');

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
  FOREIGN KEY (`Manufacturer`, `DeviceName`, `SerialNumber`) REFERENCES `Device3` (`Manufacturer`, `DeviceName`, `SerialNumber`)
);

--
-- Inserting HasAccessTo data
--

INSERT INTO `HasAccessTo` (`UserSSN`, `Manufacturer`, `DeviceName`, `SerialNumber`) VALUES
('123-45-6789', 'Nest Labs', 'Nest Thermostat', '6372829474838'),
('333-44-5555', 'Nest Labs', 'Nest Thermostat', '6372829474838'),
('369-66-0605', 'Nest Labs', 'Nest Thermostat', '6372829474838'),
('846-76-7711', 'Apple', 'iPhone', 'A483929-99'),
('191-73-8121', 'Apple', 'iPhone', 'A838929-88'),
('987-65-4321', 'Apple', 'iPhone', 'A293848-89');

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
  FOREIGN KEY (`Manufacturer`, `DeviceName`, `SerialNumber`) REFERENCES `Device3` (`Manufacturer`, `DeviceName`, `SerialNumber`)
);

--
-- Inserting Owns data
--

INSERT INTO `Owns` (`UserSSN`, `Manufacturer`, `DeviceName`, `SerialNumber`) VALUES
('123-45-6789', 'Nest Labs', 'Nest Thermostat', '6372829474838'),
('666-88-4444', 'Apple', 'iPhone', 'A483929-99'),
('191-73-8121', 'Apple', 'iPhone', 'A838929-88'),
('987-65-4321', 'Apple', 'iPhone', 'A293848-89');

--
-- Table structure for table `Provider`
--

CREATE TABLE `Provider` (
  `ProviderName` varchar(20),
  `PhoneNumber` varchar(10),
  PRIMARY KEY (`ProviderName`)
);

--
-- Table structure for table `Provider2`
--

CREATE TABLE `Provider2` (
  `ProviderName` varchar(20),
  `RegionServed` varchar(20),
  PRIMARY KEY (`ProviderName`, `RegionServed`),
  FOREIGN KEY (`ProviderName`) REFERENCES `Provider` (`ProviderName`)
);

--
-- Table structure for table `Provider3`
--

CREATE TABLE `Provider3` (
  `ProviderName` varchar(20),
  `ServicesOffered` varchar(20),
  PRIMARY KEY (`ProviderName`, `ServicesOffered`),
  FOREIGN KEY (`ProviderName`) REFERENCES `Provider` (`ProviderName`)
);

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
-- Table structure for table `Package`
--

CREATE TABLE `Package` (
  `PackageName` varchar(20) NOT NULL,
  `ProviderName` varchar(20) NOT NULL,
  `PolicyPeriod` varchar(21) NOT NULL,
  PRIMARY KEY (`PackageName`, `ProviderName`),
  FOREIGN KEY (`ProviderName`) REFERENCES `Provider` (`ProviderName`)
);

--
-- Table structure for table `Package2`
--

CREATE TABLE `Package2` (
  `PackageName` varchar(20) NOT NULL,
  `ProviderName` varchar(20) NOT NULL,
  `Service` varchar(20) NOT NULL,
  PRIMARY KEY (`PackageName`, `ProviderName`, `Service`),
  FOREIGN KEY (`ProviderName`) REFERENCES `Provider` (`ProviderName`),
  FOREIGN KEY (`PackageName`) REFERENCES `Package` (`PackageName`)
);

--
-- Table structure for table `Purchases`
--

CREATE TABLE `Purchases` (
  `UserSSN` varchar(11) NOT NULL,
  `PackageName` varchar(20) NOT NULL,
  PRIMARY KEY (`UserSSN`, `PackageName`),
  FOREIGN KEY (`UserSSN`) REFERENCES `AuthorizedUser` (`SSN`),
  FOREIGN KEY (`PackageName`) REFERENCES `Package` (`PackageName`)
);
