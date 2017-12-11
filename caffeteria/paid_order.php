<?php
    session_start();
    require("../restaurant_config/helper.php");
    if(!isset($_SESSION["e_id"]))
        redirect_to("index.php");

    if(isset($_GET["s_id"]) && isset($_GET["o_id"])){
        echo "we're here";
        require("../restaurant_config/mysql_connect.php");
        $query = "UPDATE orders_history SET paid=1 WHERE orders_history.student=? AND o_id=? AND paid=0";
        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "ii", $_GET["s_id"], $_GET["o_id"]);
        if(mysqli_stmt_execute($stmt)){
            if(mysqli_stmt_affected_rows($stmt) > 0){
                $_SESSION["msg"] = "You've successfully updated the student debt!";
                $_SESSION["type"] = "info";
                $_SESSION["subject"] = "Success!";
            }
            else{
                $_SESSION["msg"] = "An error occurred!";
                $_SESSION["type"] = "error";
                $_SESSION["subject"] = "Error!";
            }
        }
        else{
            $_SESSION["msg"] = "An error occurred!";
            $_SESSION["type"] = "error";
            $_SESSION["subject"] = "Error!";
        }
        echo mysqli_error($dbc);
        $_SESSION["msg_active"] = true;
        mysqli_stmt_free_result($stmt);
        mysqli_close($dbc);
    }
    redirect_to("employee_finished_orders.php");
