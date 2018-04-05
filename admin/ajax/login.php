<?php

session_start();

include("../include/function.php");

$admin = new function_class();

if (($_REQUEST['email']) && ($_REQUEST['password'])) {

    $data2 = $admin->function_login($_REQUEST['email'], $_REQUEST['password']);


    if ($data2 == null) {
        echo "0";
    } elseif($data2['status']==0) {
       echo "2";
    }else{
		 $_SESSION['admin_id'] =  $data2['id'];
		$_SESSION['admin_type'] =  $data2['admin_type'];
        $_SESSION['profile_pic']= $data2['profile_pic'];
        $_SESSION['name']= $data2['name'];
        echo "1";
	}
}
?>
