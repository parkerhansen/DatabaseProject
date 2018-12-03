<?php

if(isset($_POST['searchSSN']))
{
    $userSSN = $_POST['userSSN'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `Users` WHERE `SSN`='$userSSN'";
    $search_result = filterTable($query);

}

else if(isset($_POST['searchDeviceName']))
{
    $deviceName = $_POST['deviceName'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `Users` AS `U`, `HasAccessTo` AS `H`
              WHERE `SSN`=`UserSSN` AND `H`.`DeviceName`='$deviceName'";
    $search_result = filterTable($query);
}

else if(isset($_POST['searchFunctionality']))
{
    $functionalityToSearch = $_POST['functionalityToSearch'];
    $query = "SELECT * FROM `Users` AS `U`, `HasAccessTo` AS `H`, `Device2` AS `D` WHERE `SSN`=`UserSSN` AND `D`.`Manufacturer`=`H`.`Manufacturer` AND `D`.`DeviceName`=`H`.`DeviceName` AND `D`.`Functionality`='$functionalityToSearch'";
    $search_result = filterTable($query);
}

else if(isset($_POST['insertUser']))
{
  $userSSNEdit = $_POST['userSSNEdit'];
  $fNameEdit = $_POST['fNameEdit'];
  $lNameEdit = $_POST['lNameEdit'];
  $pNumberEdit = $_POST['pNumberEdit'];
  $uRole = $_POST['AuthUser'];
  // Insert User
  $query= "INSERT INTO `Users` (`Fname`, `Lname`, `SSN`, `PhoneNumber`) VALUES ('$fNameEdit', '$lNameEdit', '$userSSNEdit', '$pNumberEdit')";

  // Insert into Authorized User or Secondary User
  if($uRole == 'Auth')
  {
    $queryAuth="INSERT INTO `AuthorizedUser` (`SSN`) VALUES ('$userSSNEdit')";
  }
  else if($uRole == 'Sec')
  {
    $querySec="INSERT INTO `SecondaryUser` (`SSN`) VALUES ('$userSSNEdit')";
  }

  $connect = mysqli_connect(`Localhost`, 'root', `Project`);
  mysqli_select_db($connect, "Project");
  if (mysqli_query($connect, $query)) {
    echo "New User inserted successfully";
  }
  else {
    echo "Error:" . $query . "<br>" . mysqli_error($connect);
    echo "Error:" . $query2 . "<br>" . mysqli_error($connect);
  }
  if(mysqli_query($connect, $queryAuth) OR mysqli_query($connect, $querySec)) {
    echo "<br>Role inserted successfully";
  }
  else {
    echo "Error:" . $queryAuth . "<br>" . mysqli_error($connect);
    echo "Error:" . $querySec . "<br>" . mysqli_error($connect);
  }
}

else if(isset($_POST['deleteUser']))
{
  $userSSNEdit = $_POST['userSSNEdit'];
  $uRole = $_POST['AuthUser'];
  // Delete User from Authorized or Secondary first
  if($uRole == 'Auth')
  {
    $queryAuth= "DELETE FROM `AuthorizedUser` WHERE `SSN`='$userSSNEdit'";
  }
  else if($uRole == 'Sec')
  {
    $querySec= "DELETE FROM `SecondaryUser` WHERE `SSN`='$userSSNEdit'";
  }
  $query= "DELETE FROM `Users` WHERE `SSN`='$userSSNEdit'";

  $connect = mysqli_connect(`Localhost`, 'root', `Project`);
  mysqli_select_db($connect, "Project");
  if(mysqli_query($connect, $queryAuth) OR mysqli_query($connect, $querySec)) {
    echo "<br>User role deleted successfully";
  }
  else {
    echo "Error:" . $queryAuth . "<br>" . mysqli_error($connect);
    echo "Error:" . $querySec . "<br>" . mysqli_error($connect);
  }
  if (mysqli_query($connect, $query)) {
    echo "User deleted successfully";
  }
  else {
    echo "Error:" . $query . "<br>" . mysqli_error($connect);
    echo "Error:" . $query2 . "<br>" . mysqli_error($connect);
  }
}

//Show All Users
else if(isset($_POST['showAllUsers']))
{
  $query = "SELECT * FROM `Users`, `HasAccessTo` WHERE `SSN`=`UserSSN`";
  $search_result = filterTable($query);
}

//Search User by Role
else if(isset($_POST['searchRole']))
{
  $role = $_POST['role'];
  //query to find users
  if($role == 'AuthorizedUser')
  {
    $query = "SELECT * FROM `Users` AS `U`, `AuthorizedUser` AS `A` WHERE `U`.`SSN`=`A`.`SSN`";
    $search_result = filterTable($query);
  }
  else if($role == 'SecondaryUser')
  {
    $query = "SELECT * FROM `Users` AS `U`, `SecondaryUser` AS `S` WHERE `U`.`SSN`=`S`.`SSN`";
    $search_result = filterTable($query);
  }
}

//Default
else {
    $query = "SELECT * FROM `Users` AS `U`, `HasAccessTo` AS `H`, `Device2` AS `D` WHERE `SSN`=`UserSSN` AND `D`.`Manufacturer`=`H`.`Manufacturer` AND `D`.`DeviceName`=`H`.`DeviceName`";
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
  <h2><center><a href="http://localhost/ProjectHTML.html">Back</a></center></h2>


<center>
<table>
  <tr>
    <td>
      <form action="Users.php" method="post">
      <center><b><u>Insert/Delete a User</u></b><br><br>
      SSN: <input type="text" name="userSSNEdit" placeholder="XXX-XX-XXXX" required><br>
      Name: <input type="text" name="fNameEdit" placeholder="First Name">
            <input type="text" name="lNameEdit" placeholder="Last Name"><br>
      Phone Number: <input type="text" name="pNumberEdit" placeholder="XXXXXXXXXX"><br>
      User Role:<input type="radio" name="AuthUser" value="Auth" required>Authorized User
                <input type="radio" name="AuthUser" value="Sec">Secondary User<br><br>
      <input type="submit" name="insertUser" value="Insert">
      <input type="submit" name="deleteUser" value="Delete">
      </center>
      </form>
    </td>

    <td>
    <center>
      <center><b><u>Search for a User</u></b><br><br>
      <form action="Users.php" method="post">
        Search User:<input type="text" name="userSSN" placeholder="XXX-XX-XXXX" required>
        <input type="submit" name="searchSSN" value="Search"><br>
      </form>

      <form action="Users.php" method="post">
        Device Name:<input type="text" name="deviceName" placeholder="Device Name" required>
        <input type="submit" name="searchDeviceName" value="Filter"><br>
      </form>

      <form action="Users.php" method="post">
        Functionality:<select type="text" name="functionalityToSearch" required>
          <option value="Thermostat">Thermostat</option>
          <option value="Internet Access">Internet Access</option>
          <option value="Phone">Phone</option>
          <option value="Camera">Camera</option>
          <option value="Watch">Watch</option>
          <option value="Activity Tracker">Activity Tracker</option>
          <option value="Refrigerator">Refrigerator</option>
          <option value="Computer">Computer</option>
        <input type="submit" name="searchFunctionality" value="Filter"><br>
      </form>

      <form action="Users.php" method="post">
        Role:<select type="text" name="role" required>
          <option value="AuthorizedUser">Authorized User</option>
          <option value="SecondaryUser">Secondary User</option>
        <input type="submit" name="searchRole" value="Search">
      </form>

      <form action="Users.php" method="post">
        <input type="submit" name="showAllUsers" value="Show All">
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
  </style>
</head>

<!-- If a SSN is imputted this sequence displays the results -->
<?php if(isset($_POST['searchSSN']))
{
  echo"
    <center><table>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone Number</th>
        <th>Date of Birth</th>
        <th>Address</th>
        <th>State</th>
        <th>Sex</th>
      </tr>";
}
?>

      <!-- populate table from mysql database -->
<?php if(isset($_POST['searchSSN'])) while($row = mysqli_fetch_array($search_result)):?>
      <tr>
        <td><?php echo $row['Fname'];?></td>
        <td><?php echo $row['Lname'];?></td>
        <td><?php echo $row['PhoneNumber'];?></td>
        <td><?php echo $row['DateOfBirth'];?></td>
        <td><?php echo $row['Address'];?></td>
        <td><?php echo $row['State'];?></td>
        <td><?php echo $row['Sex'];?></td>
      </tr>
<?php endwhile;
    echo"</table></center>";?>

<!-- If a Device Name is imputted this sequence displays the results -->
<?php if(isset($_POST['searchDeviceName']))
{
  echo"
    <center><table>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone Number</th>
        <th>Device Name</th>
        </tr>";
}
?>

<!-- populate table from mysql database -->
<?php if(isset($_POST['searchDeviceName'])) while($row = mysqli_fetch_array($search_result)):?>
      <tr>
          <td><?php echo $row['Fname'];?></td>
          <td><?php echo $row['Lname'];?></td>
          <td><?php echo $row['PhoneNumber'];?></td>
          <td><?php echo $row['DeviceName'];?></td>
      </tr>
<?php endwhile;
  echo"</table></center>";?>

<!-- If a Funcationality is imputted this sequence displays the results -->
<?php if(isset($_POST['searchFunctionality']))
{
  echo"
    <center><table>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone Number</th>
        <th>Device Name</th>
        <th>Functionality</th>
      </tr>";
}
?>

<!-- populate table from mysql database -->
<?php if(isset($_POST['searchFunctionality'])) while($row = mysqli_fetch_array($search_result)):?>
      <tr>
        <td><?php echo $row['Fname'];?></td>
        <td><?php echo $row['Lname'];?></td>
        <td><?php echo $row['PhoneNumber'];?></td>
        <td><?php echo $row['DeviceName'];?></td>
        <td><?php echo $row['Functionality'];?></td>
      </tr>
<?php endwhile;
  echo"</table></center>";?>

<?php if(isset($_POST['showAllUsers']) or isset($_POST['searchRole']))
{
  echo"
    <center><table>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone Number</th>
      </tr>";
}
?>

<!-- populate table from mysql database -->
<?php if(isset($_POST['showAllUsers']) or isset($_POST['searchRole'])) while($row = mysqli_fetch_array($search_result)):?>
      <tr>
          <td><?php echo $row['Fname'];?></td>
          <td><?php echo $row['Lname'];?></td>
          <td><?php echo $row['PhoneNumber'];?></td>
      </tr>
<?php endwhile;
  echo"</table></center>";?>

</center>
</body>
</html>
