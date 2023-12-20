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
        && isset($_POST['email'])
        && isset($_POST['recaptcha'])
    )
    {
        require_once('app/dbconnection.php');

        function validate_twitter_username($username) {
            return preg_match('/^[A-Za-z0-9_]+$/', $username);
        }

        $response = array();

        $username = trim($_POST['username']);
        $password = $_POST['password'];
        $email = trim($_POST['email']);
        $recaptcha = $_POST['recaptcha'];

        if ($recaptcha == '')
        {
            $response['error'] = 'Verifica que no eres un robot';
        }
        else
        {
            if ($username == '')
            {
                $response['error'] = 'Ingresa un nombre de usuario';
            }
            else
            {
                if ($username == '')
                {
                    $response['error'] = 'Ingresa un email';
                }
                else
                {
                    if (validate_twitter_username($username) == false)
                    {
                        $response['error'] = 'El usuario solo puede tener letras, números y guion bajo';
                    }
                    else
                    {
                        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false)
                        {
                            $response['error'] = 'El email es invalido';
                        }
                        else
                        {
                            $user_count = DB::queryFirstField('SELECT COUNT(*) FROM user WHERE username=%s', $username);
                            if ($user_count > 0)
                            {
                                $response['error'] = 'El usuario ya existe';
                            }
                            else
                            {
                                $email_count = DB::queryFirstField('SELECT COUNT(*) FROM user WHERE email=%s', $email);
                                if ($email_count > 0)
                                {
                                    $response['error'] = 'El email ya existe';
                                }
                                else
                                {
                                
                                    // Create a new user account
                                    $user = array();
                                    $user['username'] = $username;
                                    $user['name'] = $username;
                                    $user['email'] = $email;
                                    $user['avatar'] = null;
                                    $user['role'] = 'user';
                                    $user['password'] = md5($password);
                                    $user['theme'] = $config['theme'];

                                    DB::insert('user', $user);

                                    // Login automatic after sign up
                                    setcookie('username', $user['username'], false, '/');
                                    setcookie('token', $user['password'], false, '/');
                                }
                            }
                        }

                    }
                }
            }
        }

        //$response['error'] = 'Falta programar';

        if (!isset($response['error']))
        {
            $response['success'] = true;
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($response);
        exit;
    }
}

//$config['theme'] = 'hentaila';

require_once(getThemeFile('user-signup'));
