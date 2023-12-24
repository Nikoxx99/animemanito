<?php
require_once('app/config.php');
require_once('app/session.php');
require_once('app/functions.php');
require_once('app/dbconnection.php');
$clientip = ip2long($_SERVER['REMOTE_ADDR']);
$row = 1;
if (($handle = fopen("gb.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 3847, ",")) !== FALSE) {
        $num = count($data);
        $row++;
        for ($c=0; $c < $num; $c++) {
            $low_ip = ip2long(explode(';', $data[$c])[0]);
            $high_ip = ip2long(explode(';', $data[$c])[1]);
            // check if clientip is in range
            if ($clientip <= $high_ip && $low_ip <= $clientip) {
                  header("Location: ".$config['urlpath']."/forbbiden.php"); 
            }
        }
    }
    fclose($handle);
}

require_once(getThemeFile('settings'));

$data = array();
$theme['last_series_genres'] = '';

//Redirect on cloudflare trace url trash is present
$current = $_SERVER['SERVER_NAME'];
// if($current !== 'www.animemanito.com') {
//   header("Location: https://www.animemanito.com"); 
// }

if ($theme['slider'] == true)
{
  $data['slider'] = DB::query('SELECT serie.* FROM slider JOIN serie ON slider.serie_id=serie.id ORDER BY slider.order ASC');

  if ($theme['slider_genres'] == true)
  {
    foreach ($data['slider'] as $key => $value)
    {
      $data['slider'][$key]['genres'] = getSerieGenres($value['genres']);
    }
  }
}

if ($theme['serie_top'] > 0)
{
  $data['serie_top'] = DB::query('SELECT * FROM serie WHERE status_id = 1 ORDER BY visits DESC LIMIT '.$theme['serie_top']);

  if ($theme['serie_top_genres'] == true)
  {
    foreach ($data['serie_top'] as $key => $value)
    {
      $data['serie_top'][$key]['genres'] = getSerieGenres($value['genres']);
    }
  }
}

$data['news'] = DB::query("SELECT * FROM ytlandia_cache");
if (isset($session)) {
  $data['user_last_episodes'] = DB::query('SELECT
    lastView.id,
    lastView.serie_episode_id,
    lastView.user,
    serie_episode.id,
    serie.name,
    serie.url,
    serie.image_screenshot,
    serie_episode.number,
    serie_episode.episodegroup,
    serie_episode.image,
    serie_episode.release_date 
    FROM lastView
    INNER JOIN serie_episode ON lastView.serie_episode_id=serie_episode.id
    INNER JOIN serie ON serie.id = serie_episode.serie_id
    WHERE lastView.user = '.$session['id'].'
    ORDER BY lastView.id DESC LIMIT 4'
  );
}

$data['latest_episodes'] = DB::query('SELECT 
      serie_episode.id,
      serie.name,
      serie.url,
      serie.image_screenshot,
      serie_episode.number,
      serie_episode.episodegroup,
      serie_episode.image,
      serie_episode.release_date
      FROM serie_episode LEFT JOIN serie ON serie_episode.serie_id=serie.id
      WHERE serie_episode.visible="yes"
      ORDER BY serie_episode.id DESC LIMIT '.$theme['last_episodes']);

if ($theme['last_series'] > 0)
{
	$data['latest_series'] = DB::query('SELECT * FROM serie WHERE visible="yes" ORDER BY id DESC LIMIT '.$theme['last_series']);
      if ($theme['last_series_genres'] == true)
      {
            foreach ($data['latest_series'] as $key => $value)
            {
              $data['latest_series'][$key]['genres'] = getSerieGenres($value['genres']);
          }
      }
}

$config['page_title'] = $config['site_name'];
$config['current_url'] = $config['urlpath'].'/';

//print_r($data['latest_series']);exit;

require_once(getThemeFile('home'));
