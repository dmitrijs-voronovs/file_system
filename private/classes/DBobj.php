<?php 
namespace Classes;

class DBobj {
    protected static $db_table;
    protected static $database;
    protected $PK;
    protected $fields = [];
    
    public function __construct($args = [])
    {
        foreach($this->fields as $field){
            $this->$field = $args[$field] ?? ''; 
        }
    }

    public static function set_database($db)
    {
        self::$database = $db;
    }

    protected static function db_query($sql)
    {
        $result = self::$database->query($sql);
        if($result->errno) {
            exit('Query failed');
        }
        return $result;
    }

    public static function find_all($order_by = 'created_at')
    {
        $sql = 'SELECT * FROM '. static::$db_table .' ORDER BY '. $order_by .' DESC;';
        $objs = [];
        $query = static::db_query($sql);
        while($obj = $query->fetch_assoc()){
            $objs[] = new static($obj);
        }
        return $objs;
    }
}