<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Booking</title>
    <link rel="stylesheet" href="enq_res.css"> <!-- Link to the external CSS file -->
</head>
<body class="booking-bg">

<?php
session_start();
require "db.php";

$doj = $_POST["doj"];
$_SESSION["doj"] = "$doj";
$sp = $_POST["sp"];
$_SESSION["sp"] = "$sp";
$dp = $_POST["dp"];
$_SESSION["dp"] = "$dp";

$query = mysqli_query($conn,"SELECT t.trainno,t.tname,c.sp,s1.departure_time,c.dp,s2.arrival_time,t.dd,c.class,c.fare,c.seatsleft FROM train as t,classseats as c, schedule as s1,schedule as s2 where s1.trainno=t.trainno AND s2.trainno=t.trainno AND s1.sname='".$sp."' AND s2.sname='".$dp."' AND t.trainno=c.trainno AND c.sp='".$sp."' AND c.dp='".$dp."' AND c.doj='".$doj."' ");

echo "<div class='table-container'>";
echo "<table class='train-table'><thead><tr><th>Train No</th><th>Train Name</th><th>Starting Point</th><th>Departure Time</th><th>Destination Point</th><th>Arrival Time</th><th>Day</th><th>Train Class</th><th>Fare</th><th>Seats Left</th></tr></thead>";

while($row = mysqli_fetch_array($query)) {
    echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[7]."</td><td>".$row[8]."</td><td>".$row[9]."</td></tr>";
}
echo "</table></div>";

if(mysqli_num_rows($query) == 0) {
    echo "<p>No such train</p>";
}
?>

<div class="booking-form">
    <p style="color:black">If you wish to proceed with booking, fill in the following details:</p>
    <form action="resvn.php" method="post">
        <label for="mno"  style="color:black">Registered Mobile No:</label>
        <input type="text" name="mno" required>

        <label for="password" style="color:black">Password:</label>
        <input type="password" name="password" required>

        <label for="tno" style="color:black">Enter Train No:</label>
        <input type="text" name="tno" required>

        <label for="class" style="color:black">Enter Class:</label>
        <input type="text" name="class" required>

        <label for="nos" style="color:black">No. of Seats:</label>
        <input type="text" name="nos" required>

        <input type="submit" value="Proceed with Booking">
    </form>
</div>

<?php
echo "<a href=\"http://localhost/enquiry.php\">More Enquiry</a> <br>";
$conn->close();
?>
<br><a href="http://localhost/index.htm">Home</a>
</body>
</html>
