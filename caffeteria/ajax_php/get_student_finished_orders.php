<?php
    session_start();
    require("../../restaurant_config/helper.php");
    if(!isset($_SESSION["s_id"]))
        redirect_to("index.php");

    require("../../restaurant_config/mysql_connect.php");
    $query = "SELECT DATE_FORMAT(o.date, \"%d.%m.%Y\") AS date, m.name, m.price, o.paid
              FROM orders AS o INNER JOIN meals as m ON o.meal=m.m_id
              WHERE o.student={$_SESSION["s_id"]} AND o.finished=1
              ORDER BY o.paid, o.date DESC";
    $r = mysqli_query($dbc, $query);
    $student_orders = array();
    while($row = mysqli_fetch_array($r))
        $student_orders[] = $row;

    mysqli_free_result($r);
    mysqli_close($dbc);
    header('Content-Type: application/json');
    echo json_encode($student_orders);