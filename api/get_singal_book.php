<?php

require_once("../admin/controller/admin_login.php");

try {
	$headers = getallheaders();
    $Book = new login();
    if ($Book->get_request_method() != "GET") {   // for checking the method
        $status = 405;
        $body = "method is not allowed";
        $Book->response($status, $body); // return responce
    }

    /*     * ****** required array which filed is required ********* */

    $requiredArray = array(
		'authorization_key'       =>$headers['authorization_key'],
		'book_id'       =>$_REQUEST['book_id'],
		
       
        'checking_exits' => 0, // 1-> checking db exite item 0-> not checking 
    );

    /*     * ****** non required array which filed is non required ********* */

    $notRequiredField = array(
		'modified'       =>$_REQUEST['modified'],
    );
    // send the token in header		
    $data = $Book->array_filed($requiredArray, $notRequiredField);  // call the important function
    extract($data, EXTR_OVERWRITE);

    $queryResult = $Book->get_singal_book_details($book_id,$user_id,$modified);
    $new_book = $Book->recent_book($data);
	$queryResult['sample_url']='';
	foreach($queryResult['audio_urls'] as $k=> $value){
		if($value['type']==1){
			$queryResult['sample_url']=$value['audio_url'];
			unset($queryResult['audio_urls'][$k]);
		}
	}
    if (count($queryResult)) {
        $status = SUCCESS_CODE;
        $body = $queryResult;
        $Book->response($status, $body,1);     // return responce
    } else {
        throw new Exception("No Book Found");
    }
} catch (Exception $e) {
    $status = FAILURE_CODE;
    $body = $e->getMessage();
    $Book->response($status, $body);      // return error 
}
?>
