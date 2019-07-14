<?php

/** Defining paths */
define('PRIVATE_PATH',dirname(__FILE__));
define('SHARED_PATH', PRIVATE_PATH . '/shared');
define('ROOT_PATH',dirname(PRIVATE_PATH));
define('PUBLIC_PATH', ROOT_PATH . '/public');

/** Necessary functions */
include_once(PRIVATE_PATH . '/functions/functions.php');
include_once(PRIVATE_PATH . '/functions/db_functions.php');

/** Database access */
include_once(PRIVATE_PATH . '/db_credentials.php');

/** Autoload Classes */
include_once(ROOT_PATH . '/vendor/autoload.php');

/** For user login and logout */
session_start();

/** 
 * Database instance assigned to DBobj, in order to ensure
 * communication between classes and database.
 */
$db = database_connect();
Classes\DBobj::set_database($db);