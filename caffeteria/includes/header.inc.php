<?php
    session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <title>SSST Food Court</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Import a favicon (small image in a browser tab) for our website -->
    <link rel="icon" type="image/png" href="images/favicon.png">
    <!-- Importing one of the most common beautiful Google Font - Open Sans -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css"  rel="stylesheet">
</head>
<body>
<!-- Header -->
<header>
    <div class="transparent_overlay">
        <div class="login_register">
            <?php
                if(!isset($_SESSION["fname"])) {
                    echo "<a href = \"login.php\" class=\"login\" > Log in </a >";
                    echo "<a href = \"register.php\" class=\"register\" > Create an account </a >";
                }
                else{
                    $href = (isset($_SESSION["a_id"]) ? "admin_panel.php" :
                            (isset($_SESSION["s_id"]) ? "student_panel.php" : "employee_panel.php"));
                    echo "<a href = \"$href\" class=\"login\" > Dashboard </a >";
                    echo "<a href=\"logout.php\" class=\"register\">Logout</a>";
                }
            ?>
        </div>
        <div class="logo">
            <a href="index.php">
                <!-- Logo designed by Nedim in Sketch -->
                <img src="images/logo.svg" alt="SSST Food Court" title="SSST Food Court" />
            </a>
            <h1>Food Court</h1>
            <p class="header_slogan">Say goodbye to waiting - order your meal now!</p>
        </div>
    </div>
</header>
<!-- End of Header -->
