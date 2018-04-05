<?php
error_reporting(0);
session_start();

$user_id=$_SESSION['user_id'];
include("../include/function.php");
$c=new function_class();

if($_REQUEST['name']){
// $_REQUEST['name'];
	$eml=$_REQUEST["email"];
$file=$_FILES['pic']['name'];
$varified=$_REQUEST["verified"];
if($file)
{
$img=move_uploaded_file($_FILES['pic']['tmp_name'],"upload/".$file);

$file1=BASE_HTTP_BASE_URL."upload/".$file;

echo 	$data2="update qmash_users set first_name ='".$_REQUEST['name']."',email='$eml',profile_pic='$file1', status='$varified'   where id='".$_REQUEST['id']."'";
$data3 =$c->excuite($data2,'false','update');
}
else 
{
 echo	$data2="update qmash_users set first_name ='".$_REQUEST['name']."',email='$eml',status='$varified'   where id='".$_REQUEST['id']."'";
	$data3 =$c->excuite($data2,'false','update');

}



if($data3)
{
	return $data3;
}
else 
{
	echo "0";
}






}



