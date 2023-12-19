<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="userlogphp.css"> <!-- Link to the external CSS file -->
</head>
<body class="dashboard-bg">

    <?php 
    session_start();
    require "db.php";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $mobile = $_POST["mno"];
    $pwd = $_POST["password"];

    $query = mysqli_query($conn, "SELECT * FROM user WHERE user.mobileno=$mobile AND user.password='".$pwd."' ") or die(mysql_error());

    $temp1;
    $temp2;

    if($row = mysqli_fetch_array($query)) {
        echo "<div class='welcome-container'>";
        echo "<h1 style='color:white;'>Welcome ".$row['emailid']."</h1>";
       

        $temp1 = $row['emailid'];
        $temp2 = $row['id'];

        $query2 = mysqli_query($conn, "SELECT * FROM user,resv WHERE user.id=resv.id AND user.mobileno=$mobile ") or die(mysql_error());

        echo "<table class='reservation-table'><thead><tr><th>PNR</th><th>Train_no</th><th>Date_Of_Journey</th><th>Total_Fare</th><th>Train_Class</th><th>Seats_Reserved</th><th>Status</th></tr></thead>";

        while($row = mysqli_fetch_array($query2)) {
            echo "<tr><td>".$row["pnr"]."</td><td>".$row["trainno"]."</td><td>".$row["doj"]."</td><td>".$row["tfare"]."</td><td>".$row["class"]."</td><td>".$row["nos"]."</td><td>".$row["status"]."</td></tr>";
        }

        echo "</table>";

        if(mysqli_num_rows($query2) == 0) {
            echo "<p>No Reservations Yet!!!</p>";
        }

        echo "</div>";
    }

    $_SESSION["id"] = $temp2;

    if(mysqli_num_rows($query) == 0) {
        echo "<p>Wrong Combination!!!</p>";
        echo "<a href=\"http://localhost/railway/index.htm\">Home Page</a>";
        die();
    }
    ?>

    <form action="cancel.php" method="post" class="cancel-form">
        <label for="cancpnr">Enter PNR for Cancellation:</label>
        <input type="text" name="cancpnr" required>
        <input type="submit" value="Cancel">
    </form>

    <a href="http://localhost/railway/index.htm" class="home-link">Home</a>

    <?php
    $conn->close(); 
    ?>

</body>
</html>
