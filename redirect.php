<?php
require_once('app/config.php');
require_once('app/session.php');
require_once('app/functions.php');
require_once('app/dbconnection.php');

$data = array();
$player = $_GET['player'];
$code = urldecode($_GET['code']);
$thumbnail = urldecode($_GET['thumbnail']);
$isFireload = urldecode($_GET['fl']);

$data['player'] = DB::queryFirstRow('SELECT * FROM player WHERE id=%s', $player);
$data['episode'] = str_replace(
    'codigo', 
    $code, 
    $data['player']['url']
);
$data['thumbnail'] = $thumbnail;

require_once(getThemeFile('redirect'));