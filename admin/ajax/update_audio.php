<?php

include("../include/function.php");
$c = new function_class();


    $file = $_FILES['url']['name'];
    $img = move_uploaded_file($_FILES['url']['tmp_name'], "upload/" . $file);

    if (!is_writeable("upload/" . $_FILES['url']['name'])) {
        die("Cannot write to destination file");
    }
	$file1 = BASE_HTTP_BASE_URL . "upload/" . $file;
	$query="update  book_audio set book_id ='".$_REQUEST['book_id']."', audio_url='$file1',created='".time()."',modified='".time()."' where id = '".$_REQUEST['id']."'";
    $data3 = $c->excuite($query, 'false', 'update');
	 $check= "select * from update_books where book_id='".$_REQUEST['book_id']."' and type=1";
	$result=$c->excuite($check, 'false', 'select');
	if (count($result)>0) {
		$this_query="insert into update_books set created='".time()."',book_id='".$_REQUEST['book_id']."',type=1";
		$datad = $c->excuite($this_query, 'false', 'insert');
	}else{
		$this_query="update update_books set created='".time()."',book_id='".$_REQUEST['book_id']."',type=1 where book_id='".$_REQUEST['book_id']."' and  type=1";
		$datad = $c->excuite($this_query, 'false', 'insert');
	}
	$new_query="select * from book_audio where id =$data3";
	$data1 = $c->excuite($new_query, 'false', 'select');
	$final=[];
	$final['id']=$data1['id'];
	$final['url']=$data1['audio_url'];
	echo json_encode($final);
    


