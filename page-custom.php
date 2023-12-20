<?php
require_once('app/config.php');
require_once('app/session.php');
require_once('app/functions.php');
require_once('app/dbconnection.php');

require_once(getThemeFile('settings'));

if (isset($theme['pages']))
{
	$url_parts = explode('/', $_GET['url']);
	$url_parts_count = count($url_parts);

	if ($url_parts_count == 1)
	{
		$key = array_search($url_parts[0], $theme['pages']['single']);
		if (false !== $key)
		{
			$page_custom = array(
				'section' => $theme['pages']['single'][$key]
			);
		}
	}
	else
	if ($url_parts_count == 2)
	{
		$key = array_search($url_parts[0], $theme['pages']['input']);
		if (false !== $key)
		{
			$page_custom = array(
				'section' => $theme['pages']['input'][$key],
				'input' => $url_parts[1]
			);	
		}
	}
}

if (isset($page_custom))
{
	require_once(getThemeFile('pages/'.$page_custom['section']));
}
else
{
	echo 'not found';
}
