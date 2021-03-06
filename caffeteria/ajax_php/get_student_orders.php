<?php
    session_start();
    require("../../restaurant_config/helper.php");
    if(!isset($_SESSION["e_id"]))
        redirect_to("index.php");

    require("../../restaurant_config/mysql_connect.php");
    $query = "SELECT o.time, o.o_id, m.name, o.comment, m.price, CONCAT(s.fname, CONCAT(\" \", s.lname)) AS full_name
              FROM orders AS o 
              INNER JOIN meals AS m ON o.meal=m.m_id 
              INNER JOIN users AS s ON o.student=s.u_id
              WHERE o.finished=0
              ORDER BY o.time, full_name";
    $r = mysqli_query($dbc, $query);
    $student_orders = array();
    while($row = mysqli_fetch_array($r))
        $student_orders[] = $row;

    mysqli_free_result($r);
    mysqli_close($dbc);
    header('Content-Type: application/json');
    echo json_encode($student_orders);