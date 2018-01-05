<?php
    include("./includes/admin_header.inc.php");

    function validate_form(){ // returns true if the form is valid else it returns a string as an error msg
        if(empty($_POST["email"])) {
            return "You must enter an email";
        }
        else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            return "You must enter a valid email format!";
        }
        else if(strpos($_POST["email"],"ssst.edu.ba") === false){
            return "The email has to be SSST based";
        }
        else if(!name_surname_format($_POST["email"])){
            return "Email must be in the format name.surname@something.something";
        }
        if(strlen($_POST["password"]) < 6) {
            return "The password has to be at least 6 characters long!";
        }
        else if($_POST["password"] != $_POST["pass_confirm"]){
            return "Passwords do not to match!";
        }
        if(empty($_POST["salary"])){
            return "You must enter the salary for the employee";
        }
        else if(!floatval($_POST["salary"]) && !is_numeric($_POST["salary"])){
            return "The salary has to be a number!";
        }
        return true;
    }

    function email_registered($email, $dbc) { // returns true if the email is registered otherwise false
        $query = "SELECT u_id FROM users WHERE email='$email'";
        $r = mysqli_query($dbc, $query);
        if(mysqli_num_rows($r) > 0){
            mysqli_free_result($r);
            return true;
        }
        return false;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (($validation = validate_form()) !== true) {
            display_msg("Registration error", $validation, "warning");
        }
        else{
            require("../restaurant_config/mysql_connect.php");

            $email = mysqli_real_escape_string($dbc, trim($_POST["email"]));
            $password = mysqli_real_escape_string($dbc, $_POST["password"]);
            $salary = floatval(mysqli_real_escape_string($dbc, $_POST["salary"]));
            $phone = mysqli_real_escape_string($dbc, $_POST["phone_number"]);
            $first_name = false;
            $last_name = false;
            list($first_name, $last_name) = explode(" ", extract_name_from_email($email));
            if(!email_registered($email, $dbc)) { // check if the employee with the inputed mail is already registered
                $pass_hash_len = PASS_HASH_LEN;
                $query = "INSERT INTO users (fname, lname, email, password, type) 
                                            VALUES(?, ?, ?, SHA2(?, $pass_hash_len), 'EMPLOYEE')";
                $stmt = mysqli_prepare($dbc, $query);
                mysqli_stmt_bind_param($stmt, "ssss", $first_name, $last_name, $email,
                    $password);
                mysqli_stmt_execute($stmt);

                $last_id = mysqli_stmt_insert_id($stmt);
                mysqli_stmt_free_result($stmt);
                $query = "UPDATE employees SET salary=?, phone=? WHERE e_id=?";
                $stmt = mysqli_prepare($dbc, $query);
                mysqli_stmt_bind_param($stmt, "dsi", $salary, $phone, $last_id);
                mysqli_stmt_execute($stmt);
                if (mysqli_stmt_affected_rows($stmt) == 1) {
                    display_msg("Success",
                        "You've succesfully registered an employee. Let him know he can access his account now!",
                        "success");
                } else {
                    display_msg("Error", "The employee couldn't be registered", "warning");
                    //echo mysqli_stmt_error($stmt);
                }
            }
            else{
                display_msg("Error", "An employee with that email is already registered!", "warning");
            }

        }
    }
?>
<!-- Welcome the user!
<script type="text/javascript">
    swal("Success!", "You are successfully logged in!", "success");
</script> -->


        <div class="small_dashboard_wrapper">
            <h3>Add employee</h3>
            <form class="update-form" method="post" action="add_employee.php">
                <label>Email:</label>
                <input type="email" name="email">
                <label>Password:</label>
                <input type="password" name="password">
                <label>Confirm:</label>
                <input type="password" name="pass_confirm">
                <label>Salary(BAM):</label>
                <input type="text" name="salary" placeholder="1400">
                <label>Phone number:</label>
                <input type="text" name="phone_number" placeholder="062-321-132">
                <input type="submit" value="Add">
                <div class="clear"></div>
            </form>
            <div class="clear"></div>
        </div>
    </div>
</div>
</body>
</html>