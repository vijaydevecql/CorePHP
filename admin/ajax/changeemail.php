<?php
session_start();
include("../controller/admin_login.php");
   $user_id=$_SESSION['user_id'];

$c=new login();
if($_REQUEST['cp'])
{
 $conn="select * from `admin` where id='$user_id'";

 $my =$c->excuite($conn,'false','select');


if($my['email']==$_REQUEST['cp'])
		{

		$conn12="select * from `admin` where email='".$_REQUEST['np']."' and id!=$user_id";

		$my1=$c->excuite($conn12,'false','select');
		if($my1!=0)
		{

		echo "This email is already register";
		}
		else
		{

		 $co="update `admin` set email='".$_REQUEST['np']."' where id='$user_id'";
		 $re=$c->excuite($co,'false','update');
		 echo 1;
		
		}

		}

else 
{

echo "Old Email is wrong ";

}


}







 ?>
