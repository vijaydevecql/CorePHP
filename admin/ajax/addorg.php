<?php

session_start();

$user_id=$_SESSION['user_id'];
include("../controller/orginzation.php");
$event=new org();


$data = array(
	 'email'       =>$_REQUEST['email'],
	 'password'    =>$_REQUEST['password'], 
	 
	 'first_name'       => $_REQUEST['name'],
	 'user_type'       => 1,
	 'under_org'       => $_SESSION['user_id'],
	 'created'     => time(),
	 
	
	);
$data['password']=$event->pass($data['password']);
$img=move_uploaded_file($_FILES['pic']['tmp_name'],"upload/".$_FILES['pic']['name']);



    $data['profile_pic']=BASE_HTTP_BASE_URL."upload/".$_FILES['pic']['name'];
	
	
$data3=	$event->addorg($data);
	
 	


if($data3)
{
	echo "1";
}
else 
{
	echo "0";
}














 ?>
