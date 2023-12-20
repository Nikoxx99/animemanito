<?php
/*
POST DATA
nombre: Frans
categoria: hentai
estado: 1
censura: 0
imgrepro: https://hentaila.com/assets/img/defecto_3.png
imagen: https://hentaila.com/assets/img/defecto_1.jpg
mini: recorte
seo: automatico
fecha: 2019-07-15
visible: 1
sinopsis: 1234
trailer: 
generos: null
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	if (isset($_POST['nombre']) 
		&& isset($_POST['categoria']) 
		&& isset($_POST['estado']) 
		&& isset($_POST['censura']) 
		&& isset($_POST['image_cover']) 
		&& isset($_POST['image_screenshot']) 
		&& isset($_POST['image_banner']) 
		&& isset($_POST['seo']) 
		&& isset($_POST['visible'])
		&& isset($_POST['sinopsis'])
		&& isset($_POST['trailer'])
		&& isset($_POST['generos'])
	)
	{
		require_once('../../app/session.php');

		if (!isset($session))
		{
			echo 'not authorized!';
		    exit;
		}
		
		require_once('../../app/config.php');
		require_once('../../app/functions.php');
		require_once('../../app/dbconnection.php');

		require_once('../app/ImageResize/ImageResize.php');
		require_once('../app/ImageResize/ImageResizeException.php');

		$cdn_path = '../../cdn/';
		$cdn_path_cover = $config['media_folder'].'/cover/';
		$cdn_path_screenshot = $config['media_folder'].'/screenshot/';
		$cdn_path_banner = $config['media_folder'].'/banner/';

		// Create validations
		if (trim($_POST['nombre']) == '')
		{
			echo 'Error: Name is required!';
			exit;
		}
		
		if (trim($_POST['sinopsis']) == '')
		{
			echo 'Error: Synopsis is required!';
			exit;
		}

		$category_id = DB::queryFirstField('SELECT id FROM category WHERE id=%s', $_POST['categoria']);
		if ($category_id == null)
		{
			echo 'Error: Category does\'nt exist!';
			exit;
		}

		$status_id = DB::queryFirstField('SELECT id FROM status WHERE id=%s', $_POST['estado']);
		if ($status_id == null)
		{
			echo 'Error: Status does\'nt exist!';
			exit;
		}

		if ($_POST['seo'] !== 'automatico')
		{
			if (trim($_POST['seo']) == '')
			{
				echo 'Error: Url is required!';
				exit;
			}
		}

		// Generate Data to insert
		$data = array();
		$data['name'] = trim($_POST['nombre']);

		$data['genres'] = array();

		$input_genres_id = explode(',', $_POST['generos']);
		foreach ($input_genres_id as $input_genre_id)
		{
			$genre_id = DB::queryFirstField('SELECT id FROM genre WHERE id=%s', $input_genre_id);
			if ($genre_id !== null)
			{
				$data['genres'][] = '"'.$genre_id.'"';
			}
		}
		$data['genres'] = implode(',', $data['genres']);

		$data['category_id'] = $category_id;
		$data['status_id'] = $status_id;

		if ($_POST['censura'] == 'yes')
		{
			$data['censorship'] = 'yes';
		}
		else
		{
			$data['censorship'] = 'no';
		}

		if ($_POST['seo'] == 'automatico')
		{
			$data['url'] = format_uri($_POST['nombre']);
		}
		else
		{
			$data['url'] = trim($_POST['seo']);
		}

		if (trim($_POST['image_cover']) !== '')
		{
			$cover_image_data = file_get_contents_curl($_POST['image_cover']);
			$cover_image_ext = getImageExtFromString($cover_image_data);
			$cover_image_name = $data['url'].'-'.uniqid().'.'.$cover_image_ext;
			$cover_image_file = $cdn_path.$cdn_path_cover.$cover_image_name;

			if (in_array($cover_image_ext, array('jpg','png')))
			{
				file_put_contents($cover_image_file, $cover_image_data);
				$data['image_cover'] = $cover_image_name;

				$image = new \Gumlet\ImageResize($cover_image_file);
				$image->quality_jpg = 85;
				$image->resize(300, 450, $allow_enlarge = True);
				$image->save($cover_image_file, IMAGETYPE_JPEG);
			}
			else
			{
				echo 'Error: Image Cover only accept JPG, PNG!';
				exit;
			}
		}

		if (trim($_POST['image_screenshot']) !== '')
		{
			$screenshot_image_data = file_get_contents_curl($_POST['image_screenshot']);
			$screenshot_image_ext = getImageExtFromString($screenshot_image_data);
			$screenshot_image_name = $data['url'].'-'.uniqid().'.'.$screenshot_image_ext;
			$screenshot_image_file = $cdn_path.$cdn_path_screenshot.$screenshot_image_name;

			if (in_array($screenshot_image_ext, array('jpg','png')))
			{
				file_put_contents($screenshot_image_file, $screenshot_image_data);
				$data['image_screenshot'] = $screenshot_image_name;

				$image = new \Gumlet\ImageResize($screenshot_image_file);
				//$image->resizeToBestFit(640, 360);
				$image->quality_jpg = 85;
				$image->resize(640, 360, $allow_enlarge = True);
				$image->save($screenshot_image_file, IMAGETYPE_JPEG);
			}
			else
			{
				echo 'Error: Image Screenshot only accept JPG, PNG!';
				exit;
			}
		}

		if (trim($_POST['image_banner']) !== '')
		{
			$banner_image_data = file_get_contents_curl($_POST['image_screenshot']);
			$banner_image_ext = getImageExtFromString($banner_image_data);
			$banner_image_name = $data['url'].'-'.uniqid().'.'.$banner_image_ext;
			$banner_image_file = $cdn_path.$cdn_path_banner.$banner_image_name;

			if (in_array($banner_image_ext, array('jpg','png')))
			{
				file_put_contents($banner_image_file, $banner_image_data);
				$data['image_banner'] = $banner_image_name;
			}
			else
			{
				echo 'Error: Image Banner only accept JPG, PNG!';
				exit;
			}
		}
		if (isset($_POST['fecha'])) {
			$data['release_date'] = date('Y-m-d', strtotime($_POST['fecha']));
		} else {
			$data['release_date'] = null;
		}
		if (isset($_POST['date_next_episode'])) {
			$data['date_next_episode'] = date('Y-m-d', strtotime($_POST['date_next_episode']));
		} else {
			$data['date_next_episode'] = null;
		
		}
		$data['date_next_episode'] = date('Y-m-d', strtotime($_POST['date_next_episode']));
		$data['release_season'] = $_POST['release_season'];
		$data['text_next_episode'] = $_POST['text_next_episode'];

		if ($_POST['visible'] == 'yes')
		{
			$data['visible'] = 'yes';
		}
		else
		{
			$data['visible'] = 'no';
		}

		$data['synopsis'] = trim($_POST['sinopsis']);

		if (trim($_POST['trailer']) !== '')
		{
			$data['trailer'] = $_POST['trailer'];
		}
		
		
		// echo '<pre>';print_r($data);
		DB::insert('serie', $data);

		$id_actual = DB::queryFirstRow('SELECT id FROM serie ORDER BY id DESC');

		//Related Series Handler
		if (isset($_POST['related_series_data'])) {
			if (is_array($_POST['related_series_data'])) {
				foreach ($_POST['related_series_data'] as $key => $value) {
					if (isset($_POST['tipo_related'][$key])) {
						if (empty($_POST['related_series_data'])) {
							unset($_POST['related_series_data']);
						} else {
							$related['serie'] = $value;
							$related['type'] = $_POST['tipo_related'][$key];
							DB::insert('serie_related', [
								'id_serie' => $id_actual['id'],
								'id_serie_related' => $related['serie'],
								'type' => $related['type']
							  ]);
						}
					}
				}
				
			}
		}



		echo 'subido';
	}
}