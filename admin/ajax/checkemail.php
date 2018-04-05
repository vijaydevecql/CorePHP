<?php
session_start();
include("../controller/orginzation.php");

$event=new org();
   $user_id=$_SESSION['user_id'];
 if($_REQUEST['email']){
 
 $query="select * from cr_users where email='".$_REQUEST['email']."'";
 $queryResult  =$event->excuite($query, 'false','select');
 if( $queryResult!=null){
 
 echo "1";
 }else {
 
  echo "0";
 }
 
 
 }
   
   
   
   
   
   
   
  
   ?>