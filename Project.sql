--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
    `Fname` varchar(20) NOT NULL,
    `Minit` varchar(20) NOT NULL,
    `Lname` varchar(20) NOT NULL,
    `SSN` int(9) NOT NULL,
    `PhoneNumber` int(10) NOT NULL,
    `DateOfBirth` char(10) NOT NULL,
    `Address` varchar(50) NOT NULL,
    `Sex` char(1) NOT NULL,
    PRIMARY KEY (`SSN`)
);

INSERT INTO `Users` (`Fname`, `Minit`, `Lname`, `SSN`, `PhoneNumber`, `DateOfBirth`, `Address`, `Sex`) VALUES
('John', 'B', 'Smith', 123456789, 4245930274, '1965-01-09', '731 Fondren, Houston, TX', 'M'),
('Bella', 'T', 'Smith', 333445555, 4247604858, '1966-12-08', '731 Fondren, Houston, TX', 'F'),
('Joyce', 'A', 'English', 453453453, 2167954402, '1972-07-31', '5631 Rice, Houston, TX', 'F'),
('Ramesh', 'K', 'Narayan', 666884444, 4603447747, '1962-09-15', '975 Fire Oak, Humble, TX', 'M'),
('James', 'E', 'Borg', 888665555, 3749574739, '1954-11-10', '450 Stone, Houston, TX', 'M'),
('Jennifer', 'S', 'Wallace', 987654321, 7039781660, '1956-06-20', '291 Berry, Bellaire, TX', 'F'),
('Ahmad', 'V', 'Jabbar', 987987987, 8099641153, '1969-03-29', '980 Dallas, Houston, TX', 'M'),
('Alicia', 'J', 'Zelaya', 999887777, 4909127789, '1968-01-19', '3321 Castle, Spring, TX', 'F');

--
-- Table structure for table `Authorized User`
--

CREATE TABLE `AuthorizedUser` (
  `SSN` int(9) NOT NULL,
  `CustomerID` varchar(20) NOT NULL,
  PRIMARY KEY (`SSN`),
  FOREIGN KEY (`SSN`) REFERENCES `Users` (`SSN`)
);

INSERT INTO `AuthorizedUser` (`SSN`, `CustomerID`) VALUES
(123456789, 1234);

--
-- Table structure for table `Secondary User`
--

CREATE TABLE `SecondaryUser` (
  `SSN` int(9) NOT NULL,
  `AuthUserSSN` int(9) NOT NULL,
  `RelationshipToAuthUser` varchar(20) NOT NULL,
  PRIMARY KEY (`SSN`),
  FOREIGN KEY (`AuthUserSSN`) REFERENCES `AuthorizedUser` (`SSN`),
  FOREIGN KEY (`SSN`) REFERENCES `Users` (`SSN`)
);

INSERT INTO `SecondaryUser` (`SSN`, `AuthUserSSN`, `RelationshipToAuthUser`) VALUES
(333445555, 123456789, 'Spouse');

--
-- Table structure for table `Data`
--

CREATE TABLE `Data` (
  `UserSSN` int(9) NOT NULL,
  `Location` varchar(50) NOT NULL,
  `Amount` float NOT NULL,
  `Time` varchar(5) NOT NULL,
  PRIMARY KEY (`UserSSN`, `Location`, `Amount`, `Time`),
  FOREIGN KEY (`UserSSN`) REFERENCES `Users` (`SSN`)
);

--
-- Table structure for table `Device`
--

CREATE TABLE `Device` (
  `Manufacturer` varchar(20) NOT NULL,
  `SerialNumber` varchar(30) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `AccessTime` varchar(20),
  PRIMARY KEY (`Manufacturer`, `SerialNumber`)
);

--
-- Table structure for table `Device2`
--

CREATE TABLE `Device2` (
  `Manufacturer` varchar(20),
  `SerialNumber` varchar(30),
  `Functionality` varchar(20),
  FOREIGN KEY (`Manufacturer`, `SerialNumber`) REFERENCES `Device` (`Manufacturer`, `SerialNumber`),
  PRIMARY KEY (`Manufacturer`, `SerialNumber`, `Functionality`)
);

--
-- Table structure for table `HasAccessTo`
--

CREATE TABLE `HasAccessTo` (
  `UserSSN` int(9) NOT NULL,
  `Manufacturer` varchar(20) NOT NULL,
  `SerialNumber` varchar(30) NOT NULL,
  PRIMARY KEY (`UserSSN`, `Manufacturer`, `SerialNumber`),
  FOREIGN KEY (`UserSSN`) REFERENCES `Users` (`SSN`),
  FOREIGN KEY (`Manufacturer`, `SerialNumber`) REFERENCES `Device` (`Manufacturer`, `SerialNumber`)
);

--
-- Table structure for table `Provider`
--

CREATE TABLE `Provider` (
  `ProviderName` varchar(20) NOT NULL,
  `PhoneNumber` int(10) NOT NULL,
  PRIMARY KEY (`ProviderName`)
);

--
-- Table structure for table `Provider2`
--

CREATE TABLE `Provider2` (
  `ProviderName` varchar(20) NOT NULL,
  `RegionServed` varchar(20) NOT NULL,
  PRIMARY KEY (`ProviderName`, `RegionServed`),
  FOREIGN KEY (`ProviderName`) REFERENCES `Provider` (`ProviderName`)
);

--
-- Table structure for table `Provider3`
--

CREATE TABLE `Provider3` (
  `ProviderName` varchar(20) NOT NULL,
  `ServicesOffered` varchar(20) NOT NULL,
  PRIMARY KEY (`ProviderName`, `ServicesOffered`),
  FOREIGN KEY (`ProviderName`) REFERENCES `Provider` (`ProviderName`)
);

--
-- Table structure for table `Offers`
--

CREATE TABLE `Offers` (
  `ProviderName` varchar(20) NOT NULL,
  `Manufacturer` varchar(20) NOT NULL,
  `SerialNumber` varchar(30) NOT NULL,
  PRIMARY KEY (`ProviderName`, `Manufacturer`, `SerialNumber`),
  FOREIGN KEY (`ProviderName`) REFERENCES `Provider` (`ProviderName`),
  FOREIGN KEY (`Manufacturer`, `SerialNumber`) REFERENCES `Device` (`Manufacturer`, `SerialNumber`)
);

--
-- Table structure for table `Owns`
--

CREATE TABLE `Owns` (
  `UserSSN` int(9) NOT NULL,
  `Manufacturer` varchar(20) NOT NULL,
  `SerialNumber` varchar(30) NOT NULL,
  PRIMARY KEY (`UserSSN`, `Manufacturer`, `SerialNumber`),
  FOREIGN KEY (`UserSSN`) REFERENCES `Users` (`SSN`),
  FOREIGN KEY (`Manufacturer`, `SerialNumber`) REFERENCES `Device` (`Manufacturer`, `SerialNumber`)
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
  `UserSSN` int(9) NOT NULL,
  `PackageName` varchar(20) NOT NULL,
  PRIMARY KEY (`UserSSN`, `PackageName`),
  FOREIGN KEY (`UserSSN`) REFERENCES `AuthorizedUser` (`SSN`),
  FOREIGN KEY (`PackageName`) REFERENCES `Package` (`PackageName`)
);
