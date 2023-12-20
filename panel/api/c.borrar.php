<?php
/*
POST DATA
tipo: serie
id: 300
*/

if (isset($_POST['type']) && isset($_POST['id']))
{
	require_once('../../app/session.php');

	if (!isset($session))
	{
		echo 'not authorized!';
	    exit;
	}
	
	require_once('../../app/dbconnection.php');

	$type = $_POST['type'];
	$id = $_POST['id'];

	switch ($type){
		case "serie":
			DB::delete('serie', 'id=%s', $id);
			$counter = DB::affectedRows();
			if($counter > 0){
				echo 1;
			}else{
				echo 0;
			}
			break;
		case "episode":
			DB::delete('serie_episode', 'id=%s', $id);
			$counter = DB::affectedRows();
			if($counter > 0){
				echo 1;
			}else{
				echo 0;
			}
			break;
		case "user":
			DB::delete('user', 'id=%s', $id);
			$counter = DB::affectedRows();
			if($counter > 0){
				echo 1;
			}else{
				echo 0;
			}
			break;
		case "genre":
			DB::delete('genre', 'id=%s', $id);
			$counter = DB::affectedRows();
			if($counter > 0){
				echo 1;
			}else{
				echo 0;
			}
			break;
		case "player":
			DB::delete('player', 'id=%s', $id);
			$counter = DB::affectedRows();
			if($counter > 0){
				echo 1;
			}else{
				echo 0;
			}
			break;
	}
}

// 	if ($_POST['type'] == 'serie')
// 	{
// 		$serie = DB::queryFirstRow('SELECT name FROM serie WHERE id = %s', $_POST['id']);
// 		if ($serie)
// 		{
// 			echo $serie['name'];
// 		}
// 	}

// 	else

// 	if ($_POST['type'] == 'user')
// 	{
// 		$user = DB::queryFirstRow('SELECT name FROM user WHERE id = %s', $_POST['id']);
// 		if ($user)
// 		{
// 			echo $user['name'];
// 		}
// 	}	
// }
