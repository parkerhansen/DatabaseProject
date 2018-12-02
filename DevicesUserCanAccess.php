<?php

if(isset($_POST['searchSocial']))
{
    $social = $_POST['social'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `Users`, `HasAccessTo` WHERE `SSN` = `UserSSN` AND `SSN`='$social'";
    $search_result = filterTable($query);

}

else if(isset($_POST['searchRole']))
{
  $role = $_POST['Role'];

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
  else {
    $query = "SELECT * FROM `Users`, `HasAccessTo` WHERE `SSN` = `UserSSN`";
    $search_result = filterTable($query);
  }
}

if(isset($_POST['searchFunction']))
{
    $functionality = $_POST['functionality'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `Users` AS `U`, `HasAccessTo` AS `H`, `Device2` AS `D`
      WHERE `SSN`=`UserSSN` AND `D`.`Manufacturer`=`H`.`Manufacturer` AND `D`.`DeviceName`=`H`.`DeviceName` AND `D`.`Functionality`='$functionality'";
    $search_result = filterTable($query);

}

 else {
    $query = "SELECT * FROM `Users`, `HasAccessTo` WHERE `SSN` = `UserSSN`";
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


  <form action="DevicesUserCanAccess.php" method="post">
    <input type="text" name="social" placeholder="SSN (XXX-XX-XXXX)">
    <input type="submit" name="searchSocial" value="Filter">
  </form>

  <form action="DevicesUserCanAccess.php" method="post">
    <select type="text" name="Role">
      <option value="">--</option>
      <option value="AuthorizedUser">Authorized User</option>
      <option value="SecondaryUser">Secondary User</option>
    <input type="submit" name="searchRole" value="Filter">
  </form>

  <form action="DevicesUserCanAccess.php" method="post">
    <input type="text" name="functionality" placeholder="Functionality">
    <input type="submit" name="searchFunction" value="Filter">
  </form>

  <form>
    <input type="button" value="Show All" onclick="window.location.href='DevicesUserCanAccess.php'" />
  </form>

    <table>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Device Name</th>
        <th>Manufacturer</th>
      </tr>

      <!-- populate table from mysql database -->
<?php while($row = mysqli_fetch_array($search_result)):?>
      <tr>
        <td><?php echo $row['Fname'];?></td>
        <td><?php echo $row['Lname'];?></td>
        <td><?php echo $row['DeviceName'];?></td>
        <td><?php echo $row['Manufacturer'];?></td>
      </tr>
<?php endwhile;?>
    </table>

</body>
</html>
