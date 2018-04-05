<?php

include("../include/function.php");
$pwn=new function_class();
  $id=$_POST['del_id'];
$data3 = "select * from users where email='".$_REQUEST['email']."' and id!= '".$_REQUEST['id']."'";

    $data4 = $pwn->excuite($data3, 'false', 'select');
	
	
    if(count($data4)){
	
		echo "3";
		die();
	}
 $qry="update users set name='".$_REQUEST['name']."',email='".$_REQUEST['email']."' WHERE id='".$_REQUEST['id']."'";
$del=$pwn->excuite($qry,'false','update');
// print_r($del);
if($del)
{
    echo "1";
}
else 
{
    echo "0";
}






 ?>
