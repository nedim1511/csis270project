<?php
    session_start();
    require("../restaurant_config/helper.php");
    if(!isset($_GET["s_id"])){
        redirect_to("approve_student.php");
    }
    require("../restaurant_config/mysql_connect.php");
    delete_student($dbc, $_GET["s_id"], true);
    mysqli_close($dbc);
    redirect_to("approve_student.php");