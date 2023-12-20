<?php

require_once('app/config.php');
require_once('app/session.php');
require_once('app/functions.php');
require_once('app/dbconnection.php');
date_default_timezone_set('America/Bogota');

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $data["user_info"] = DB::query('SELECT id,username,name,email,avatar,theme FROM user WHERE id=%i',$user_id);
    
} else {
    header("Location: ".$config['urlpath']."?login=error");
}
if (!isset($_COOKIE['username'])) {
    header("Location:".$config['urlpath']."/user/login");
}
if($user_id != $_COOKIE['user_id']){
    header("Location:".$config['urlpath']);
}
//Querys a listas de Favoritos, Ultimas Visitas y Ver Luego

$user['last-view-count'] = DB::query('SELECT 
serie.name,serie.url,serie.image_screenshot,serie_episode.serie_id,serie_episode.number,serie_episode.image 
FROM serie_episode 
INNER JOIN lastView 
ON serie_episode.id = lastView.serie_episode_id 
INNER JOIN serie 
ON serie.id = serie_episode.serie_id 
WHERE lastView.user = %i 
ORDER BY lastView.id DESC',$user_id);

$user['favorite-count'] = DB::query('SELECT * FROM serie INNER JOIN favorite ON serie.id = favorite.id_serie WHERE favorite.id_user = %i ORDER BY favorite.id DESC',$user_id);

$user['watch-later-count'] = DB::query('SELECT 
serie.name,serie.url,serie.image_screenshot,serie_episode.serie_id,serie_episode.number,serie_episode.image 
FROM serie_episode 
INNER JOIN watchLater 
ON serie_episode.id = watchLater.id_serie_episode
INNER JOIN serie 
ON serie.id = serie_episode.serie_id 
WHERE watchLater.id_user = %i 
ORDER BY watchLater.id DESC',$user_id);

$user['watch-later-serie-count'] = DB::query('SELECT * FROM serie INNER JOIN watchLater_serie ON serie.id = watchLater_serie.id_serie WHERE watchLater_serie.id_user = %i ORDER BY watchLater_serie.id DESC',$user_id);

//Datos del Usuario
$user['avatar'] = $data['user_info'][0]['avatar'];
// $user['bio'] = $data['user_info']['bio'];

//Settings

// $user_settings['theme'] = $data['user_info']['theme'];
// $user_settings['mode_day_night'] = $data['user_info']['mode'];

//Paginador de Ultimos Vistos
define("ROW_PER_PAGE", 21);
$count = count($user['last-view-count']);
$per_page_html = '';
$page = 1;
$start = 0;
if (!empty($_GET["page"])) {
    $page = $_GET["page"];
    $start = ($page - 1) * ROW_PER_PAGE;
}
if (!empty($count)) {//Generamos los botones para cambiar de pagina
    $per_page_html .= "<div style='text-align:center;margin:20px 0px;'><form action='' method='get'>";
    $page_count = ceil($count / ROW_PER_PAGE);
    if ($page_count > 1) {
        for ($i = 1; $i <= $page_count; $i++) {
            if ($i == $page) {
                $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
            } else {
                $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
            }
        }
    }
    $per_page_html .= "</form></div>";
}
$user['last-view'] = DB::query('SELECT 
serie.name,serie.url,serie.image_screenshot,serie_episode.serie_id,serie_episode.number,serie_episode.episodegroup,serie_episode.image 
FROM serie_episode 
INNER JOIN lastView 
ON serie_episode.id = lastView.serie_episode_id 
INNER JOIN serie 
ON serie.id = serie_episode.serie_id 
WHERE lastView.user = %i0 
ORDER BY lastView.id DESC LIMIT %i1,%i2',$user_id,$start,ROW_PER_PAGE);       

//Paginador de Favoritos
$count_favorite = count($user['favorite-count']);
$per_page_html_favorite = '';
$page_favorite = 1;
$start_favorite = 0;
if (!empty($_GET["page"])) {
    $page_favorite = $_GET["page"];
    $start_favorite = ($page_favorite - 1) * ROW_PER_PAGE;
}
if (!empty($count_favorite)) {//Generamos los botones para cambiar de pagina
    $per_page_html_favorite .= "<div style='text-align:center;margin:20px 0px;'><form action='' method='get'>";
    $page_count_favorite = ceil($count_favorite / ROW_PER_PAGE);
    if ($page_count_favorite > 1) {
        for ($i = 1; $i <= $page_count_favorite; $i++) {
            if ($i == $page_favorite) {
                $per_page_html_favorite .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
            } else {
                $per_page_html_favorite .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
            }
        }
    }
    $per_page_html_favorite .= "</form></div>";
}
$user['favorite'] = DB::query('SELECT * FROM serie INNER JOIN favorite ON serie.id = favorite.id_serie WHERE favorite.id_user = %i0 ORDER BY favorite.id DESC LIMIT %i1,%i2',$user_id,$start_favorite,ROW_PER_PAGE);

//Paginador de Pendientes por Ver
$count_wl = count($user['watch-later-count']);
$per_page_html_wl = '';
$page_wl = 1;
$start_wl = 0;
if (!empty($_GET["page"])) {
    $page_wl = $_GET["page"];
    $start_wl = ($page_wl - 1) * ROW_PER_PAGE;
}
if (!empty($count_wl)) {//Generamos los botones para cambiar de pagina
    $per_page_html_wl .= "<div style='text-align:center;margin:20px 0px;'><form action='' method='get'>";
    $page_count_wl = ceil($count_wl / ROW_PER_PAGE);
    if ($page_count_wl > 1) {
        for ($i = 1; $i <= $page_count_wl; $i++) {
            if ($i == $page_wl) {
                $per_page_html_wl .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
            } else {
                $per_page_html_wl .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
            }
        }
    }
    $per_page_html_wl .= "</form></div>";
}
$user['watch-later'] = DB::query('SELECT 
serie.name,serie.url,serie.image_screenshot,serie_episode.serie_id,serie_episode.number,serie_episode.image 
FROM serie_episode 
INNER JOIN watchLater 
ON serie_episode.id = watchLater.id_serie_episode
INNER JOIN serie 
ON serie.id = serie_episode.serie_id 
WHERE watchLater.id_user = %i0 
ORDER BY watchLater.id DESC LIMIT %i1,%i2',$user_id,$start,ROW_PER_PAGE); 

//Paginador de Series Por Ver
$count_wl_serie = count($user['watch-later-serie-count']);
$per_page_html_wl_serie = '';
$page_wl_serie = 1;
$start_wl_serie = 0;
if (!empty($_GET["page"])) {
    $page_wl_serie = $_GET["page"];
    $start_wl_serie = ($page_wl_serie - 1) * ROW_PER_PAGE;
}
if (!empty($count_wl_serie)) {//Generamos los botones para cambiar de pagina
    $per_page_html_wl_serie .= "<div style='text-align:center;margin:20px 0px;'><form action='' method='get'>";
    $page_count_wl_serie = ceil($count_wl_serie / ROW_PER_PAGE);
    if ($page_count_wl_serie > 1) {
        for ($i = 1; $i <= $page_count_wl_serie; $i++) {
            if ($i == $page_wl_serie) {
                $per_page_html_wl_serie .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
            } else {
                $per_page_html_wl_serie .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
            }
        }
    }
    $per_page_html_wl_serie .= "</form></div>";
}
$user['watch-later-serie'] = DB::query('SELECT * FROM serie INNER JOIN watchLater_serie ON serie.id = watchLater_serie.id_serie WHERE watchLater_serie.id_user = %i0 ORDER BY watchLater_serie.id DESC LIMIT %i1,%i2',$user_id,$start_wl_serie,ROW_PER_PAGE);


require_once(getThemeFile('user-profile'));
