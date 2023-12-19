<!DOCTYPE html>
<html>

<body style="background-image: url(inside.jpg);
     
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    font-size: 24px;
    height:100vh;
">

    <?php

    session_start();

    require "db.php";

    $pnr = $_POST["cancpnr"];
    $uid = $_SESSION["id"];

    $sql = "UPDATE resv SET status ='CANCELLED' WHERE resv.pnr='" . $pnr . "' AND resv.id='" . $uid . "' ";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='message'>Cancellation Successful!!!</div>";
    } else {
        echo "<div class='message'>Error: " . $conn->error . "</div>";
    }

    echo "<br><br><a href=\"http://localhost/railway/index.htm\" style=\"text-decoration:none; color:white\">Home Page</a><br>";

    $conn->close();
    ?>

</body>

</html>
