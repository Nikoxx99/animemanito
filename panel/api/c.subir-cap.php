<?php
/*
POST DATA
codserie: 2
nroepi: 1
fecha: 2019-07-18
visible: yes
titulo: 1
facebook: 
video[]: drive
codigo[]: 123
url[]: https://www.facebook.com/
url[]: https://www.fb.com/
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (
		isset($_POST['codserie'])
		&& isset($_POST['nroepi'])
		&& isset($_POST['fecha'])
		&& isset($_POST['visible'])
		&& isset($_POST['titulo'])
		&& isset($_POST['facebook'])
	) {
		require_once('../../app/session.php');

		if (!isset($session)) {
			echo 'not authorized!';
			exit;
		}

		require_once('../../app/config.php');
		require_once('../../app/functions.php');
		require_once('../../app/dbconnection.php');

		require_once('../app/ImageResize/ImageResize.php');
		require_once('../app/ImageResize/ImageResizeException.php');

		$cdn_path = '../../cdn/';
		$cdn_path_episode = $config['media_folder'] . '/episode/';

		// Create validations
		$serie = DB::queryFirstRow('SELECT * FROM serie WHERE id=%s', $_POST['codserie']);
		if ($serie == null) {
			echo 'Error: Serie does\'nt exist!';
			exit;
		}

		//Update the next episode date
		$update_date_next_episode = $_POST['update_date_next_episode'];
		$update_date_next_episode_data = $_POST['update_date_next_episode_data'];
		if(isset($update_date_next_episode)){
			DB::update('serie', ['date_next_episode' => $update_date_next_episode_data], "id=%i", $serie['id']);
		}

		$language_id = DB::queryFirstField('SELECT id FROM language WHERE id=%s', $_POST['titulo']);
		if ($language_id == null) {
			echo 'Error: Status does\'nt exist!';
			exit;
		}

		// Generate Data to insert
		$data = array();
		$data['serie_id'] = $serie['id'];
		$data['number'] = trim($_POST['nroepi']);
		$data['episodegroup'] = $_POST['groepi'] != '' ? trim($_POST['groepi']) : null;

		$data['release_date'] = date('Y-m-d', strtotime($_POST['fecha']));

		if ($_POST['visible'] == 'yes') {
			$data['visible'] = 'yes';
		} else {
			$data['visible'] = 'no';
		}

		$data['language_id'] = $language_id;
		//$data['videos'] = trim($_POST['nombre']);

		if (trim($_POST['facebook']) !== '') {
			$episode_image_data = file_get_contents_curl($_POST['facebook']);
			$episode_image_ext = getImageExtFromString($episode_image_data);
			$episode_image_name = $serie['url'] . '-' . $data['number'] . '-' . uniqid() . '.' . $episode_image_ext;
			$episode_image_file = $cdn_path . $cdn_path_episode . $episode_image_name;

			if (in_array($episode_image_ext, array('jpg', 'png'))) {
				file_put_contents($episode_image_file, $episode_image_data);
				$data['image'] = $episode_image_name;

				$image = new \Gumlet\ImageResize($episode_image_file);
				//$image->resizeToBestFit(640, 360);
				$image->quality_jpg = 85;
				$image->resize(640, 360, $allow_enlarge = True);
				$image->save($episode_image_file, IMAGETYPE_JPEG);
			} else {
				echo 'Error: Image Episode only accept JPG, PNG!';
				exit;
			}
		}

		if (isset($_POST['video'])) {
			if (is_array($_POST['video'])) {
				$data['videos'] = array();
				foreach ($_POST['video'] as $key => $value) {
					if (isset($_POST['codigo'][$key])) {
						if (trim($value) !== '' && trim($_POST['codigo'][$key]) !== '') {
							$data['videos'][] = array(
								'player' => $value,
								'code' => $_POST['codigo'][$key]
							);
						}
					}
				}
				if (empty($data['videos'])) {
					unset($data['videos']);
				} else {
					$data['videos'] = json_encode($data['videos']);
				}
			}
		}

		if (isset($_POST['video'])) {
			if (is_array($_POST['url'])) {
				$data['downloads'] = array();
				foreach ($_POST['url'] as $key => $value) {
					if (trim($value) !== '') {
						$data['downloads'][] = $value;
					}
				}
				if (empty($data['downloads'])) {
					unset($data['downloads']);
				} else {
					$data['downloads'] = json_encode($data['downloads']);
				}
			}
		}

		// if (isset($_POST['update_date'])) {
		// 	$temp_data = DB::queryFirstRow('SELECT date_next_episode FROM serie WHERE id=%s', $data['serie_id']);
		// 	echo $temp_data[0];
		// 	$new_date = date("Y-m-d", strtotime($$temp_data[0] . " + 1 week"));
		// 	echo $new_date;
		// 	DB::update('update serie set date_next_episode = ? where id = ?', [$new_date, $data['serie_id']]);
		// }
		//echo '<pre>';print_r($data);
		DB::insert('serie_episode', $data);
		//Enfiar notificacion del capitulo
		// if (isset($_POST['send_notification'])) {
		// 	$data['text_notification'] = $_POST['text_notification'];
		// 	$nombre_link = $serie['name'] . " " . $serie['number'];
		// 	$imagen_noti = $config['cdnpath'] . "/" . $cdn_path_episode . $data['image'];
		// 	$img_badge = $config['urlpath'] . "/themes/" . $config['theme'] . "/images/AF-LOG.ico";
		// 	$texto_sub = $data['text_notification'];
		// 	function sendMessage($nombre_link1, $texto_sub, $img, $badge)
		// 	{
		// 		$titulo_noti = $nombre_link1 . " | animemanito";
		// 		$message      = array(
		// 			'title' => $titulo_noti,
		// 			'text' => $texto_sub,
		// 			'url' => 'https://www.animemanito.com/',
		// 			'image' => $img,
		// 			'icon' => $badge
		// 		);
		// 		$fields = array(
		// 			'message' => $message
		// 		);

		// 		$fields = json_encode($fields);

		// 		$ch = curl_init();
		// 		curl_setopt($ch, CURLOPT_URL, "http://notix.io/api/send?app=10040253060911e2dc65ae5d88d69ed");
		// 		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		// 			'Content-Type: application/json; charset=utf-8',
		// 			'Authorization-Token: 7d1feed5a069306a511cbd2beb9c3bdef7c78aa96c71733e'
		// 		));
		// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		// 		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		// 		curl_setopt($ch, CURLOPT_POST, TRUE);
		// 		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		// 		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		// 		$response = curl_exec($ch);
		// 		curl_close($ch);
		// 		$response = "";
		// 		return $response;
		// 	}

		// 	sendMessage($nombre_link, $texto_sub, $imagen_noti, $img_badge);
		// }
		echo 'subido';
	}
}
