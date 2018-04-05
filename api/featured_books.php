<?php

require_once("../admin/controller/Books.php");

try {
    $headers = getallheaders();
    $Book = new Books();
    if ($Book->get_request_method() != "GET") {
        $status = 405;
        $body = "method is not allowed";
        $Book->response($status, $body);
    }
    $requiredArray = array(
        'authorization_key' => $headers['authorization_key'],
        'limit' => $_REQUEST['limit'],
        'page' => $_REQUEST['page'],
        'book_type' => $_REQUEST['book_type'],
        'checking_exits' => 0, // 1-> checking db exite item 0-> not checking 
    );
    $notRequiredField = array(
        'search' => $_REQUEST['search']
    );
    // send the token in header		
    $data = $Book->array_filed($requiredArray, $notRequiredField);
    extract($data, EXTR_OVERWRITE);

    $queryResult = $Book->featured_books($book_type, $limit, $page, $user_id, $search);
    if (count($queryResult)) {
        $status = SUCCESS_CODE;
        $body = $queryResult;
        $Book->response($status, $body);
    } else {
        throw new Exception("No Book Found");
    }
} catch (Exception $e) {
    $status = FAILURE_CODE;
    $body = $e->getMessage();
    $Book->response($status, $body);
}

