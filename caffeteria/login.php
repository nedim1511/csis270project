<?php
    include("./includes/header.inc.php");

    function user_exists($table_name, $email, $password, $dbc){
        $id = $table_name[0] . "_id";
        $query = "SELECT $id";
        if($table_name == "students") $query .= ",activated";
        $query .= ",fname, lname FROM $table_name WHERE email='$email' AND password=SHA2('$password', 224)";
        $r = mysqli_query($dbc, $query);
        if(mysqli_num_rows($r) > 0) {
            $res = mysqli_fetch_array($r);
            mysqli_free_result($r);
            return $res;
        }
        return false;
    }
    require("../restaurant_config/helper.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        require("../restaurant_config/mysql_connect.php");
        $email = mysqli_real_escape_string($dbc, strip_tags($_POST["email"]));
        $password = mysqli_real_escape_string($dbc, $_POST["password"]);

        if($res = user_exists("students", $email, $password, $dbc)){
            if(!$res["activated"]){
                display_msg("Error", "You must wait until the admin activates your account",
                    "error");
            }
            else {
                $_SESSION["s_id"] = $res["s_id"];
                $_SESSION["first_login"] = true;
                $_SESSION["fname"] = $res["fname"];
                $_SESSION["lname"] = $res["lname"];
                redirect_to("student_panel.php");
            }
        }
        else if($res = user_exists("employees", $email, $password, $dbc)){
            $_SESSION["e_id"] = $res["e_id"];
            $_SESSION["first_login"] = true;
            $_SESSION["fname"] = $res["fname"];
            $_SESSION["lname"] = $res["lname"];
            redirect_to("employee_panel.php");
        }
        else if($res = user_exists("administrators", $email, $password, $dbc)){
            $_SESSION["a_id"] = $res["a_id"];
            $_SESSION["first_login"] = true;
            $_SESSION["fname"] = $res["fname"];
            $_SESSION["lname"] = $res["lname"];
            redirect_to("admin_panel.php");
        }
        else{
            display_msg("Error", "Email/Password combination invalid!", "error");
        }
    }
    else if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_SESSION["s_id"])) redirect_to("student_panel.php");
        else if(isset($_SESSION["e_id"])) redirect_to("employee_panel.php");
        else if(isset($_SESSION["a_id"])) redirect_to("admin_panel.php");
    }

?>
	<main>
        <h2>Log into your account</h2>
        <form class="login" method="post" action="login.php">
            <input type="email" placeholder="Email address" id="email" name="email"/>
            <input type="password" placeholder="Password" id="password" name="password"/>
            <input type="submit" value="Log in">
        </form>
	</main>

	<footer>
		<span class="left">SSST Food Court</span>
		<span class="right">&copy; Copyright 2017</span>
	</footer>

</body>
</html>