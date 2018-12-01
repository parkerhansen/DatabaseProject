<?php

if(isset($_POST['searchSSN']))
{
  $ssn = $_POST['ssn'];
  $query = "SELECT * FROM `Users`, `Data` WHERE `SSN`=`UserSSN` AND `SSN` LIKE '$ssn'";
  $search_result = filterTable($query);

}

else if(isset($_POST['searchDate']))
{
  $beginning = $_POST['beginning'];
  $end = $_POST['end'];
  $query = "SELECT * FROM `Users`, `Data` WHERE `SSN`=`UserSSN` AND `Date` BETWEEN '$beginning' AND '$end'";
  $search_result = filterTable($query);
}

else if(isset($_POST['searchRole']))
{
  $role = $_POST['Role'];

  if($role == 'AuthorizedUser')
  {
    $query = "SELECT * FROM `Users` AS `U`, `AuthorizedUser` AS `A`, `Data` AS `D` WHERE `U`.`SSN`=`A`.`SSN` AND `U`.`SSN`=`D`.`UserSSN`";
    $search_result = filterTable($query);
  }
  else if($role == 'SecondaryUser')
  {
    $query = "SELECT * FROM `Users` AS `U`, `SecondaryUser` AS `S`, `Data` AS `D` WHERE `U`.`SSN`=`S`.`SSN` AND `U`.`SSN`=`D`.`UserSSN`";
    $search_result = filterTable($query);
  }
}

else if(isset($_POST['searchRule']))
{
  $rule = $_POST['rule'];
  $query = "SELECT Fname, Lname, Amount, Location, Time, Date FROM Users AS U, Data AS Da WHERE U.SSN=Da.UserSSN AND U.SSN IN (
                  SELECT U.SSN
                  FROM Users AS U, HasAccessTo AS H, Device AS De
                  WHERE U.SSN=H.UserSSN AND De.Manufacturer=H.Manufacturer AND De.DeviceName=H.DeviceName AND De.AccessTime='$rule')";
  $search_result = filterTable($query);
}

else
{
    $query = "SELECT * FROM `Users`, `Data` WHERE `SSN`=`UserSSN`";
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
  <h2><center><a href="http://localhost/ProjectHTML.html">Back</a></center><h2>


  <center>
    <form action="SearchAccessLogs.php" method="post">
      <input type="text" name="ssn" placeholder="SSN (XXX-XX-XXXX)">
      <input type="submit" name="searchSSN" value="Search">
    </form>

    <form action="SearchAccessLogs.php" method="post">
      <input type="text" name="beginning" placeholder="Beginning">
      <input type="text" name="end" placeholder="End">
      <input type="submit" name="searchDate" value="Search">
    </form>

    <form action="SearchAccessLogs.php" method="post">
      <select type="text" name="Role">
        <option value="AuthorizedUser">Authorized User</option>
        <option value="SecondaryUser">Secondary User</option>
      <input type="submit" name="searchRole" value="Search">
    </form>

    <form action="SearchAccessLogs.php" method="post">
      <select type="text" name="rule">
        <option value="Every Day">Everyday</option>
        <option value="Weekdays">Weekdays</option>
        <option value="Weekends">Weekends</option>
        <option value="Evenings">Evenings</option>
        <option value="Mornings">Mornings</option>
      <input type="submit" name="searchRule" value="Search"><br><br>
    </form>

    <form>
      <input type="button" value="Show All" onclick="window.location.href='SearchAccessLogs.php'" />
    </form>

    <center>
    <table>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Amount</th>
        <th>Location</th>
        <th>Time</th>
        <th>Date</th>
      </tr>

      <!-- populate table from mysql database -->
<?php while($row = mysqli_fetch_array($search_result)):?>
      <tr>
        <td><?php echo $row['Fname'];?></td>
        <td><?php echo $row['Lname'];?></td>
        <td><?php echo $row['Amount'];?></td>
        <td><?php echo $row['Location'];?></td>
        <td><?php echo $row['Time'];?></td>
        <td><?php echo $row['Date'];?></td>
      </tr>
<?php endwhile;?>
    </table>
  <center>

</body>
</html>
