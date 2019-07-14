<?php 
namespace Classes;

class User extends DBobj {
    protected static $db_table = 'users';
    protected static $PK = 'id';
    protected static $fields = ['username', 'hashed_password','password','password_repeat'];
    protected static $form_fields = ['username','password','password_repeat'];
    protected static $form_fields_type = ['text','password','password'];
    protected static $form_hidden_fields = [];

    public $id;
    public $username;
    
    /**
     * Two following fields are stored internally,
     * are not saved to database.
     */
    protected $password;    
    protected $password_repeat;

    /** 
     * @var string 60char string for password, 
     * that is being send to database.
     */
    protected $hashed_password;
    protected $errors = [];

    public function create($exclude = [])
    {
        if ($this->validate()){
            // generate $this->hashed_password before sending to db
            $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
            // saves object to db excluding two password fields, as
            // plain text passwords should not be stored in db
            $result = parent::create(['password','password_repeat']);
            $this->id = static::find_by_username($this->username)->id;
            return $result;
        }
        return false;
    }

    /** for user registration */
    protected function validate()
    {
        $this->errors = [];
        if(static::find_by_username($this->username)){
            $this->errors[] = "User with this username already exists";
        }
        if(strlen($this->username)<4){
            $this->errors[] = "Username should be more than 3 characters long";
        }
        if($this->password != $this->password_repeat){
            $this->errors[] = "Passwords do not match";
        } else if(strlen($this->password)<8){
            $this->errors[] = "Password should be more than 7 characters long";
        }
            
        if(sizeof($this->errors)>0) return false;
        return true;
    }

    /** for login */
    protected function validate_for_login()
    {
        $this->errors = [];
        $user = static::find_by_username($this->username);
        if(!$user){
            $this->errors[] = "No user with this username";
        } else if(!$user->validate_password($this->password)){
            $this->errors[] = "Incorrect password";
        }
            
        if(sizeof($this->errors)>0) return false;
        return true;
    }

    public function validate_password($pass)
    {
        return password_verify($pass,$this->hashed_password);
    }

    public function login()
    {
        if($this->validate_for_login()){
            $_SESSION['username'] = $this->username;
            $_SESSION['user_id'] = static::find_by_username($this->username)->id;
            redirect_to('index');
        } 
        return false;
    }

    public static function is_logged()
    {
        return(isset($_SESSION['username']) && isset($_SESSION['user_id']));
    }

    public static function getLoggedUser()
    {
        if(static::is_logged()){
            return static::find_by_username($_SESSION['username']);
        }
        return false;
    }

    public static function logout()
    {
        unset($_SESSION['username']);
        unset($_SESSION['id']);
        redirect_to('index.php');
    }

    public function display_errors()
    {
        if(sizeof($this->errors)>0){
            $html = '<div class="errors">';
            foreach($this->errors as $error){
                $html .= '<div class="error">'. $error .'</div>';
            }
            $html .= '</div>';
        }
        return $html ?? '';
    }

    public static function find_by_username($username)
    {
        $sql = "SELECT * FROM ". static::$db_table ." WHERE username = '". $username ."';";
        $result = static::db_query($sql);
        if($result->num_rows){
            return new static($result->fetch_assoc());
        }
        return false;
    }

    public static function get_login_form($values = [], $includePK = false, $action = "login.php")
    {
        // Trick, that allows us to use parent form generation
        // method. Exclude some fileds and then include them back.
        $fields = static::$form_fields;
        static::$form_fields = ['username','password'];
        $html = parent::get_form($values, $includePK, $action);
        
        static::$form_fields = $fields;
        return $html;
    }
}