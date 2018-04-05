<?php 
define( 'ROOT_DIR', "/var/www/html/staging/car_show/admin/" );
 require_once(ROOT_DIR."include/function.php");
 
	class event extends function_class{
	
		public function addevent($data){

			$resultSet  = "INSERT
			INTO
			`cr_event`			
			(`".implode("`, `", array_keys($data))."`)
			VALUES
			('".implode("' , '", $data)."')

			";

			return $queryResult  =$this->excuite($resultSet, 'false','insert');

		}
		
		public function getallevent(){

			$query1 = "SELECT * FROM `cr_event` where event_owner='".$_SESSION['user_id']."' order by id desc";
			return $data= $this->excuite($query1,'true','select');

		}
		
		public function updatevent($data){
		
			if($data['event_pic']=='' ){
			$data['event_pic']=self::eventbyid($data['id']);
			}else {
			$data['event_pic']=$data['event_pic'];
			}
		    $query1 = "update  `cr_event` set 
			`event_name`='".$data['event_name']."',
			`event_title`='".$data['event_title']."',
			`event_pic`='".$data['event_pic']."',
			`location`='".$data['location']."',
			`date`='".$data['date']."'
			where id='".$data['id']."'
			";
			return $data= $this->excuite($query1,'true','select');

		}
		
		public function deletevent($id){
		
		    $query1 = "delete  FROM `cr_event` where id=$id";
			$data= $this->excuite($query1,'false','delete');
			return true;
		
		
		
		}
		
		
		
		
		private function eventbyid($id){
		

		    $query1 = "SELECT * FROM `cr_event` where id=$id";
			$data= $this->excuite($query1,'false','select');
			return $data['event_pic'];
		
		
		}




}

?>
