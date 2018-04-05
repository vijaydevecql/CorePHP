<?php
session_start();
include("../controller/orginzation.php");
$event=new org();
   $user_id=$_SESSION['user_id'];
 if($_REQUEST['id']){
 $query="update admin set status='".$_POST['status']."' where id='".$_REQUEST['id']."'";
 $queryResult  =$event->excuite($query, 'false','update');
 if( $queryResult){
	echo "1";
 }else {
	echo "0";
 }
 }