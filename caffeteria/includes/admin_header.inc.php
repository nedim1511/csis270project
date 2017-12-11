<?php
    session_start();
    require("../restaurant_config/helper.php");
    if(!isset($_SESSION["a_id"])){
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
<!-- Welcome the user!
<script type="text/javascript">
    swal("Success!", "You are successfully logged in!", "success");
</script> -->
<div class="main_wrapper">
        <div class="dashboard_sidebar">
            <a href="index.php"><img src="images/logo.svg" alt="Logo"></a>
            <h2>Food Court</h2>
            <ul>
                <li <?php if(get_page_name() == "admin_panel.php") echo "class=\"active\""; ?>>
                    <a href="admin_panel.php">Dashboard</a>
                </li>
                <li <?php if(get_page_name() == "add_food.php") echo "class=\"active\""; ?>>
                    <a href="add_food.php">Add new food</a>
                </li>
                <li <?php if(get_page_name() == "add_employee.php") echo "class=\"active\""; ?>>
                    <a href="add_employee.php">Add new employee</a>
                </li>
                <li <?php if(get_page_name() == "students.php") echo "class=\"active\""; ?>>
                    <a href="students.php">Students</a>
                </li>
                <li <?php if(get_page_name() == "approve_student.php") echo "class=\"active\""; ?>>
                    <a href="approve_student.php">Student requests</a>
                </li>
                <li <?php if(get_page_name() == "admin_statistics.php") echo "class=\"active\""; ?>>
                    <a href="admin_statistics.php">Statistics</a>
                </li>
                <li>
                    <a href="logout.php">Log out</a>
                </li>
            </ul>
        </div>
    <div class="dashboard_content">
        <div class="topbar">
            <ul>
                <li><a href="change_password.php">Change password</a></li>
                <li class="logout"><a href="logout.php">Log out</a></li>
            </ul>
        </div>