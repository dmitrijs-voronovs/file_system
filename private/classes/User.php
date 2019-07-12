<?php 
namespace Classes;

class User extends DBobj {
    protected static $db_table = 'users';
    protected $PK = ['id'];
    protected $fields = ['level','prev_id','title'];
}