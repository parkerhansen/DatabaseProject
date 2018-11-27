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
<?php

require 'Connector.php';

mysqli_select_db($conn, "Project");

$sql="INSERT INTO `Users` (`Fname`, `Lname`, `SSN`, `Sex`) VALUES
  ('$_POST[Fname]', '$_POST[Lname]', '$_POST[SSN]', '$_POST[Sex]')";

if (mysqli_query($conn, $sql)) {
  echo "New User record created successfully";
}
else {
  echo "Error:" . $sql . "<br>" . mysqli_error($conn);
}

if($_POST['AuthUser'] == 'Yes') {
  $sql="INSERT INTO `AuthorizedUser` (`SSN`, `CustomerID`) VALUES
    ('$_POST[SSN]', '$_POST[CustID]')";

    if (mysqli_query($conn, $sql)) {
      echo "<br><br>Authorized User record created successfully";
    }
    else {
      echo "Error:" . $sql . "<br>" . mysqli_error($conn);
    }
}

else if ($_POST['AuthUser'] == 'No') {
  $sql="INSERT INTO `SecondaryUser` (`SSN`) VALUES
    ('$_POST[SSN]')";

  if (mysqli_query($conn, $sql)) {
    echo "<br><br>Secondary User record created successfully";
  }
  else {
    echo "Error:" . $sql . "<br>" . mysqli_error($conn);
  }


mysqli_close($conn);
}

else {
echo"Provide Information";
mysqli_close($conn);
}
?>

<form method="post">

  Customer ID: <input type="text" name="CustID" /><br><br>
  <input type="submit" />

</form>

<?php

while (!empty($_POST["SSN"]))

 ?>

<br>
<br>

<a href="http://localhost/ProjectHTML.php">Back</a>


</body>
</html>
