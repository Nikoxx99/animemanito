<?php
/*
POST DATA
codserie: 2
nroepi: 1
fecha: 2018-08-28
visible: yes
titulo: 1
facebook: 
id: 712
video[]: fembed
codigo[]: 123
url[]: https://www.facebook.com/
url[]: https://www.fb.com/
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	if (isset($_POST['codserie']) 
		&& isset($_POST['nroepi']) 
		&& isset($_POST['fecha']) 
		&& isset($_POST['visible'])
		&& isset($_POST['titulo'])
		&& isset($_POST['facebook'])
		&& isset($_POST['id'])
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
		$cdn_path_episode = $config['media_folder'].'/episode/';

		// Create validations
		$serie = DB::queryFirstRow('SELECT * FROM serie WHERE id=%s', $_POST['codserie']);
		if ($serie == null)
		{
			echo 'Error: Serie does\'nt exist!';
			exit;
		}

		$episode = DB::queryFirstRow('SELECT * FROM serie_episode WHERE serie_id=%s AND id=%s', $serie['id'], $_POST['id']);
		if ($episode == null)
		{
			echo 'Error: Episode does\'nt exist!';
			exit;
		}

		$language_id = DB::queryFirstField('SELECT id FROM language WHERE id=%s', $_POST['titulo']);
		if ($language_id == null)
		{
			echo 'Error: Status does\'nt exist!';
			exit;
		}

		// Generate Data to insert
		$data = array();
		$data['serie_id'] = $serie['id'];
		$data['number'] = trim($_POST['nroepi']);
		$data['episodegroup'] = $_POST['groepi'] != '' ? trim($_POST['groepi']) : null;
		$data['release_date'] = date('Y-m-d', strtotime($_POST['fecha']));
		
		if ($_POST['visible'] == 'yes')
		{
			$data['visible'] = 'yes';
		}
		else
		{
			$data['visible'] = 'no';
		}

		$data['language_id'] = $language_id;

		if (trim($_POST['facebook']) !== '')
		{
			$episode_image_data = file_get_contents_curl($_POST['facebook']);
			$episode_image_ext = 'jpg';
			$episode_image_name = $serie['url'].'-'.$data['number'].'-'.uniqid().'.'.$episode_image_ext;
			$episode_image_file = $cdn_path.$cdn_path_episode.$episode_image_name;

			file_put_contents($episode_image_file, $episode_image_data);
			$data['image'] = $episode_image_name;

			$image = new \Gumlet\ImageResize($episode_image_file);
			//$image->resizeToBestFit(640, 360);
			$image->quality_jpg = 85;
			$image->resize(640, 360, $allow_enlarge = True);
			$image->save($episode_image_file, IMAGETYPE_JPEG);
		}

		if (isset($_POST['video']))
		{
			if (is_array($_POST['video']))
			{
				$data['videos'] = array();
				foreach ($_POST['video'] as $key => $value)
				{
					if (isset($_POST['codigo'][$key]))
					{
						if (trim($value) !== '' && trim($_POST['codigo'][$key]) !== '')
						{
							$data['videos'][] = array(
								'player' => $value,
								'code' => $_POST['codigo'][$key]
							);
						}
					}
				}
				if (empty($data['videos']))
				{
					unset($data['videos']);
				}
				else
				{
					$data['videos'] = json_encode($data['videos']);
				}
			}
		}
		else
		{
			$data['videos'] = null;
		}

		if (isset($_POST['url']))
		{
			if (is_array($_POST['url']))
			{
				$data['downloads'] = array();
				foreach ($_POST['url'] as $key => $value)
				{
					if (trim($value) !== '')
					{
						$data['downloads'][] = $value;
					}
				}
				if (empty($data['downloads']))
				{
					unset($data['downloads']);
				}
				else
				{
					$data['downloads'] = json_encode($data['downloads']);
				}
			}
		}
		else
		{
			$data['downloads'] = null;
		}

		//echo '<pre>';print_r($data);
		DB::update('serie_episode', $data, 'serie_id=%s AND id=%s', $serie['id'], $episode['id']);

		if (isset($episode_image_file))
		{
			$file = $cdn_path.$cdn_path_episode.$episode['image'];
			if (file_exists($file))
			{
				unlink($file);
			}
		}

		echo 'subido';
	}
}
