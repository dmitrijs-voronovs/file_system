<?php
include_once('../private/initialize.php');
// this is not obligatory, but is logically correct
requires_login();

Classes\User::logout();