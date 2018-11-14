--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
    `SSN` int(9) NOT NULL,
    `Fname` varchar(20) NOT NULL,
    `Mname` varchar(20) NOT NULL,
    `Lname` varchar(20) NOT NULL,
    `PhoneNumber` int(10) NOT NULL,
    `Address` varchar(50) NOT NULL,
    `Sex` char(1) NOT NULL,
    `Date of Birth` int(8) NOT NULL,
    PRIMARY KEY (`SSN`)
);

--
-- Table structure for table `Authorized User`
--

CREATE TABLE `AuthorizedUser` (
  `SSN` int(9) NOT NULL,
  `CustomerID` varchar(20) NOT NULL,
  PRIMARY KEY (`SSN`),
  FOREIGN KEY (`SSN`) REFERENCES `Users` (`SSN`)
);

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
