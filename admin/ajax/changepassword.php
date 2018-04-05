<?php
session_start();
$user_id=$_SESSION['admin_id'];

include("../include/function.php");

$c=new function_class();
if($_REQUEST['cp']){
 $conn="select * from `admin` where id='$user_id'";

$data2 =$c->excuite($conn,'false','select');

if($data2['password']== $c->pass($_REQUEST['cp'])){

  $conn1="update `admin` set `password`='".$c->pass($_REQUEST['np'])."' where id='$user_id'";

 $data3=$c->excuite($conn1,'false','update');
if($data3==1){
echo "1";


}else {

echo "Error to update passward";
}

}else {

echo "Old passward is wrong";

}


}







 ?>
