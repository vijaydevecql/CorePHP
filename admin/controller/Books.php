<?php

define('ROOT_DIR', "/var/www/html/staging/audio_book/admin/");
require_once(ROOT_DIR . "/include/function.php");

class Books extends function_class {

    public function like_book($data) {
        try {
            $query1 = "select * from  `rating` where user_id='" . $data['user_id'] . "' and book_id='" . $data['book_id'] . "'";
            $reuslt = $this->excuite($query1, 'false', 'select');
            if (!empty($reuslt)) {
                throw new Exception("You allready do rating");
            } else {
                $query = "INSERT
		INTO
		`rating`				
		(`" . implode("`, `", array_keys($data)) . "`)
		VALUES
		('" . implode("' , '", $data) . "')";
                $result = $this->excuite($query, 'false', 'insert');
                if ($result) {
                    return Books::get_rating([], $result);
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

    public function make_bookmark($data) {
        try {
            $query1 = "select * from  `bookmarks` where user_id='" . $data['user_id'] . "'and page_no='" . $data['page_no'] . "' and book_id='" . $data['book_id'] . "'";
            $reuslt = $this->excuite($query1, 'false', 'select');
            if (!empty($reuslt)) {
                $query1 = "delete  from  `bookmarks` where user_id='" . $data['user_id'] . "'and page_no='" . $data['page_no'] . "' and book_id='" . $data['book_id'] . "'";
                $reuslt = $this->excuite($query1, 'false', 'delete');
                return false;
            } else {
                $query = "INSERT
		INTO
		`bookmarks`				
		(`" . implode("`, `", array_keys($data)) . "`)
		VALUES
		('" . implode("' , '", $data) . "')";
                $data = $this->excuite($query, 'false', 'insert');
                if ($data) {
                    return true;
                } else {
                    throw new Exception("Server Error ");
                }
            }
        } catch (Exception $e) {
            $status = FAILURE_CODE;
            $body = $e->getMessage();
            $this->response($status, $body);
        }
    }

    public function do_comment($data) {
        $query = "INSERT
		INTO
		`book_comments`				
		(`" . implode("`, `", array_keys($data)) . "`)
		VALUES
		('" . implode("' , '", $data) . "')";
        $result = $this->excuite($query, 'false', 'insert');
        if ($result) {
            return Books::get_singal_comment($data);
        } else {
            return false;
        }
    }

    public function get_comments($data) {
        $query = "select c.*,u.name from book_comments as c join users as u on (c.user_id=u.id) where book_id='" . $data['book_id'] . "'";
        $data = $this->excuite($query, 'true', 'select');
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    private function get_singal_comment($data) {
        $query = "select  c.*,u.name from book_comments as c join users as u on (c.user_id=u.id) where book_id='" . $data['book_id'] . "' and user_id='" . $data['user_id'] . "'";
        $data = $this->excuite($query, 'false', 'select');
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function get_index($data) {
        $query = "select * from book_pdf_index where book_id ='" . $data['book_id'] . "'";
        $data = $this->excuite($query, 'true', 'select');
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function get_rating($data, $id = '') {

        if ($id == '') {
            $query = "select r.*,u.name"
                    . " from rating as r left join users as u on (r.user_id=u.id) "
                    . "where book_id='" . $data['book_id'] . "' ";
            $data1 = $this->excuite($query, 'true', 'select');
            if (!empty($data1)) {
                $data2['comments'] = $data1;
            } else {
                $data2['comments'] = [];
            }
            $q2 = "select IFNULL(round(avg(rating),1),0) as rating,"
                    . "(select count(id) as rating from rating where book_id='" . $data['book_id'] . "' )  as total_count_rating,"
                    . "(select count(id) as rating from rating where book_id='" . $data['book_id'] . "' and rating=1)  as one_rating,"
                    . "(select count(id) as rating from rating where book_id='" . $data['book_id'] . "' and rating=2)  as two_rating,"
                    . "(select count(id) as rating from rating where book_id='" . $data['book_id'] . "' and rating=3)  as three_rating,"
                    . "(select count(id) as rating from rating where book_id='" . $data['book_id'] . "' and rating=4)  as four_rating,"
                    . "(select count(id) as rating from rating where book_id='" . $data['book_id'] . "' and rating=5)  as five_rating"
                    . " from rating where book_id='" . $data['book_id'] . "'";
            $data2['rating'] = $this->excuite($q2, 'false', 'select');
            $data2['rating']['total_review'] = count($data1);
        } else {
            $query = "select r.*,u.name"
                    . " from rating as r left join users as u on (r.user_id=u.id) "
                    . "where r.id='$id' ";
            $data2 = $this->excuite($query, 'false', 'select');
        }

        return $data2;
    }

    public function get_bookmarks($data) {
        $query1 = "select * from  `bookmarks` where user_id='" . $data['user_id'] . "' and book_id='" . $data['book_id'] . "'";
        $reuslt = $this->excuite($query1, 'true', 'select');
        if ($data['type']) {
            $book_mark = [];
            foreach ($reuslt as $value) {
                if (strlen($value))
                    $book_mark[] = $value['page_no'];
            }
            $data = implode(',', $fin);
            $data = (is_null($data)) ? '' : $data;
            return $data;
        }else {
            return $reuslt;
        }
    }

    public function get_book_cat($book_type, $type) {
        if ($type == 1) {
            $qry = "select b.audio_url as ebook_url,b.*,info.publisher,c.catgory_name from books as b join book_info as info on (b.id=info.book_id) join catgory as c on (info.categary_id=c.id) where book_type=$book_type order by c.catgory_name asc";
        } else {
            $qry = "select b.audio_url as ebook_url,b.*,info.publisher from books as b join book_info as info on (b.id=info.book_id) join catgory as c on (info.categary_id=c.id) where book_type=$book_type order by info.publisher asc";
        }
        $data = $this->excuite($qry, 'true', 'select');
        return $data;
    }

    /**
     * 
     * @param type $book_type
     * @param type $limit
     * @param type $page
     * @param type $user_id
     * @param type $search
     * @return type array
     */
    public function get_recent_book($book_type, $limit, $page, $user_id, $search) {
        if ($page > 0) {
            $start = ((($page - 1) * $limit) == 0) ? 0 : (($page - 1) * $limit);
        }
        if ($book_type == 0) {
            $book = "and b.book_type=0";
        } elseif ($book_type == 1) {
            $book = "and b.book_type=1";
        } elseif ($book_type == 2) {
            $book = "and b.book_type=2";
        } else {
            $book = "";
        }
        if ($search != '') {
            $search = "and b.book_name like '%$search%'";
        }
        $qry = "select b.audio_url as ebook_url,b.*,b.id as book_id,info.publisher,c.catgory_name from `recent_view_book` as rc join  books as b on (rc.book_id=b.id) join book_info as info on (b.id=info.book_id) join catgory as c on (info.categary_id=c.id) where rc.user_id=$user_id $search $book  order by c.catgory_name asc  LIMIT $start,$limit";
        $data = $this->excuite($qry, 'true', 'select');
        $condtition = "`recent_view_book` as rc join  books as b on (rc.book_id=b.id) join book_info as info on (b.id=info.book_id) join catgory as c on (info.categary_id=c.id) where rc.user_id=$user_id $search $book";
        $final = [];
        $final['totol_count'] = Books::total_count($condtition);
        $final['data'] = (!empty($data)) ? $data : array();
        return $final;
    }

    /**
     * 
     * @param type $book_type
     * @param type $limit
     * @param type $page
     * @param type $user_id
     * @return type array
     */
    public function get_book_by_title($book_type, $limit, $page, $user_id, $search) {
        if ($page > 0) {
            $start = ((($page - 1) * $limit) == 0) ? 0 : (($page - 1) * $limit);
        }
        if ($book_type == 0) {
            $book = "where b.book_type=0";
        } elseif ($book_type == 1) {
            $book = "where b.book_type=1";
        } elseif ($book_type == 2) {
            $book = "where b.book_type=2";
        } else {
            $book = "";
        }
        if ($search != '') {
            $search = ($book == '') ? "where b.book_name like '%$search%'" : "and b.book_name like '%$search%'";
        }
        $qry = "select b.audio_url as ebook_url,b.*,info.*,c.catgory_name from   books as b  join book_info as info on (b.id=info.book_id) join catgory as c on (info.categary_id=c.id)   $book $search order by b.book_name asc  LIMIT $start,$limit";
        $data = $this->excuite($qry, 'true', 'select');
        $condtition = "books as b  join book_info as info on (b.id=info.book_id) join catgory as c on (info.categary_id=c.id)   $book $search";
        $final = [];
        $final['totol_count'] = Books::total_count($condtition);
        $final['data'] = (!empty($data)) ? $data : array();
        return $final;
    }

    /**
     * 
     * @param type $book_type
     * @param type $limit
     * @param type $page
     * @param type $cat_id
     * @return type array
     */
    public function book_cat($book_type, $limit, $page, $cat_id = '', $search, $book_id = '') {
        if ($page > 0) {
            $start = ((($page - 1) * $limit) == 0) ? 0 : (($page - 1) * $limit);
        }
        /*
         * check the book type
         */
        if ($book_type == 0) {
            $book = "where b.book_type=0";
        } elseif ($book_type == 1) {
            $book = "where b.book_type=1";
        } elseif ($book_type == 2) {
            $book = "where b.book_type=2";
        } else {
            $book = "";
        }
        /*
         * search field check the data
         */
        if ($search != '') {
            if ($cat_id == '') {
                $search = "and c.catgory_name like '%$search%'";
            } else {
                $search = "and b.book_name like '%$search%'";
            }
        }
        if ($book_id != '') {
            $book_id = "and b.id!=$book_id";
        }
        if ($book == '') {
            $categary_id = "where bb.categary_id=$cat_id";
        } else {
            $categary_id = "and bb.categary_id=$cat_id";
        }

        if ($cat_id == '') {
            $qry = "select c.* from catgory as c left join book_info as bb on (c.id=bb.categary_id) join books as b on (bb.book_id=b.id)  $book $search group by c.id  LIMIT $start,$limit";
            $condtition = "catgory as c left join book_info as bb on (c.id=bb.categary_id) join books as b on (bb.book_id=b.id)  $book $search group by c.id";
            $filed = "c.id";
            $type = "true";
        } else {
            $qry = "select IFNULL(author.name,'no name') as author_name,b.*,bb.* from catgory as c join book_info as bb on (c.id=bb.categary_id) join books as b on (bb.book_id=b.id) left join books_auther as author on (author.id=bb.author_id)  $book $search $book_id $categary_id  LIMIT $start,$limit";
            $condtition = "catgory as c join book_info as bb on (c.id=bb.categary_id) join books as b on (bb.book_id=b.id) left join books_auther as author on (author.id=bb.author_id)  $book $search $book_id $categary_id";
            $filed = "";
            $type = "false";
        }
        $final = [];
        $data = $this->excuite($qry, 'true', 'select');
        $final['totol_count'] = Books::total_count($condtition, $filed, $type);
        $final['data'] = (!empty($data)) ? $data : array();
        ;
        return $final;
    }

    /**
     * 
     * @param type $limit
     * @param type $page
     * @param type $admin
     * @return author 
     */
    public function get_all_auther($limit, $page, $admin = '', $book_type = '', $search = '', $top_rated) {
        if ($admin != '') {
            if ($page > 0) {
                $start = ((($page - 1) * $limit) == 0) ? 0 : (($page - 1) * $limit);
            }
            $limit = "LIMIT $start,$limit";
        } else {
            $limit = "";
        }
        if ($search != '') {
            $search = ($top_rated == 1) ? "where author.name like '%$search%'" : "and author.name like '%$search%'";
        }
        if ($book_type == 0) {
            $book = "where b.book_type=0";
        } elseif ($book_type == 1) {
            $book = "where b.book_type=1";
        } elseif ($book_type == 2) {
            $book = "where b.book_type=2";
        } else {
            $book = "";
        }

        if ($book != '') {
            if ($top_rated == 1) {
                $qry = "SELECT  author.* FROM `books_auther` as author  join book_info as info on (author.id = info.author_id) join "
                        . "books as b on (info.book_id = b.id )"
                        . " join rating as r on (r.book_id= b.id)   $search group by author.id order by r.rating desc $limit ";

                $condtition = "`books_auther` as author  join book_info as info on (author.id = info.author_id) join "
                        . "books as b on (info.book_id = b.id )"
                        . "  join rating as r on (r.book_id= b.id)   $search group by author.id";
                $filed = "r.id";
            } else {
                $qry = "SELECT author.* FROM `books_auther` as author  join book_info as info on (author.id = info.author_id) join "
                        . "books as b on (info.book_id = b.id ) $book $search group by author.id order by name asc $limit ";

                $condtition = "`books_auther` as author  join book_info as info on (author.id = info.author_id) join "
                        . "books as b on (info.book_id = b.id ) $book $search group by author.id";
                $filed = "book_id";
            }
            $type = "true";
        } else {
            $qry = "SELECT * FROM `books_auther` order by name asc  $limit ";
            $condtition = "`books_auther`";
            $type = "false";
            $filed = "";
        }
        $final = [];
        $data = $this->excuite($qry, 'true', 'select');
        $final['totol_count'] = Books::total_count($condtition, $filed, $type);
        $final['data'] = (!empty($data)) ? $data : array();
        ;
        return $final;
    }

    public function make_note($data) {
        try {
            $query1 = "select * from  `notes` where user_id='" . $data['user_id'] . "'and page_no='" . $data['page_no'] . "' and book_id='" . $data['book_id'] . "'";
            $reuslt = $this->excuite($query1, 'false', 'select');
            if (!empty($reuslt)) {
                $query1 = "delete  from  `notes` where user_id='" . $data['user_id'] . "'and page_no='" . $data['page_no'] . "' and book_id='" . $data['book_id'] . "'";
                $reuslt = $this->excuite($query1, 'false', 'delete');
                return false;
            } else {
                $query = "INSERT
		INTO
		`notes`				
		(`" . implode("`, `", array_keys($data)) . "`)
		VALUES
		('" . implode("' , '", $data) . "')";
                $data = $this->excuite($query, 'false', 'insert');
                if ($data) {
                    return true;
                } else {
                    throw new Exception("Server Error ");
                }
            }
        } catch (Exception $e) {
            $status = FAILURE_CODE;
            $body = $e->getMessage();
            $this->response($status, $body);
        }
    }

    public function get_notes($data) {
        $query1 = "select * from  `notes` where user_id='" . $data['user_id'] . "' and book_id='" . $data['book_id'] . "'";
        return $reuslt = $this->excuite($query1, 'true', 'select');
    }

    /**
     * 
     * @param type $data
     * @return type array
     */
    public function get_author($data) {
        if ($data['page'] > 0) {
            $start = ((($data['page'] - 1) * $data['limit']) == 0) ? 0 : (($data['page'] - 1) * $data['limit']);
        }
        $limit = $data['limit'];

        if ($data['search'] != '') {
            $search = "and b.book_name like '%" . $data['search'] . "%'";
        }
        if ($data['book_type'] == 0) {
            $book = "and b.book_type=0";
        } elseif ($data['book_type'] == 1) {
            $book = "and b.book_type=1";
        } elseif ($data['book_type'] == 2) {
            $book = "and b.book_type=2";
        } else {
            $book = "";
        }
        $qry = "select  "
                . "IFNULL(aa.name,'NO Name') as author_name,info.*,b.audio_url as ebook_url,b.*,c.catgory_name from books as b join book_info as info on (b.id=info.book_id) join catgory as c on (info.categary_id=c.id)"
                . " left join books_auther as aa on (info.author_id=aa.id) where info.author_id='" . $data['author_id'] . "'"
                . " $book  $search LIMIT $start,$limit";

        /*
         * this will make the condition for get the count
         */
        $condtition = "books as b join book_info as info on (b.id=info.book_id) join catgory as c on (info.categary_id=c.id)"
                . "left join books_auther as aa on (info.author_id=aa.id) where info.author_id='" . $data['author_id'] . "'"
                . " $book $search";

        $data = $this->excuite($qry, 'true', 'select');
        $final = [];
        $final['totol_count'] = Books::total_count($condtition);
        $final['data'] = (!empty($data)) ? $data : array();
        return $final;
    }

    /**
     * 
     * @param type $data
     * @return boolean
     */
    public function payment($data) {
        $query1 = "
		INSERT
		INTO
                      `payments`
		(`" . implode("`, `", array_keys($data)) . "`)
		VALUES
		('" . implode("' , '", $data) . "')";

        $data1 = $this->excuite($query1, 'false', 'insert');
        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    public function get_Payments_books($book_type, $limit, $page, $user_id, $search = '') {
        if ($page > 0) {
            $start = ((($page - 1) * $limit) == 0) ? 0 : (($page - 1) * $limit);
        }
        if ($book_type == 0) {
            $book = "and b.book_type=0";
        } elseif ($book_type == 1) {
            $book = "and b.book_type=1";
        } elseif ($book_type == 2) {
            $book = " and b.book_type=2";
        } else {
            $book = "";
        }
        if ($search != '') {
            $search = "and b.book_name like '%$search%'";
        }

        $qry = "select 1 as is_modified,1 as is_paid_user, b.audio_url as ebook_url,b.*,info.publisher,c.catgory_name,b.id as book_id from   books as b  join book_info as info on (b.id=info.book_id) join catgory as c on (info.categary_id=c.id) join payments as p on (p.book_id = b.id) where p.user_id=$user_id   $book $search order by b.book_name asc  LIMIT $start,$limit";
        $data = $this->excuite($qry, 'true', 'select');
        $condtition = "books as b  join book_info as info on (b.id=info.book_id) join catgory as c on (info.categary_id=c.id) join payments as p on (p.book_id = b.id) where p.user_id=$user_id   $book $search";
        $final = [];
        $final['totol_count'] = Books::total_count($condtition);
        $final['data'] = (!empty($data)) ? $data : array();
        if (!empty($final['data'])) {
            foreach ($final['data'] as $key => $value) {
                $data1 = array();
                $data1['boo_id'] = $value['book_id'];
                $data1['user_id'] = $user_id;
                $data1['type'] = 1;
                $final['data'][$key]['bookmark'] = $this->get_bookmarks($data1);
            }
        }
        return $final;
    }

    public function featured_books($book_type, $limit, $page, $user_id, $search = '') {
        if ($page > 0) {
            $start = ((($page - 1) * $limit) == 0) ? 0 : (($page - 1) * $limit);
        }
        if ($book_type == 0) {
            $book = "and b.book_type=0";
        } elseif ($book_type == 1) {
            $book = "and b.book_type=1";
        } elseif ($book_type == 2) {
            $book = " and b.book_type=2";
        } else {
            $book = "";
        }
        if ($search != '') {
            $search = "and b.book_name like '%$search%'";
        }

        $qry = "select b.id as book_id,1 as is_paid_user, b.audio_url as ebook_url,b.*,info.publisher,c.catgory_name from   books as b  join book_info as info on (b.id=info.book_id) join catgory as c on (info.categary_id=c.id)  where b.featured=1   $book $search order by b.book_name asc  LIMIT $start,$limit";
        $data = $this->excuite($qry, 'true', 'select');
        $condtition = "books as b  join book_info as info on (b.id=info.book_id) join catgory as c on (info.categary_id=c.id)  where b.featured=1  $book $search";
        $final = [];
        $final['totol_count'] = Books::total_count($condtition);
        $final['data'] = (!empty($data)) ? $data : array();
        return $final;
    }

    /**
     * 
     * @param int $book_id
     * @param int $limit
     * @param int $page
     * @return array
     * 
     */
    public function get_all_audio($book_id, $limit, $page) {
        if ($page > 0) {
            $start = ((($page - 1) * $limit) == 0) ? 0 : (($page - 1) * $limit);
        }
        $qry = "select book_audio.*,books.book_name,books.book_type from book_audio join books on (book_audio.book_id=books.id) where book_id=$book_id and type=0 LIMIT $start,$limit";
        $data = $this->excuite($qry, 'true', 'select');
        $condtition = "book_audio where book_id=$book_id and type=0";
        $final = [];
        $final['totol_count'] = Books::total_count($condtition);
        $final['data'] = (!empty($data)) ? $data : array();
        return $final;
    }

    /**
     * 
     * @param int $book_id
     * @param int $limit
     * @param int $page
     * @return array
     */
    public function get_index1($book_id, $limit, $page) {
        if ($page > 0) {
            $start = ((($page - 1) * $limit) == 0) ? 0 : (($page - 1) * $limit);
        }
        $qry = "select * from book_index where book_id=$book_id order by index_no asc LIMIT $start,$limit";
        $data = $this->excuite($qry, 'true', 'select');
        $condtition = "book_index where book_id=$book_id";
        $final = [];
        $final['totol_count'] = Books::total_count($condtition);
        $final['data'] = (!empty($data)) ? $data : array();
        return $final;
    }

}
