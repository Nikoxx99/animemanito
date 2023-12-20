<?php
require_once('config.php');
require_once('session.php');
require_once('functions.php');
require_once('dbconnection.php');

$like = $_POST['like'];
$dislike = $_POST['dislike'];
$id_usuario = $_POST['id_usuario'];
$id_serie = $_POST['id_serie'];
$c_likes = $_POST['c_l'];
$c_dislikes = $_POST['c_d'];
$fecha = date("Y-m-d");
$hour = time() + 3600 * 24 * 30 * 12;

switch ($like) {

    case "1":
        DB::update('serie', [
            'likes' => $c_likes + $like
        ], "id=%s", $id_serie);
        $vote = 1;
        DB::insert('votes', [
            'episode_id' => $id_serie,
            'user_id' => $id_usuario,
            'vote' => $vote,
            'date' => $fecha
        ]);
        setcookie($id_serie, $vote, $hour, '/');
        break;
    case "-1":
        $l_valor = 1;
        DB::update('serie', [
            'likes' => $c_likes - $l_valor
        ], "id=%s", $id_serie);
        setcookie($id_serie, null, -1, '/');
        break;
    case "0";
        echo "La operacion no tenia Likes";
        break;
}
switch ($dislike) {
    case "1":
        DB::update('serie', [
            'dislikes' => $c_dislikes + $dislike
        ], "id=%s", $id_serie);
        $vote = 0;
        DB::insert('votes', [
            'episode_id' => $id_serie,
            'user_id' => $id_usuario,
            'vote' => $vote,
            'date' => $fecha
          ]);
          setcookie($id_serie, $vote, $hour, '/');
        break;
    case "-1":
        $d_valor = 1;
        DB::update('serie', [
            'dislikes' => $c_dislikes - $d_valor
        ], "id=%s", $id_serie);
        setcookie($id_serie, null, -1, '/');
        break;
    case "0";
        echo "La operacion no tenia Dislikes";
        break;
}
