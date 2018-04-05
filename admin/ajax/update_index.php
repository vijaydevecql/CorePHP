<?php
include("../include/function.php");
$c=new function_class();
  $id=$_POST['id'];

 $qry="update book_index set index_no='".$_POST['name']."',index_name='".$_POST['email']."'  WHERE id='$id'";
	$del=$c->excuite($qry,'false','update');
	$check= "select * from update_books where book_id='".$_REQUEST['book_id']."' and type=0";
		$result=$c->excuite($check, 'false', 'select');
		if (empty($result)) {
			$this_query="insert into update_books set created='".time()."',book_id='".$_REQUEST['book_id']."',type=0";
			$datad = $c->excuite($this_query, 'false', 'insert');
		}else{
			$this_query="update update_books set created='".time()."',book_id='".$_REQUEST['book_id']."',type=0 where book_id='".$_REQUEST['book_id']."' and type=0";
			$datad = $c->excuite($this_query, 'false', 'insert');
		}
if($del)
{
    echo "1";
}
else 
{
    echo "0";
}

