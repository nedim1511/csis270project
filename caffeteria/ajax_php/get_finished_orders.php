<?php
    session_start();
    require("../../restaurant_config/helper.php");
    if(!isset($_SESSION["e_id"]))
        redirect_to("index.php");

    require("../../restaurant_config/mysql_connect.php");
    $query = "SELECT DATE_FORMAT(o.date, \"%d.%m.%Y\") AS date, o.name, o.student, o.o_id, o.paid,
              CONCAT(s.fname, CONCAT(\" \", s.lname)) AS full_name, o.price 
              FROM orders_history AS o
              INNER JOIN students AS s ON s.s_id=o.student
              ORDER BY o.paid, date, full_name DESC";
    $r = mysqli_query($dbc, $query);
    $student_orders = array();
    while($row = mysqli_fetch_array($r))
        $student_orders[] = $row;

    mysqli_free_result($r);
    mysqli_close($dbc);
    echo json_encode($student_orders);