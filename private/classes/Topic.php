<?php 
namespace Classes;

class Topic extends DBobj {
    protected static $db_table = 'topics';
    protected $PK = ['id'];
    protected $fields = ['level','prev_id','title'];

    public $id;
    public $level;
    public $prev_id;
    public $title;
}