<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `Users` `Data` WHERE `SSN`=`UserSSN` (`SSN`) LIKE '%".$valueToSearch."%'";
   $search_result = filterTable($query);

}
 else {
    $query = "SELECT * FROM `Users` `Data` WHERE `SSN`=`UserSSN`";
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


  <center><form action="SearchAccessLogs.php" method="post">
    <select type="text" name="valueToSearch" placeholder="User SSN">
      <option value="">ALL</option>
      <option value="Thermostat">Thermostat</option>
      <option value="Internet Access">Internet Access</option>
      <option value="Phone">Phone</option>
      <option value="Camera">Camera</option>
      <option value="Watch">Watch</option>
      <option value="Activity Tracker">Activity Tracker</option>
      <option value="Refrigerator">Refrigerator</option>
      <option value="Computer">Computer</option>
    <input type="submit" name="search" value="Filter"><br><br>

    <center><table>
      <tr>
        <th>Amount</th>
        <th>Location</th>
        <th>Time</th>
        <th>Date</th>
      </tr>

      <!-- populate table from mysql database -->
<?php if(isset($_POST['search'])) while($row = mysqli_fetch_array($search_result)):?>
      <tr>
        <td><?php echo $row['Location'];?></td>
        <td><?php echo $row['Amount'];?></td>
        <td><?php echo $row['Time'];?></td>
        <td><?php echo $row['Date'];?></td>
      </tr>
<?php endwhile;?>
    </table>
  </form><center>

</body>
</html>