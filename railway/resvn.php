<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <link rel="stylesheet" href="resvn.css"> <!-- Link to the external CSS file -->
</head>
<body class="booking-form-bg">

<form action="new_png.php" method="post" class="booking-form">

    <?php 
    session_start();
    require "db.php";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $mobile = $_POST["mno"];
    $pwd = $_POST["password"];

    $query = mysqli_query($conn, "SELECT * FROM user WHERE user.mobileno=$mobile AND user.password='".$pwd."' ") or die(mysql_error());

    if(mysqli_num_rows($query) == 0) {
        echo "<p class='error-msg'>No such login!</p>";
        echo "<a href=\"http://localhost/railway/enquiry_result.php\">Go Back</a>";
        die();
    }

    $row = mysqli_fetch_array($query);
    $temp = $row['id'];
    $_SESSION["id"] = "$temp";
    $tno = $_POST["tno"];
    $_SESSION["tno"] = "$tno";
    $class = $_POST["class"];
    $_SESSION["class"] = "$class";
    $nos = $_POST["nos"];
    $_SESSION["nos"] = "$nos";
    ?>

    <table class="passenger-table">
        <?php
        for ($i = 0; $i < $nos; $i++) {
            echo "<tr>";
            echo "<td><input type='text' name='pname[]' placeholder=\"Passenger Name\" required></td>";
            echo "<td><input type='text' name='page[]' placeholder=\"Passenger Age\" required></td>";
            echo "<td><input type='text' name='pgender[]' placeholder=\"Passenger Gender\" required></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <input type="submit" value="Book">
    <br>
   
    <a href="http://localhost/railway/enquiry.php" class="back-link">Back to Enquiry</a>
    <?php
    $conn->close();
    ?>

</form>

</body>
</html>
