<?php 
session_start();
define( 'ROOT_DIR', "/var/www/html/staging/audio_book/admin/" );
 require_once(ROOT_DIR."/include/function.php");
 
	class admin extends function_class{
	
		public function admin_detalis(){
         
			 $query1 = "SELECT * FROM `admin` where id=".$_SESSION['admin_id']." ";
		
			
				 return $data= $this->excuite($query1,'false','select');
			 
            
		}
	
}
