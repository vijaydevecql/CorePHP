<?php
include("../include/function.php");
$pwn=new function_class();
  $id=$_POST['id'];
  $var=$_POST["verified"];
if($var==0)
{
	 $qry="update qmash_users set status=1 where id='$id'";

	$del=$pwn->excuite($qry,'false','update');
	// print_r($del);
	if($del)
	{
	    return $del;
	}
	else 
	{
	    echo "0";
	}
}
else
{
  $qry="update qmash_users set status=0 where id='$id'";

	$del=$pwn->excuite($qry,'false','update');
	// print_r($del);
	if($del)
	{
	    return $del;
	}
	else 
	{
	    echo "0";
	}
}
?>