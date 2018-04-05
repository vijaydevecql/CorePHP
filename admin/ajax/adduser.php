<?php

error_reporting(E_ALL);



include("../include/function.php");
$c = new function_class();

if ($_REQUEST['name']) {

    $file = $_FILES['pic']['name'];

    $img = move_uploaded_file($_FILES['pic']['tmp_name'], "upload/" . $file);

    if (!is_writeable("upload/" . $_FILES['pic']['name'])) {
        die("Cannot write to destination file");
    }
	
	$data3 = "select * from users where email='".$_REQUEST['email']."'";

    $data4 = $c->excuite($data3, 'false', 'select');
	
	
    if(count($data4)){
	
		echo "3";
		die();
	}
	
    $file1 = BASE_HTTP_BASE_URL . "upload/" . $file;
    
     $data2 = "insert into users set name ='" . $_REQUEST['name'] . "',email='".$_REQUEST['email']."' ,created='".time()."'";

    $data3 = $c->excuite($data2, 'false', 'update');
    if ($data3) {
        echo "1";
    } else {
        echo "0";
    }
}
?>
