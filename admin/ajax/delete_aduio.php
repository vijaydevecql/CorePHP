<?php

error_reporting(E_ALL);


$user_id = $_SESSION['admin_id'];
include("../include/function.php");
$c = new function_class();

if ($_REQUEST['id']) {

     $data2 = "delete from book_audio where id ='".$_REQUEST['id']."'";

    $data3 = $c->excuite($data2, 'false', 'delete');
    if ($data3) {
		$check= "select * from update_books where book_id='".$_REQUEST['book_id']."' and type=1";
		$result=$c->excuite($check, 'false', 'select');
		if (empty($result)) {
			$this_query="insert into update_books set created='".time()."',book_id='".$_REQUEST['book_id']."',type=1";
			$datad = $c->excuite($this_query, 'false', 'insert');
		}else{
			$this_query="update update_books set created='".time()."',book_id='".$_REQUEST['book_id']."',type=1 where book_id='".$_REQUEST['book_id']."' and type=1";
			$datad = $c->excuite($this_query, 'false', 'insert');
		}
        echo "1";
    } else {
        echo "0";
    }
}
