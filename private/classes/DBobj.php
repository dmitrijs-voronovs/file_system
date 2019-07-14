<?php 
namespace Classes;

/**
 * This is a universal class, representing database object.
 * Provides basic functionality, according to active-record
 * pattern. 
 * Instantiates objects, find objects in database, 
 * saves and updates objects in db, generates forms for users.
 */
class DBobj {

    /**
     * Used by all children objects to communicate with
     * database.
     * @var mysqli
     */
    protected static $database;

    /**
     * Name of the table in database
     * @var string
     */
    protected static $db_table;
    protected static $PK;
    protected static $fields = [];
    protected static $form_fields = [];  

    /**
     * Input types, e.g. ["text","number","password"]
     * @var string[]
     */
    protected static $form_fieds_type = [];
    protected static $form_hidden_fields = [];
    
    public function __construct($args = [])
    {
        $all_fields = array_merge([static::$PK], static::$fields);
        foreach($all_fields as $field){
            $this->$field = $args[$field] ?? '0'; 
        }
    }

    /**
     * Saves or updates object in database.
     *
     * @param  string[] $exclude fields, that should
     * not be sent to database
     *
     * @return DBobj|false
     */
    public function save($exclude = [])
    {
        if(isset($this->{static::$PK}) && !empty($this->{static::$PK})){
            return $this->update();
        } else {
            return $this->create($exclude);
        }
    }

    /** 
     * Saves object to database
     *
     * @param  string[] $exclude
     *
     * @return DBobj|false
     */
    public function create($exclude = [])
    {
        $fields = array_diff(static::$fields, $exclude); 
        $sql = "INSERT INTO ". static::$db_table ." (". join(",",$fields);
        $sql .= ") VALUES (";
        foreach($fields as $i => $field){
            if(empty($this->$field)){
                $sql.= "DEFAULT";
            } else {
                $sql.= "'". $this->$field ."'";
            }
            if($i+1 != sizeof($fields)) $sql.=',';
            else $sql.= ');';
        }
        return static::db_query($sql);
    }
    
    /** 
     * Updates object in database
     *
     * @param  string[] $exclude
     *
     * @return DBobj|false
     */
    public function update()
    {
        $sql = "UPDATE ". static::$db_table ." SET ";
        foreach(static::$fields as $i => $field){
            if(empty($this->$field)) continue;
            $sql .= " ". $field ." = '". $this->$field ."'";
            if ($i+1 != sizeof(static::$fields)) {
                $sql .= ", ";
            }
        }
        $sql .= " WHERE ". static::$PK ." = '". $this->{static::$PK} ."';";
        return static::find_by_PK(static::db_query($sql));
    }

    public static function set_database($db)
    {
        self::$database = $db;
    }

    /**
     * All queries should be made through this method.
     * Prints errors in canse of fault.
     *
     * @param  string $sql
     *
     * @return Object|null
     */
    protected static function db_query($sql)
    {
        $result = self::$database->query($sql);
        if(self::$database->errno) {
            exit('Query failed : ' . self::$database->error);
        }
        return $result;
    }

    public static function sanitize($str = "")
    {
        $str = h($str);
        $str = self::$database->real_escape_string($str);
        return $str;
    }

    public static function sanitize_all($bad_args = [])
    {
        $args = [];
        foreach($bad_args as $key => $arg){
            $args[$key] = static::sanitize($arg);
        }
        return $args;
    }

    public static function find_all($orderClause = '')
    {
        $sql = 'SELECT * FROM '. static::$db_table .' '.$orderClause .';';
        $objs = [];
        $query = static::db_query($sql);
        while($obj = $query->fetch_assoc()){
            $objs[] = new static($obj);
        }
        return $objs;
    }

    public static function find_by_PK($pk)
    {
        $sql = "SELECT * FROM ". static::$db_table;
        $sql .= " WHERE ". static::$PK . " = '". $pk ."';";
        $result = static::db_query($sql);
        return new static($result->fetch_assoc());
    }

    public static function update_or_create($args)
    {
        $obj = new static($args);
        $obj->save();
        return $obj;
    }

    public static function delete($objectID)
    {
        $sql = "DELETE FROM ". static::$db_table ." WHERE ";
        $sql .= static::$PK ." = '". $objectID ."';";
        return static::db_query($sql);
    }

    public static function deleteMany($objectIDs)
    {
        $sql = "DELETE FROM ". static::$db_table ." WHERE ";
        $sql .= static::$PK ." IN ('". join("', '",$objectIDs) ."');";
        return static::db_query($sql);
    }

    public static function get_form($values = [], $includePK = false, $action = "index.php")
    {
        $form = '
        <form action='. $action .' method="POST">';
            foreach(static::$form_fields as $i => $field){
                $val = $values[$field] ?? "";
                $form .= 
                    '<div class="form-group">
                        <label for="'. $field .'">'. $field .'</label>
                        <input id="'. $field .'" class="form-control"
                            type="'. static::$form_fields_type[$i] .'" name="'. static::$db_table .'['. $field .']"
                            value="'. $val .'" required/>
                    </div>';
            }
            if ($includePK) {
                $hidden_fields = array_merge(static::$form_hidden_fields, [static::$PK]);
            } else {
                $hidden_fields = static::$form_hidden_fields;
            }
            foreach($hidden_fields as $i => $field){
                $val = $values[$field] ?? "";
                $form .= 
                    '<input id="'. $field .'" class="form-control"
                        name="'. static::$db_table .'['. $field .']"
                        value="'. $val .'" hidden/>';
            }
        $form .= '
            <div class="form-group">
                <button type="submit"><i class="fas fa-check"></i></button>
            </div></form>';
        return $form;
    }
}