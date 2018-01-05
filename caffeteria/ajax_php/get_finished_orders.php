<?php
    session_start();
    require("../../restaurant_config/helper.php");
    if(!isset($_SESSION["e_id"]))
        redirect_to("index.php");

    require("../../restaurant_config/mysql_connect.php");
    $query = "SELECT DATE_FORMAT(o.date, \"%d.%m.%Y\") AS date, m.name, o.student, o.o_id, o.paid,
              CONCAT(s.fname, CONCAT(' ', s.lname)) AS full_name, m.price 
              FROM orders AS o
              INNER JOIN meals as m ON m.m_id=o.meal
              INNER JOIN users AS s ON s.u_id=o.student
              WHERE o.finished=1
              ORDER BY o.paid, date, full_name DESC";
    $r = mysqli_query($dbc, $query);
    $student_orders = array();
    while($row = mysqli_fetch_array($r))
        $student_orders[] = $row;
    echo mysqli_error($dbc);
    mysqli_free_result($r);
    mysqli_close($dbc);
    header('Content-Type: application/json');
    echo json_encode($student_orders);