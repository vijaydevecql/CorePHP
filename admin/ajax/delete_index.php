<?php
include("../include/function.php");
$pwn=new function_class();
  $id=$_POST['del_id'];

 $qry="DELETE FROM book_index  WHERE id='$id'";
$del=$pwn->excuite($qry,'false','delete');
$check= "select * from update_books where book_id='".$_REQUEST['book_id']."' and type=0";
		$result=$c->excuite($check, 'false', 'select');
		if (empty($result)) {
			$this_query="insert into update_books set created='".time()."',book_id='".$_REQUEST['book_id']."',type=0";
			$datad = $c->excuite($this_query, 'false', 'insert');
		}else{
			$this_query="update update_books set created='".time()."',book_id='".$_REQUEST['book_id']."',type=0 where book_id='".$_REQUEST['book_id']."'";
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

