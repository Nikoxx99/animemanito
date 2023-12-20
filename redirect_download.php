<?php
require_once('app/config.php');
require_once('app/session.php');
require_once('app/functions.php');
require_once('app/dbconnection.php');

$sid = urldecode($_GET['sid']);
$cnumber = urldecode($_GET['cnumber']);
$dl = urldecode($_GET['dl']);

$data['episode'] = DB::queryFirstRow('SELECT * FROM serie_episode WHERE serie_id=%s AND number=%s', $sid, $cnumber);
if ($data['episode'] == null)
{
    Redirekct404To($config['urlpath'].'/');
}

$data['episode']['downloads'] = json_decode($data['episode']['downloads'], true);
if ($data['episode']['downloads'] == null)
{
    $data['episode']['downloads'] = array();
}

try{
  header("Location: ".$data['episode']['downloads'][$dl]);
}catch(Exception $error){
  echo $error;
}