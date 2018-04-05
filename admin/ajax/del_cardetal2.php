<?php
include("../controller/users.php");
$user=new users();;
  $id=$_REQUEST['del_id'];
  $qry="select make_one,model_one,year_one,license_one from cr_car_info where id='$id'";  
  $add1=$user->excuite($qry,'false','select');


  if($add1['make_one']=='' and $add1['model_one']=='' and $add1['year_one']== 0 and $add1['license_one']=='')
  {
 echo $qry="delete  from cr_car_info where id='$id'";
  $add=$user->excuite($qry,'true','delete');
  
  }
  else
  {
echo $qry="update cr_car_info set make_two='', model_two='' ,year_two='',license_two='' where id='$id'";
			
$add=$user->excuite($qry,'false','update');
}










// print_r($del);



?>