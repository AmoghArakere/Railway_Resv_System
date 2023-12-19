<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Enquiry</title>
    <link rel="stylesheet" href="enq.css"> <!-- Link to the external CSS file -->
</head>
<body class="enquiry-bg">

<?php
session_start();
$_SESSION=array();
session_destroy();
?>

<div class="enquiry-container" align="center">
    <form action="enquiry_result.php" method="post">
        <label for="sp" style="color:black">Starting Point:</label>
        <select id="sp" name="sp" required>
            <?php
                require "db.php";
                $cdquery = "SELECT sname FROM station";
                $cdresult = mysqli_query($conn, $cdquery);
                
                echo "<option value=\"\"></option>";

                while ($cdrow = mysqli_fetch_array($cdresult)) {
                    $cdTitle = $cdrow['sname'];
                    echo "<option value=\"$cdTitle\">$cdTitle</option>";
                }
            ?>
        </select>
        <br><br>
        
        <label for="dp" style="color:black">Destination Point:</label>
        <select id="dp" name="dp" required>
            <?php
                require "db.php";
                $cdquery = "SELECT sname FROM station";
                $cdresult = mysqli_query($conn, $cdquery);
                
                echo "<option value=\"\"></option>";

                while ($cdrow = mysqli_fetch_array($cdresult)) {
                    $cdTitle = $cdrow['sname'];
                    echo "<option value=\"$cdTitle\">$cdTitle</option>";
                }
            ?>
        </select>
        <br><br>
        
        <label for="doj" style="color:black">Date of Journey:</label>
        <input type="date" name="doj" required><br>
        
        <input type="submit" value="Submit">
    </form>
    <br><br>
    <a href="http://localhost/railway/index.htm">Home</a>
</div>

</body>
</html>
