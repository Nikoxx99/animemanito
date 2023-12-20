<?php
require_once('app/dbconnection.php');
require_once('app/config.php');
$ch = file_get_contents('https://ytlandia.es/fenixPost.php');
$posts = json_decode($ch, true);
$oldPosts = DB::query("SELECT * FROM ytlandia_cache");
if(!empty($oldPosts)) {
  foreach($posts as $post){
    echo 'Post actualizado: '.$post['title'].'<br>';
    $res = DB::update('ytlandia_cache', [
      'title' => $post['title'],
      'thumbnail' => $post['thumbnail'][0],
      'url' => $post['url'],
      'date_post' => $post['date']
    ], "id=%s", $post['id']);
  }
  echo "Posts actualizados correctamente: ".count($posts);
} else {
  foreach($posts as $post){
    DB::insert('ytlandia_cache', [
      'title' => $post['title'],
      'thumbnail' => $post['thumbnail'][0],
      'url' => $post['url'],
      'date_post' => $post['date']
    ]);
  }
  echo "Posts creados";
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