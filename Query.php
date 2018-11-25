<html>
<body>
<h1><center>A DATABASE FOR YOUR INTERNET OF THINGS:</center></h1>
<center><img src="http://localhost/ElitaDrawing.jpeg" /></center>
<h2><center>HELPING YOU SEE BOTH THE FOREST AND THE TREES</center></h2>
<?php

require 'Connector.php';

mysqli_select_db($conn, "Project");

if (!empty($_POST["ProviderName"])) {

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

else if (!empty($_POST["SSN"])) {

  if($_POST['AuthUser'] == "Yes") {
    echo "<form method="post" action="$_SERVER["PHP_SELF"]">
            Customer ID: <input type="text" name="CustID" /><br><br>"
  }

  $sql="INSERT INTO `Users` (`Fname`, `Lname`, `SSN`, `Sex`) VALUES
    ('$_POST[Fname]', '$_POST[Lname]', '$_POST[SSN]', '$_POST[Sex]')";

  if (mysqli_query($conn, $sql)) {
    echo "New User record created successfully";
  }
  else {
    echo "Error:" . $sql . "<br>" . mysqli_error($conn);
  }

  if($_POST['AuthUser'] == "Yes") {
    $sql="INSERT INTO `AuthorizedUser` (`SSN`, `CustomerID`) VALUES
      ('$_POST[SSN]', '$_POST[CustID]')";

      if (mysqli_query($conn, $sql)) {
        echo "<br><br>Authorized User record created successfully";
      }
      else {
        echo "Error:" . $sql . "<br>" . mysqli_error($conn);
      }
  }

  else if ($_POST['AuthUser'] == "No") {
    $sql="INSERT INTO `SecondaryUser` (`SSN`) VALUES
      ('$_POST[SSN]')";

    if (mysqli_query($conn, $sql)) {
      echo "<br><br>Secondary User record created successfully";
    }
    else {
      echo "Error:" . $sql . "<br>" . mysqli_error($conn);
    }
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

<a href="http://localhost/ProjectHTML.php">Back</a>


</body>
</html>
