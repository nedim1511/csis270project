<?php
DEFINE("DB_HOST", "localhost");
DEFINE("DB_USER", "root");
DEFINE("DB_PASS", "");
DEFINE("DB_NAME", "restaurant2");

DEFINE("PASS_HASH_LEN", 224);

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or
            die("App couldn't connect to database. MySQL error: " . mysqli_connect_error());

mysqli_set_charset($dbc,"utf8");