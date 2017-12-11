<?php
    include("./includes/admin_header.inc.php");
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
        if($_FILES["food_picture"]["size"] == 0 && !$_FILES["food_picture"]["error"] == 0){
            return "You must add an image of the food!";
        }
        else if(!validate_img($_FILES["food_picture"])){
            return "The image is not of the right format!";
        }
        return true;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $food_name = false;
        $category = false;
        $img = false;

        if(($validation = validate_form()) !== true){
            display_msg("Error", $validation, "warning");
        }
        else{
            $food_name = strip_tags(trim($_POST["food_name"]));
            $category = $_POST["category"];
            $img = $_FILES["food_picture"];
            $price = floatval($_POST["price"]);
            $prep_time = intval($_POST["prep_time"]);

            require("../restaurant_config/mysql_connect.php");
            $query = "INSERT INTO meals (name, category, picture, price, prep_time) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($dbc, $query);

            $img_name = generate_random_img_name($img);
            mysqli_stmt_bind_param($stmt, "sssdi", $food_name, $category, $img_name, $price, $prep_time);

            move_uploaded_file($_FILES["food_picture"]["tmp_name"], "../../uploads/meals/$img_name");
            mysqli_stmt_execute($stmt);

            if(mysqli_stmt_affected_rows($stmt)){
                display_msg("Success","You've successfully added a new meal!", "success");
            }else{
                display_msg("Error", "An error occured. Try again!", "error");
            }

            mysqli_stmt_free_result($stmt);
            mysqli_close($dbc);

        }


    }
?>
<!-- Welcome the user!
<script type="text/javascript">
    swal("Success!", "You are successfully logged in!", "success");
</script> -->


        <div class="small_dashboard_wrapper">
            <h3>Add food</h3>
            <form class="login" id="add-food" enctype="multipart/form-data" action="add_food.php" method="post">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" placeholder="Food name" name="food_name">
                </div>
                <div class="select">
                    <label>
                        Category
                        <select name="category">
                            <option value="Breakfast">Breakfast</option>
                            <option value="Pizzas">Pizzas</option>
                            <option value="Fast food">Fast food</option>
                            <option value="Soups">Soups</option>
                            <option value="Dishes">Dishes</option>
                            <option value="Pasta">Pasta</option>
                            <option value="Salads">Salads</option>
                            <option value="Desserts">Desserts</option>
                        </select>
                    </label>
                </div>
                <div class="clear"></div>
                <div class="form-group">
                    <label>Price(BAM)</label>
                    <input type="text" placeholder="3.5" name="price">
                </div>
                <div class="form-group">
                    <label>Preparation(min)</label>
                    <input type="text" placeholder="6" name="prep_time">
                </div>
                <div class="form-group">
                    <label>Picture</label>
                    <input type="file" name="food_picture">
                </div>

                <input type="submit" value="Add">
                <div class="clear"></div>
            </form>
            <div class="clear"></div>
        </div>
    </div>
</div>
</body>
</html>