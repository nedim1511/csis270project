<?php
    include("./includes/admin_header.inc.php");
    require("../restaurant_config/mysql_connect.php");

    display_notification();

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET["s_id"])){
            $id = $_GET["s_id"];
            $query = "UPDATE students SET activated=1 WHERE s_id=?";
            $stmt = mysqli_prepare($dbc, $query);
            mysqli_stmt_bind_param($stmt, "i", $id);
            if(mysqli_stmt_execute($stmt)){
                if(mysqli_stmt_affected_rows($stmt) > 0){
                    display_msg("Success", "You've succesfully approved the chosen student!", "success");
                }
                else{
                    display_msg("Error", "Student with that id doesn't exist", "error");
                }
            }
            else{
                display_msg("Error", "An error occured!", "error");
            }
            mysqli_stmt_free_result($stmt);
        }
    }

?>
<div class="small_dashboard_wrapper">
    <h3>Students on registration hold</h3>
    <table class="pure-table" id="student-hold">
        <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Accept</th>
            <th>Deny</th>
        </tr>
        </thead>

        <tbody>
        <?php
            $query = "SELECT s_id, fname, lname, email FROM students WHERE activated=0";
            $r = mysqli_query($dbc, $query);

            while($row = mysqli_fetch_array($r)){
                echo "<tr class='pure-table-odd'>";
                echo "<td>" . $row["fname"] . "</td>";
                echo "<td>" . $row["lname"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td><a href=\"approve_student.php?s_id={$row["s_id"]}\">Accept</a></td>";
                echo "<td><a href=\"deny_student.php?s_id={$row["s_id"]}\">Deny</a></td>";
                echo "</tr>";
            }
            mysqli_free_result($r);
            mysqli_close($dbc);
        ?>
        </tbody>
    </table>
</div>
</div>
</div>
</body>
</html>
