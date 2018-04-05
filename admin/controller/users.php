<?php

define('ROOT_DIR', "/var/www/html/staging/audio_book/admin/");
require_once(ROOT_DIR . "/include/function.php");

class Users extends function_class {

    public function Register($data) {
        $query1 = "
		INSERT
		INTO
		" . USER . "				
		(`" . implode("`, `", array_keys($data)) . "`)
		VALUES
		('" . implode("' , '", $data) . "')";

        $data1 = $this->excuite($query1, 'false', 'insert');
        if ($data1) {
            $mail = [];
            $mail['to'] = $data['email'];
            $mail['from'] = 'Admin <admin@apphinge.com>';
            $mail['subject'] = 'Verfication Code | ' . date('M d Y H:i:s');
            $mail['body'] = 'verfication code of USER account is  | ' . $data['otp'] . ' ' . date('M d Y H:i:s');
            $Email = $this->sendmail($mail);
            return true;
        } else {
            return false;
        }
    }

    public function login($data) {
        try {
            $query1 = "select * from " . USER . " where email='" . $data['email'] . "' and password='" . $data['password'] . "'";
            $data1 = $this->excuite($query1, 'false', 'select');
            if (empty($data1)) {
                throw new Exception("wromg Email or password");
            } else {
                if ($data1['status'] == 0) {
                    $status = SUCCESS_CODE;
                    $body = $this->userinfo($data1['authorization_key']);
                    $this->response($status, $body);
                } else {
					//die('check');
                    $query1 = "update " . USER . " set authorization_key='" . $data['authorization_key'] . "',device_type='" . $data['device_type'] . "',device_token='" . $data['device_token'] . "' where email='" . $data['email'] . "' and password='" . $data['password'] . "'";
                   // die('check');
					$data2 = $this->excuite($query1, 'false', 'update');
                    return $this->userinfo($data['authorization_key']);
                }
            }
        } catch (Exception $e) {
            $status = FAILURE_CODE;
            $body = $e->getMessage();
            $this->response($status, $body);
        }
    }

    private function userinfo($authorization_key, $user_id = '') {
        try {
            if ($user_id == '') {
                $query1 = "select * from " . USER . " where authorization_key='$authorization_key'";
            } else {
                $query1 = "select * from " . USER . " where id='$user_id'";
            }
            $data = $this->excuite($query1, 'false', 'select');

            $is_perchased = "select * from payments where user_id ='" . $data['id'] . "'";
            $is_perchased = $this->excuite($is_perchased, 'false', 'select');
            if (empty($is_perchased)) {
                $data['is_perchased'] = "0";
            } else {
                $data['is_perchased'] = "1";
            }
            unset($data['password']);
            unset($data['device_type']);
            unset($data['device_token']);
            unset($data['otp']);
            unset($data['created']);
            return $data;
        } catch (Exception $e) {
            $status = FAILURE_CODE;
            $body = $e->getMessage();
            $this->response($status, $body);
        }
    }

    public function forgotpassword($data) {
        try {
            $new_password = $this->genrate_Otp(4);
            //$password = $this->pass($new_password);
            $query1 = "update " . USER . " set otp='$new_password' where email='" . $data['email'] . "'";
            $data2 = $this->excuite($query1, 'false', 'update');
            if ($data2) {

                $mail = [];
                $mail['to'] = $data['email'];
                $mail['from'] = 'Admin <admin@apphinge.com>';
                $mail['subject'] = 'change Password Request | ' . date('M d Y H:i:s');
                $mail['body'] = 'otp is   | ' . $new_password . ' ' . date('M d Y H:i:s');
                $Email = $this->sendmail($mail);
                $key = $this->get_details_email($data['email']);

                return $key['authorization_key'];
            } else {
                throw new Exception('Email is not Register');
            }
        } catch (Exception $e) {
            $status = FAILURE_CODE;
            $body = $e->getMessage();
            $this->response($status, $body);
        }
    }

    public function match_otp($data) {
        try {
            $query1 = "select * from " . USER . " where id='" . $data['user_id'] . "'";
            $data1 = $this->excuite($query1, 'false', 'select');
            if ($data['otp'] != $data1['otp']) {
                throw new Exception('Wrong Otp');
            } else {
                $query1 = "update " . USER . " set status=1,device_type='" . $data['device_type'] . "',device_token='" . $data['device_token'] . "' where authorization_key='" . $data1['authorization_key'] . "'";
                $data2 = $this->excuite($query1, 'false', 'update');
                return $this->userinfo($data1['authorization_key']);
            }
        } catch (Exception $e) {
            $status = FAILURE_CODE;
            $body = $e->getMessage();
            $this->response($status, $body);
        }
    }

    public function resendotp($data) {
        $query1 = "select * from " . USER . " where id='" . $data['user_id'] . "'";
        $data1 = $this->excuite($query1, 'false', 'select');
        if ($data1) {
            $mail = [];
            $mail['to'] = $data1['email'];
            $mail['from'] = 'Admin <admin@apphinge.com>';
            $mail['subject'] = 'change Password Request | ' . date('M d Y H:i:s');
            $mail['body'] = 'otp is   | ' . $data1['otp'] . ' ' . date('M d Y H:i:s');
            $Email = $this->sendmail($mail);
            return true;
        } else {
            return false;
        }
    }

    public function new_password($data) {
        try {
            $password = $this->pass($data['new_password']);
            $query1 = "update " . USER . " set password='$password' where id='" . $data['user_id'] . "'";
            $data2 = $this->excuite($query1, 'false', 'update');
            return $this->userinfo('no_key', $data['user_id']);
        } catch (Exception $e) {
            $status = FAILURE_CODE;
            $body = $e->getMessage();
            $this->response($status, $body);
        }
    }

    public function get_details_email($email) {
        $query1 = "select * from " . USER . " where email='" . $email . "'";
        return $data1 = $this->excuite($query1, 'false', 'select');
    }

}

?>
