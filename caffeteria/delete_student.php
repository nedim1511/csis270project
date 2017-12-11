<?php
    session_start();
    require("../restaurant_config/helper.php");
    if(!isset($_GET["s_id"])){
        redirect_to("students.php");
    }
    require("../restaurant_config/mysql_connect.php");
    delete_student($dbc, $_GET["s_id"]);
    mysqli_close($dbc);
    redirect_to("students.php");