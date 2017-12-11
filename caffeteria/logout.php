<?php
    session_start();
    require("../restaurant_config/helper.php");
    if(!isset($_SESSION["s_id"]) &&
       !isset($_SESSION["a_id"]) &&
       !isset($_SESSION["e_id"])) redirect_to("login.php");

    $_SESSION = array();
    session_destroy();
    setcookie(session_name(), "", time() - 3600);
    redirect_to("login.php");

