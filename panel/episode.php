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

$data['episode']['videos'] = json_decode($data['episode']['videos'], true);
if ($data['episode']['videos'] == null)
{
    $data['episode']['videos'] = array();
}

$players = array();
$players_db = DB::query('SELECT * FROM player ORDER BY name ASC');
foreach ($players_db as $player)
{
    $players[$player['id']] = $player;
}

foreach ($data['episode']['videos'] as $key => $video)
{
    if (isset( $players[ $video['player'] ] ))
    {
        $data['episode']['videos'][$key]['title'] = $players[ $video['player'] ]['name'];
        
        $data['episode']['videos'][$key]['code'] = str_replace(
            'codigo', 
            $data['episode']['videos'][$key]['code'], 
            $players[ $video['player'] ]['url']
        );

        $data['episode']['videos'][$key]['type'] = $players[ $video['player'] ]['type'];
    }
}

$data['episode']['downloads'] = json_decode($data['episode']['downloads'], true);
if ($data['episode']['downloads'] == null)
{
    $data['episode']['downloads'] = array();
}

$data['episode_prev'] = DB::queryFirstField('SELECT number FROM serie_episode WHERE serie_id=%s AND number+0.0 < %s ORDER BY number+0.0 DESC LIMIT 1', $data['serie']['id'], $data['episode']['number']);


$data['episode_next'] = DB::queryFirstField('SELECT number FROM serie_episode WHERE serie_id=%s AND number+0.0 > %s ORDER BY number+0.0 ASC LIMIT 1', $data['serie']['id'], $data['episode']['number']);

$data['episode_recommended'] = DB::query('SELECT id,name,genres,image_cover,url FROM serie WHERE genres like %s0 and genres like %s1 and genres like %s2 ORDER BY RAND() LIMIT 4','%'.$data['serie']['genres'][0].'%','%'.$data['serie']['genres'][1].'%','%'.$data['serie']['genres'][2].'%');


$config['page_title'] = $data['serie']['name'].' '.$data['episode']['number'];
$config['current_url'] = $config['urlpath'].'/ver/'.$data['serie']['url'].'_'.$data['episode']['number'];
//Conrtolador de capitulos vistos
if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
    $add_date = date("Y-m-d");
    $last30Entries = DB::query('SELECT * FROM lastView WHERE user=%i ORDER BY id DESC',$user_id);
    if(count($last30Entries) <= 41){
    DB::insertIgnore('lastView', [
        'serie_episode_id' => $episode_id,
        'user' => $user_id,
        'add_date' => $add_date
        ]);
    }else{
        $the22Entry = DB::query('SELECT * FROM lastView WHERE user=%i ORDER BY id ASC LIMIT 1',$user_id);
        DB::query('DELETE FROM lastView WHERE id=%i',$the22Entry[0]['id']);
        DB::insertIgnore('lastView', [
            'serie_episode_id' => $episode_id,
            'user' => $user_id,
            'add_date' => $add_date
            ]);
    }
}
//Controlador Serie Favorita
$favIsSet = '';
$vlIsSet = '';
if(isset($session['id'])){
    $data['episode']['is-fav'] = DB::query('SELECT * FROM favorite WHERE id_serie = %i0 AND id_user=%i1 ORDER BY id DESC',$data['serie']['id'],$session['id']);
    if (!empty($data['episode']['is-fav'])) {
        $favIsSet = "1";
        $favActive = "is-orange";
    } else {
        $favIsSet = "0";
        $favActive = "is-light";
    }
    $data['episode']['wl'] = DB::query('SELECT * FROM watchLater WHERE id_serie_episode = %i0 AND id_user=%i1 ORDER BY id DESC',$data['episode']['id'],$session['id']);
    if (!empty($data['episode']['wl'])) {
        $vlIsSet = "1";
        $colorVerLuego = "is-orange";
        $icon = "fas fa-times";
        
    } else {
        $vlIsSet = "0";
        $colorVerLuego = "is-light";
        $icon = "fas fa-history";
    }
}


require_once(getThemeFile('episode'));
