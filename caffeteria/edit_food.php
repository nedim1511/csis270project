<?php
session_start();

//include("./includes/admin_header.inc.php");
require("../restaurant_config/helper.php");
if(!isset($_SESSION["e_id"]) && !isset($_SESSION["a_id"]))
    redirect_to("login.php");

function validate_form(){ // returns true if the form is valid else it returns a string as an error msg
    if(empty($_POST["food_name"])) {
        return "You must enter the name of the food!";
    }
    if(!isset($_POST["category"])) {
        return "You have to give the food a category!";
    }
    if(empty($_POST["price"])){
        return "You have to enter a price for the food!";
    }
    else if(!floatval($_POST["price"]) && !is_numeric($_POST["price"])){
        return "The price has to be a number!";
    }
    if(empty($_POST["prep_time"])){
        return "You have to enter the time the food needs to be prepared!";
    }
    else if(!intval($_POST["prep_time"]) && !is_numeric($_POST["prep_time"])){
        return "The preparation time has to be an integer!";
    }
    return true;
}


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(($validation = validate_form()) !== true){
        $_SESSION["msg"] = $validation;
        $_SESSION["type"] = "warning";
        $_SESSION["subject"] = "Error";
        $_SESSION["msg_active"] = true;
        redirect_to("index.php");
    }
    else {
        require("../restaurant_config/mysql_connect.php");
        $food_name = $_POST["food_name"];
        $food_category = $_POST["category"];
        $price = $_POST["price"];
        $prep_time = $_POST["prep_time"];
        $available = isset($_POST["available"]);
        $m_id = $_POST["m_id"];
        display_msg("subject", "sisa", "error");
        $query = "UPDATE meals SET name=?, category=?, price=?, prep_time=?, available=? WHERE m_id=?";
        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "ssdiii", $food_name, $food_category,
            $price, $prep_time, $available, $m_id);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                $_SESSION["msg"] = "You've successfully update the meal info!";
                $_SESSION["type"] =  "success";
                $_SESSION["subject"] = "Success!";
            }
        } else {
            $_SESSION["msg"] = "An error occured!";
            $_SESSION["type"] = "error";
            $_SESSION["subject"] = "Error!";
        }
        $_SESSION["msg_active"] = true;
        mysqli_stmt_free_result($stmt);
        mysqli_close($dbc);
        redirect_to("index.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Importing one of the most common beautiful Google Font - Open Sans -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <!-- Importing a stylish library for a fancy JS alert. It is called SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/full_page_background.css">
</head>
<body>


<div class="small_dashboard_wrapper">
    <h3 id="edit-food-header">Edit food</h3>
    <form class="update-form" method="post" action="edit_food.php">
    <label>Name</label>
<?php
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET["m_id"])) {
            require("../restaurant_config/mysql_connect.php");

            $meal_id = mysqli_real_escape_string($dbc, $_GET["m_id"]);
            $query = "SELECT name, available, category, price, prep_time FROM meals WHERE m_id=$meal_id";
            $r = mysqli_query($dbc, $query);
            if (mysqli_num_rows($r) > 0) {
                $meal = mysqli_fetch_array($r, MYSQLI_ASSOC);

                $food_categories = array("Breakfast", "Pizzas", "Fast food", "Soups",
                    "Dishes", "Pasta", "Salads", "Desserts");

                echo "<input type='text' placeholder='Food name' name='food_name' value=\"{$meal["name"]}\">";
                echo "<label>Category</label>";
                echo "<select name='category'>";
                foreach ($food_categories as $category) {
                    if ($category == $meal["category"])
                        echo "<option value=\"$category\" selected='selected'>$category</option>";
                    else
                        echo "<option value=\"$category\">$category</option>";
                }
                echo "</select>";
                echo "<div class='clear'></div>";
                echo "<label>Price(BAM)</label>";
                echo "<input type='text' placeholder='3.5' name='price' value=\"{$meal["price"]}\">";
                echo "<label>Preparation(min)</label>";
                echo "<input type='text' placeholder='6' name='prep_time' value=\"{$meal["prep_time"]}\">";
                echo "<label>Is available</label><input name='available' type='checkbox' " .
                    ($meal["available"] ? "checked>" : ">");
                echo "<div class='clear'></div>";
                echo "<input type='hidden' value=\"$meal_id\" name='m_id'>";
                echo "<input type='submit' value='Update'>";
            } else {
                $_SESSION["msg"] = "Meal with that id doesn't exist!";
                $_SESSION["type"] = "error";
                $_SESSION["subject"] = "Not found!";
                $_SESSION["msg_active"] = true;
                redirect_to("index.php");
            }
        } else {
            redirect_to("index.php");
        }
    }
?>
    <div class='clear'></div>
    </form>
    <div class="clear"></div>
</div>
</div>
</div>
</body>
</html>
