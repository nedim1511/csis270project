<?php
    session_start();
    require("../../restaurant_config/helper.php");
    if(!isset($_SESSION["e_id"]) && !isset($_SESSION["a_id"]))
        redirect_to("index.php");

    require("../../restaurant_config/mysql_connect.php");

    // this query is simpler because it uses a stored derived attribute that is updated through the triggers
    $query = "SELECT owns, CONCAT(fname, CONCAT(' ', lname)) AS full_name FROM students
              WHERE owns > 0
              ORDER BY owns DESC";

    // this query is a bit more complicated because we have to always calculate the derived attribute
    // we went with the first option because it simplifies our other queries
    /*$query = "SELECT SUM(o.price) AS owns, CONCAT(s.fname, CONCAT(\" \", s.lname)) AS full_name
              FROM orders_history AS o
              INNER JOIN students AS s ON s.s_id=o.student WHERE owns > 0 GROUP BY s.s_id";*/
    $r = mysqli_query($dbc, $query);

    $students = array();
    while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
        $students[] = $row;
    }

    mysqli_free_result($r);
    mysqli_close($dbc);

    echo json_encode($students);