<?php

if (!isset($session))
{
    RedirectTo($config['urlpath'].'/user/login');
}

if ($session['role'] !== 'admin')
{
	die('access denied');
}
