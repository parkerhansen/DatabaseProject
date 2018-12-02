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
else if(isset($_POST['showAllDevices'])) {
    $query = "SELECT * FROM `Device`";
    $search_result = filterTable($query);
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
  <link href="https://fonts.googleapis.com/css?family=Sedgwick+Ave" rel="stylesheet">
  <style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
    th, td {
      padding: 15px;
    }
    h1{
      font-family: 'Sedgwick Ave', cursive;
    }
    h2{
      font-family: 'Sedgwick Ave', cursive;
    }
  </style>
</head>
<body>

  <h1><center>A DATABASE FOR YOUR INTERNET OF THINGS:</center></h1>
  <center><img src="http://localhost/ElitaDrawing.jpeg" /></center>
  <h2><center>HELPING YOU SEE BOTH THE FOREST AND THE TREES</center></h2>
  <h2><center><a href="http://localhost/ProjectHTML.html">Back</a></center></h2>


  <center>

    <form action="SearchDevices.php" method="post">
      <input type="text" name="manufacturerName" placeholder="Manufacturer Name">
      <input type="text" name="deviceName" placeholder="Device Name">
      <input type="submit" name="searchDeviceName" value="Search">
    </form>

    <form action="SearchDevices.php" method="post">
      What devices does a user have access to?:<input type="text" name="ssn" placeholder="User SSN (XXX-XX-XXXX)">
      <input type="submit" name="searchSSN" value="Search">
    </form>

    <form action="SearchDevices.php" method="post">
      <select type="text" name="valueToSearch">
        <option>--Choose a Functionality--</option>
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
    echo"</table>";?>


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
    echo"</table>";?>

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
    echo"</table>";?>
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
    echo"</table>";?>

</body>
</html>
