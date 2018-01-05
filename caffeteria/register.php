<?php
    include("./includes/header.inc.php");
    require("../restaurant_config/helper.php");

    function validate_form(){ // returns true if the form is valid else it returns a string as an error msg
        if(empty($_POST["email"])) {
            return "You must enter an email";
        }
        else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            return "You must enter a valid email format!";
        }
        else if(strpos($_POST["email"],"stu.ssst.edu.ba") === false){
            return "You have to be a student of SSST in order to register!";
        }
        else if(!name_surname_format($_POST["email"])){
            return "Email must be in the format name.surname@stu.ssst.edu.ba";
        }
        if(strlen($_POST["password"]) < 6) {
            return "The password has to be at least 6 characters long!";
        }
        else if($_POST["password"] != $_POST["pass_confirm"]){
            return "Passwords do not to match!";
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

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(($validation = validate_form()) !== true){
            display_msg("Registration error", $validation, "warning");
        }
        else{
            require("../restaurant_config/mysql_connect.php");

            $email = mysqli_real_escape_string($dbc, trim($_POST["email"]));
            $password = $_POST["password"];
            $first_name = false; $last_name = false;
            list($first_name, $last_name) = explode(" ", extract_name_from_email($email));

            if(!email_registered($email, $dbc)) { // check if the student with the inputed mail is already registered
                $pass_hash_len = PASS_HASH_LEN;
                $query = "INSERT INTO users (fname, lname, email, password, type, activated) 
                          VALUES(?, ?, ?, SHA2(?, $pass_hash_len), 'STUDENT', 0)";
                $stmt = mysqli_prepare($dbc, $query);
                mysqli_stmt_bind_param($stmt, "ssss", $first_name, $last_name, $email, $password);
                mysqli_stmt_execute($stmt);

                if (mysqli_stmt_affected_rows($stmt) == 1) {
                    display_msg("Success",
                        "You've succesfully registered. Please wait for your account to be accepted",
                        "success");
                } else {
                    display_msg("Error", "You couldn't be registered! Please try again!", "warning");
                    //echo mysqli_stmt_error($stmt);
                }
            }
            else{
                display_msg("Error", "User with that email is already registered!", "warning");
            }

        }
    }
    else if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_SESSION["s_id"])) redirect_to("student_panel.php");
        else if(isset($_SESSION["e_id"])) redirect_to("employee_panel.php");
        else if(isset($_SESSION["a_id"])) redirect_to("admin_panel.php");
    }
?>

	<main>
		<h2>Create your account</h2>
		<form class="login" action="register.php" method="post">
    		<input type="email" placeholder="Student email address" id="email" name="email" />
    		<input type="password" placeholder="Password" id="password" name="password" />
    		<input type="password" placeholder="Repeat password" id="password_repeat" name="pass_confirm" />
    		<input type="submit" value="Create an account">
		</form>
	</main>
	<footer>
		<span class="left">SSST Food Court</span>
		<span class="right">&copy; Copyright 2017</span>
	</footer>

</body>
</html>