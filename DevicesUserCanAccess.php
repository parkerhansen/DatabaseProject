<?php

if(isset($_POST['searchDevice']))
{
    $device = $_POST['device'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `Users`, `HasAccessTo` WHERE `SSN` = `UserSSN` AND (`SSN`) LIKE '%".$device."%'";
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
    <input type="text" name="device" placeholder="Device Name"><br><br>
    <input type="submit" name="searchDevice" value="Filter"><br><br>

    <table>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>SSN</th>
        <th>Device Name</th>
        <th>Manufacturer</th>
      </tr>

      <!-- populate table from mysql database -->
<?php while($row = mysqli_fetch_array($search_result)):?>
      <tr>
        <td><?php echo $row['Fname'];?></td>
        <td><?php echo $row['Lname'];?></td>
        <td><?php echo $row['SSN'];?></td>
        <td><?php echo $row['DeviceName'];?></td>
        <td><?php echo $row['Manufacturer'];?></td>
      </tr>
<?php endwhile;?>
    </table>
  </form>

</body>
</html>
