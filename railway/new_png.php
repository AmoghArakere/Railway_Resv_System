<html>
<body style="background-image: url(trainnnnnn.webp);
    height: 100%; 
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
     
">

<?php 
session_start();
require "db.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);


$pname = isset($_POST["pname"]) ? $_POST["pname"] : array();
$page = isset($_POST["page"]) ? $_POST["page"] : array();
$pgender = isset($_POST["pgender"]) ? $_POST["pgender"] : array();

$tno = $_SESSION["tno"];
$doj = $_SESSION["doj"];
$sp = $_SESSION["sp"];
$dp = $_SESSION["dp"];
$class = $_SESSION["class"];

$query = "SELECT fare FROM classseats WHERE trainno='".$tno."' AND class='".$class."' AND doj='".$doj."' AND sp='".$sp."' AND dp='".$dp."'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

$row = mysqli_fetch_array($result);
$fare = $row[0];

$tempfare = 0;
$temp = 0;

for ($i = 0; $i < count($page); $i++) {
    if ($page[$i] >= 18) {
        $temp++;
        $tempfare += $fare;
    } elseif ($page[$i] < 18 || $page[$i] >= 60) {
        $tempfare += 0.5 * $fare;
    }
}

if ($temp == 0) {
    echo "<br><br>At least one adult must accompany!!!";
    echo "<br><br><a href=\"http://localhost/railway/enquiry.php\">Back to Enquiry</a> <br>";
    die();
}

echo "Total fare is Rs.".$tempfare."/-";
$sql = "INSERT INTO resv (id, trainno, sp, dp, doj, tfare, class, nos, status)
        VALUES ('".$_SESSION["id"]."','".$_SESSION["tno"]."','".$_SESSION["sp"]."','".$_SESSION["dp"]."','".$_SESSION["doj"]."','".$tempfare."','".$_SESSION["class"]."','".count($page)."','BOOKED')";

echo "<br><br>======";

if ($conn->query($sql) === TRUE) {
    echo "<br><br>Reservation Successful";
} else {
    echo "<br><br>Booking Not Possible: " . $conn->error;
    die();
}

$tid = $_SESSION["id"];
$ttno = $_SESSION["tno"];
$tdoj = $_SESSION["doj"];

$query = "SELECT pnr FROM resv WHERE id='".$tid."' AND trainno='".$ttno."' AND doj='".$tdoj."'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

$row = mysqli_fetch_array($result);
$rpnr = $row['pnr'];

for ($i = 0; $i < count($pname); $i++) {
    $sql = "INSERT INTO pd(pnr, pname, page, pgender) VALUES ('".$rpnr."','".$pname[$i]."','".$page[$i]."','".$pgender[$i]."')";

    if ($conn->query($sql) === TRUE) {
        echo "<br><br>Passenger details added!!";
    } else {
        echo "<br><br>Booking Not Possible: " . $conn->error;
        die();
    }
}

echo "<br><br><a href=\"http://localhost/railway/index.htm\" style=\"text-decoration: none\">Back to Home</a> <br>";

$conn->close(); 
?>

</body>
</html>
