<?php 
namespace Classes;

class User extends db_object {
    protected static $db_table = 'users';
    protected $PK = 'id';
    protected $fields = ['level','prev_id','title'];
}