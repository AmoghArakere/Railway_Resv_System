<link rel="stylesheet" href="style.css" />
<?php
$servername = "localhost";
$username = "root";
$password = "fire02arthurboyle31452";
$dbname = "railway";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) 
{
 die("Connection failed: " . $conn->connect_error);
} 
?>