<?php
function display_msg($subject ,$msg, $type){
    $output = "<script>sweetAlert(\"$subject\", \"$msg\", \"$type\")</script>";
    echo $output;
}
function display_notification(){
    if(isset($_SESSION["msg_active"]) && $_SESSION["msg_active"]){
        display_msg($_SESSION["subject"], $_SESSION["msg"], $_SESSION["type"]);
        $_SESSION["msg_active"] = false;
    }
}

function redirect_to($page){
    $header = "http://localhost/caffeteria/" . $page;
    //echo "<script>window.location.replace('$header')</script>";
    header("Location: " . $header);
    die();
}

function get_page_name(){
    return basename($_SERVER["PHP_SELF"]);
}

function validate_img($img_file){
    $allowed_img_types = array("image/gif", "image/jpeg", "image/png");
    $file_info = finfo_open(FILEINFO_MIME_TYPE);
    $detected_type = finfo_file($file_info, $img_file["tmp_name"]);
    finfo_close($file_info);
    return in_array($detected_type, $allowed_img_types);
}

function generate_random_img_name($img_file){
    $ext = "." . pathinfo($img_file["name"], PATHINFO_EXTENSION);
    $img = substr(base_convert(time(), 10, 36) . md5(microtime()), 0, 16) . $ext;
    while(file_exists("../uploads/meals/" . $img)){
        $img = substr(base_convert(time(), 10, 36) .
               md5(microtime()), 0, 16) . $ext;
    }
    return $img;
}


function extract_name_from_email($email){
    /* EXAMPLE:
     * extract_name_from_email("mehmed.bazdar@stu.ssst.edu.ba") will return
     * Mehmed Bazdar
     *
     */
    $fname = "";
    $lname = "";
    $i = 0;
    while($i < strlen($email) && $email[$i] != '.') $fname .= $email[$i++];
    $i++; // skip the dot
    while($i < strlen($email) && $email[$i] != '@') $lname .= $email[$i++];
    $fname[0] = strtoupper($fname[0]); // capitalize first name
    $lname[0] = strtoupper($lname[0]); // capitalize last name

    return $fname . " " . $lname;
}
function name_surname_format($email){
    $firstName = false;
    $dot = false;
    for($i = 0; $i < strlen($email) && $email[$i] != '@'; $i++){
        if($email[$i] != '.' && !$firstName) $firstName = true;
        else if($email[$i] == '.') $dot = true;
        else if($email[$i] != '.' && $firstName && $dot) return true;
    }
    return false;
}
function delete_student($dbc, $s_id, $deny=false){
    $query = "DELETE FROM users WHERE" . ($deny ? " activated=0 AND" : "") . " u_id=?";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, "i", $s_id);
    if(mysqli_stmt_execute($stmt)){
        if (mysqli_stmt_affected_rows($stmt)) {
            $_SESSION["msg"] = "You have successfully " . ($deny ? " denied and " : "") . "deleted the student" .
                ($deny ? " registration request!" : "!");
            $_SESSION["type"] = "success";
            $_SESSION["subject"] = "Success!";
        }
        else{
            $_SESSION["msg"] = "Student with given id doesn't exist";
            $_SESSION["type"] = "error";
            $_SESSION["subject"] = "Student not found!";
        }
    }
    else {
        $_SESSION["msg"] = "An error occured!" . mysqli_error($dbc);
        $_SESSION["type"] = "error";
        $_SESSION["subject"] = "Error!";
    }
    $_SESSION["msg_active"] = true;
    mysqli_stmt_free_result($stmt);
}

function get_num_of_orders($dbc, $s_id=""){
    $query = "SELECT COUNT(o_id) AS num_of_orders FROM orders WHERE finished=0";
    if(!empty(trim($s_id))){
        $query = "SELECT s.owns, COUNT(o_id) AS num_of_orders FROM orders AS o
                  INNER JOIN students AS s ON s.s_id=o.student WHERE s_id=$s_id AND o.finished=0";
    }

    $r = mysqli_query($dbc, $query);
    $num_of_orders = mysqli_fetch_array($r, MYSQLI_ASSOC);
    mysqli_free_result($r);
    mysqli_close($dbc);
    return json_encode($num_of_orders);
}