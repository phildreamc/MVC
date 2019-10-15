<?php
class Model {
    
    var $table;
    var $sql;
    
    public function __construct() {
        $this->table = DB_NAME.'_'.strtolower(get_called_class());
	}
    
    public function get($param) {
        $get = implode(",", $param);
        $this->sql = "select ".$get." from ".$this->table;
        return $this;
    }
    
    public function where($param) {
        $this->sql .= ' where ';
        $arr = $this->param($param);
        $w = implode(" and ", $arr);
        $this->sql .= $w;
        return $this;
    }
    
    public function save($param) {
        $this->sql = 'insert into '.$this->table;
        $p = array();
        $i = array();
        foreach($param as $key => $value) {
            $p[] = $key;
            $i[] = is_int($value) ? $value : "'".$value."'";
        }
        $this->sql .= " (".implode(",", $p).")";
        $this->sql .= ' values ';
        $this->sql .= "(".implode(",", $i).")";
        return DB::query($this->sql);
    }
    
    public function update($param, $condition, $table = '') {
        $table = $table == '' ? $this->table : DB_NAME.'_'.strtolower($table);
        $this->sql = "update ".$table." set ";
        $arr = $this->param($param);
        $w = implode(",", $arr);
        $this->sql .= $w;
        $this->where($condition);
        return DB::query($this->sql);
    }
    
    public function del($param) {
        $this->sql = "delete from ".$this->table;
        $this->where($param);
        return DB::query($this->sql);
    }
    
    public function cache() {
        if ($data = Cache::get($this->sql)) {
            return $data;
        }
        $arr = $this->find();
        Cache::set($this->sql, serialize($arr));
        return $arr;
    }
    
    public function find() {
        $arr = array();
        $id = 0;
        $result = DB::query($this->sql);
        while($row = $result->fetch_array()){
            $arr[$id] = array();
            foreach($row as $key => $value) {
                $arr[$id][$key] = $value;
            }
            $id += 1;
        }
        return $arr;
    }
    
    public function param($param) {
        $arr = array();
        foreach($param as $key => $value) {
            $str = $key."=";
            if (is_int($value)) {
                $str .= $value;
            }else {
                $str .= "'".$value."'";
            }
            $arr[] = $str;
        }
        return $arr;
    }
}