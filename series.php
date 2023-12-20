<?php
require_once('app/config.php');
require_once('app/session.php');
require_once('app/functions.php');
require_once('app/dbconnection.php');

require_once(getThemeFile('settings'));

$data = array();






// FILTERS VALUES
$data['years'] = array();
$data['genres'] = DB::query('SELECT * FROM genre ORDER BY name ASC');
$data['categories'] = DB::query('SELECT * FROM category ORDER BY id ASC');
$data['status'] = DB::query('SELECT * FROM status ORDER BY id ASC');

$data['order-list'] = array();
$data['order-list'][] = ['url' => 'default', 'name' => 'Por Defecto'];
$data['order-list'][] = ['url' => 'updated', 'name' => 'Recientemente Actualizados'];
$data['order-list'][] = ['url' => 'added', 'name' => 'Recientemente Agregados'];
$data['order-list'][] = ['url' => 'title', 'name' => 'Nombre A-Z'];
$data['order-list'][] = ['url' => 'likes', 'name' => 'Calificación'];
$data['order-list'][] = ['url' => 'visits', 'name' => 'Más Vistos'];

for($i=date('Y'); $i>=1990; $i--)
{
	$data['years'][] = $i;
}


$db_genre = array();
foreach ($data['genres'] as $genre)
{
	$db_genre[$genre['url']] = $genre['id'];
}

$db_category = array();
foreach ($data['categories'] as $category)
{
	$db_category[$category['url']] = $category['id'];
}

$sql_order = 'id DESC';
$sql_query = '';
$url_query = '';
if(isset($_GET['q']))
{
	$url_query = '&q='.urlencode($_GET['q']);
	$input_name_sql = fixInputText($_GET['q']);
	$input_name_sql = str_replace(' ', '%', $input_name_sql);
	$input_name_sql = str_replace('-', '%', $input_name_sql);

	$sql_query .= 'AND (';
	$sql_query .= 'name LIKE "%'.$input_name_sql.'%" ';

	//$sql_query .= 'OR name_alternative LIKE "%'.$input_name_sql.'%")';
	$sql_query .= ')';
}

if(isset($_GET['genero']) || isset($_GET['year']) || isset($_GET['type']) || isset($_GET['estado']) || isset($_GET['order']) )
{
	//$url_query = '?';
	if(isset($_GET['genero']))
	{
		if(is_array($_GET['genero']))
		{
			if(count($_GET['genero']) == 1)
			{
				if(isset($db_genre[ $_GET['genero'][0] ]))
				{
					$genre_id = $db_genre[ $_GET['genero'][0] ];
					$sql_query .= 'AND genres LIKE "%\"'.$genre_id.'\"%" ';
					$url_query .= '&genero[]='.$_GET['genero'][0];
				}
			}
			else
			{
				for ($i=0; $i < count($_GET['genero']); $i++)
				{
					if(isset($db_genre[ $_GET['genero'][$i] ]))
					{
						$genre_id = $db_genre[ $_GET['genero'][$i] ];
						$sql_query .= 'AND genres LIKE "%\"'.$genre_id.'\"%" ';
						$url_query .= '&genero[]='.$_GET['genero'][$i];
					}
				}
			}
			//echo $sql_query;
		}
	}

	if(isset($_GET['year']))
{
    if(is_array($_GET['year']))
    {
        $sql_years = array();
        for ($i=0; $i < count($_GET['year']); $i++)
        {
            $year_id = $_GET['year'][$i];
            $sql_years[] = 'release_date LIKE "'.$year_id.'-%"';
            $url_query .= '&year[]='.$_GET['year'][$i];
        }
        if (!empty($sql_years)) {
            $sql_query .= ' AND (' . implode(' OR ', $sql_years) . ') ';
        }
        //echo $sql_query;
    }
}

	if(isset($_GET['type']))
	{
		if(is_array($_GET['type']))
		{
			if(count($_GET['type']) == 1)
			{
				if(isset($db_category[ $_GET['type'][0] ]))
				{
					$category_id = $db_category[ $_GET['type'][0] ];
					$sql_query .= 'AND category_id="'.$category_id.'"';
					$url_query .= '&type[]='.$_GET['type'][0];
				}
			}
			else
			{
				$sql_query .= 'AND ( ';
				$sql_ors = array();
				for ($i=0; $i < count($_GET['type']); $i++)
				{
					if(isset($db_category[ $_GET['type'][$i] ]))
					{
						$category_id = $db_category[ $_GET['type'][$i] ];
						$sql_ors[] = 'category_id="'.$category_id.'"';
						$url_query .= '&type[]='.$_GET['type'][$i];
					}
				}
				$sql_query .= implode(' OR ', $sql_ors);
				$sql_query .= ') ';
			}
			// Fix no where data
			$sql_query = str_replace('AND ( )', '', $sql_query);
		}
	}

	if(isset($_GET['estado']))
	{
		if(is_array($_GET['estado']))
		{
			if(count($_GET['estado']) == 1)
			{
				$value = fixInputText($_GET['estado'][0]);
				$sql_query .= 'AND status_id="'.$value.'"';
				$url_query .= '&estado[]='.$_GET['estado'][0];
			}
			else
			{
				$sql_query .= 'AND ( ';
				$sql_ors = array();
				for ($i=0; $i < count($_GET['estado']); $i++)
				{
					$value = fixInputText($_GET['estado'][$i]);
					$sql_ors[] = 'status_id="'.$value.'"';
					$url_query .= '&estado[]='.$_GET['estado'][$i];
				}
				$sql_query .= implode(' OR ', $sql_ors);
				$sql_query .= ') ';
			}
		}
	}

	if(isset($_GET['order']))
	{
		switch ($_GET['order']) {
			case 'default': $sql_order = 'id DESC'; break;//Por Defecto
			case 'updated': $sql_order = 'id DESC'; break;//Recientemente Actualizados
			case 'added': $sql_order = 'id DESC'; break;
			case 'title': $sql_order = 'name ASC'; break;
			case 'likes': $sql_order = 'likes DESC'; break;
			case 'visits': $sql_order = 'visits DESC'; break;
			default: $no_order = true; break;
		}
		if (!isset($no_order))
		{
			$url_query .= '&order='.fixInputText($_GET['order']);
		}
	}
}

if($url_query == '')
{
	$url_query = '?';
}
else
{
	$url_query = '?'.substr($url_query, 1).'&';
}

$paginator = array();
if(isset($_GET['page']))
{
	$paginator['page'] = $_GET['page'];	
}
else
{
	$paginator['page'] = 1;
}

$paginator['limit'] = 25;
$paginator['links'] = 10;
$paginator['total'] = DB::queryFirstField('SELECT COUNT(*) FROM serie WHERE id IS NOT NULL '.$sql_query);

$data['series'] = DB::query('SELECT * FROM serie WHERE id IS NOT NULL '.$sql_query.' ORDER BY '.$sql_order.' LIMIT '.( ( $paginator['page'] - 1 ) * $paginator['limit'] ) . ',' . $paginator['limit']);



$config['page_title'] = $config['site_name'];
$config['current_url'] = $config['urlpath'].'/animes';

require_once(getThemeFile('series'));
