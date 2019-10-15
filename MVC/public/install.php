<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

require_once('../config/config.php');
require_once('../core/db.class.php');

$sql1 = <<<SQL1

create table if not exists `phil_book`(
    `book_id` int unsigned auto_increment,
    `book_pic` varchar(50) not null,
    `book_type` varchar(40) not null,
    `book_author` varchar(40) not null,
    PRIMARY KEY ( `book_id` )
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

SQL1;

$sql2 = <<<SQL2

create table if not exists `phil_info`(
    `book_id` int not null,
    `book_count` int not null,
    `book_status` varchar(10) not null,
    `book_owner` varchar(40),
    `book_bt` DATE,
    `book_at` DATE,
    PRIMARY KEY ( `book_id` )
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

SQL2;

if (is_file('install.lock')) {
    die('test');
}

if (DB::query($sql1) && DB::query($sql2)) {
    echo '安装成功~！';
}else {
    die('建表失败！！');
}