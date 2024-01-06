<?php
require_once('phpmailer.php');
require_once('smtp.php');
require_once('exception.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function startZone() {
    ob_start();
}

function endZone() {
    $section = ob_get_contents();
    ob_end_clean();
    return $section;
}

function Redirect404To($path='')
{
    global $config;
    header('HTTP/1.0 404 Not Found');
    header('Location: '.$path);
    exit;
}
function RedirectTo($path='')
{
    global $config;
    header('Location: '.$path);
    exit;
}

function getThemePath($default = false)
{
    global $config, $session;

    if ( isset($session) && (!defined('FRANS_THEME_NOT_FOUND') && $default == false) )
    {
        $config['theme'] = $session['theme'];
    }
    //echo $config['theme'].'<br>';
    return dirname(__FILE__).'/../themes/'.$config['theme'];
}

function getThemeFile($file_name)
{
    global $config;

    $file_name .= '.php';

    $file = getThemePath().'/'.$file_name;

    if (!defined('FRANS_THEME_NOT_FOUND'))
    {
        if (!file_exists($file))
        {
            $config['theme'] = 'default';
            $file = getThemePath(true).'/'.$file_name;

            define('FRANS_THEME_NOT_FOUND', true);
        }
    }
    
    return $file;
}

function getThemeUrl()
{
    global $config;
    return $config['urlpath'].'/themes/'.$config['theme'];
}

// SERIE IMAGE  HELPERS
function getSerieScreenshot($image)
{
    global $config;
    
    if ($image == '')
        return $config['cdnpath'].'/'.$config['media_folder'].'/no_screenshot.png';

    preg_match('#(.*)-(.*).(jpg|png|gif)#', $image, $match);
    $url = $config['cdnpath'].'/'.$config['media_folder'].'/screenshot/'.$match[2].'/'.$match[1].'.'.$match['3'];
    //$url = $config['cdnpath'].'/'.$config['media_folder'].'/screenshot/'.$image;
    return $url;
}

function getSerieCover($image)
{
    global $config;
    
    if ($image == '')
        return $config['cdnpath'].'/'.$config['media_folder'].'/no_cover.png';

    preg_match('#(.*)-(.*).(jpg|png|gif)#', $image, $match);
    $url = $config['cdnpath'].'/'.$config['media_folder'].'/cover/'.$match[2].'/'.$match[1].'.'.$match['3'];
    //$url = $config['cdnpath'].'/'.$config['media_folder'].'/cover/'.$image;
    return $url;
}

function getEpisodeImage($image_screenshot, $image_episode)
{
    global $config;

    if ($image_episode == '')
        return getSerieScreenshot($image_screenshot);
    
    preg_match('#(.*)-(.*).(jpg|png|gif)#', $image_episode, $match);
    $url = $config['cdnpath'].'/'.$config['media_folder'].'/episode/'.$match[2].'/'.$match[1].'.'.$match['3'];
    //$url = $config['cdnpath'].'/'.$config['media_folder'].'/banner/'.$image;
    return $url;
}

// END





// ANIME HELPERS

function getUserAvatar($image)
{
    global $config;

    if ($image == '')
        return $config['cdnpath'].'/user/no_avatar.png';
    
    $url = $config['cdnpath'].'/user/avatar/'.$image;
    return $url;
}



function getSerieBanner($image)
{
    global $config;

    if ($image == '')
        return $config['cdnpath'].'/'.$config['media_folder'].'/no_banner.png';
    
    preg_match('#(.*)-(.*).(jpg|png|gif)#', $image, $match);
    $url = $config['cdnpath'].'/'.$config['media_folder'].'/banner/'.$match[2].'/'.$match[1].'.'.$match['3'];
    //$url = $config['cdnpath'].'/'.$config['media_folder'].'/banner/'.$image;
    return $url;
}


function format_uri( $string, $separator = '-' )
{
    $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
    $special_cases = array( '&' => 'and', "'" => '');
    $string = mb_strtolower( trim( $string ), 'UTF-8' );
    $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
    $string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
    $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
    $string = preg_replace("/[$separator]+/u", "$separator", $string);
    
    if (substr($string, -1) == $separator)
    {
        $string = substr($string, 0, -1);
    }

    return $string;
}

function file_get_contents_curl($url)
{ 
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_HEADER, 0); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_USERAGENT, 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)');
    curl_setopt($ch, CURLOPT_REFERER, 'https://www.facebook.com/');

    $data = curl_exec($ch); 
    curl_close($ch); 
    return $data; 
} 

function getImageExtFromString($image_data)
{
    $info = getimagesizefromstring($image_data);
    switch ($info['mime']) {
        case 'image/png': $ext = 'png'; break;
        case 'image/jpeg': $ext = 'jpg'; break;
        case 'image/gif': $ext = 'gif'; break;
        default: $ext = 'png'; break;
    }
    return $ext;
}

function getSerieGenres($genres)
{    
    if (!isset($GLOBALS['genres_list_by_id']))
    {
        $genre_list = DB::query('SELECT * FROM genre ORDER BY name ASC');
        $GLOBALS['genres_list_by_id'] = array();
        foreach ($genre_list as $genre)
        {
            $GLOBALS['genres_list_by_id'][$genre['id']] = $genre;
        }
    }

    $list_of_genres = array();
    $genre_ids = str_replace('"', '', $genres);
    $genre_ids = explode(',', $genre_ids);
    foreach ($genre_ids as $genre_id)
    {
        if(isset($GLOBALS['genres_list_by_id'][ $genre_id ]))
        {
            $list_of_genres[] = $GLOBALS['genres_list_by_id'][ $genre_id ];
        }
    }
    //return implode(', ', $list_of_genres);
    return $list_of_genres;
}

function getSerieCategory($category_id)
{    
    if (!isset($GLOBALS['category_list_by_id']))
    {
        $category_list = DB::query('SELECT * FROM category ORDER BY name ASC');
        $GLOBALS['category_list_by_id'] = array();
        foreach ($category_list as $category)
        {
            $GLOBALS['category_list_by_id'][$category['id']] = $category['name'];
        }
    }

    $category = 'none';

    if(isset($GLOBALS['category_list_by_id'][ $category_id ]))
    {
        $category = $GLOBALS['category_list_by_id'][ $category_id ];
    }
    return $category;
}

function getSerieStatus($status_id)
{
    if (!isset($GLOBALS['status_list_by_id']))
    {
        $GLOBALS['status_list_by_id'] = array();
    }

    if (isset($GLOBALS['status_list_by_id'][$status_id]))
    {
        return $GLOBALS['status_list_by_id'][$status_id];
    }
    else
    {
        $GLOBALS['status_list_by_id'][$status_id] = DB::queryFirstField('SELECT name FROM status WHERE id = %s', $status_id);
        return $GLOBALS['status_list_by_id'][$status_id];
    }
}


function FrankySetCache($folder, $file, $val) {
    $val = var_export($val, true);
    // HHVM fails at __set_state, so just use object cast for now
    $val = str_replace('stdClass::__set_state', '(object)', $val);
    // Write to temp file first to ensure atomicity
    //$tmp = "/tmp/$file." . uniqid('', true) . '.tmp';
    //file_put_contents($tmp, '<?php $val = ' . $val . ';', LOCK_EX);


    $folder = dirname(__FILE__).'/../cache/';
    if ($folder !== '')
    {
        $folder .= '/';
    }

    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }
    
    file_put_contents($folder.$file.'.php', '<?php $val = ' . $val . ';', LOCK_EX);

    //rename($tmp, $folder.$file.'.php');
}

function FrankyGetCache($folder, $file)
{
    @include dirname(__FILE__).'/../cache/'.$folder.'/'.$file.'.php';
    return isset($val) ? $val : false;
}

function FrankyIsCacheExpired($folder, $file)
{
    $folder_path = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR;
    if ($folder !== '')
    {
        $folder_path .= $folder.DIRECTORY_SEPARATOR;
    }
    $cache_file = $folder_path.$file.'.php';

    $minutes = 5;
    if(file_exists($cache_file) && (filemtime($cache_file) > (time() - 60 * $minutes )))
        return false;
    else
        return true;
}

function getTypeName($type)
{
    $type_name = '';

    $types = [];
    $types['tv'] = 'Serie';
    $types['movie'] = 'Película';
    $types['special'] = 'Especial';
    $types['ova'] = 'Ova';

    if (isset($types[$type]))
        $type_name = $types[$type];

    return $type_name;
}

function fixInputText($input)
{
    $input = strip_tags($input);
    $input = trim($input);
    return $input;
}

function generateUniqueId(){
    return str_replace('.','',microtime(true));
}

function frans_order_servers($a, $b) {
    global $config;

    if ($a[ $config['server_key'] ] == $b[ $config['server_key'] ]) {
        return 0;
    }
    return (array_search($a[ $config['server_key'] ],$config['server_order']) < array_search($b[ $config['server_key'] ],$config['server_order'])) ? -1 : 1;
}

function getPercentage($up_votes,$down_votes){
    echo $up_votes;
    if ($up_votes == 0 or $down_votes == 0) {
        return 'Sem votos';
    } else {
        $ratio = $up_votes / ($up_votes + $down_votes);
        $puntuacion = $ratio * 9 + 1;
    
        return round($puntuacion, 2) . '/10';
    }

}

function getVotes($up,$down){
    $votes = $up+$down;
    return $votes;
}
function send_mail($email,$token,$username){
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                       // Enable verbose debug output
        // $mail->isSMTP();    
        $mail->CharSet = "utf-8";                                        // Set mailer to use SMTP
        $mail->Host       = 'mail.ytlandia.es';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'fenix@ytlandia.es';                     // SMTP username
        $mail->Password   = 'a6M5TjwRjPpzZ5c';                               // SMTP password
        $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 465;                                    // TCP port to connect to
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        //Recipients
        $mail->setFrom('fenix@ytlandia.es', 'animemanito Papu');    // Add a recipient
        $mail->addAddress($email);               // Name is optional

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Resetear clave en animemanito';
        $mail->Body    = 'Se ha solicitado un reseteo para tu cuenta en animemanito: '.$username.'<br>Si no has sido tu has caso omiso a este mensaje.<br><br>Visita el siguiente link para resetear tu clave: https://www.animemanito.com/user/password-reset?token='.$token."<br>El link será valido solo por las siguientes 48 horas";

        $mail->send();
    }catch (Exception $e) {
        echo "El mensaje no pudo ser enviado. Envia el siguiente error a un administrador de animemanito: {$mail->ErrorInfo}";
    }
}