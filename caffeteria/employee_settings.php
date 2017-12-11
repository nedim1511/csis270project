<?php
    include("./includes/employee_header.inc.php");

    require("../restaurant_config/mysql_connect.php");
    function validate_form(){
        if(empty($_POST["email"])){
            return "The email field cannot be empty!";
        }
        else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            return "The email has to be of a valid format!";
        }
        return true;
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(($validation = validate_form()) !== true){
            display_msg("Error", $validation, "error");
        }
        else{
            $email = strip_tags(trim($_POST["email"]));
            $phone = strip_tags(trim($_POST["phone"]));
            $fname = false;
            $lname = false;
            list($fname, $lname) = explode(" ", extract_name_from_email($email));
            $e_id = $_SESSION["e_id"];
            $query = "UPDATE employees SET email=?, fname=?, lname=?, phone=? WHERE e_id=?";
            $stmt = mysqli_prepare($dbc, $query);
            mysqli_stmt_bind_param($stmt, "ssssi", $email, $fname, $lname, $phone, $e_id);

            if(mysqli_stmt_execute($stmt)) {
                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    $_SESSION["fname"] = $fname;
                    $_SESSION["lname"] = $lname;
                    $_SESSION["msg"] = "You've successfully updated your info!";
                    $_SESSION["type"] = "success";
                    $_SESSION["subject"] = "Succesfully edited!";
                }
            }
            else{
                $_SESSION["msg"] = "An error occured!";
                $_SESSION["type"] = "error";
                $_SESSION["subject"] = "Error!";
            }
            $_SESSION["msg_active"] = true;
            mysqli_stmt_free_result($stmt);
            redirect_to("employee_panel.php");
        }
    }

?>
<div class="small_dashboard_wrapper">
    <h3>Settings</h3>
    <form method="post" action="employee_settings.php">
    <?php
        $query = "SELECT phone, email, salary FROM employees WHERE e_id={$_SESSION["e_id"]}";
        $r = mysqli_query($dbc, $query);

        $employee = mysqli_fetch_array($r, MYSQLI_ASSOC);

        echo "<div class='field'><label class='label'>Email: </label>";
        echo "<input class='input' type='email' name='email' value=\"{$employee["email"]}\"></div>";
        echo "<div class='field'><label class='label'>Phone number: </label>";
        echo "<input class='input' type='text' name='phone' value=\"{$employee["phone"]}\"></div>";
        echo "<div class='field'><label class='label'>Salary: </label>";
        echo "<input class='input' disabled type='text' name='phone' value=\"{$employee["salary"]} KM\"></div>";
        mysqli_free_result($r);
        mysqli_close($dbc);

    ?>

        <input type="submit" class="login" value="Save">
    </form>
</div>
</div>
</div>
</body>
</html>