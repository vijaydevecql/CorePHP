<?php

include("../include/function.php");
$pwn=new function_class();
  $id=$_POST['del_id'];

 $qry="update catgory set catgory_name='".$_REQUEST['name']."' WHERE id=".$_REQUEST['id'];
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
