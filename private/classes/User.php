<?php 
namespace Classes;

class User extends db_object {
    protected static $db_table = 'users';
    protected $PK = 'id';
    protected $fields = ['username','hashed_password'];

    public function __construct($args = [])
    {
        parent::__construct($args);
    }
}