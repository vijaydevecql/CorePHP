<?php

require_once("../admin/controller/Books.php");

try{
	    $Book = new Books();
		$headers = getallheaders();
		if($Book->get_request_method() == "POST")   // for checking the method
		{
		/******** required array which filed is required **********/
		$requiredArray = array(
		 'authorization_key'       =>$headers['authorization_key'], 
		 'book_id'          => $_REQUEST['book_id'],
		 'comment'          => $_REQUEST['comment'],
		 'created'          => time(),
		 'checking_exits' => 0,  // 1-> checking db exite item 0-> not checking 
		
		);
        /******** non required array which filed is non required **********/
		$notRequiredField =	array(
		 
		);	
		
		$data=$Book->array_filed($requiredArray,$notRequiredField);  // call the important function
		extract($data ,EXTR_OVERWRITE);

		$queryResult=$Book->do_comment($data);

		if(count($queryResult)>0){
			$status=SUCCESS_CODE;
			$body = $queryResult;
			$Book->response($status,$body);     // return responce
		}		
		else{	
			throw new Exception("Internet server error");	
			}
		}
		if($Book->get_request_method() == "GET"){
			$requiredArray = array(
		 'authorization_key'       =>$headers['authorization_key'], 
		 'book_id'          => $_REQUEST['book_id'],
		 'checking_exits' => 0,  // 1-> checking db exite item 0-> not checking 
		
		);
        /******** non required array which filed is non required **********/
		$notRequiredField =	array(
		 
		);	
		
		$data=$Book->array_filed($requiredArray,$notRequiredField);  // call the important function
		extract($data ,EXTR_OVERWRITE);

		$queryResult=$Book->get_comments($data);

		if(count($queryResult)>0){
			$status=SUCCESS_CODE;
			$body = $queryResult;
			$Book->response($status,$body);     // return responce
		}		
		else{	
			throw new Exception("no comment found");	
			}
		}
		
		
					
	}
	catch(Exception $e)
	{	  			
		$status = FAILURE_CODE;
		$body= $e->getMessage();	
		$Book->response($status,$body);      // return error 
	}
?>