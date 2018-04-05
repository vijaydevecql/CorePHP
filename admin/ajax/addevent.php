<?php

session_start();

$user_id=$_SESSION['user_id'];
include("../controller/event.php");
$event=new event();


$data = array(
	 'event_name'       =>$_REQUEST['event_name'],
	 'event_title'    =>$_REQUEST['event_title'], 
	 'event_owner'       => $_REQUEST['event_owner'],
	 'location'       => $_REQUEST['location'],
	 'date'       =>   $_REQUEST['date'],
	 
	 'description'       =>   $_REQUEST['description'],
	 'created'     => time(),
	 
	
	);

$img=move_uploaded_file($_FILES['event_pic']['tmp_name'],"upload/".$_FILES['event_pic']['name']);



    $data['event_pic']=BASE_HTTP_BASE_URL."upload/".$_FILES['event_pic']['name'];
	
	print_r($data);
$data3=	$event->addevent($data);
	
 	


if($data3!=0)
{
	echo "1";
}
else 
{
	echo "0";
}














 ?>
