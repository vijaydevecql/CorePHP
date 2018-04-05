<?php

error_reporting(E_ALL);



include("../include/function.php");
$c = new function_class();
$password=$c->pass($_REQUEST['password']);
if ($_REQUEST['name']) {

    $file = $_FILES['image']['name'];

    $img = move_uploaded_file($_FILES['image']['tmp_name'], "upload/" . $file);

    if (!is_writeable("upload/" . $_FILES['image']['name'])) {
        die("Cannot write to destination file");
    }
	
	$data3 = "select * from admin where email='".$_REQUEST['email']."'";

    $data4 = $c->excuite($data3, 'false', 'select');
	
	
    if(count($data4)){
	
		echo "3";
		die();
	}
	
    $file1 = BASE_HTTP_BASE_URL . "upload/" . $file;
    
     $data2 = "insert into admin set status='0',admin_type='1',password ='" . $password . "',name ='" . $_REQUEST['name'] . "',email='".$_REQUEST['email']."',profile_pic='$file1' ,created='".time()."'";
	 $data3 = $c->excuite($data2, 'false', 'update');
	 
	 
	 $data2 = "insert into books_auther set admin_id='$data3',name ='" . $_REQUEST['name'] . "',image='$file1' ,created='".time()."'";
	 $data3 = $c->excuite($data2, 'false', 'update');
    if ($data3) {
        echo "1";
    } else {
        echo "0";
    }
}
?>
