<?php
    session_start();
    if(!isset($_SESSION["a_id"]))
        redirect_to("index.php");

    require("../restaurant_config/helper.php");

    if(isset($_GET["e_id"])){
        require("../restaurant_config/mysql_connect.php");

        $employeee_id = $_GET["e_id"];
        $query = "DELETE FROM employees WHERE e_id=?";
        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "i", $employeee_id);
        if(mysqli_stmt_execute($stmt)){
            if(mysqli_stmt_affected_rows($stmt) > 0){
                $_SESSION["msg"] = "You have successfully deleted the chosen employee!";
                $_SESSION["type"] = "success";
                $_SESSION["subject"] = "Success!";
            }
            else{
                $_SESSION["msg"] = "Employee with given id doesn't exist!";
                $_SESSION["type"] = "error";
                $_SESSION["subject"] = "Employee not found!";
            }
        }
        else{
            $_SESSION["msg"] = "An error occured!";
            $_SESSION["type"] = "error";
            $_SESSION["subject"] = "Error!";
        }
        $_SESSION["msg_active"] = true;
        mysqli_stmt_free_result($stmt);
        mysqli_close($dbc);
        redirect_to("admin_panel.php");
    }
    else{
        redirect_to("admin_panel.php");
    }