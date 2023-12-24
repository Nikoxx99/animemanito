<?php
date_default_timezone_set('UTC');
$env = getenv('ENV');
$host = ($env === 'DEV' ? 'animemanito.test' : 'animemanito.tv');
function getSiteDomain()
{
	$domain = $_SERVER['SERVER_NAME'] ?? '';
	$domain = preg_replace('/^www\./', '', $domain);
	return $domain;
}

$site_domain = getSiteDomain();
/*
https://stackoverflow.com/questions/17201170/php-how-to-get-the-base-domain-url
*/
/*
$url = trim($url, '/');
$urlParts = parse_url($url);
$domain = preg_replace('/^www\./', '', $urlParts['host']);
*/
//require_once('config.'.$site_domain.'.php');
require_once('config.'.$host.'.php');

//$config['theme'] = 'hentaila';
//$config['theme'] = 'animefenix';
//$config['theme'] = 'animefenix-frans185';
//$config['theme'] = 'animeyt';
