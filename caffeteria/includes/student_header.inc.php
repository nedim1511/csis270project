<?php
    session_start();

    require("../restaurant_config/helper.php");
    if(!isset($_SESSION["s_id"])){
        redirect_to("login.php");
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Importing one of the most common beautiful Google Font - Open Sans -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Importing a stylish library for a fancy JS alert. It is called SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/full_page_background.css">
</head>
<body>
<div class="main_wrapper">
    <div class="dashboard_sidebar">
        <a href="index.php"><img src="images/logo.svg" alt="Logo"></a>
        <h2>Food Court</h2>
        <ul>
            <li <?php if(get_page_name() == "student_panel.php") echo "class=\"active\""; ?>>
                <a href="student_panel.php">Dashboard</a>
            </li>
            <li <?php if(get_page_name() == "student_active_orders.php") echo "class=\"active\""; ?>>
                <a href="student_active_orders.php">Active Orders</a>
            </li>
            <li <?php if(get_page_name() == "student_finished_orders.php") echo "class=\"active\""; ?>>
                <a href="student_finished_orders.php">Finished Orders</a>
            </li>
            <li><a href="logout.php">Log out</a></li>
        </ul>
    </div>
    <div class="dashboard_content">
        <div class="topbar">
            <ul>
                <li><a href="change_password.php">Change password</a></li>
                <li><a href="index.php">Order a meal</a></li>
                <li class="logout"><a href="logout.php">Log out</a></li>
            </ul>
        </div>