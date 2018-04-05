<?php 

error_reporting(1);

header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Origin: *');


//important config
define("INCLUDE", "http://example.com/api/");
define("PATH", "http://example.com"); 
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWD', 'password');
define('DB_NAME', 'dbname');
define("BASE_HTTP_BASE_URL"   , "http://exapmel.com/admin/ajax/");

define("BASE_HTTP_URL"        , BASE_HTTP_BASE_URL."api/Modules/v1/");
 
define("BASE_SERVER_URL" , dirname(dirname(__FILE__)));

define("APP_NAME" ,'car_show');

define("SECURITY_KEY" ,'car_show');

define("MAIL_FROM_EMAIL" ,'admin@'.APP_NAME.'.com');

define("SUCCESS_CODE"  , "200");

define("FAILURE_CODE"  , "403");

define("DEFAULT_IMAGE"  ,'upload/defaultProfileImage.png');

define("SECURE_STRING","asdcgd23sd_#F4s");

define("PROXIMITY_RANGE","20");

define("GOOGLE_API_KEY", "AIzaSyB4IjaOapm8uuX8NMajf1UKP7zZ5jIKozg"); // Place your Google API Key





//database  configration 
//

define("ADMIN", "admin");
define("USER", "users");


?>
