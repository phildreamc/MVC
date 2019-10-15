<?php
class Info extends Model{
    public function __construct(){
        parent::__construct();
	}
    
    public function info() {
        $book_status = $this->get(array('book_id', 'book_count', 'book_status', 'book_owner', 'book_bt', 'book_at'))->cache();
        return $book_status;
    }
}