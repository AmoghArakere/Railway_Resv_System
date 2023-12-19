<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="admin.css"> <!-- Link to the external CSS file -->
</head>
<body class="admin-login-bg">

    <div class="login-container">
        <?php 
        session_start();

        if (isset($_SESSION["admin_login"])) {
            if ($_SESSION["admin_login"] == true) {
                // ... (the rest of your code)
            }
        } else {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $userid = $_POST["uid"];
                $password = $_POST["password"];

                if ($userid == 'admin' && $password == 'admin' ) {
                    $_SESSION["admin_login"] = true;
                    header("Location: admin_login.php");
                    exit();
                } else {
                    echo "<p class='error-msg'>Incorrect username or password. Please try again.</p>";
                }
            }

            if (isset($_SESSION["admin_login"]) && $_SESSION["admin_login"] == true) {
                // ... (the rest of your code)
            } else {
                echo "
                <form action=\"admin_login.php\" method=\"post\" class='login-form'>
                    <label for=\"uid\">User ID:</label>
                    <input type=\"text\" name=\"uid\" required><br>
                    
                    <label for=\"password\">Password:</label>
                    <input type=\"password\" name=\"password\" required><br>
                    
                    <input type=\"submit\" value=\"Login\">
                </form>
                ";
            }
        }
        ?>

        <a href="index.htm" class="home-link">Home Page</a>
    </div>

</body>
</html>
