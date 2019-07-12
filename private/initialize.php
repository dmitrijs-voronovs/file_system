<?php

define('PRIVATE_PATH',dirname(__FILE__));
define('SHARED_PATH', PRIVATE_PATH . '/shared');
define('ROOT_PATH',dirname(PRIVATE_PATH));
define('PUBLIC_PATH', ROOT_PATH . '/public');

include_once(PRIVATE_PATH . '/functions/functions.php');
include_once(PRIVATE_PATH . '/functions/db_functions.php');

include_once(PRIVATE_PATH . '/db_credentials.php');

include_once(ROOT_PATH . '/vendor/autoload.php');

session_start();

$db = database_connect();
Classes\DBobj::set_database($db);