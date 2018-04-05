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
        'type' => $_REQUEST['type'], // 0-> for ebook book  1-> audio Book 
		'limit'       =>$_REQUEST['limit'],
        'page'       =>$_REQUEST['page'],
        'checking_exits' => 0, // 1-> checking db exite item 0-> not checking 
    );

    /*     * ****** non required array which filed is non required ********* */

    $notRequiredField = array(
		'search' => $_REQUEST['search']
    );
    // send the token in header		
    $data = $Book->array_filed($requiredArray, $notRequiredField);  // call the important function
    extract($data, EXTR_OVERWRITE);

    $queryResult = $Book->getallbook($type,$limit, $page,$search);
    if (count($queryResult)) {
        $status = SUCCESS_CODE;
        $body = $queryResult;
        $Book->response($status, $body);     // return responce
    } else {
        throw new Exception("No Book Found");
    }
} catch (Exception $e) {
    $status = FAILURE_CODE;
    $body = $e->getMessage();
    $Book->response($status, $body);      // return error 
}
?>
