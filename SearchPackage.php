<?php

if(isset($_POST['searchSSN']))
{
  $ssn = $_POST['ssn'];
  $query = "SELECT * FROM Users AS U, AuthorizedUser AS A, Purchases AS P WHERE U.SSN=A.SSN AND A.SSN=P.UserSSN AND U.SSN='$ssn'";
  $search_result = filterTable($query);

}

else if(isset($_POST['showExpired']))
{

  $query = "SELECT * FROM Users AS U, AuthorizedUser AS A, Purchases AS P WHERE U.SSN=A.SSN AND A.SSN=P.UserSSN AND P.PolicyEnd < CURRENT_DATE()";
  $search_result = filterTable($query);

}

else if(isset($_POST['showAll']))
{
  $query = "SELECT * FROM Package";
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
    body{
      background-color: rgb(255, 255, 255);
      color: rgb(26, 83, 66);
      font-family: 'IBM Plex Sans', sans-serif;
      font-weight: 100;
      font-size: 30px;
    }
    table{
      font-family: 'IBM Plex Sans', sans-serif;
      font-size: 20px;
    }
    input[type='text']
    {font-family: 'IBM Plex Sans', sans-serif;
    font-size: 15px;}

    input[type='submit']
    {font-family: 'IBM Plex Sans', sans-serif;
    font-size: 15px;}
  </style>
</head>
<body>

  <h1><center>A DATABASE FOR YOUR INTERNET OF THINGS:</center></h1>
  <center><img src="http://localhost/ElitaDrawing.jpeg" /></center>
  <h2><center>HELPING YOU SEE BOTH THE FOREST AND THE TREES</center></h2>
  <h4><center><a href="http://localhost/WebInterface.html">Back</a></center></h4>


  <center>
    <table>
      <tr>
        <td>
          <center>
    <form action="SearchPackage.php" method="post">
      <input type="text" name="ssn" placeholder="SSN (XXX-XX-XXXX)">
      <input type="submit" name="searchSSN" value="Search">
    </form>

    <form action="SearchPackage.php" method="post">
      <input type="submit" name="showExpired" value="Show Expired">
    </form>

    <form action="SearchPackage.php" method="post">
      <input type="submit" name="showAll" value="Show All">
    </form>
  </center>
  </td>
</tr>
</table>
</center>

<?php if(isset($_POST['searchSSN']))
{ echo"
    <center>
    <table>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Provider Name</th>
        <th>Package Name</th>
      </tr>";
}
?>
      <!-- populate table from mysql database when searching for SSN -->
<?php if(isset($_POST['searchSSN'])) while($row = mysqli_fetch_array($search_result)):?>
      <tr>
        <td><?php echo $row['Fname'];?></td>
        <td><?php echo $row['Lname'];?></td>
        <td><?php echo $row['ProviderName'];?></td>
        <td><?php echo $row['PackageName'];?></td>
      </tr>
<?php endwhile;
    echo"</table>"?>

<!-- if show all is selected will trigger this to show all packages -->
<?php if(isset($_POST['showAll']))
    { echo"
        <center>
        <table>
          <tr>
            <th>Provider Name</th>
            <th>Package Name</th>
          </tr>";
    }
?>
          <!-- populate table from mysql database when searching for all packages-->
<?php if(isset($_POST['showAll'])) while($row = mysqli_fetch_array($search_result)):?>
          <tr>
            <td><?php echo $row['ProviderName'];?></td>
            <td><?php echo $row['PackageName'];?></td>
          </tr>
<?php endwhile;
        echo"</table>"?>

<!-- if show all is selected will trigger this to show all expired packages -->
<?php if(isset($_POST['showExpired']))
    { echo"
          <center>
          <table>
          <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Provider Name</th>
            <th>Package Name</th>
            <th>Policy End Date</th>
          </tr>";
    }
?>
<!-- populate table from mysql database when searching for all packages-->
<?php if(isset($_POST['showExpired'])) while($row = mysqli_fetch_array($search_result)):?>
          <tr>
            <td><?php echo $row['Fname'];?></td>
            <td><?php echo $row['Lname'];?></td>
            <td><?php echo $row['ProviderName'];?></td>
            <td><?php echo $row['PackageName'];?></td>
            <td><?php echo $row['PolicyEnd'];?></td>
          </tr>
<?php endwhile;
echo"</table>"?>


  <center>

</body>
</html>
