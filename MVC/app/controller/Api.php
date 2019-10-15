<?php
class Api extends Controller{
    public function __construct(){
        parent::__construct();
	}
    
    function apply($book_id){
        $user_name = 'test';
        // die($book_id);
        // session_start();
        // $user_name = $_SESSION['name'];
        $book = new Book();
        if ($info = $book->getById($book_id)) {
            if (!$info['book_owner'] && $book->update(array('book_status' => '申请中', 'book_owner' => $user_name, 'book_bt' => date("Y/m/d", time())), array('book_id' => intval($book_id)), 'info')) {
                Cache::clean();
                $result = array('code'=>'200','message' =>'success');
                echo json_encode($result);
                return;
            }
        }
        
        $result = array('code'=>'500','message' =>'erro');
        echo json_encode($result);
        return;
    }
}