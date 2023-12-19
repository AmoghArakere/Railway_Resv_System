<html>
<body style="background-image: url(train_logo.jpg);
    height: 100%; 
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;">

<?php

require "db.php";

$mno = $_POST["mobileno"];
$dob = $_POST["dob"];
$eid = $_POST["emailid"];
$pwd = $_POST["password"];

// Convert date format from dd-mm-yyyy to yyyy-mm-dd
$dob = date('Y-m-d', strtotime($dob));



$sql = "INSERT INTO user (mobileno, dob, emailid, password) VALUES ('$mno', '$dob', '$eid', '$pwd')";

if ($conn->query($sql) === TRUE) {
    echo "<div style=\"position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; font-size: 48px; color: white;\">Hi $eid, Thank You for Registering, <a href=\"http://localhost/railway/index.htm\" style=\"color: black; text-decoration: none; font-size: 32px;\">Click Here</a> to browse through our website!!!</div>";




        
} else {
    echo "Error:" . $conn->error . "<br> <a href=\"http://localhost/railway/new_user_form.htm\">Try Again!!!</a> ";
}

$conn->close(); 
?>

</body>
</html>
