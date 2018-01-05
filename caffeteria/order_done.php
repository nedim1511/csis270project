<?php
    session_start();
    require("../restaurant_config/helper.php");
    if(!isset($_SESSION["e_id"]))
        redirect_to("index.php");

    if(isset($_GET["o_id"])){
        require("../restaurant_config/mysql_connect.php");

        $query = "UPDATE orders SET finished=1 WHERE o_id=?";
        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "i", $_GET["o_id"]);
        if(mysqli_stmt_execute($stmt)){
            $_SESSION["msg"] = "The meal is successfully finished!";
            $_SESSION["type"] = "success";
            $_SESSION["subject"] = "Success!";
            $_SESSION["msg_active"] = true;

        }
        else{
            $_SESSION["msg"] = "An error occured!" . mysqli_error($dbc);
            $_SESSION["type"] = "error";
            $_SESSION["subject"] = "Error!";
            $_SESSION["msg_active"] = true;
        }
        mysqli_stmt_free_result($stmt);
        mysqli_close($dbc);
    }
    redirect_to("employee_active_orders.php");
