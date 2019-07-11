<?php 
namespace Classes;

class Topic extends db_object {
    protected static $db_table = 'topics';
    protected $PK = 'id';
    protected $fields = ['level','prev_id','title'];
}