<?php

session_start();

$user_id=$_SESSION['user_id'];
include("../controller/event.php");
$event=new event();




  
		$data=array(
		'event_name'=>$_REQUEST['event_name'],
		'event_title'=>$_REQUEST['event_des'],
		'location'=>$_REQUEST['location'],
		'date'=>$_REQUEST['event_date'],
		'id' =>$_REQUEST['id'],
		);
		
		if(move_uploaded_file($_FILES['image']['tmp_name'],"upload/".$_FILES['image']['name'])){
		$data['event_pic']=BASE_HTTP_BASE_URL."upload/".$_FILES['image']['name'];
		}
		else {
		$data['event_pic']="";
		}
		$add=$event->updatevent($data);
        








 ?>
