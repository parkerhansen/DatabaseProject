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
      <input type="submit" name="searchSSN" value="Search"><br><br>
    </form>

    <form action="SearchAccessLogs.php" method="post">
      <input type="text" name="beginning" placeholder="Beginning">
      <input type="text" name="end" placeholder="End">
      <input type="submit" name="searchDate" value="Search"><br><br>
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
