<?php
if (isset($_GET['image']))
{
	require_once('../../app/config.php');
	require_once('../../app/functions.php');

	if ($_GET['image'] == 'null')
	{
		$_GET['image'] = '';
	}

	$image_url = getSerieScreenshot($_GET['image']);
	header('Location: '.$image_url);
}
