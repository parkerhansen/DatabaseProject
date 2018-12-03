<?php

if (isset($_POST['searchDeviceName']))
{
    $manufacturerName = $_POST['manufacturerName'];
    $deviceName = $_POST['deviceName'];
    // search in all table columns
    $query = "SELECT * FROM Device2 WHERE Manufacturer='$manufacturerName' AND DeviceName='$deviceName'";
    $search_result = filterTable($query);
}

else if(isset($_POST['searchSSN']))
{
  $ssn = $_POST['ssn'];
  // search in all table columns
  $query = "SELECT * FROM Users AS U, HasAccessTo AS H WHERE U.SSN=H.UserSSN AND U.SSN='$ssn'";
  $search_result = filterTable($query);
}

else if(isset($_POST['searchFunction']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    $query = "SELECT * FROM `Device2` WHERE `Functionality`='$valueToSearch'";
    $search_result = filterTable($query);

}
else if(isset($_POST['showAllDevices']))
{
    $query = "SELECT * FROM `Device`";
    $search_result = filterTable($query);
}

else if(isset($_POST['insertDevice']))
{
  $deviceNameEdit = $_POST['deviceNameEdit'];
  $manufacturerNameEdit = $_POST['manufacturerNameEdit'];
  $typeEdit = $_POST['typeEdit'];
  $functionalityEdit = $_POST['functionalityEdit'];
  $ruleEdit = $_POST['ruleEdit'];
  // Insert device
  $query= "INSERT INTO `Device` (`Manufacturer`, `DeviceName`, `Type`, `AccessTime`) VALUES ('$manufacturerNameEdit', '$deviceNameEdit', '$typeEdit', '$ruleEdit')";
  $query2= "INSERT INTO `Device2` (`Manufacturer`, `DeviceName`, `Functionality`) VALUES ('$manufacturerNameEdit', '$deviceNameEdit', '$functionalityEdit')";

  $connect = mysqli_connect(`Localhost`, 'root', `Project`);
  mysqli_select_db($connect, "Project");
  if (mysqli_query($connect, $query) && mysqli_query($connect, $query2)) {
    echo "New device inserted successfully";
  }
  else {
    echo "Error:" . $query . "<br>" . mysqli_error($connect);
    echo "Error:" . $query2 . "<br>" . mysqli_error($connect);
  }
}

else if(isset($_POST['deleteDevice']))
{
  $deviceNameEdit = $_POST['deviceNameEdit'];
  $manufacturerNameEdit = $_POST['manufacturerNameEdit'];
  $functionalityEdit = $_POST['functionalityEdit'];
  // Insert device
  $query= "DELETE FROM `Device2` WHERE `Manufacturer`='$manufacturerNameEdit' AND `DeviceName`='$deviceNameEdit'";
  $query2= "DELETE FROM `Device` WHERE `Manufacturer`='$manufacturerNameEdit' AND `DeviceName`='$deviceNameEdit'";

  $connect = mysqli_connect(`Localhost`, 'root', `Project`);
  mysqli_select_db($connect, "Project");
  if (mysqli_query($connect, $query) && mysqli_query($connect, $query2)) {
    echo "Device deleted successfully";
  }
  else {
    echo "Error:" . $query . "<br>" . mysqli_error($connect);
    echo "Error:" . $query2 . "<br>" . mysqli_error($connect);
  }
}

else if(isset($_POST['searchRole']))
{
  $role = $_POST['role'];

  if($role == 'AuthorizedUser')
  {
    $query = "SELECT * FROM `Users` AS `U`, `AuthorizedUser` AS `A`, `HasAccessTo` AS `H` WHERE `U`.`SSN`=`A`.`SSN` AND `U`.`SSN`=`H`.`UserSSN`";
    $search_result = filterTable($query);
  }
  else if($role == 'SecondaryUser')
  {
    $query = "SELECT * FROM `Users` AS `U`, `SecondaryUser` AS `S`, `HasAccessTo` AS `H` WHERE `U`.`SSN`=`S`.`SSN` AND `U`.`SSN`=`H`.`UserSSN`";
    $search_result = filterTable($query);
  }
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect(`Localhost`, 'root', `Project`);
    mysqli_select_db($connect, "Project");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>

<html>
<head>
<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:100,100i&amp;subset=latin-ext" rel="stylesheet">
    <style>

    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
    th, td {
      padding: 15px;
    }

  h1{
    font-family: 'IBM Plex Sans', sans-serif;
  }
  h2{
    font-family: 'IBM Plex Sans', sans-serif;
  }
    </style>
</head>
<body>

  <h1><center>A DATABASE FOR YOUR INTERNET OF THINGS:</center></h1>
  <center><img src="http://localhost/ElitaDrawing.jpeg" /></center>
  <h2><center>HELPING YOU SEE BOTH THE FOREST AND THE TREES</center></h2>
  <h2><center><a href="http://localhost/WebInterface.html">Back</a></center></h2>


  <center>
<table>
  <tr>
    <td>
      <form action="SearchDevices.php" method="post">
      <center><b><u>Insert/Delete a Device</u></b><br><br>
      Manufacturer: <input type="text" name="manufacturerNameEdit" required>
      Device Name: <input type="text" name="deviceNameEdit" required><br>
      Type: <input type="text" name="typeEdit"><br>
      Functionality: <input type="text" name="functionalityEdit"><br>
      When can you Access?: <select type="text" name="ruleEdit"><br>
        <option value="">--Chose a Access Rule--</option>
        <option value="Every Day">Everyday</option>
        <option value="Weekdays">Weekdays</option>
        <option value="Weekends">Weekends</option>
        <option value="Evenings">Evenings</option>
        <option value="Mornings">Mornings</option></select><br>
      <input type="submit" name="insertDevice" value="Insert">
      <input type="submit" name="deleteDevice" value="Delete">
      </center>
      </form>
    </td>

    <td>
    <center>
    <form action="SearchDevices.php" method="post">
      <input type="text" name="manufacturerName" placeholder="Manufacturer Name" required>
      <input type="text" name="deviceName" placeholder="Device Name" required>
      <input type="submit" name="searchDeviceName" value="Search">
    </form>

    <form action="SearchDevices.php" method="post">
      What devices does a user have access to?:<input type="text" name="ssn" placeholder="User SSN (XXX-XX-XXXX)" required>
      <input type="submit" name="searchSSN" value="Search">
    </form>

    <form action="SearchDevices.php" method="post">
      What devices does a role have access to?:<select type="text" name="role" required>
        <option value="AuthorizedUser">Authorized User</option>
        <option value="SecondaryUser">Secondary User</option>
      <input type="submit" name="searchRole" value="Search">
    </form>

    <form action="SearchDevices.php" method="post">
      Chose a Functionality<select type="text" name="valueToSearch" required>
        <option value="Thermostat">Thermostat</option>
        <option value="Internet Access">Internet Access</option>
        <option value="Phone">Phone</option>
        <option value="Camera">Camera</option>
        <option value="Watch">Watch</option>
        <option value="Activity Tracker">Activity Tracker</option>
        <option value="Refrigerator">Refrigerator</option>
        <option value="Computer">Computer</option>
        <input type="submit" name="searchFunction" value="Search">
    </form>

    <form action="SearchDevices.php" method="post">
      <input type="submit" name="showAllDevices" value="Show All">
    </form>
    </center>
    </td>
  </tr>
</table>

<head>
<style type="text/css">
table{
  font-family: 'IBM Plex Sans', sans-serif;
}
body{
  font-family: 'IBM Plex Sans', sans-serif;
}
input[type='text']
{font-family: 'IBM Plex Sans', sans-serif;}

input[type='submit']
{font-family: 'IBM Plex Sans', sans-serif;}

  </style>
</head>


<!-- If a functionality is selected execute this sequence to display results -->
<?php if(isset($_POST['searchFunction']))
{
  echo"
    <center><table>
      <tr>
        <th>Manufacturer</th>
        <th>Device Name</th>
        <th>Functionality</th>
      </tr>";
}
?>

<!-- populate table from mysql database -->
<?php if(isset($_POST['searchFunction'])) while($row = mysqli_fetch_array($search_result)):?>
      <tr>
        <td><?php echo $row['Manufacturer'];?></td>
        <td><?php echo $row['DeviceName'];?></td>
        <td><?php echo $row['Functionality'];?></td>
      </tr>
<?php endwhile;
    echo"</table></center>";?>


<!-- If a SSN is inputted execute this sequence to display results -->
<?php if(isset($_POST['searchSSN']))
{
  echo"
    <center><table>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Manufacturer</th>
        <th>Device Name</th>
      </tr>";
}
?>

<!-- populate table from mysql database -->
<?php if(isset($_POST['searchSSN'])) while($row = mysqli_fetch_array($search_result)):?>
      <tr>
        <td><?php echo $row['Fname'];?></td>
        <td><?php echo $row['Lname'];?></td>
        <td><?php echo $row['Manufacturer'];?></td>
        <td><?php echo $row['DeviceName'];?></td>
      </tr>
<?php endwhile;
    echo"</table></center>";?>

<!-- If a functionality is selected execute this sequence to display results -->
<?php if(isset($_POST['showAllDevices']))
{
  echo"
    <center><table>
      <tr>
        <th>Manufacturer</th>
        <th>Device Name</th>
        <th>Type</th>
      </tr>";
}
?>

<!-- populate table from mysql database -->
<?php if(isset($_POST['showAllDevices'])) while($row = mysqli_fetch_array($search_result)):?>
      <tr>
        <td><?php echo $row['Manufacturer'];?></td>
        <td><?php echo $row['DeviceName'];?></td>
        <td><?php echo $row['Type'];?></td>
      </tr>
<?php endwhile;
    echo"</table></center>";?>
    <center>

<!-- If Manufacturer and Device Name is inputted, execute this sequence to display results -->
<?php if(isset($_POST['searchDeviceName']))
{
  echo"
    <center><table>
      <tr>
        <th>Manufacturer</th>
        <th>Device Name</th>
        <th>Functionality</th>
      </tr>";
}
?>

<!-- populate table from mysql database -->
<?php if(isset($_POST['searchDeviceName'])) while($row = mysqli_fetch_array($search_result)):?>
      <tr>
        <td><?php echo $row['Manufacturer'];?></td>
        <td><?php echo $row['DeviceName'];?></td>
        <td><?php echo $row['Functionality'];?></td>
      </tr>
<?php endwhile;
    echo"</table></center>";?>

<!-- If a SSN is inputted execute this sequence to display results -->
<?php if(isset($_POST['searchRole']))
{
  echo"
    <center><table>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Manufacturer</th>
        <th>Device Name</th>
      </tr>";
}
?>

<!-- populate table from mysql database -->
<?php if(isset($_POST['searchRole'])) while($row = mysqli_fetch_array($search_result)):?>
      <tr>
        <td><?php echo $row['Fname'];?></td>
        <td><?php echo $row['Lname'];?></td>
        <td><?php echo $row['Manufacturer'];?></td>
        <td><?php echo $row['DeviceName'];?></td>
      </tr>
<?php endwhile;
    echo"</table></center>";?>

</center>
</body>
</html>
