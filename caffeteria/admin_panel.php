<?php
    include("./includes/admin_header.inc.php");
    require("../restaurant_config/mysql_connect.php");

    if($_SESSION["first_login"]){
        display_msg("Success", "You've successfully logged in!", "success");
        $_SESSION["first_login"] = false;
    }
    display_notification();

?>
        <div class="small_dashboard_wrapper">
            <h3>Employees</h3>
            <?php
                $query = "SELECT e_id, fname, lname FROM employees";
                $r = mysqli_query($dbc, $query);

                while($row = mysqli_fetch_array($r)){
                    echo "<div class='employee-box'>";
                    echo "<a href=\"employee.php?e_id={$row["e_id"]}\">{$row["fname"]} {$row["lname"][0]}.</a>";
                    echo "</div>";
                }
                mysqli_free_result($r);
                mysqli_close($dbc);
            ?>

            <div class="clear"></div>
        </div>
    </div>
</div>
</body>
</html>