<?php
require_once('config.php');
require_once('session.php');
require_once('functions.php');
require_once('dbconnection.php');

$vl = $_POST['vl'];
$idUser = $_POST['idUser'];
$idSerie = $_POST['idSerie'];
$fecha = date("Y-m-d");

switch ($vl) {

    case "1":
        try {
            DB::insert('watchLater', [
                'id_serie_episode' => $idSerie,
                'id_user' => $idUser,
                'add_date' => $fecha
            ]);
        } catch (Exception $e) {
            echo "Fallo en la base datos" . $e->getMessage();
        }

        break;
    case "-1":
        try {
            DB::query("DELETE FROM watchLater WHERE id_serie_episode=%i0 AND id_user=%i1", $idSerie,$idUser);
        } catch (Exception $e) {
            echo "Fallo en la base datos" . $e->getMessage();
        }
        break;
    case "0";
        echo "La operacion no tenia Likes";
        break;
}
