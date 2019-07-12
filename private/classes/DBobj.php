<?php 
namespace Classes;

class DBobj {
    protected static $db_table;
    protected static $database;
    protected $PK = [];
    protected $fields = [];
    
    public function __construct($args = [])
    {
        $all_fields = array_merge($this->PK, $this->fields);
        foreach($all_fields as $field){
            $this->$field = $args[$field] ?? '0'; 
        }
    }

    public static function set_database($db)
    {
        self::$database = $db;
    }

    protected static function db_query($sql)
    {
        $result = self::$database->query($sql);
        if(self::$database->errno) {
            exit('Query failed');
        }
        return $result;
    }

    public static function find_all($order_by = 'created_at DESC')
    {
        $sql = 'SELECT * FROM '. static::$db_table .' ORDER BY '. $order_by .';';
        $objs = [];
        $query = static::db_query($sql);
        while($obj = $query->fetch_assoc()){
            $objs[] = new static($obj);
        }
        return $objs;
    }
}