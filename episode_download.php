<?php
require_once('app/config.php');
require_once('app/session.php');
require_once('app/functions.php');
require_once('app/dbconnection.php');
$video['type'] = '';
$video['title'] = '';
$data = array();
$data['serie'] = DB::queryFirstRow('SELECT * FROM serie WHERE url=%s', $_GET['serie_url']);
if ($data['serie'] == null)
{
    Redirect404To($config['urlpath'].'/');
}
$episode_number = $_GET['episode_number'];
$data['episode'] = DB::queryFirstRow('SELECT * FROM serie_episode WHERE serie_id=%s AND number=%s', $data['serie']['id'], $episode_number);
$episode_id = $data['episode']['id'];
if ($data['episode'] == null)
{
    Redirekct404To($config['urlpath'].'/');
}

$data['episode']['language'] = DB::queryFirstField('SELECT name FROM language WHERE id=%s', $data['episode']['language_id']);

$data['episode']['downloads'] = json_decode($data['episode']['downloads'], true);
if ($data['episode']['downloads'] == null)
{
    $data['episode']['downloads'] = array();
}

$config['page_title'] = $data['serie']['name'].' '.$data['episode']['number'];
$config['current_url'] = $config['urlpath'].'/ver/'.$data['serie']['url'].'-'.$data['episode']['number'];

$data['episode_prev'] = DB::queryFirstField('SELECT number FROM serie_episode WHERE serie_id=%s AND number+0.0 < %s ORDER BY number+0.0 DESC LIMIT 1', $data['serie']['id'], $data['episode']['number']);


$data['episode_next'] = DB::queryFirstField('SELECT number FROM serie_episode WHERE serie_id=%s AND number+0.0 > %s ORDER BY number+0.0 ASC LIMIT 1', $data['serie']['id'], $data['episode']['number']);


require_once(getThemeFile('episode_download'));
