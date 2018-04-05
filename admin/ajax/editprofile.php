<?php

error_reporting(E_ALL);
session_start();

$user_id = $_SESSION['admin_id'];
include("../include/function.php");
$c = new function_class();

if ($_REQUEST['name']) {

    $file = $_FILES['pic']['name'];

    $img = move_uploaded_file($_FILES['pic']['tmp_name'], "upload/" . $file);

    if (!is_writeable("upload/" . $_FILES['pic']['name'])) {
        die("Cannot write to destination file");
    }

    $file1 = BASE_HTTP_BASE_URL . "upload/" . $file;
    $_SESSION['profile_pic']=$file1;
    $_SESSION['name']=$_REQUEST['name'];
     $data2 = "update admin set name ='" . $_REQUEST['name'] . "',profile_pic='$file1' where id=$user_id";

    $data3 = $c->excuite($data2, 'false', 'update');
    if ($data3) {
        echo "1";
    } else {
        echo "0";
    }
}
?>
