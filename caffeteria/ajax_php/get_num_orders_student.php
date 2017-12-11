<?php
    session_start();
    require("../../restaurant_config/helper.php");
    if(!isset($_SESSION["s_id"]))
        redirect_to("index.php");
    require("../../restaurant_config/mysql_connect.php");

    echo get_num_of_orders($dbc, $_SESSION["s_id"]);