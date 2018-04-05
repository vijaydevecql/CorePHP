<?php
include("../controller/event.php");
$user=new event();
 if($_REQUEST['id']){
		$qry="update cr_event set status=1 where id='".$_REQUEST['id']."'";

		$add1=$user->excuite($qry,'false','update');

		$qry="select * from  cr_users  where device_token!=''";

		$add=$user->excuite($qry,'true','select');
		
		foreach($add as $v){
		
		$qry="select * from  cr_event  where id='".$_REQUEST['id']."'";

		$ad=$user->excuite($qry,'false','select');
		$user->sendPushNotiFication($v['id'] ,"event is cancel" , "0",$ad);
		}
		return true;
}






?>