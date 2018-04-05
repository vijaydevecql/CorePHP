<?php

define('ROOT_DIR', "/var/www/html/staging/audio_book/admin/");
require_once(ROOT_DIR . "/include/function.php");

class login extends function_class {

    public function function_login($email, $password) {

        $password = self::pass($password);
        $query1 = "SELECT * FROM " . USER . " WHERE (email = '$email' AND password = '$password') and ( user_type=1 or user_type=0) ";


        return $data = $this->excuite($query1, 'false', 'select');
    }

    public function admin_detail() {
        $qry = "select * from " . ADMIN . " where id='" . $_SESSION['admin_id'] . "'";
        return $this->excuite($qry, 'false', 'select');
    }

    public function totoluser() {


        $qry = "select count(*) as total from " . USER . " where user_type=3";
        $data = $this->excuite($qry, 'false', 'select');

        return $data['total'];
    }

    public function totolorg() {


        $qry = "select count(*) as total from " . USER . " where user_type=1";
        $data = $this->excuite($qry, 'false', 'select');

        return $data['total'];
    }

    public function totolemployee() {


        $qry = "select count(*) as total from " . USER . " where user_type=2 and under_org='" . $_SESSION['user_id'] . "'";
        $data = $this->excuite($qry, 'false', 'select');

        return $data['total'];
    }

    public function totalevent() {


        $qry = "select count(*) as total from cr_event where event_owner='" . $_SESSION['user_id'] . "'";
        $data = $this->excuite($qry, 'false', 'select');

        return $data['total'];
    }

    public function getalluser() {
        $qry = "select * from users ";
        return $data = $this->excuite($qry, 'true', 'select');
    }

    public function getallcat() {
        $qry = "select * from catgory order by id desc";
        return $data = $this->excuite($qry, 'true', 'select');
    }

    public function addcat($data) {
        $qry = "insert into  catgory set catgory_name='" . $data . "', created='" . time() . "'";
        return $data = $this->excuite($qry, 'false', 'insert');
    }

    public function getallbook($type, $limit = '', $page = '', $search = '') {

        if ($page > 0) {
            $start = ((($page - 1) * $limit) == 0) ? 0 : (($page - 1) * $limit);
        }
        if ($type == 0) {
            $type = "book_type=$type";
        }if ($type == 1) {
            $type = "book_type=$type";
        }if ($type == 2) {
            $type = "book_type=$type";
        }if ($type == 3) {
            $type = "";
        }
        if ($limit == '') {
            $limit = '';
        } else {
            $limit = "LIMIT $start,$limit";
        }
        if ($search != '') {
            $search = "and b.book_name like '%$search%'";
        }
        $qry = "select info.*,b.audio_url as ebook_url,b.*,c.catgory_name from books as b join book_info as info on (b.id=info.book_id) join catgory as c on (info.categary_id=c.id) where $type $search order by b.id desc $limit";
        $data = $this->excuite($qry, 'true', 'select');
        if ($type == 1 || $type == 2) {
            foreach ($data as $k => $value) {
                $qry1 = "select * from book_audio where book_id=" . $value['id'];
                $data1 = $this->excuite($qry1, 'true', 'select');
                if (!empty($data1)) {
                    $data[$k]['audio_urls'] = $data1;
                } else {
                    $data[$k]['audio_urls'] = [];
                }
            }
        }
        $condtition = "books as b join book_info as info on (b.id=info.book_id) join catgory as c on (info.categary_id=c.id) where $type $search";
        $final = [];
        $final['totol_count'] = login::total_count($condtition);
        $final['data'] = (!empty($data)) ? $data : array();
        return $final;
    }

    public function singalbook($id) {
        $qry = "select info.*,b.*,c.catgory_name from books as b join book_info as info on (b.id=info.book_id) join catgory as c on (info.categary_id=c.id) where  b.id=$id order by b.id desc";
        return $data = $this->excuite($qry, 'false', 'select');
    }

    public function addbook($data) {

        $qry = "insert into  books set book_name='" . $data['book_name'] . "', "
                . "description='" . $data['description'] . "',"
                . "book_type='" . $data['book_type'] . "',"
                . "is_paid='" . $data['is_paid'] . "',"
                . "audio_url='" . $data['audio_url'] . "',"
                . "price='" . $data['price'] . "',"
                . "image='" . $data['image'] . "',"
                . "created='" . time() . "'";
        $last_id = $this->excuite($qry, 'false', 'insert');

        /*         * ***** book info add************** */

        $qry1 = "insert into  book_info set book_id='" . $last_id . "', "
                . "language='" . $data['language'] . "',"
                . "categary_id='" . $data['categary_id'] . "',"
                . "publisher='" . $data['publisher'] . "',"
                . "publish_date='" . $data['publish_date'] . "',"
                . "size='" . $data['size'] . "',"
                . "seller_name='" . $data['seller_name'] . "',"
                . "author_id='" . $data['author_id'] . "',"
                . "length_print='" . $data['length_print'] . "',"
                . "created='" . time() . "'";
        $data1 = $this->excuite($qry1, 'false', 'insert');

        foreach ($data['book_audio'] as $k => $value) {
            $qry1 = "insert into  book_audio set book_id='" . $last_id . "', "
                    . "audio_url='" . $value . "',"
                    . " duration='" . $data['duration'][$k] . "' , "
                    . "created='" . time() . "'";
            $data1 = $this->excuite($qry1, 'false', 'insert');
        }
        if ($data['sample_url'] != '') {
            $qry1 = "insert into  book_audio set book_id='" . $last_id . "', "
                    . "audio_url='" . $data['sample_url'] . "',"
                    . "type=1,"
                    . "created='" . time() . "'";
            $data1 = $this->excuite($qry1, 'false', 'insert');
        }

        return $data['book_type'];
    }

    public function update_book($data) {
        $qry = "update  books set book_name='" . $data['book_name'] . "', "
                . "description='" . $data['description'] . "',"
                . "book_type='" . $data['book_type'] . "',"
                . "is_paid='" . $data['is_paid'] . "',"
                . "audio_url='" . $data['audio_url'] . "',"
                . "price='" . $data['price'] . "',"
                . "image='" . $data['image'] . "',"
                . "created='" . time() . "' where id='" . $data['id'] . "'";
        $last_id = $this->excuite($qry, 'false', 'update');

        /*         * ***** book info add************** */

        $qry1 = "update  book_info set "
                . "language='" . $data['language'] . "',"
                . "categary_id='" . $data['categary_id'] . "',"
                . "publisher='" . $data['publisher'] . "',"
                . "publish_date='" . $data['publish_date'] . "',"
                . "size='" . $data['size'] . "',"
                . "seller_name='" . $data['seller_name'] . "',"
                . "length_print='" . $data['length_print'] . "',"
                . "created='" . time() . "' where book_id='" . $data['id'] . "'";
        $data1 = $this->excuite($qry1, 'false', 'update');

        return $data['book_type'];
    }

    public function totaluser() {
        $qry = "select count(id) as total from users ";
        $data = $this->excuite($qry, 'false', 'select');
        return $data['total'];
    }

    public function totalbook() {
        $qry = "select count(id) as total from books ";
        $data = $this->excuite($qry, 'false', 'select');
        return $data['total'];
    }

    public function simplebook() {
        $qry = "select count(id) as total from books where book_type =0 ";
        $data = $this->excuite($qry, 'false', 'select');
        return $data['total'];
    }

    public function audiobook() {
        $qry = "select count(id) as total from books where book_type =1";
        $data = $this->excuite($qry, 'false', 'select');
        return $data['total'];
    }

    public function verifie($data) {
        $qry = "update users set status='" . $data['status'] . "' WHERE id='" . $data['id'] . "'";
        $del = $this->excuite($qry, 'false', 'update');
    }

    public function getcat_Count() {
        $qry = "select count(id) as total from catgory ";
        $data = $this->excuite($qry, 'false', 'select');
        return $data['total'];
    }

    public function paid_books($type, $book_type = 0, $page = '', $limit = '', $search = '', $is_admin = 0) {
        if ($book_type == 0) {
            $book_type = "and book_type=0";
        } elseif ($book_type == 1) {
            $book_type = "and book_type=1";
        } elseif ($book_type == 2) {
            $book_type = "and book_type=2";
        } else {
            $book_type = "";
        }
        if ($limit != '') {
            if ($page > 0) {
                $start = ((($page - 1) * $limit) == 0) ? 0 : (($page - 1) * $limit);
            }
            $limit = "LIMIT $start,$limit";
        } else {
            $limit = "";
        }
        if ($search != '') {
            $search = "and b.book_name like '%$search%'";
        }
        $qry = "select info.*,b.*,c.catgory_name from books as b join book_info as info on (b.id=info.book_id) join catgory as c on (info.categary_id=c.id) where is_paid=$type $book_type $search order by b.id desc $limit";
        /*
         * this will make the condition for get the count
         */
        $condtition = "books as b join book_info as info on (b.id=info.book_id) join catgory as c on (info.categary_id=c.id) where is_paid=$type $search $book_type";
        $data = $this->excuite($qry, 'true', 'select');
        $final = [];
        $final['totol_count'] = login::total_count($condtition);
        $final['data'] = (!empty($data)) ? $data : array();
        return $final;
    }

    public function free_books() {
        
    }

    public function getall_book() {
        $qry = "select info.*,b.audio_url as ebook_url,b.*,c.catgory_name from books as b join book_info as info on (b.id=info.book_id) join catgory as c on (info.categary_id=c.id) where book_type=1 order by b.id desc LIMIT 8";
        $data['audio_books'] = $this->excuite($qry, 'true', 'select');
        if ($type == 1 || $type == 2) {
            foreach ($data['audio_books'] as $k => $value) {
                $qry1 = "select * from book_audio where book_id=" . $value['id'];
                $data1 = $this->excuite($qry1, 'true', 'select');
                if (!empty($data1)) {
                    $data['audio_books'][$k]['audio_urls'] = $data1;
                } else {
                    $data['audio_books'][$k]['audio_urls'] = [];
                }
            }
        }
        $qry = "select info.*,b.audio_url as ebook_url,b.*,c.catgory_name from books as b join book_info as info on (b.id=info.book_id) join catgory as c on (info.categary_id=c.id) where book_type=0 order by b.id desc LIMIT 8";
        $data['ebooks'] = $this->excuite($qry, 'true', 'select');
        return $data;
    }

    public function getaudio_book($type) {
        if ($type == 0) {
            $type = "and book_type=$type";
        }if ($type == 1) {
            $type = "and book_type=$type";
        }if ($type == 2) {
            $type = "";
        }
        $qry = "select info.*,b.audio_url as ebook_url,b.*,c.catgory_name from books as b join book_info as info on (b.id=info.book_id) join catgory as c on (info.categary_id=c.id) where is_paid=0 $type order by b.id desc LIMIT 10";
        $data['free_book'] = $this->excuite($qry, 'true', 'select');
        if ($type == 1 || $type == 2) {
            foreach ($data['audio_books'] as $k => $value) {
                $qry1 = "select * from book_audio where book_id=" . $value['id'];
                $data1 = $this->excuite($qry1, 'true', 'select');
                if (!empty($data1)) {
                    $data['audio_books'][$k]['audio_urls'] = $data1;
                } else {
                    $data['audio_books'][$k]['audio_urls'] = [];
                }
            }
        }
        $qry = "select info.*,b.audio_url as ebook_url,b.*,c.catgory_name from books as b join book_info as info on (b.id=info.book_id) join catgory as c on (info.categary_id=c.id) where is_paid=1 $type order by b.id desc LIMIT 10";
        $data['paid_book'] = $this->excuite($qry, 'true', 'select');
        if (empty($data['paid_book'])) {
            $data['paid_book'] = [];
        }if (empty($data['free_book'])) {
            $data['free_book'] = [];
        }
        return $data;
    }

    public function get_singal_book_details($book_id, $user_id = 0, $modified = '') {

        $qry = "select round(IFNULL((select avg(rating) as rating from rating where book_id='$book_id'),0),1) as rating "
                . ",(select count(*) from payments where book_id = $book_id and user_id = $user_id) as is_paid_user "
                . ",IFNULL((select count(id) as rating from rating where book_id='$book_id'),0) as total_people_rating"
                . ",IFNULL(aa.name,'NO Name') as author_name,info.*,b.audio_url as ebook_url,b.*,c.catgory_name from books as b join book_info as info on (b.id=info.book_id) left join catgory as c on (info.categary_id=c.id)"
                . " left join books_auther as aa on (info.author_id=aa.id) where b.id='$book_id' ";
        $data = $this->excuite($qry, 'false', 'select');

        if ($modified != '') {
            $data['is_modified'] = $this->check_edit($book_id, $data['book_type'], $modified);
            $data['modified_time'] = $this->modified_time($book_id, $data['book_type'], $modified);
        }
        if ($data['modified_time'] == 0) {
            $data['modified_time'] = $data['created'];
        }
        if ($data['modified_time'] == $modified) {
            $data['is_modified'] = 0;
        }
        $query1 = "select page_no from  `bookmarks` where user_id='" . $user_id . "' and book_id='" . $book_id . "'";
        $reuslt = $this->excuite($query1, 'true', 'select');
        foreach ($reuslt as $value) {
            $fin[] = $value['page_no'];
        }
        $data['bookmark'] = implode(',', $fin);
        $data['bookmark'] = (is_null($data['bookmark'])) ? '' : $data['bookmark'];

        if ($data['book_type'] == 1 || $data['book_type'] == 2) {
            $qry1 = "select * from book_audio where book_id=" . $data['id'];
            $data1 = $this->excuite($qry1, 'true', 'select');
            if (!empty($data1)) {
                $data['audio_urls'] = $data1;
            } else {
                $data['audio_urls'] = [];
            }
        }
        if ($modified != '') {
            unset($data['audio_urls']);
        }
        return $data;
    }

    public function recent_book($data) {
        unset($data['modified']);
        try {
            $query1 = "select * from  `recent_view_book` where user_id='" . $data['user_id'] . "' and book_id='" . $data['book_id'] . "'";
            $reuslt = $this->excuite($query1, 'false', 'select');
            if (!empty($reuslt)) {
                $query = "update `recent_view_book` set created='" . time() . "' where user_id='" . $data['user_id'] . "' and book_id='" . $data['book_id'] . "' ";
                $reuslt = $this->excuite($query, 'false', 'select');
            } else {
                $query = "INSERT
		INTO
		`recent_view_book`				
		(`" . implode("`, `", array_keys($data)) . "`)
		VALUES
		('" . implode("' , '", $data) . "')";
                $result = $this->excuite($query, 'false', 'insert');
                if ($result) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (Exception $e) {
            $status = FAILURE_CODE;
            $body = $e->getMessage();
            $this->response($status, $body);
        }
    }

    public function getallauther() {
        $query = "select a.*,admin.status from books_auther a left join admin on (a.admin_id=admin.id) order by id desc";
        return $result = $this->excuite($query, 'true', 'select');
    } 
	
	public function get_auther_id($id) {
        $query = "select * from books_auther where admin_id=$id ";
        return $result = $this->excuite($query, 'false', 'select');
    }

    public function add_auther($data) {
        $query1 = "
		INSERT
		INTO
		`books_auther`				
		(`" . implode("`, `", array_keys($data)) . "`)
		VALUES
		('" . implode("' , '", $data) . "')";

        $data1 = $this->excuite($query1, 'false', 'insert');
    }

    /*
     * admin author 
     */

    public function get_auther() {
        $qry = "SELECT * FROM `books_auther` order by name asc  ";
        return $this->excuite($qry, 'true', 'select');
    }

    public function get_index_books($book_id) {
        $qry = "SELECT * FROM `book_index` where book_id=$book_id";
        return $this->excuite($qry, 'true', 'select');
    }

    /**
     * this function is check book updated or not 
     * @param int $book_id
     * @param int $type
     * @param int $time
     * @return int
     */
    private function check_edit($book_id, $type, $time) {
        $check = "select * from update_books where book_id='$book_id' and type='$type' and created= '$time'";
        $result = $this->excuite($check, 'false', 'select');
        if (empty($result)) {
            return 1;
        } else {
            return 0;
        }
    }

    private function modified_time($book_id, $type, $time) {
        $check = "select * from update_books where book_id='$book_id' and type='$type' and created= '$time'";
        $result = $this->excuite($check, 'false', 'select');
        if (empty($result)) {
            return 0;
        } else {
            return $result['created'];
        }
    }

}
