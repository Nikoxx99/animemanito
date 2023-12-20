<?php
require_once('dbconnection.php');

if (isset($_COOKIE['username']) && isset($_COOKIE['token']))
{
    
    $user_login = DB::queryFirstRow('SELECT * FROM user WHERE username=%s AND password=%s LIMIT 1', $_COOKIE['username'], $_COOKIE['token']);
    if ($user_login == null)
    {
        setcookie('user_id', null, -1, '/');
    	setcookie('username', null, -1, '/');
        setcookie('token', null, -1, '/');
    }
    else
    {
    	$session = $user_login;
    	unset($user_login);
    }
}
