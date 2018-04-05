<?php
session_start();
include("../controller/orginzation.php");
$event=new org();
   $user_id=$_SESSION['user_id'];
 if($_REQUEST['book_id']){
 $query="update books set featured='".$_POST['val']."' where id='".$_REQUEST['book_id']."'";
 $queryResult  =$event->excuite($query, 'false','update');
 if( $queryResult){
	echo "1";
 }else {
	echo "0";
 }
 }