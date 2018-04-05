<?php
include("../include/function.php");
$pwn=new function_class();
  $id=$_POST['del_id'];
$dddd="select * from admin where id = $id";
$ss=$pwn->excuite($dddd,'false','select');
 $qry="DELETE FROM books_auther WHERE id='$id'";
$del=$pwn->excuite($qry,'false','delete');
$qry="DELETE FROM admin WHERE id='".$dddd['admin_id']."'";
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