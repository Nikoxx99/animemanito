<?php
if (isset($_GET['name']))
{
	require_once('../../app/dbconnection.php');

	$items = DB::query('SELECT id,name,image_screenshot FROM serie WHERE name LIKE %s ORDER BY name ASC LIMIT 10', '%'.$_GET['name'].'%');

	header('Content-type: application/json; charset=utf-8');
	echo json_encode($items);
}
