<?php
class Test extends Controller {
    function index() {
        $user = new User();
        $data = $user->get(array('id'))->cache();
        var_dump($data);
    }
}