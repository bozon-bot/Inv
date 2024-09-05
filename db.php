<?php
$servername = "localhost";
$username = "softlife_db";
$password = "Hicks2005";
$dbname = "softlife_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>