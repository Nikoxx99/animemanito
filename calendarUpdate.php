<?php
require_once('app/dbconnection.php');
require_once('app/config.php');
include 'vendor/autoload.php';
date_default_timezone_set('America/Bogota');
setlocale(LC_TIME, 'es_ES');
// Query series airing in winter seasion of 2023
$query = '
query ($page: Int, $perPage: Int, $season: MediaSeason, $seasonYear: Int, $sort: [MediaSort]) {
  Page (page: $page, perPage: $perPage) {
    pageInfo {
      total
      currentPage
      lastPage
      hasNextPage
      perPage
    }
    media (season: $season, seasonYear: $seasonYear, sort: $sort) {
      id
      title {
        romaji
      }
      popularity
      season
      seasonYear
      coverImage {
        large
      }
      nextAiringEpisode {
        airingAt
        timeUntilAiring
        episode
      }
    }
  }
}
';

// Define our query variables and values that will be used in the query request
$variables1 = [
  "season" => "FALL",
  "seasonYear" => 2023,
  "perPage" => 99,
  "page" => 1,
  "sort" => "START_DATE"
];
$variables2 = [
  "season" => "FALL",
  "seasonYear" => 2023,
  "perPage" => 99,
  "page" => 2,
  "sort" => "START_DATE"
];

try {
  // Make the HTTP Api request
$http = new GuzzleHttp\Client;
$response1 = $http->post('https://graphql.anilist.co', [
    'json' => [
        'query' => $query,
        'variables' => $variables1,
    ]
]);
$response2 = $http->post('https://graphql.anilist.co', [
    'json' => [
        'query' => $query,
        'variables' => $variables2,
    ]
]);
$response1 = json_decode($response1->getBody()->getContents(), true)['data']['Page']['media'];
$response2 = json_decode($response2->getBody()->getContents(), true)['data']['Page']['media'];
$response = array_merge($response1, $response2);
// sort by airingAt asc
usort($response, function($a, $b) {
  return $a['nextAiringEpisode']['airingAt'] <=> $b['nextAiringEpisode']['airingAt'];
});
foreach ($response as $anime) {
  if(!isset($anime['nextAiringEpisode']['airingAt'])) continue;
  $anime['nextAiringEpisode']['airingAt'] = date('F jS', $anime['nextAiringEpisode']['airingAt']);
  $grouped[$anime['nextAiringEpisode']['airingAt']][] = $anime;
  $grouped[$anime['nextAiringEpisode']['airingAt']]['airingAt'] = $anime['nextAiringEpisode']['airingAt'];
}
//sort by popularity
foreach ($grouped as $key => $value) {
  usort($grouped[$key], function($a, $b) {
    return $b['popularity'] <=> $a['popularity'];
  });
}
// print("<pre>".print_r($grouped,true)."</pre>");

} catch (GuzzleHttp\Exception\GuzzleException $e) {
  echo $e->getMessage();
}

$oldCalendar = DB::query("SELECT * FROM calendar");
if(!empty($oldCalendar)) {
  $res = DB::update('calendar', [
    'data' => json_encode($grouped),
  ], "id=%s", 1);
  echo "Calendario actualizado correctamente";
} else {
  DB::insert('calendar', [
    'data' => json_encode($grouped)
  ]);
  echo "Calendario creado correctamente";
}
// function imgtodb($url, $name) {
//   $imgWritebleStream = file_get_contents_curl($url);
//   $fileNewName = strtolower(preg_replace('/[\W\s\/]+/', '-', $name));
//   $imageurl = 'ytlandia/'.$fileNewName . '.jpg';
//   file_put_contents( $imageurl, $imgWritebleStream );
//   return $imageurl;
// }
// /*FUNCION QUE TOMA LA IMAGEN DE LA URL DEL POST Y LA ALMACENA EN UNA VARIABLE*/

// function file_get_contents_curl($url) {
//   $ch = curl_init();

//   curl_setopt($ch, CURLOPT_HEADER, 0);
//   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//   curl_setopt($ch, CURLOPT_URL, $url);

//   $data = curl_exec($ch);
//   curl_close($ch);

//   return $data;
// }