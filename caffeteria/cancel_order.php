<?php
    session_start();
    require("../restaurant_config/helper.php");
    if(!isset($_SESSION["s_id"])){
        redirect_to("login.php");
    }
    if(isset($_GET["o_id"])){
        require("../restaurant_config/mysql_connect.php");
        $query = "DELETE FROM orders WHERE o_id=? AND student=? AND finished=0";
        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "ii", $_GET["o_id"], $_SESSION["s_id"]);

        if(mysqli_stmt_execute($stmt)){
            if(mysqli_stmt_affected_rows($stmt) > 0){
                $_SESSION["msg"] = "You've successfully canceled your order!";
                $_SESSION["type"] = "success";
                $_SESSION["subject"] = "Success";
                $_SESSION["msg_active"] = true;
            }
        }
        else{
            $_SESSION["msg"] = "An error occured!";
            $_SESSION["type"] = "error";
            $_SESSION["subject"] = "Error";
            $_SESSION["msg_active"] = true;
        }
        mysqli_stmt_free_result($stmt);
        mysqli_close($dbc);
        redirect_to("student_active_orders.php");
    }