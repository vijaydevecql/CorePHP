<?php 
 require_once("../include/function.php");
class org extends function_class{
	
public function addorg($data){

if($data['pic']==''){
unset($data['pic']);
 $query1="INSERT
					INTO
						".USER."				
						(`".implode("`, `", array_keys($data))."`)
					VALUES
						('".implode("' , '", $data)."')
					
					";
}else{
unset($data['pic']);
 $query1="INSERT
					INTO
						".USER."				
						(`".implode("`, `", array_keys($data))."`)
					VALUES
						('".implode("' , '", $data)."')
					
					";

}


 return $data= $this->excuite($query1,'true','select');


}

public function getallemplye(){


 $query1 = "SELECT * FROM ".USER." where user_type='2' and under_org='".$_SESSION['user_id']."' and under_org!=0";

 return $data= $this->excuite($query1,'true','select');


}
public function admin_detail()
    {
        $qry="select * from ".USER." where id='".$_SESSION['user_id']."'";
        return $this->excuite($qry,'false','select');
    }




}

?>
