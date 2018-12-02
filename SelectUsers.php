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
