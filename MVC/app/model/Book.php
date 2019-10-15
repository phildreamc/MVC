<?php
class Book extends Model{
    public function __construct(){
        parent::__construct();
	}
    
    public function books() {
        $key = 'bookList';
        if ($data = Cache::get($key)) {
            
        }else {
            $book_info = $this->get(array('book_id', 'book_name', 'book_pic', 'book_type', 'book_author'))->cache();
            $info = new Info();
            $book_status = $info->get(array('book_id', 'book_count', 'book_status', 'book_owner', 'book_bt', 'book_at'))->cache();
            $data = array();
            foreach($book_status as $key => $value) {
                $data[$key] = array_merge($book_info[$key], $value);
            }
            Cache::set($key, serialize($data));
        }
        
        return $data;
    }
    
    public function getById($book_id) {
        $data = $this->books();
        foreach ($data as $key => $value) {
            if ($value['book_id'] == $book_id) {
                return $value;
            }
        }
        return FAlSE;
    }
    
    public function getByName($user_name) {
        $data = $this->books;
        $arr = array();
        foreach ($data as $key => $value) {
            if ($value['book_owner'] == $user_name) {
                $arr[] = $value;
            }
        }
        return $arr;
    }
}