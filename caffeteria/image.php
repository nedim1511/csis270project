<?php
    if(isset($_GET["img"])) {
        $file_extension = strtolower(substr(strrchr($_GET["img"],"."),1));
        $ctype = "";
        switch($file_extension) {
            case "gif":
                $ctype="image/gif";
                break;
            case "png":
                $ctype="image/png";
                break;
            case "jpeg":
            case "jpg":
                $ctype="image/jpeg";
                break;
        }

        header('Content-type: ' . $ctype);
        readfile("../../uploads/meals/" . $_GET["img"]);
    }