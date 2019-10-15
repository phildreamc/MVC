<?php
class BookList extends Controller {
    function index() {
        $this->display();
    }
    
    function books() {
        $book = new Book();
        $books = $book->books();
        $this->assign('data', $books);
        $this->display('books');
    }
}