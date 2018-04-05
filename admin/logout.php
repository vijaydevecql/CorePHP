<?php
session_start();
error_reporting(0);
unset($_SESSION['admin_id']);
if($_SESSION['admin_id']==''){
header("location:index.php");

}
 ?>