<?php
    include("./includes/header.inc.php");
    require("../restaurant_config/helper.php");

    if(!isset($_SESSION["s_id"])){
        redirect_to("login.php");
    }
    require("../restaurant_config/mysql_connect.php");
    function validate_form(){
        if(empty(trim($_POST["time"]))){
            return "You must give a time for your food to be prepared!";
        }
        if(!preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/", trim($_POST["time"]))){
            return "Time has to be in the correct format! HH:MM";
        }
        return true;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(($validation = validate_form()) !== true){
            $_SESSION["msg_active"] = true;
            $_SESSION["msg"] = $validation;
            $_SESSION["subject"] = "Error";
            $_SESSION["type"] = "error";
            redirect_to("order.php", "m_id", $_POST["m_id"]);
        }
        else{
            $time = trim($_POST["time"]);
            $note = strip_tags(trim($_POST["note"]));
            $m_id = $_POST["m_id"];

            $query = "INSERT INTO orders(student, meal, comment, time) VALUES(?, ?, ?, ?)";
            $stmt = mysqli_prepare($dbc, $query);
            mysqli_stmt_bind_param($stmt, "iiss", $_SESSION["s_id"], $m_id, $note, $time);

            if(mysqli_stmt_execute($stmt)){
                if(mysqli_stmt_affected_rows($stmt) > 0){
                    $_SESSION["msg"] = "You've successfully ordered your meal!";
                    $_SESSION["type"] = "success";
                    $_SESSION["subject"] = "Success";
                }
            }
            else{
                $_SESSION["msg"] = "An error occured!";
                $_SESSION["type"] = "error";
                $_SESSION["subject"] = "Error";
            }
            $_SESSION["msg_active"] = true;
            mysqli_stmt_free_result($stmt);
            mysqli_close($dbc);
            redirect_to("index.php");
        }
    }
    display_notification();
    if(isset($_GET["m_id"])){
        $id = mysqli_real_escape_string($dbc, $_GET["m_id"]);
        $query = "SELECT name, available, picture FROM meals WHERE m_id=$id";
        $r = mysqli_query($dbc, $query);
        if(mysqli_num_rows($r) > 0){
            $meal = mysqli_fetch_array($r, MYSQLI_ASSOC);
            if(!$meal["available"]){
                $_SESSION["msg"] = "The meal is not available right now!";
                $_SESSION["subject"] = "Meal not available!";
                $_SESSION["type"] = "warning";
                $_SESSION["msg_active"] = true;
                redirect_to("index.php");
            }
            echo "<nav><p><em>{$meal["name"]}</em></p></nav>";
            echo "<main><div class='center'>";
            echo "<img class='order-img' src=\"image.php?img={$meal["picture"]}\">";
            echo "<h3>Order your meal now:</h3>";
            echo "<form id='order' action='order.php' method='post'>";
            echo "<p class='note'>Note:</p>";
            echo "<input type='text' name='note'>";
            echo "<br>";
            echo "<p class='note'>Time:</p>";
            echo "<input type='text' id='time' placeholder='Time' name='time'>";
            echo "<input type='hidden' name='m_id' value=\"$id\">";
            echo "<br><br><br>";
            echo "<input type='submit' value='Order'></form>";
        }
        mysqli_free_result($r);
        mysqli_close($dbc);
    }

?>
			<div class="clear"></div>
			</div>
	</main>

	<!-- Footer -->

	<footer>
		<span class="left">SSST Food Court</span>
		<span class="right">&copy; Copyright 2017</span>
	</footer>
    <script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
    <script>
        var timepicker = new TimePicker("time", {
            theme: 'dark', // or 'blue-grey'
            lang: 'en' // 'en', 'pt' for now
        });
        timepicker.on('change', function(evt){
            var hours = evt.hour;
            if(evt.hour < 10) hours = '0' + hours;
            var value = (hours || '00') + ':' + (evt.minute || '00');
            evt.element.value = value;
        });
    </script>
</body>
</html>
