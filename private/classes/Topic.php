<?php 
namespace Classes;

class Topic extends DBobj {
    protected static $db_table = 'topics';
    protected static $PK = 'id';
    protected static $fields = ['level','prev_id','title','description','user_id'];
    protected static $form_fields = ['title','description'];
    protected static $form_fields_type = ['text','text'];
    protected static $form_hidden_fields = ['level','prev_id','user_id'];
    // datetime field created_at

    public $id;
    public $level;
    public $prev_id;
    public $title;
    public $description;
    public $user_id;
    
    // for convenience
    public $username;

    public function __construct($args)
    {
        parent::__construct($args);
        $this->username = User::find_by_PK($this->user_id)->username;
    }
}