<?php
include("../include/function.php");
$pwn=new function_class();
  $id=$_POST['del_id'];

 $qry="DELETE FROM users WHERE id='$id'";
$del=$pwn->excuite($qry,'false','delete');
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