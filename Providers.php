


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

<form action="InsertProvider.php" method="post">

<center>Insert a new Provider</center><br>

Provider Name: <input type="text" name="ProviderName"><br><br>

Phone Number: <input type="text" name="PhoneNumber" placeholder="XXXXXXXXXX"><br><br>

<input type="submit" name="SubmitProvider" value="Insert">

</form>

</td>
<td>

<?php

require 'Connector.php';

mysqli_select_db($conn, "Project");

if (isset($_POST['SubmitProvider']) && !empty($_POST['ProviderName'])) {

  $sql="INSERT INTO `Provider` (`ProviderName`, `PhoneNumber`) VALUES
    ('$_POST[ProviderName]','$_POST[PhoneNumber]')";

  if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  }

  else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  mysqli_close($conn);
}

else {
  echo"Provide Information";
  mysqli_close($conn);
}

?>
<br>
<br>

<a href="http://localhost/ProjectHTML.html">Back</a>


</body>
</html>
