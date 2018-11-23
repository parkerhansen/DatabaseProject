<html>
<body>
<?php
$conn = mysqli_connect(`Localhost`, 'root', `Project`);

if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

//echo "Success: A proper connection to MySQL was made!" . PHP_EOL;
//echo "Host information: " . mysqli_get_host_info($conn) . PHP_EOL;

mysqli_select_db($conn, "Project");

$sql="INSERT INTO `Provider` (`ProviderName`, `PhoneNumber`) VALUES
('$_POST[ProviderName]','$_POST[PhoneNumber]')";

if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);

?>

<a href="http://localhost/ProjectHTML.php">Back</a>

</body>
</html>
