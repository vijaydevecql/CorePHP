<?php 
 require_once("./include/function.php");
class chat extends function_class{
	
public function getchat($friend_id,$user_id){


 $query1 = "SELECT c.*,u.* FROM ".CHAT." as c join ".USER." as u on(c.sender_id=u.id) where (sender_id='$user_id' and friend_id='$friend_id')or (friend_id='$user_id' and sender_id ='$friend_id') ";

 return $data= $this->excuite($query1,'true','select');


}
public function getlastchat($user_id)
    {
         $resultSet  = "SELECT  distinct IF(`sender_id` = '$user_id', `friend_id`, `sender_id`) as friend_id from 
           ".CHAT." where 
           `sender_id` = '$user_id' or `friend_id`='$user_id' 
		";
	 
	 
	 $data2 =$this->excuite($resultSet,'true','select');
      foreach($data2 as $k=>$v){
	 
	
	 
	
	 $query2="SELECT c.*,u.name  FROM ".CHAT." as c join ".USER." as u on (c.sender_id=u.id) where (c.sender_id='$user_id' and c.friend_id='".$v['friend_id']."') or (c.sender_id='".$v['friend_id']."' and c.friend_id='$user_id') order by c.id desc limit 1 ";
	 $queryResult[]=$this->excuite($query2, 'false','select');
	 
    }
	
	
	
return $queryResult;

}

public function sendmessage($data){

 $resultSet  = "INSERT
					INTO
						".CHAT."				
						(`".implode("`, `", array_keys($data))."`)
					VALUES
						('".implode("' , '", $data)."')
					
					";
					
	$queryResult  =$this->excuite($resultSet, 'false','insert');

return self::lastmessage($queryResult);

}
private function lastmessage($queryResult){

$query1 = "SELECT c.*,u.* FROM ".CHAT." as c join ".USER." as u on(c.sender_id=u.id) where c.id='$queryResult' ";

 return $data= $this->excuite($query1,'false','select');
}



}

?>
