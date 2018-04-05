<?php

session_start();


include("../controller/users.php");
$user=new users();

if($_REQUEST['make_one'] || $_REQUEST['model_one']||$_REQUEST['year_one']||$_REQUEST['license_one']){
    $qry="update cr_car_info set make_one='".$_REQUEST['make_one']."', model_one='".$_REQUEST['model_one']."' ,year_one='".$_REQUEST['year_one']."',license_one='".$_REQUEST['license_one']."' where id='".$_REQUEST['id']."'";
			$add=$user->excuite($qry,'false','update');
		}
		if($_REQUEST['make_two'] || $_REQUEST['model_two']||$_REQUEST['year_two']||$_REQUEST['license_two'])
		{
			$qry="update cr_car_info set make_two='".$_REQUEST['make_two']."', model_two='".$_REQUEST['model_two']."' ,year_two='".$_REQUEST['year_two']."',license_two='".$_REQUEST['license_two']."' where id='".$_REQUEST['id']."'";
			$add=$user->excuite($qry,'false','update');
		}

  
		
        








 ?>
