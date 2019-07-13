<?php 
namespace Classes;

class Topic extends DBobj {
    protected static $db_table = 'topics';
    protected static $PK = 'id';
    protected static $fields = ['level','prev_id','title'];
    protected static $form_fields = ['title'];
    protected static $form_fields_type = ['text'];
    protected static $form_hidden_fields = ['level','prev_id'];

    public $id;
    public $level;
    public $prev_id;
    public $title;
}