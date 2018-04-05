<?php 


class connection {

    
private $conn;
   
   

Public function connection_create(){

try {

    
        require_once 'setting.php';
        
     
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWD, DB_NAME);
        
        return $this->conn;
   
   
	
	
}
catch(Exception $e){

    echo $e->getMessage();

}







}




}
?>
