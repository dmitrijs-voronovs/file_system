<?php 
namespace Classes;

class DBobj {
    protected static $db_table;
    protected static $database;
    protected $PK = [];
    protected static $fields = [];
    protected static $form_fields = [];    
    protected static $form_fieds_type = [];
    protected static $form_hidden_fields = [];
    
    public function __construct($bad_args = [])
    {
        $args = [];
        foreach($bad_args as $key => $arg){
            $args[$key] = $this->sanitize($arg);
        }
        $all_fields = array_merge($this->PK, static::$fields);
        foreach($all_fields as $field){
            $this->$field = $args[$field] ?? '0'; 
        }
    }

    public function save($includePK = false)
    {
        if($includePK) $all_fields = array_merge($PK,static::$fields);
        else $all_fields = static::$fields;
        
        $sql = "INSERT INTO ". static::$db_table ." (". join(",",$all_fields);
        $sql .= ") VALUES (";
        foreach($all_fields as $i => $field){
            if(empty($this->$field)){
                $sql.= "DEFAULT";
            } else {
                $sql.= "'". $this->$field ."'";
            }
            if($i+1 != sizeof($all_fields)) $sql.=',';
            else $sql.= ');';
        }
        var_dump($sql);
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

    public function sanitize($str)
    {
        var_dump($str);
        $str = h($str);
        var_dump($str);
        $str = self::$database->real_escape_string($str);
        var_dump($str);
        return $str;
    }

    public static function find_all()
    {
        $sql = 'SELECT * FROM '. static::$db_table .';';
        $objs = [];
        $query = static::db_query($sql);
        while($obj = $query->fetch_assoc()){
            $objs[] = new static($obj);
        }
        return $objs;
    }

    public static function get_form($values = [])
    {
        $form = '
        <form action="index.php" method="POST">';
            foreach(static::$form_fields as $i => $field){
                $val = $values->$field ?? "";
                $form .= 
                    '<div class="form-group">
                        <label for="'. $field .'">'. $field .'</label>
                        <input id="'. $field .'" class="form-control"
                            type="'. static::$form_fields_type[$i] .'" name="'. static::$db_table .'['. $field .']"
                            value="'. $val .'" required/>
                    </div>';
            }
            foreach(static::$form_hidden_fields as $i => $field){
                $val = $values[$field] ?? "";
                $form .= 
                    '<div class="form-group">
                        <input id="'. $field .'" class="form-control"
                            name="'. static::$db_table .'['. $field .']"
                            value="'. $val .'" hidden/>
                    </div>';
            }
        $form .= '
            <div class="form-group">
                <button type="submit"><i class="fas fa-check"></i></button>
            </div></form>';
        return $form;
    }
}