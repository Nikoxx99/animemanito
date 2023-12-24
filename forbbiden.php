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
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Not available in your country</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!--link rel="stylesheet" href="https://unpkg.com/bulma@0.7.5/css/bulma.min.css" /-->
    <link rel="stylesheet" href="<?php echo getThemeUrl(); ?>/css/bulma.min.css">
    <link rel="stylesheet" href="<?php echo getThemeUrl(); ?>/css/fontawesome.all.min.css">
    <style>
    .has-text-orange {
        color: #E2C205!important;
    }
    .button.is-orange {
        background-color: #E2C205;
        border-color: transparent;
        color: #fff;
    }
    .button.is-pink{
        background-color: #e53935;
        border-color: transparent;
        color: #fff;
    }
    .frans-no-click{
        position: absolute;
        height: 100%;
        width: 100%;
    }
    
    .hero {
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
    }
    .hero-body{
        background: rgba(0,0,0,0.6);
    }
    .card-content{
        background-color: #222;
    }
    </style>
</head>

<body>
    <section class="hero is-success is-fullheight" style="background-image: url('<?php echo getThemeUrl(); ?>/images/bg-login.jpg');">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">

                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-4by2">
                                <div class="frans-no-click"></div>
                                <img src="<?php echo getThemeUrl(); ?>/images/header-login.gif" alt="Login">
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="content">
                                <h2 class="has-text-white">animemanito is not available in your country</h2><br>
                                <h3 class="has-text-white">animemanito no se encuentra disponible en tu pais.</h3><br>
                                <h3 class="has-text-white">あなたの国では利用できません</h3><br>
                                <h3 class="has-text-white">在您所在的国家/地区不可用</h3><br>
                                <br><br>
                                <p>Client IP: <?php echo $_SERVER['REMOTE_ADDR'];?></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</body>

</html>