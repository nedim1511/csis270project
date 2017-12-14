<?php
    session_start();
    require("../../restaurant_config/helper.php");
    if(!$_SESSION["a_id"])
        redirect_to("index.php");

    require("../../restaurant_config/mysql_connect.php");

    $query = "SELECT CONCAT(MONTHNAME(date), CONCAT(\" \", YEAR(date))) AS monthyear, 
              MONTHNAME(date) AS month, SUM(price) AS revenue 
              FROM orders_history 
              GROUP BY month 
              ORDER BY DATE_FORMAT(date, \"%y\"), DATE_FORMAT(date, \"%m\") DESC LIMIT 12;";

    $r = mysqli_query($dbc, $query);

    $month_details = array();

    while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
        $month_details[] = $row;

    mysqli_free_result($r);
    mysqli_close($dbc);
    header('Content-Type: application/json');
    echo json_encode($month_details);