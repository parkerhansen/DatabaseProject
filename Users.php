<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Sedgwick+Ave" rel="stylesheet">
  <style>
    body{
      font-family: 'Sedgwick Ave', cursive;
    }
  </style>
</head>
<body>
<h1><center>A DATABASE FOR YOUR INTERNET OF THINGS:</center></h1>
<center><img src="http://localhost/ElitaDrawing.jpeg" /></center>
<h2><center>HELPING YOU SEE BOTH THE FOREST AND THE TREES</center></h2>

<form action="InsertUsers.php" method="post">

<center>Insert a new user</center><br>

User SSN: <input type="text" name="SSN" placeholder="XXX-XX-XXXX"><br><br>

First Name: <input type="text" name="Fname"><br><br>

Last Name: <input type="text" name="Lname"><br><br>

Gender:
<input type="radio" name="Sex" value="F">Female
<input type="radio" name="Sex" value="M">Male
<input type="radio" name="Sex" value="O">Other <br><br>

Authorized User?:
<input type="radio" name="AuthUser" value="Yes">Yes
<input type="radio" name="AuthUser" value="No">No <br><br>

<input type="submit" name="SubmitUser" value="Insert">

</form>

</td>
</tr>
</table>

<?php

require 'Connector.php';

mysqli_select_db($conn, "Project");

$sql="INSERT INTO `Users` (`Fname`, `Lname`, `SSN`, `Sex`) VALUES
  ('$_POST[Fname]', '$_POST[Lname]', '$_POST[SSN]', '$_POST[Sex]')";

if (mysqli_query($conn, $sql)) {
  echo "New User record created successfully";
}
else {
  echo "Error:" . $sql . "<br>" . mysqli_error($conn);
}

if($_POST['AuthUser'] == 'Yes') {
  $sql="INSERT INTO `AuthorizedUser` (`SSN`, `CustomerID`) VALUES
    ('$_POST[SSN]', '$_POST[CustID]')";

    if (mysqli_query($conn, $sql)) {
      echo "<br><br>Authorized User record created successfully";
    }
    else {
      echo "Error:" . $sql . "<br>" . mysqli_error($conn);
    }
}

else if ($_POST['AuthUser'] == 'No') {
  $sql="INSERT INTO `SecondaryUser` (`SSN`) VALUES
    ('$_POST[SSN]')";

  if (mysqli_query($conn, $sql)) {
    echo "<br><br>Secondary User record created successfully";
  }
  else {
    echo "Error:" . $sql . "<br>" . mysqli_error($conn);
  }


mysqli_close($conn);
}

else {
echo"Provide Information";
mysqli_close($conn);
}
?>

<form method="post">

  Customer ID: <input type="text" name="CustID" /><br><br>
  <input type="submit" />

</form>

<?php

while (!empty($_POST["SSN"]))

 ?>

<br>
<br>

<a href="http://localhost/ProjectHTML.html">Back</a>


</body>
</html>


<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `Users` WHERE `Fname`='$valueToSearch'";
    $search_result = filterTable($query);

}
 else {
    $query = "SELECT * FROM `Users`";
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


  <center><form action="SelectUsers.php" method="post">
    <input type="text" name="valueToSearch" placeholder="User First Name"><br><br>
    <input type="submit" name="search" value="Filter"><br><br>

    <table>
      <tr>
        <th>First Name</th>
        <th>Middle Initial</th>
        <th>Last Name</th>
        <th>SSN</th>
        <th>Phone Number</th>
        <th>Date of Birth</th>
        <th>Address</th>
        <th>State</th>
        <th>Sex</th>
      </tr>

      <!-- populate table from mysql database -->
<?php if(isset($_POST['search'])) while($row = mysqli_fetch_array($search_result)):?>
      <tr>
        <td><?php echo $row['Fname'];?></td>
        <td><?php echo $row['Minit'];?></td>
        <td><?php echo $row['Lname'];?></td>
        <td><?php echo $row['SSN'];?></td>
        <td><?php echo $row['PhoneNumber'];?></td>
        <td><?php echo $row['DateOfBirth'];?></td>
        <td><?php echo $row['Address'];?></td>
        <td><?php echo $row['State'];?></td>
        <td><?php echo $row['Sex'];?></td>
      </tr>
<?php endwhile;?>
    </table>
  </form></center>

</body>
</html>

<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `Users` AS `U`, `HasAccessTo` AS `H`, `Device2` AS `D` WHERE `SSN`=`UserSSN` AND `D`.`Manufacturer`=`H`.`Manufacturer` AND `D`.`DeviceName`=`H`.`DeviceName` AND `D`.`DeviceName`='$valueToSearch'";
    $search_result = filterTable1($query);
}

else if(isset($_POST['search2']))
{
    $functionalityToSearch = $_POST['functionalityToSearch'];
    $query = "SELECT * FROM `Users` AS `U`, `HasAccessTo` AS `H`, `Device2` AS `D` WHERE `SSN`=`UserSSN` AND `D`.`Manufacturer`=`H`.`Manufacturer` AND `D`.`DeviceName`=`H`.`DeviceName` AND `D`.`Functionality`='$functionalityToSearch'";
    $search_result = filterTable1($query);
}

else {
    $query = "SELECT * FROM `Users` AS `U`, `HasAccessTo` AS `H`, `Device2` AS `D` WHERE `SSN`=`UserSSN` AND `D`.`Manufacturer`=`H`.`Manufacturer` AND `D`.`DeviceName`=`H`.`DeviceName`";
    $search_result = filterTable1($query);
}

// function to connect and execute the query
function filterTable1($query)
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


  <form action="UserQueries.php" method="post">
    <input type="text" name="valueToSearch" placeholder="Device Name">
    <input type="submit" name="search" value="Filter"><br><br>
  </form>
  <form action="UserQueries.php" method="post">
  <select type="text" name="functionalityToSearch">
    <option value="">ALL</option>
    <option value="Thermostat">Thermostat</option>
    <option value="Internet Access">Internet Access</option>
    <option value="Phone">Phone</option>
    <option value="Camera">Camera</option>
    <option value="Watch">Watch</option>
    <option value="Activity Tracker">Activity Tracker</option>
    <option value="Refrigerator">Refrigerator</option>
    <option value="Computer">Computer</option>
  <input type="submit" name="search2" value="Filter"><br><br>

    <table>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone Number</th>
        <th>Device Name</th>
        <th>Functionality</th>
      </tr>

      <!-- populate table from mysql database -->
<?php while($row = mysqli_fetch_array($search_result)):?>
      <tr>
        <td><?php echo $row['Fname'];?></td>
        <td><?php echo $row['Lname'];?></td>
        <td><?php echo $row['PhoneNumber'];?></td>
        <td><?php echo $row['DeviceName'];?></td>
        <td><?php echo $row['Functionality'];?></td>
      </tr>
<?php endwhile;?>
    </table>

</body>
</html>
