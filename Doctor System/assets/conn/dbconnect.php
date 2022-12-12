<?php

$dblogin = "root";
$dbpass = "";
$db = "mydb";
$dbhost="localhost";
  $con = mysqli_connect($dbhost, $dblogin, $dbpass, $db);
  if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>