<link rel="stylesheet" href="style.css" />
<?php
$servername = "localhost";
$username = "YOUR_USERNAME";
$password = "YOUR_PASSWORD";
$dbname = "DB_NAME";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) 
{
 die("Connection failed: " . $conn->connect_error);
} 
?>
