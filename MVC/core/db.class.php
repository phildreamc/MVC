<?php 
class DB {
    protected static $dbhost = DB_HOST;
    protected static $dbuser = DB_USER;
    protected static $dbpwd = DB_PASS;
    protected static $dbname = DB_NAME;
    protected static $dbpre = DB_NAME;
    protected static $db;
    protected $con;
    
    function __construct() {
        $this->con = new mysqli(self::$dbhost, self::$dbuser, self::$dbpwd, self::$dbname);
        $this->con->query("set names utf8");
    }
    
    public static function getDb() {
        if (!is_object(self::$db)) {
            self::$db = new DB();
        }
        return self::$db;
    }
    
    public static function query($q) {
        $result = mysqli_query(self::getDb()->con, $q);
        return $result;
    }

    // function getPersonalUse($name) {
        // $use = 0;
        // $result  = $this->getPersonal($name);
        // while($row=$result->fetch_array()){
            // $datetime_start = new DateTime($row['start_time']);
            // $datetime_end = new DateTime($row['end_time']);
            // $day = $datetime_start->diff($datetime_end)->days;
            // $days = intval($day)+1;
            // $use += $days;
        // }
        // return $use;
    // }
    
    function __destruct() {
        mysqli_close(self::getDb()->con);
    }
}
?>