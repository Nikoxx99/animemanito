<?php

function fixToSaveText($string)
{
	$string = trim($string);
	$string = strip_tags($string);
	return $string;
}