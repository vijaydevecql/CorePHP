<?php

require_once("../admin/controller/Books.php");

try {
    $Book = new Books();
    $headers = getallheaders();
    if ($Book->get_request_method() != "GET") {   // for checking the method
        $status = 405;
        $body = "method is not allowed";
        $Book->response($status, $body); // return responce
    }

    /*     * ****** required array which filed is required ********* */

    $requiredArray = array(
        'authorization_key' => $headers['authorization_key'],
        'book_type' => $_REQUEST['book_type'],
        'cat_id' => $_REQUEST['cat_id'],
        'limit' => $_REQUEST['limit'],
        'page' => $_REQUEST['page'],
        'checking_exits' => 0, // 1-> checking db exite item 0-> not checking 
    );

    /*     * ****** non required array which filed is non required ********* */

    $notRequiredField = array(
    );

    $data = $Book->array_filed($requiredArray, $notRequiredField);  // call the important function
    extract($data, EXTR_OVERWRITE);

    $queryResult = $Book->get_book_cat($data);
    if (count($queryResult)) {
        $status = SUCCESS_CODE;
        $body['data'] = $queryResult;
        $Book->response($status, $body);     // return responce
    } else {
        throw new Exception("No Cat found");
    }
} catch (Exception $e) {
    $status = FAILURE_CODE;
    $body = $e->getMessage();
    $Book->response($status, $body);      // return error 
}
?>
