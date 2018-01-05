<?php
    session_start();
    require("../../restaurant_config/helper.php");
    if(!$_SESSION["a_id"])
        redirect_to("index.php");

    require("../../restaurant_config/mysql_connect.php");

    $query = "SELECT CONCAT(MONTHNAME(date), CONCAT(\" \", YEAR(date))) AS monthyear, 
              MONTHNAME(date) AS month, SUM(m.price) AS revenue 
              FROM orders as o INNER JOIN meals as m ON o.meal=m.m_id
              WHERE o.finished=1
              GROUP BY month 
              ORDER BY o.date DESC LIMIT 12;";

    $r = mysqli_query($dbc, $query);

    $month_details = array();

    while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
        $month_details[] = $row;

    mysqli_free_result($r);
    mysqli_close($dbc);
    header('Content-Type: application/json');
    echo json_encode($month_details);