<?php
    session_start();
    require("../../restaurant_config/helper.php");

    if(!isset($_SESSION["s_id"]))
        redirect_to("index.php");

    require("../../restaurant_config/mysql_connect.php");
    $query = "SELECT m.name, m.price, o.time, o.comment, o.o_id
              FROM meals AS m 
              INNER JOIN orders AS o ON m.m_id=o.meal
              WHERE o.student={$_SESSION["s_id"]} AND o.finished=0";
    $r = mysqli_query($dbc, $query);
    $student_orders = array();
    while($row = mysqli_fetch_array($r))
        $student_orders[] = $row;

    mysqli_free_result($r);
    mysqli_close($dbc);
    header('Content-Type: application/json');
    echo json_encode($student_orders);