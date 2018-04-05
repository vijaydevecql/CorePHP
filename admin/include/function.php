<?php

session_start();
require_once("setting.php");

class function_class {

    private $conn;

    function __construct() {
        require_once 'connection.php';
        $db = new connection();
        $this->conn = $db->connection_create();
    }

    function __destruct() {
        
    }

    public function processApi() {
        $func = strtolower(trim(str_replace("/", "", $_REQUEST['rquest'])));
        if ((int) method_exists($this, $func) > 0)
            $this->$func();
        else
            $this->response('Error code 404, Page not found', 404);   // If the method not exist with in this class, response would be "Page not found".
    }

    public function response($status, $body, $remove_null = 0) {
        $this->_code = ($status) ? $status : 200;
        $this->set_headers();
        if ($status != 200) {
            header('message: ' . $body . '');
            $result['message'] = $body;
            $result['code'] = $status;
        } else {
            if ($remove_null == 1) {
                $result = self::remove_null($body);
            } else {
                $result = $body;
            }
        }
        echo json_encode($result);
        // utf8_encode_all($resutl);
        die();
    }

    public function get_request_method() {
        return $_SERVER['REQUEST_METHOD'];
    }

    private static function remove_null($data) {
        $final = [];
        foreach ($data as $k => $value) {

            if (is_null($value)) {
                $value = '';
            }
            $final[$k] = $value;
        }
        return $final;
    }

    /* admin login
     * 
     */

    public function function_login($email, $password) {
        $password = self::pass($password);
        $query1 = "SELECT * FROM " . ADMIN . " WHERE (email = '$email' AND password = '$password')  ";
        return $data = $this->excuite($query1, 'false', 'select');
    }

    private function user_id($key) {
        $query1 = "SELECT * FROM " . USER . " WHERE authorization_key='$key'  ";
        $data = $this->excuite($query1, 'false', 'select');
        return $data['id'];
    }

    private function inputs() {
        switch ($this->get_request_method()) {
            case "POST":
                $this->_request = $this->cleanInputs($_POST);
                break;
            case "GET":
            case "DELETE":
                $this->_request = $this->cleanInputs($_GET);
                break;
            case "PUT":
                parse_str(file_get_contents("php://input"), $this->_request);
                $this->_request = $this->cleanInputs($this->_request);
                break;
            default:
                $this->response('', 406);
                break;
        }
    }

    private function get_status_message() {
        $status = array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported');
        return ($status[$this->_code]) ? $status[$this->_code] : $status[500];
    }

    private function set_headers() {
        header("HTTP/1.1 " . $this->_code . " " . $this->get_status_message());
        header("Content-Type:" . $this->_content_type);
    }

    function getSafeValue($value) {
        return $item = mysqli_real_escape_string($this->conn, $value);
    }

    function sendvalue($data, $dbdata) {
        return ( isset($data) || trim($data) != "") ? $data : $dbdata;
    }

    /*
     * get audio file duration 
     */

    function getDuration($file) {
        if (file_exists($file)) {
            ## open and read video file
            $handle = fopen($file, "r");

            ## read video file size
            $contents = fread($handle, filesize($file));
            fclose($handle);
            $make_hexa = hexdec(bin2hex(substr($contents, strlen($contents) - 3)));
            if (strlen($contents) > $make_hexa) {
                $pre_duration = hexdec(bin2hex(substr($contents, strlen($contents) - $make_hexa, 3)));
                $post_duration = $pre_duration / 1000;
                $timehours = $post_duration / 3600;
                $timeminutes = ($post_duration % 3600) / 60;
                $timeseconds = ($post_duration % 3600) % 60;
                $timehours = explode(".", $timehours);
                $timeminutes = explode(".", $timeminutes);
                $timeseconds = explode(".", $timeseconds);
                $duration = $timehours[0] . ":" . $timeminutes[0] . ":" . $timeseconds[0];
            }
            return $duration;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param type $table_name string
     * @param type $filed string
     * @param type $type string 
     * @return type total count
     */
    public function total_count($table_name, $filed = '', $type = 'false') {
        if ($filed == '') {
            $filed = "count(*)";
        } else {
            $filed = "count($filed)";
        }
        $query = "select $filed as total from $table_name";
        $count = $this->excuite($query, $type, 'select');
        if ($type == "false") {
            return $count['total'];
        } else {
            return count($count);
        }
    }

    public static function json($status, $body = '') {

        $giveresponce = array();
        $giveresponce['status'] = $status;
        $giveresponce['body'] = $body;
        echo json_encode($giveresponce);
        die();
    }

    function excuite($query1, $type, $q_type) {

        try {
            if (($q_type == 'insert' || $q_type == 'update' || $q_type == 'delete' ) && $type == 'false') {
               // echo "$query1";
                $query = mysqli_query($this->conn, $query1);
                if ($query) {
                    if ($q_type == 'insert') {
                        return mysqli_insert_id($this->conn);
                    } else {
                        return true;
                    }
                } else {
                    throw new Exception("Error in your " . $q_type . " Query " . mysqli_error($this->conn));
                }
            } else {
                if ($type == 'false' && $q_type == 'select') {
                    $row = mysqli_query($this->conn, $query1);
                    if ($row) {
                        $data = mysqli_fetch_assoc($row);
                        return $data;
                    } else {
                        throw new Exception("Error in your " . $q_type . " Query " . mysqli_error($this->conn));
                    }
                }if ($type == 'true' && $q_type == 'select') {
                    $row = mysqli_query($this->conn, $query1);
                    if ($row) {
                        while ($row1 = mysqli_fetch_assoc($row)) {
                            $data[] = $row1;
                        }
                        return $data;
                    } else {
                        throw new Exception("Error in your " . $q_typ . " Query " . mysqli_error($this->conn));
                    }
                }
            }
        } catch (Exception $e) {
            $status = FAILURE_CODE;
            $body = $e->getMessage();
            return function_class::response($status, $body);
        }
    }

    public function sendmail($params = []) {
        $_parmas = ['to' => 'to@admin.com', 'from' => 'from@admin.com', 'subject' => 'Test Subject | ' . date('Y m d H:i:s'), 'body' => 'Test Body'];
        foreach ($params as $k => $param) {
            if (!strlen(trim($param)) || !array_key_exists($k, $_parmas)) {
                $r = "$k is empty";
                return $r;
            }
        }

        define('API', 'key-c58a069be6d91f94336037421eeb84fb');

        $username = 'api';
        $password = API;
        $data = [
            'to' => $params['to'],
            'from' => $params['from'],
            'subject' => $params['subject'],
            'text' => $params['body']
        ];
        $req = '';
        foreach ($data as $key => $value) {
            $value = urlencode($value);
            $req .= "&$key=$value";
        }
        $_url = "https://api.mailgun.net/v3/mail.apphinge.com/messages";

        $ch = curl_init();
        $curlConfig = [
            CURLOPT_URL => $_url,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $req,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => "{$username}:{$password}"
        ];
        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);

        curl_close($ch);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function dbExist($value, $field_name, $table_name, $type = '=', $faliureCode = FAILURE_CODE, $failureMessg = 'Error in the query while looking for field in database') {



        $sql = mysqli_query($this->conn, "SELECT * FROM $table_name WHERE $field_name $type '$value' LIMIT 1 ");


        if (!$sql) {

            $status['code'] = $faliureCode;

            $status['message'] = $failureMessg;

            self::json($status);
        }

        return (mysqli_num_rows($sql) > 0);
    }

    function genrate_Authorization() {
        return md5(rand(time(), 99999));
    }

    protected static function Required($requiredArray) {
        $field = array();
        foreach ($requiredArray as $key => $value) {
            if (trim($requiredArray[$key]) == "") {
                $field[] = $key . " field is required";
            }
        }
        return $field;
    }

    public function pass($password) {
        return $password = self::md6($password);
    }

    // push function here
    public function sendPushNotiFication($notiArray, $message, $notification_code, $data) {


        $notifDbDetails = array(
            "message" => $message,
            "title" => APP_NAME . " Notification",
            "msgcnt" => "1",
            "soundname" => "beep.wav",
            "timeStamp" => time(),
            "notification_code" => $notification_code,
            "Unread" => $unread_messages,
            "body" => $data
        );

        $resultSet = "SELECT `device_type` , `device_token` FROM " . USER1 . "  WHERE `user_id` = '" . $notiArray . "'";


        $ds = $this->excuite($resultSet, 'true', 'select');

        foreach ($ds as $ds) {
            $device_id = $ds['device_type'];
            $device_token = $ds['device_token'];

            if ($device_id == '1') {

                $deviceToken = $device_token;
                $passphrase = '123456789';

                $message = $message;

                $ctx = stream_context_create();
                stream_context_set_option($ctx, 'ssl', 'local_cert', dirname(__FILE__) . '/playpush.pem');
                stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

                // Open a connection to the APNS server
                $fp = stream_socket_client(
                        'ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

                if (!$fp)
                    exit("Failed to connect: $err $errstr" . PHP_EOL);


                PHP_EOL;


                $body = $notifDbDetails;
                $body['aps'] = array(
                    'alert' => 'you have new message',
                    'sound' => 'default',
                    'badge' => (int) $unread_messages
                );


                $payload = json_encode($body);
                // print_r($payload);
                $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

                $result = fwrite($fp, $msg, strlen($msg));
                // print_r($result);
                if (!$result)
                    PHP_EOL;
                else
                    PHP_EOL;

                fclose($fp);
            }
            else {



                //	  AIzaSyC-397wMw6l5mg99yFzDERFB7H28f-ZDcE	

                if (count($device_token) > 0) {

                    $url = 'https://fcm.googleapis.com/fcm/send';

                    $fields = array(
                        'registration_ids' => array($device_token),
                        'data' => $notifDbDetails,
                    );


                    $headers = array(
                        'Authorization: key=AAAAVGa2OdI:APA91bE6ChtUU6tvnhRohG6WZpsWnPjdfgaC0e5oLUt3_HE2xWzUjj3sKDam5K2zmkOBy9gDSc9Yb0FqEtm-loMDCs9mG8DeesjCFa8uxxBuW2epc27MTWwmDKGA65mDu1FpAJBml2Iz9Dpl7XRkb7dpl1Bbv26low',
                        'Content-Type: application/json'
                    );


                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, $url);

                    curl_setopt($ch, CURLOPT_POST, true);

                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

                    $result = curl_exec($ch);
                    //	print_r($result);
                    curl_close($ch);
                }
            }
        }
    }

    protected static function email($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            return true;
        }
    }

    public function array_filed($requr, $nonrequred) {

        try {
            $rfield = function_class::Required($requr);

            if (count($rfield) > 0) {
                throw new Exception(implode(' , ', $rfield));
            }
            if ($requr['password']) {
                $requr['password'] = function_class::md6($requr['password']);
            }

            if ($requr['authorization_key']) {
                if (!$this->dbExist($requr['authorization_key'], '`authorization_key`', USER)) {
                    throw new Exception("Authorization failed");
                } else {
                    $requr['user_id'] = self::user_id($requr['authorization_key']);
                    unset($requr['authorization_key']);
                }
            }
            $Array = array_merge($requr, $nonrequred);

            if ($Array['email']) {
                $rfield = self::email($Array['email']);
                if ($rfield) {
                    throw new Exception("enter valid email address");
                }
            }
            array_walk($data, 'getSafeValue');
            if ($Array['checking_exits'] == 1) {
                if ($Array['email']) {
                    if ($this->dbExist($requr['email'], '`email`', USER)) {
                        throw new Exception("this email already register");
                    }
                }
                if ($Array['user_id']) {
                    if (!$this->dbExist($Array['user_id'], '`user_id`', USER)) {
                        throw new Exception("no user found for this user id");
                    }
                }
                if ($Array['phone']) {
                    if ($this->dbExist($Array['phone'], '`phone`', USER)) {
                        throw new Exception("this phone already register");
                    }
                }
                // checking token here ; note-> checking where token is store in table
            }
            unset($Array['checking_exits']);
            return $Array;
        } catch (Exception $e) {
            $status = FAILURE_CODE;
            $body = $e->getMessage();
            return self::response($status, $body);
        }
    }

    protected static function md6($password) {

        $password = md5($password);
        $password = base64_encode($password);
        $password = sha1($password);
        return $password;
    }

    public function uploadpic($file) {
        
    }

    public function genrate_Otp($digits = 4) {
        $i = 0;
        $otp = "";
        while ($i < $digits) {
            $otp .= mt_rand(0, 9);
            $i++;
        }
        return $otp;
    }

    public function USERID($token) {
        $query = "select user_id from " . USER . " where `Authorization-key`='$token'";
        $data = $this->excuite($query, 'false', 'select');
        return $data['user_id'];
    }

    public function facebook($token) {
        $json_url = 'https://graph.facebook.com/me?fields=id,name,picture&access_token=$token';
        $json = file_get_contents($json_url);
        return $json_output = json_decode($json);
    }

    public function twitter($token) {
        $json_url = 'https://api.twitter.com/1.1/users/show.json?access_token=$token';
        $json = file_get_contents($json_url);
        return $json_output = json_decode($json);
    }

    protected function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
        $sort_col = array();
        foreach ($arr as $key => $row) {
            $sort_col[$key] = strtolower($row[$col]);
        }
        array_multisort($sort_col, $dir, $arr);
    }

    protected function array_sort_by_column1(&$arr, $col, $dir = SORT_DESC) {
        $sort_col = array();
        foreach ($arr as $key => $row) {
            $sort_col[$key] = strtolower($row[$col]);
        }
        array_multisort($sort_col, $dir, $arr);
    }

    public static function unique_multidim_array($array, $key) {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach ($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

    public function parse_raw_http_request(array &$a_data, $data) {
        // read incoming data
        $input = file_get_contents('php://input');

        // grab multipart boundary from content type header
        preg_match('/boundary=(.*)$/', $_SERVER['CONTENT_TYPE'], $matches);
        $boundary = $matches[1];

        // split content by boundary and get rid of last -- element
        $a_blocks = preg_split("/-+$boundary/", $input);
        array_pop($a_blocks);

        // loop data blocks
        foreach ($a_blocks as $id => $block) {
            if (empty($block))
                continue;

            // you'll have to var_dump $block to understand this and maybe replace \n or \r with a visibile char
            // parse uploaded files
            if (strpos($block, 'application/octet-stream') !== FALSE) {
                // match "name", then everything after "stream" (optional) except for prepending newlines 
                preg_match("/name=\"([^\"]*)\".*stream[\n|\r]+([^\n\r].*)?$/s", $block, $matches);
            }
            // parse all other fields
            else {
                // match "name" and optional value in between newline sequences
                preg_match('/name=\"([^\"]*)\"[\n|\r]+([^\n\r].*)?\r$/s', $block, $matches);
            }
            return $a_data[$matches[1]] = $matches[2];
        }
    }

    function time_passed($timestamp) {
        //type cast, current time, difference in timestamps
        $timestamp = (int) $timestamp;
        $current_time = time();
        $diff = $current_time - $timestamp;

        //intervals in seconds
        $intervals = array(
            'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute' => 60
        );

        //now we just find the difference
        if ($diff == 0) {
            return 'just now';
        }

        if ($diff < 60) {
            return $diff == 1 ? $diff . ' second ago' : $diff . ' seconds ago';
        }

        if ($diff >= 60 && $diff < $intervals['hour']) {
            $diff = floor($diff / $intervals['minute']);
            return $diff == 1 ? $diff . ' minute ago' : $diff . ' minutes ago';
        }

        if ($diff >= $intervals['hour'] && $diff < $intervals['day']) {
            $diff = floor($diff / $intervals['hour']);
            return $diff == 1 ? $diff . ' hour ago' : $diff . ' hours ago';
        }

        if ($diff >= $intervals['day'] && $diff < $intervals['week']) {
            $diff = floor($diff / $intervals['day']);
            return $diff == 1 ? $diff . ' day ago' : $diff . ' days ago';
        }

        if ($diff >= $intervals['week'] && $diff < $intervals['month']) {
            $diff = floor($diff / $intervals['week']);
            return $diff == 1 ? $diff . ' week ago' : $diff . ' weeks ago';
        }

        if ($diff >= $intervals['month'] && $diff < $intervals['year']) {
            $diff = floor($diff / $intervals['month']);
            return $diff == 1 ? $diff . ' month ago' : $diff . ' months ago';
        }

        if ($diff >= $intervals['year']) {
            $diff = floor($diff / $intervals['year']);
            return $diff == 1 ? $diff . ' year ago' : $diff . ' years ago';
        }
    }

}

// card checking class



class CreditCard extends function_class {

    protected static $cards = array(
        // Debit cards must come first, since they have more specific patterns than their credit-card equivalents.

        'visaelectron' => array(
            'type' => 'visaelectron',
            'pattern' => '/^4(026|17500|405|508|844|91[37])/',
            'length' => array(16),
            'cvcLength' => array(3),
            'luhn' => true,
        ),
        'maestro' => array(
            'type' => 'maestro',
            'pattern' => '/^(5(018|0[23]|[68])|6(39|7))/',
            'length' => array(12, 13, 14, 15, 16, 17, 18, 19),
            'cvcLength' => array(3),
            'luhn' => true,
        ),
        'forbrugsforeningen' => array(
            'type' => 'forbrugsforeningen',
            'pattern' => '/^600/',
            'length' => array(16),
            'cvcLength' => array(3),
            'luhn' => true,
        ),
        'dankort' => array(
            'type' => 'dankort',
            'pattern' => '/^5019/',
            'length' => array(16),
            'cvcLength' => array(3),
            'luhn' => true,
        ),
        // Credit cards
        'visa' => array(
            'type' => 'visa',
            'pattern' => '/^4/',
            'length' => array(13, 16),
            'cvcLength' => array(3),
            'luhn' => true,
        ),
        'mastercard' => array(
            'type' => 'mastercard',
            'pattern' => '/^(5[0-5]|2[2-7])/',
            'length' => array(16),
            'cvcLength' => array(3),
            'luhn' => true,
        ),
        'amex' => array(
            'type' => 'amex',
            'pattern' => '/^3[47]/',
            'format' => '/(\d{1,4})(\d{1,6})?(\d{1,5})?/',
            'length' => array(15),
            'cvcLength' => array(3, 4),
            'luhn' => true,
        ),
        'dinersclub' => array(
            'type' => 'dinersclub',
            'pattern' => '/^3[0689]/',
            'length' => array(14),
            'cvcLength' => array(3),
            'luhn' => true,
        ),
        'discover' => array(
            'type' => 'discover',
            'pattern' => '/^6([045]|22)/',
            'length' => array(16),
            'cvcLength' => array(3),
            'luhn' => true,
        ),
        'unionpay' => array(
            'type' => 'unionpay',
            'pattern' => '/^(62|88)/',
            'length' => array(16, 17, 18, 19),
            'cvcLength' => array(3),
            'luhn' => false,
        ),
        'jcb' => array(
            'type' => 'jcb',
            'pattern' => '/^35/',
            'length' => array(16),
            'cvcLength' => array(3),
            'luhn' => true,
        ),
    );

    public static function validCreditCard($number, $type = null) {
        $ret = array(
            'valid' => 0,
            'number' => '',
            'type' => '',
        );

        // Strip non-numeric characters
        $number = preg_replace('/[^0-9]/', '', $number);

        if (empty($type)) {
            $type = self::creditCardType($number);
        }

        if (array_key_exists($type, self::$cards) && self::validCard($number, $type)) {
            return array(
                'valid' => true,
                'number' => $number,
                'type' => $type,
            );
        }

        return $ret;
    }

    public static function validCvc($cvc, $type) {
        return (ctype_digit($cvc) && array_key_exists($type, self::$cards) && self::validCvcLength($cvc, $type));
    }

    public static function validDate($year, $month) {
        $month = str_pad($month, 2, '0', STR_PAD_LEFT);

        if (!preg_match('/^20\d\d$/', $year)) {
            return false;
        }

        if (!preg_match('/^(0[1-9]|1[0-2])$/', $month)) {
            return false;
        }

        // past date
        if ($year < date('Y') || $year == date('Y') && $month < date('m')) {
            return false;
        }

        return true;
    }

    // PROTECTED
    // ---------------------------------------------------------

    protected static function creditCardType($number) {
        foreach (self::$cards as $type => $card) {
            if (preg_match($card['pattern'], $number)) {
                return $type;
            }
        }

        return '';
    }

    protected static function validCard($number, $type) {
        return (self::validPattern($number, $type) && self::validLength($number, $type) && self::validLuhn($number, $type));
    }

    protected static function validPattern($number, $type) {
        return preg_match(self::$cards[$type]['pattern'], $number);
    }

    protected static function validLength($number, $type) {
        foreach (self::$cards[$type]['length'] as $length) {
            if (strlen($number) == $length) {
                return true;
            }
        }

        return false;
    }

    protected static function validCvcLength($cvc, $type) {
        foreach (self::$cards[$type]['cvcLength'] as $length) {
            if (strlen($cvc) == $length) {
                return true;
            }
        }

        return false;
    }

    protected static function validLuhn($number, $type) {
        if (!self::$cards[$type]['luhn']) {
            return true;
        } else {
            return self::luhnCheck($number);
        }
    }

    protected static function luhnCheck($number) {
        $checksum = 0;
        for ($i = (2 - (strlen($number) % 2)); $i <= strlen($number); $i += 2) {
            $checksum += (int) ($number{$i - 1});
        }

        // Analyze odd digits in even length strings or even digits in odd length strings.
        for ($i = (strlen($number) % 2) + 1; $i < strlen($number); $i += 2) {
            $digit = (int) ($number{$i - 1}) * 2;
            if ($digit < 10) {
                $checksum += $digit;
            } else {
                $checksum += ($digit - 9);
            }
        }

        if (($checksum % 10) == 0) {
            return true;
        } else {
            return false;
        }
    }

}

class MP3File extends function_class {

    protected $filename;

    public function __construct($filename) {
        $this->filename = $filename;
    }

    public static function formatTime($duration) { //as hh:mm:ss
        //return sprintf("%d:%02d", $duration/60, $duration%60);
        $hours = floor($duration / 3600);
        $minutes = floor(($duration - ($hours * 3600)) / 60);
        $seconds = $duration - ($hours * 3600) - ($minutes * 60);
        return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    }

    //Read first mp3 frame only...  use for CBR constant bit rate MP3s
    public function getDurationEstimate() {
        return $this->getDuration($use_cbr_estimate = true);
    }

    //Read entire file, frame by frame... ie: Variable Bit Rate (VBR)
    public function getDuration($use_cbr_estimate = false) {
        $fd = fopen($this->filename, "rb");

        $duration = 0;
        $block = fread($fd, 100);
        $offset = $this->skipID3v2Tag($block);
        fseek($fd, $offset, SEEK_SET);
        while (!feof($fd)) {
            $block = fread($fd, 10);
            if (strlen($block) < 10) {
                break;
            }
            //looking for 1111 1111 111 (frame synchronization bits)
            else if ($block[0] == "\xff" && (ord($block[1]) & 0xe0)) {
                $info = self::parseFrameHeader(substr($block, 0, 4));
                if (empty($info['Framesize'])) {
                    return $duration;
                } //some corrupt mp3 files
                fseek($fd, $info['Framesize'] - 10, SEEK_CUR);
                $duration += ( $info['Samples'] / $info['Sampling Rate'] );
            } else if (substr($block, 0, 3) == 'TAG') {
                fseek($fd, 128 - 10, SEEK_CUR); //skip over id3v1 tag size
            } else {
                fseek($fd, -9, SEEK_CUR);
            }
            if ($use_cbr_estimate && !empty($info)) {
                return $this->estimateDuration($info['Bitrate'], $offset);
            }
        }
        return round($duration);
    }

    private function estimateDuration($bitrate, $offset) {
        $kbps = ($bitrate * 1000) / 8;
        $datasize = filesize($this->filename) - $offset;
        return round($datasize / $kbps);
    }

    private function skipID3v2Tag(&$block) {
        if (substr($block, 0, 3) == "ID3") {
            $id3v2_major_version = ord($block[3]);
            $id3v2_minor_version = ord($block[4]);
            $id3v2_flags = ord($block[5]);
            $flag_unsynchronisation = $id3v2_flags & 0x80 ? 1 : 0;
            $flag_extended_header = $id3v2_flags & 0x40 ? 1 : 0;
            $flag_experimental_ind = $id3v2_flags & 0x20 ? 1 : 0;
            $flag_footer_present = $id3v2_flags & 0x10 ? 1 : 0;
            $z0 = ord($block[6]);
            $z1 = ord($block[7]);
            $z2 = ord($block[8]);
            $z3 = ord($block[9]);
            if ((($z0 & 0x80) == 0) && (($z1 & 0x80) == 0) && (($z2 & 0x80) == 0) && (($z3 & 0x80) == 0)) {
                $header_size = 10;
                $tag_size = (($z0 & 0x7f) * 2097152) + (($z1 & 0x7f) * 16384) + (($z2 & 0x7f) * 128) + ($z3 & 0x7f);
                $footer_size = $flag_footer_present ? 10 : 0;
                return $header_size + $tag_size + $footer_size; //bytes to skip
            }
        }
        return 0;
    }

    public static function parseFrameHeader($fourbytes) {
        static $versions = array(
            0x0 => '2.5', 0x1 => 'x', 0x2 => '2', 0x3 => '1', // x=>'reserved'
        );
        static $layers = array(
            0x0 => 'x', 0x1 => '3', 0x2 => '2', 0x3 => '1', // x=>'reserved'
        );
        static $bitrates = array(
            'V1L1' => array(0, 32, 64, 96, 128, 160, 192, 224, 256, 288, 320, 352, 384, 416, 448),
            'V1L2' => array(0, 32, 48, 56, 64, 80, 96, 112, 128, 160, 192, 224, 256, 320, 384),
            'V1L3' => array(0, 32, 40, 48, 56, 64, 80, 96, 112, 128, 160, 192, 224, 256, 320),
            'V2L1' => array(0, 32, 48, 56, 64, 80, 96, 112, 128, 144, 160, 176, 192, 224, 256),
            'V2L2' => array(0, 8, 16, 24, 32, 40, 48, 56, 64, 80, 96, 112, 128, 144, 160),
            'V2L3' => array(0, 8, 16, 24, 32, 40, 48, 56, 64, 80, 96, 112, 128, 144, 160),
        );
        static $sample_rates = array(
            '1' => array(44100, 48000, 32000),
            '2' => array(22050, 24000, 16000),
            '2.5' => array(11025, 12000, 8000),
        );
        static $samples = array(
            1 => array(1 => 384, 2 => 1152, 3 => 1152,), //MPEGv1,     Layers 1,2,3
            2 => array(1 => 384, 2 => 1152, 3 => 576,), //MPEGv2/2.5, Layers 1,2,3
        );
        //$b0=ord($fourbytes[0]);//will always be 0xff
        $b1 = ord($fourbytes[1]);
        $b2 = ord($fourbytes[2]);
        $b3 = ord($fourbytes[3]);

        $version_bits = ($b1 & 0x18) >> 3;
        $version = $versions[$version_bits];
        $simple_version = ($version == '2.5' ? 2 : $version);

        $layer_bits = ($b1 & 0x06) >> 1;
        $layer = $layers[$layer_bits];

        $protection_bit = ($b1 & 0x01);
        $bitrate_key = sprintf('V%dL%d', $simple_version, $layer);
        $bitrate_idx = ($b2 & 0xf0) >> 4;
        $bitrate = isset($bitrates[$bitrate_key][$bitrate_idx]) ? $bitrates[$bitrate_key][$bitrate_idx] : 0;

        $sample_rate_idx = ($b2 & 0x0c) >> 2; //0xc => b1100
        $sample_rate = isset($sample_rates[$version][$sample_rate_idx]) ? $sample_rates[$version][$sample_rate_idx] : 0;
        $padding_bit = ($b2 & 0x02) >> 1;
        $private_bit = ($b2 & 0x01);
        $channel_mode_bits = ($b3 & 0xc0) >> 6;
        $mode_extension_bits = ($b3 & 0x30) >> 4;
        $copyright_bit = ($b3 & 0x08) >> 3;
        $original_bit = ($b3 & 0x04) >> 2;
        $emphasis = ($b3 & 0x03);

        $info = array();
        $info['Version'] = $version; //MPEGVersion
        $info['Layer'] = $layer;
        //$info['Protection Bit'] = $protection_bit; //0=> protected by 2 byte CRC, 1=>not protected
        $info['Bitrate'] = $bitrate;
        $info['Sampling Rate'] = $sample_rate;
        //$info['Padding Bit'] = $padding_bit;
        //$info['Private Bit'] = $private_bit;
        //$info['Channel Mode'] = $channel_mode_bits;
        //$info['Mode Extension'] = $mode_extension_bits;
        //$info['Copyright'] = $copyright_bit;
        //$info['Original'] = $original_bit;
        //$info['Emphasis'] = $emphasis;
        $info['Framesize'] = self::framesize($layer, $bitrate, $sample_rate, $padding_bit);
        $info['Samples'] = $samples[$simple_version][$layer];
        return $info;
    }

    private static function framesize($layer, $bitrate, $sample_rate, $padding_bit) {
        if ($layer == 1)
            return intval(((12 * $bitrate * 1000 / $sample_rate) + $padding_bit) * 4);
        else //layer 2, 3
            return intval(((144 * $bitrate * 1000) / $sample_rate) + $padding_bit);
    }

}
