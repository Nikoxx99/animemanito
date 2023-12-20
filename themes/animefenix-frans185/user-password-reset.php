<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Cambia tu contraseña - <?php echo $config['site_name']; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!--link rel="stylesheet" href="https://unpkg.com/bulma@0.7.5/css/bulma.min.css" /-->
    <link rel="stylesheet" href="<?php echo getThemeUrl(); ?>/css/bulma.min.css">
    <link rel="stylesheet" href="<?php echo getThemeUrl(); ?>/css/fontawesome.all.min.css">
    <style>
    .has-text-orange {
        color: #ff7d12!important;
    }
    .button.is-orange {
        background-color: #ff7d12;
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
    <section class="hero is-success is-fullheight" style="background-image: url('<?php echo getThemeUrl(); ?>/images/bg-password-reset.jpg');">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">

                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-4by2">
                                <div class="frans-no-click"></div>
                                <img src="<?php echo getThemeUrl(); ?>/images/header-password-reset.gif" alt="Login">
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="content">
                                <div class="field">
                                    <p class="control has-icons-left has-icons-right">
                                        <input class="input" type="password" placeholder="Nueva contraseña" id="password">
                                        <span class="icon is-small is-left"><i class="fas fa-user"></i></span>
                                    </p>
                                </div>
                                <div class="field">
                                    <p class="control has-icons-left">
                                        <input class="input" type="password" placeholder="Repite la contraseña" id="password_repeat">
                                        <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
                                    </p>
                                </div>
                                <div class="notification is-danger is-paddingless" id="message">
                                    
                                </div>
                                <div class="field">
                                    <p class="control has-text-centered">
                                        <button class="button is-pink" id="send_button">Confirmar</button>
                                    </p>
                                </div>
                                <p class="has-text-grey has-text-weight-semibold">
                                    <a href="<?php echo $config['urlpath']; ?>/user/login">Ingresa</a>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#send_button').click(function() {
                var urlpath = '<?php echo $config['urlpath']; ?>';
                var token = '<?php echo $_GET['token']; ?>';
                var remember = 'yes';
                var password = $('#password').val();
                var password_repeat = $('#password_repeat').val();
                if(password || password_repeat){
                    if (password === password_repeat) {
                        $('#message').html('Cargando...').slideDown(500);
                        $.post(urlpath + '/user/password-reset', {
                                password: password,
                                password_repeat: password_repeat,
                                token: token
                            })
                            .done(function(response) {
                                if(response.error){
                                    $('#message').html(response.error).slideDown(500);
                                }else{
                                    $('#message').html("Contraseña Actualizada con Éxito. Puedes ir ingresar ahora.");
                                    $('.field').hide();
                                }
                            })
                    }else{
                        $('#message').html('Las contraseñas no coinciden.').slideDown(500);
                    }
                }else{
                    $('#message').html('Ingresa una contraseña.').slideDown(500);
                }
                
            });
        });
    </script>
</body>

</html>