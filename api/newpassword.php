<?php

require_once("../admin/controller/users.php");

try{
	    $Book = new Users();
		$headers = getallheaders();
		if($Book->get_request_method() != "POST")   // for checking the method
		{
			$status = 405;
			$body= "method is not allowed";	
			$Book->response($status,$body); // return responce
		}
		/******** required array which filed is required **********/
		$requiredArray = array(
		 'authorization_key'          => $headers['authorization_key'],
		 'new_password'          => $_REQUEST['new_password'],
		 'checking_exits' => 0,  // 1-> checking db exite item 0-> not checking 
		
		);
        /******** non required array which filed is non required **********/
		$notRequiredField =	array(
		
		);	
		
		$data=$Book->array_filed($requiredArray,$notRequiredField);  // call the important function
		extract($data ,EXTR_OVERWRITE);

		$queryResult=$Book->new_password($data);

		if($queryResult){
			$status=SUCCESS_CODE;
			$body =$queryResult;
			$Book->response($status,$body);     // return responce
		}		
		else{	
			throw new Exception("Error to forgot password");	
			}
					
	}
	catch(Exception $e)
	{	  			
		$status = FAILURE_CODE;
		$body= $e->getMessage();	
		$Book->response($status,$body);      // return error 
	}
?>
