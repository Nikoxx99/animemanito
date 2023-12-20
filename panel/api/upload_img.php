<?php
/*
POST DATA
idusuario: 1
file: (binary)
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	if (isset($_FILES['file']))
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
		$cdn_path_avatar = 'user/avatar/';

		if (isset($_POST['idusuario']))
		{

			if (in_array($_FILES['file']['type'], array('image/jpeg', 'image/png')))
			{
				$avatar_image_data = file_get_contents($_FILES['file']['tmp_name']);
				$avatar_image_ext = 'jpg';
				$avatar_image_name = $session['id'].'-'.uniqid().'.'.$avatar_image_ext;
				$avatar_image_file = $cdn_path.$cdn_path_avatar.$avatar_image_name;

				file_put_contents($avatar_image_file, $avatar_image_data);

				$image = new \Gumlet\ImageResize($avatar_image_file);
				$image->quality_jpg = 85;
				$image->resize(320, 320, $allow_enlarge = True);
				$image->save($avatar_image_file, IMAGETYPE_JPEG);

				$data = array(
					'avatar' => $avatar_image_name
				);

				DB::update('user', $data, 'id=%s', $session['id']);

				$file = $cdn_path.$cdn_path_avatar.$session['avatar'];
				if (file_exists($file))
				{
					unlink($file);
				}

				echo 'Imagen actualizada!';	
			}
			else
			{
				echo 'Error: Solo se acepta imagenes JPG y PNG!';
				exit;
			}

			
		}		
	}
}
