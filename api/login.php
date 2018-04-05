<?php

require_once("../admin/controller/users.php");

try{
	    $Book = new Users();
		if($Book->get_request_method() != "POST")   // for checking the method
		{
			$status = 405;
			$body= "method is not allowed";	
			$Book->response($status,$body); // return responce
		}
		/******** required array which filed is required **********/
		$requiredArray = array(
		 'password'       =>$_REQUEST['password'], 
		 'email'          => $_REQUEST['email'],
		 'created'        => time(),
		 'checking_exits' => 0,  // 1-> checking db exite item 0-> not checking 
		
		);
        /******** non required array which filed is non required **********/
		$notRequiredField =	array(
		'device_token'    =>$_REQUEST['device_token'],
		'device_type'     =>$_REQUEST['device_type'],
		'authorization_key' =>$Book->genrate_Authorization() 
		);	
				
		$data=$Book->array_filed($requiredArray,$notRequiredField);  // call the important function
		extract($data ,EXTR_OVERWRITE);

		$queryResult=$Book->login($data);

		if(count($queryResult)>0){
			$status=SUCCESS_CODE;
			$body = $queryResult;
			$Book->response($status,$body);     // return responce
		}		
		else{	
			throw new Exception("error to signup");	
			}
					
	}
	catch(Exception $e)
	{	  			
		$status = FAILURE_CODE;
		$body= $e->getMessage();	
		$Book->response($status,$body);      // return error 
	}
?>
