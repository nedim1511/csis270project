<?php
    include("./includes/admin_header.inc.php");


    function validate_form(){
        if(empty($_POST["salary"])){
            return "The salary cannot be empty!";
        }
        else if(!is_numeric($_POST["salary"])){
            return "The salary has to be in a numeric format!";
        }
        return true;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(($validation = validate_form()) !== true){
            $_SESSION["msg"] = $validation;
            $_SESSION["type"] = "warning";
            $_SESSION["subject"] = "Warning!";
            $_SESSION["msg_active"] = true;
            redirect_to("admin_panel.php");
        }
        else {
            require("../restaurant_config/mysql_connect.php");
            $query = "UPDATE employees SET salary=? WHERE e_id=?";
            $stmt = mysqli_prepare($dbc, $query);
            mysqli_stmt_bind_param($stmt, "di", $_POST["salary"], $_POST["e_id"]);
            if(mysqli_stmt_execute($stmt)){
                if(mysqli_stmt_affected_rows($stmt) > 0){
                    $_SESSION["msg"] = "You have successfully updated the employee's salary!";
                    $_SESSION["type"] = "success";
                    $_SESSION["subject"] = "Success!";
                }
            }
            else{
                $_SESSION["msg"] = "An error occurred!";
                $_SESSION["type"] = "error";
                $_SESSION["subject"] = "Error!";
            }
            $_SESSION["msg_active"] = true;
            mysqli_stmt_free_result($stmt);
            redirect_to("admin_panel.php");
        }
    }
?>

<div class="small_dashboard_wrapper">
    <h3>Employee info</h3>
    <form class="update-form" action="edit_salary_employee.php" method="post">
        <?php
            if($_SERVER["REQUEST_METHOD"] == "GET") {
                if (!isset($_GET["e_id"]))
                    redirect_to("admin_panel.php");
                require("../restaurant_config/mysql_connect.php");
                $id = mysqli_real_escape_string($dbc, $_GET["e_id"]);
                $query = "SELECT salary FROM employees WHERE e_id=$id";
                $r = mysqli_query($dbc, $query);

                if (mysqli_num_rows($r) > 0) {
                    $salary = mysqli_fetch_array($r, MYSQLI_ASSOC)["salary"];
                    echo "<label>Salary</label>";
                    echo "<input name='salary' type='text' value=\"$salary\">";
                    echo "<input name='e_id' type='hidden' value=\"{$_GET["e_id"]}\">";
                    echo "<input type='submit' value='Change'>";
                } else {
                    redirect_to("admin_panel.php");
                }
            }
        ?>
    </form>
</div>
</div>
</div>
</body>
</html>
