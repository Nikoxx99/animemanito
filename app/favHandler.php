<?php
require_once('config.php');
require_once('session.php');
require_once('functions.php');
require_once('dbconnection.php');

$fav = $_POST['fav'];
$id_usuario = $_POST['id_usuario'];
$id_serie = $_POST['id_serie'];
$fecha = date("Y-m-d");

switch ($fav) {

    case "1":
        try {
        DB::insert('favorite', [
            'id_serie' => $id_serie,
            'id_user' => $id_usuario,
            'add_date' => $fecha
            ]);
            echo "1";
        } catch (Exception $e) {
            echo "Fallo en la base datos" . $e->getMessage();
        }

        break;
    case "-1":
        try {
            DB::query("DELETE FROM favorite WHERE id_serie=%i0 AND id_user=%i1", $id_serie,$id_usuario);
            echo "0";
        } catch (Exception $e) {
            echo "Fallo en la base datos" . $e->getMessage();
        }
        break;
    case "0";
        echo "La operacion no tenia Favoritos";
        break;
}
