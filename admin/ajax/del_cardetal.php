<?php
include("../controller/users.php");
$user=new users();;
  $id=$_REQUEST['del_id'];
  $qry="select make_two,model_two,year_two,license_two from cr_car_info where id='$id'";
  $add1=$user->excuite($qry,'false','select');
  if($add1['make_two']=='' and $add1['model_two']=='' and $add1['year_two']==0  and $add1['license_two']=='')
  {
 echo $qry="delete  from cr_car_info where id='$id'";
  $add1=$user->excuite($qry,'false','delete');
  }
  else
  {
echo $qry="update cr_car_info set make_one='', model_one='' ,year_one='',license_one='' where id='$id'";
			
$add=$user->excuite($qry,'false','update');
}










// print_r($del);



?>