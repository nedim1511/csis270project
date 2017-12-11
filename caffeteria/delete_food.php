<?php
    session_start();
    if(!isset($_SESSION["a_id"]))
        redirect_to("index.php");

    require("../restaurant_config/helper.php");

    if(isset($_GET["m_id"])){
        require("../restaurant_config/mysql_connect.php");

        $meal_id = mysqli_real_escape_string($dbc, $_GET["m_id"]);
        // delete the image associated with the meal to be deleted
        $query = "SELECT picture FROM meals WHERE m_id=$meal_id";
        $r = mysqli_query($dbc, $query);
        $picture = "";
        if(mysqli_num_rows($r) > 0){
            $picture = mysqli_fetch_array($r, MYSQLI_ASSOC)["picture"];
        }
        mysqli_free_result($r);

        $query = "DELETE FROM meals WHERE m_id=?";
        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "i", $meal_id);
        if(mysqli_stmt_execute($stmt)){
            if(mysqli_stmt_affected_rows($stmt) > 0){
                unlink("../../uploads/meals/" . $picture);
                $_SESSION["msg"] = "You have successfully deleted the chosen meal!";
                $_SESSION["type"] = "success";
                $_SESSION["subject"] = "Success!";
            }
            else{
                $_SESSION["msg"] = "Meal with given id doesn't exist!";
                $_SESSION["type"] = "error";
                $_SESSION["subject"] = "Meal not found!";
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
        redirect_to("index.php");
    }
    else{
        redirect_to("index.php");
    }