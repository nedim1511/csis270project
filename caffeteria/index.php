<?php
    include("./includes/header.inc.php");
    include("./includes/nav.inc.php");

?>

	<main>
        <?php
            require("../restaurant_config/helper.php");
            display_notification();
            require("../restaurant_config/mysql_connect.php");

            $query = "SELECT m.picture, m.name, m.available, m.prep_time, m.price, m.m_id, COUNT(o.o_id) AS num_bought
                      FROM MEALS as m
                      INNER JOIN ORDERS AS o ON m.m_id=o.meal
                      WHERE o.finished=1
                      GROUP BY m.m_id, m.picture, m.name, m.available, m.prep_time, m.price
                      ORDER BY num_bought DESC LIMIT 5";
            $heading_info = "Best Sellers";
            if(isset($_GET["category"])){

                $category = mysqli_real_escape_string($dbc, urldecode($_GET["category"]));
                $heading_info = urldecode($_GET["category"]);
                $query = "SELECT m_id, picture, name, price, prep_time, available 
                          FROM meals WHERE category='$category'";
            }
            if(isset($_GET["meal"])){
                $meal = mysqli_real_escape_string($dbc, urldecode($_GET["meal"]));
                $heading_info = "Results for: " .  urldecode($_GET["meal"]);
                $query = "SELECT m_id, picture, name, price, prep_time, available
                          FROM meals 
                          WHERE UPPER(name) LIKE UPPER(\"%{$_GET["meal"]}%\") OR 
                                UPPER(category) LIKE UPPER(\"%{$_GET["meal"]}%\")";
            }
            $r = mysqli_query($dbc, $query);
            if(mysqli_num_rows($r) > 0){
                echo "<h2>$heading_info</h2>";
                echo "<div class=\"food\">";
                echo "<ul>";
                while($row = mysqli_fetch_array($r)){
                    echo "<li>";
                    echo "<img src=\"image.php?img={$row["picture"]}\" alt='{$row["name"]}'>";
                    echo "<p class='meal_details " . (!$row["available"] ? "not_available'>" : "'>");
                    echo "<strong>{$row["prep_time"]} min</strong><br><br>";
                    echo "<strong>{$row["price"]} KM</strong><br><br>";
                    if(isset($_SESSION["a_id"]) || isset($_SESSION["e_id"])) {
                        echo "<a href=\"edit_food.php?m_id={$row["m_id"]}\">Edit</a> ";
                        if(isset($_SESSION["a_id"]))
                            echo "<a href=\"delete_food.php?m_id={$row["m_id"]}\">Delete</a>";
                    }
                    else {
                        if($row["available"])
                            echo "<a href=\"order.php?m_id={$row["m_id"]}\">ORDER</a>";
                        else
                            echo "<span>Not available</span>";
                    }
                    echo "</p><span>{$row["name"]}</span></li>";
                }
                echo "</ul>";
                echo "</div>";
            }

            if(!isset($_SESSION["fname"])) {
                echo "<h3>Order your meal now:</h3>";
                echo "<a class=\"register\" href=\"register.php\">Register Now</a>";
                echo "<a class=\"login\" href=\"login.php\">Login</a>";
            }
        ?>
	</main>

	<!-- Footer -->
    <footer>
        <span class="left">SSST Food Court</span>
        <span class="right">&copy; Copyright 2017</span>
    </footer>

</body>
</html>
