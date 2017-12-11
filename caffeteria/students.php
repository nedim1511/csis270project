<?php
    include("./includes/admin_header.inc.php");
    require("../restaurant_config/mysql_connect.php");

    display_notification();
?>

<div class="small_dashboard_wrapper">
    <h3>Students</h3>
    <table class="pure-table" id="student-hold">
        <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Ows</th>
            <th>Delete</th>
        </tr>
        </thead>

        <tbody>
        <?php
        $query = "SELECT s_id, fname, lname, email, owns FROM students WHERE activated=1 ORDER BY owns DESC";
        $r = mysqli_query($dbc, $query);

        while($row = mysqli_fetch_array($r)){
            echo "<tr class='pure-table-odd'>";
            echo "<td>" . $row["fname"] . "</td>";
            echo "<td>" . $row["lname"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["owns"] . " KM</td>";
            echo "<td><a style='background: red;' href=\"delete_student.php?s_id={$row["s_id"]}\">Delete</a></td>";
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
