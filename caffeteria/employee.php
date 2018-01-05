<?php
    include("./includes/admin_header.inc.php");

    if(!isset($_GET["e_id"]))
        redirect_to("admin_panel.php");
?>

<div class="small_dashboard_wrapper">
    <h3>Employee info</h3>

<?php
    require("../restaurant_config/mysql_connect.php");
    $id = mysqli_real_escape_string($dbc, $_GET["e_id"]);
    $query = "SELECT fname, lname, email, salary, phone, IFNULL(phone, 'No number') as phone 
              FROM employees, users WHERE e_id=u_id AND e_id=$id";
    $r = mysqli_query($dbc, $query);
    if(mysqli_num_rows($r) > 0){
        $employee = mysqli_fetch_array($r, MYSQLI_ASSOC);
        echo "<h1 id='employee_name'>{$employee["fname"]} {$employee["lname"]}</h1>";
        echo "<h2>Employee email: {$employee["email"]}</h2>";
        echo "<h2>Employee salary: {$employee["salary"]} KM</h2>";
        echo "<h2>Employee phone: {$employee["phone"]}</h2>";
        echo "<a class='delete-link' href=\"delete_employee.php?e_id=$id\">Delete Employee</a> ";
        echo "<a class='finished-link' href=\"edit_salary_employee.php?e_id=$id\">Edit salary</a>";
    }
    else{
        $_SESSION["type"] = "error";
        $_SESSION["msg"] = "Employee with that id doesn't exist!";
        $_SESSION["subject"] = "Employee not found!";
        $_SESSION["msg_active"] = true;
        redirect_to("admin_panel.php");
    }
    mysqli_free_result($r);
    mysqli_close($dbc);
?>
</div>
</div>
</div>
</body>
</html>
