<?php
require_once('app/config.php');
require_once('app/session.php');
require_once('app/functions.php');
require_once('app/dbconnection.php');

require_once(getThemeFile('settings'));

$data = array();
$data['serie'] = DB::queryFirstRow('SELECT * FROM serie WHERE url=%s', $_GET['url']);
if ($data['serie'] == null)
{
    Redirect404To($config['urlpath'].'/');
}


$genre_ids = explode(',', str_replace('"', '', $data['serie']['genres']));
$data['serie']['category'] = DB::queryFirstField('SELECT name FROM category WHERE id=%s', $data['serie']['category_id']);
$data['serie']['status'] = DB::queryFirstField('SELECT name FROM status WHERE id=%s', $data['serie']['status_id']);

$data['serie']['genres'] = DB::query('SELECT id,name,url FROM genre WHERE id IN %ls ORDER BY name ASC', $genre_ids);

$data['episodes'] = DB::query('SELECT * FROM serie_episode WHERE serie_id=%s ORDER BY number+0 DESC', $data['serie']['id']);

$data['serie']['related'] = DB::query('SELECT id_serie_related,type FROM serie_related WHERE id_serie=%i',$data['serie']['id']);


$languages = array();

foreach ($data['episodes'] as $key => $value)
{
	if (!isset($languages[ $value['language_id'] ]))
	{
		$languages[ $value['language_id'] ] = DB::queryFirstField('SELECT name FROM language WHERE id=%s', $value['language_id']);
	}
	$data['episodes'][$key]['language'] = $languages[ $value['language_id'] ];;
}

if ($theme['related_series'] > 0)
{
	$data['related_series'] = DB::query('SELECT * FROM serie ORDER BY RAND() LIMIT '.$theme['related_series']);
}
DB::update('serie', array('visits' => DB::sqleval('visits + 1') ), 'id=%s', $data['serie']['id']);
$data['serie']['visits']++;

$config['page_title'] = $data['serie']['name'];
$config['current_url'] = $config['urlpath'].'/'.$data['serie']['url'];
$favIsSet = "0";
$favActive = "is-light";
$wl_sIsSet = "0";
$wl_sActive = "is-light";
$icon = "fas fa-history";
if(!empty($session)) {
	$data['serie']['is-fav'] = DB::query('SELECT * FROM favorite WHERE id_serie = %i0 AND id_user=%i1 ORDER BY id DESC',$data['serie']['id'],$session['id']);
	if (!empty($data['serie']['is-fav'])) {
			$favIsSet = "1";
			$favActive = "is-orange";
	} else {
			$favIsSet = "0";
			$favActive = "is-light";
	}

	$data['serie']['watch-later-serie'] = DB::query('SELECT * FROM watchLater_serie WHERE id_serie = %i0 AND id_user=%i1 ORDER BY id DESC',$data['serie']['id'],$session['id']);
	if (!empty($data['serie']['watch-later-serie'])) {
			$wl_sIsSet = "1";
		$wl_sActive = "is-orange";
		$icon = "fas fa-times";
	} else {
			$wl_sIsSet = "0";
		$wl_sActive = "is-light";
		$icon = "fas fa-history";
	}
}


require_once(getThemeFile('serie'));
