<?php
session_start();
include("../controller/orginzation.php");
include("../include/connection.php");
$event=new org();
   $user_id=$_SESSION['user_id'];
 if($_REQUEST['email']){
 
 $conn="select * from cr_users where email='".$_REQUEST['email']."'";
 $ab  =$event->excuite($conn, 'false','select');
 if( $ab!=null){
 
 echo "1";
 }else {
 
  echo "0";
 }
 
 
 }
   ?>