<?php
    session_start();


    function validate_form(){
        if(strlen($_POST["new_password"]) < 6){
            return "Password has to be at least 6 characters in length!";
        }
        else if($_POST["new_password"] != $_POST["conf_password"]){
            return "Passwords do not match!";
        }
        return true;
    }

    $table = "";
    $id_type = "";
    if(isset($_SESSION["a_id"])){
        session_abort();
        include("./includes/admin_header.inc.php");
        $table = "administrators";
        $id_type = "a_id";
    }
    else if(isset($_SESSION["s_id"])){
        session_abort();
        include("./includes/student_header.inc.php");
        $table = "students";
        $id_type = "s_id";
    }
    else if(isset($_SESSION["e_id"])){
        session_abort();
        include("./includes/employee_header.inc.php");
        $table = "employees";
        $id_type = "e_id";
    }
    else{
        require("../restaurant_config/helper.php");
        redirect_to("login.php");
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        require("../restaurant_config/mysql_connect.php");
        $curr_password = mysqli_real_escape_string($dbc, $_POST["curr_password"]);
        $pass_hash_len = PASS_HASH_LEN;

        $query = "SELECT " . $id_type . " FROM " . $table .
                " WHERE password=SHA2(\"$curr_password\",$pass_hash_len) AND " . $id_type . "={$_SESSION[$id_type]}";
        $r = mysqli_query($dbc, $query);

        if(mysqli_num_rows($r) > 0){
            if(($validation = validate_form()) !== true){
                display_msg("Warning", $validation, "warning");
            }
            else{
                $query = "UPDATE " . $table . " SET password=SHA2(?, $pass_hash_len) WHERE " . $id_type . "=?";
                $stmt = mysqli_prepare($dbc, $query);
                mysqli_stmt_bind_param($stmt, "si", $_POST["new_password"], $_SESSION[$id_type]);
                if(mysqli_stmt_execute($stmt)){
                    if(mysqli_stmt_affected_rows($stmt) > 0){
                        display_msg("Success", "You've successfully updated your password!", "success");
                    }
                }
                mysqli_stmt_free_result($stmt);
            }

        }
        else{
            display_msg("Password incorrect", "The entered current password is incorrect", "error");
        }
        mysqli_free_result($r);
        mysqli_close($dbc);
    }

?>
<div class="small_dashboard_wrapper">
    <h3>Change Password</h3>
    <form class="update-form" method="post" action="change_password.php">
        <label for="curr_password">Current Password</label>
        <input id="curr_password" type="password" name="curr_password">
        <label for="new_password">New Password</label>
        <input id="new_password" type="password" name="new_password">
        <label for="conf_password">Confirm Password</label>
        <input id="conf_password" type="password" name="conf_password">
        <input type="submit" value="Change">
    </form>

    <div class="clear"></div>
</div>
</div>
</div>
</body>
</html>
