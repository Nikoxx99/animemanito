<?php
require_once('app/config.php');

setcookie('username', $user['username'], false, '/');
setcookie('token', $user['password'], false, '/');

header('Location: '.$config['urlpath'].'/');
