<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Recuperar Contraseña - <?php echo $config['site_name']; ?></title>
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
    <section class="hero is-success is-fullheight" style="background-image: url('<?php echo getThemeUrl(); ?>/images/bg-forgot-password.jpg');background-size:cover;">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">

                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-4by2">
                                <div class="frans-no-click"></div>
                                <img src="<?php echo getThemeUrl(); ?>/images/header-forgot-password.gif" alt="Login">
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="content">

                                <div class="field">
                                    <p class="control has-icons-left has-icons-right">
                                        <input class="input" type="text" placeholder="Tu Email" id="email">
                                        <span class="icon is-small is-left"><i class="fas fa-user"></i></span>
                                        <?php /*<span class="icon is-small is-right"><i class="fas fa-check"></i></span>*/?>
                                    </p>
                                </div>

                                <div class="notification is-danger is-paddingless" id="message">
                                    
                                </div>
                                <div class="field">
                                    <p class="control has-text-centered">
                                        <button class="button is-pink" id="send_button">Enviar Correo de Recuperacion</button>
                                    </p>
                                </div>

                                <p class="has-text-grey has-text-weight-semibold">
                                    <a href="<?php echo $config['urlpath']; ?>/user/login">Ingresa</a> &nbsp;·&nbsp;
                                    <a href="<?php echo $config['urlpath']; ?>/user/signup">Registrate</a>
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
                var email = $('#email').val();
                var email_validation = email.split(" ").join("");
                regex_for_email = /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
                if (!regex_for_email.exec(email_validation)) {
                    $('#message').html('Email no v\u00e1lido').slideDown(500);
                }else{
                    $('#message').html('Enviando mensaje de recuperacion...').slideDown(500);
                    $.post(urlpath + '/user/forgot-password', {
                            email: email
                        })
                        .done(function(response) {
                            if(response.error){
                                $('#message').html(response.error).slideDown(500);
                            }else{
                                $('#message').html("Correo de recuperación enviado con éxito.");
                                $('.field').hide();
                            }
                        })
                }
            });
        });
    </script>
</body>

</html>