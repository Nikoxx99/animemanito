<?php
require_once('app/config.php');
require_once('app/session.php');
require_once('app/functions.php');

if (isset($session))
{
    RedirectTo($config['urlpath']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_POST['username']) 
        && isset($_POST['password'])
        && isset($_POST['remember'])
    )
    {
        require_once('app/dbconnection.php');

        $response = array();

        $user = DB::queryFirstRow('SELECT * FROM user WHERE username=%s AND password=%s', $_POST['username'], md5($_POST['password']));
        if ($user == null)
        {
            $response['error'] = 'Inicio de sesión incorrecto';
        }
        else
        {
            $hour = time() + 3600 * 24 * 30 * 12; //Define el tiempo de duracion de la cookie a 1 año
            setcookie('user_id', $user['id'], $hour, '/');
            setcookie('username', $user['username'], $hour, '/');
            setcookie('token', $user['password'], $hour, '/');

            $response['success'] = true;
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($response);
        exit;
    }
}

//$config['theme'] = 'hentaila';

require_once(getThemeFile('user-login'));
