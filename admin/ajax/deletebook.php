<?php
include("../include/function.php");
$pwn=new function_class();
  $id=$_POST['del_id'];

 $qry="DELETE FROM books WHERE id='$id'";
 $del=$pwn->excuite($qry,'false','delete'); 
 $qry="DELETE FROM book_info WHERE book_id='$id'";
 $del=$pwn->excuite($qry,'false','delete');

if($del)
{
    echo "1";
}
else 
{
    echo "0";
}


?>