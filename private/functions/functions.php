<?php

function is_post_request()
{
    return ($_SERVER['REQUEST_METHOD'] === 'POST');
}

function h($str)
{
    $str = trim($str);
    $str = stripslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}

function redirect_to($path)
{
    header('Location: '.$path);
}

function requires_login()
{
    if (!isset($_SESSION['username'])){
        redirect_to('login.php');
    }
}