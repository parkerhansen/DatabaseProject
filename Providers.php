<?php
if(isset($_POST['insertProvider']))
{
  $providerName = $_POST['ProviderName'];
  $phoneNumber = $_POST['PhoneNumber'];
  // Insert Provider
  $query= "INSERT INTO `Provider` (`ProviderName`, `PhoneNumber`) VALUES ('$providerName', '$phoneNumber')";

  $connect = mysqli_connect(`Localhost`, 'root', `Project`);
  mysqli_select_db($connect, "Project");
  if (mysqli_query($connect, $query)) {
    echo "Provider inserted successfully";
  }
  else {
    echo "Error:" . $query . "<br>" . mysqli_error($connect);
  }
}

else if(isset($_POST['deleteProvider']))
{
  $providerName = $_POST['ProviderName'];
  // Delete User from Authorized or Secondary first
  $query= "DELETE FROM `Provider` WHERE `ProviderName`='$providerName'";

  $connect = mysqli_connect(`Localhost`, 'root', `Project`);
  mysqli_select_db($connect, "Project");
  if (mysqli_query($connect, $query)) {
    echo "Provider deleted successfully";
  }
  else {
    echo "Error:" . $query . "<br>" . mysqli_error($connect);
  }
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
      <form action="Providers.php" method="post">
        <center>
        Insert/Delete a Provider<br>
        Provider Name: <input type="text" name="ProviderName" placeholder="Name" required><br>
        Phone Number: <input type="text" name="PhoneNumber" placeholder="XXXXXXXXXX"><br>
        <input type="submit" name="insertProvider" value="Insert">
        <input type="submit" name="deleteProvider" value="Delete">
        </center>
      </form>
    </td>
  </tr>
</table>

<br>
<br>

<head>
<style type="text/css">
table{
  font-family: 'IBM Plex Sans', sans-serif;
  font-size: 20px;
}
body{
  font-family: 'IBM Plex Sans', sans-serif;
  font-size: 20px;
}
input[type='text']
{font-family: 'IBM Plex Sans', sans-serif;
  font-size: 20px;
}

input[type='submit']
{font-family: 'IBM Plex Sans', sans-serif;
  font-size: 15px;
}

  </style>
</head>

</body>
</html>
