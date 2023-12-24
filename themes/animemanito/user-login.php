<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Iniciar Sesión - <?php echo $config['site_name']; ?></title>
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

                                <div class="field">
                                    <p class="control has-icons-left has-icons-right">
                                        <input class="input" type="text" placeholder="Usuario" id="username">
                                        <span class="icon is-small is-left"><i class="fas fa-user"></i></span>
                                        <?php /*<span class="icon is-small is-right"><i class="fas fa-check"></i></span>*/?>
                                    </p>
                                </div>
                                <div class="field">
                                    <p class="control has-icons-left">
                                        <input class="input" type="password" placeholder="Contraseña" id="password">
                                        <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
                                    </p>
                                </div>

                                <div class="notification is-danger is-paddingless" id="message">
                                    
                                </div>
                                <div class="field">
                                    <p class="control has-text-centered">
                                        <button class="button is-pink" id="send_button">Ingresar</button>
                                    </p>
                                </div>

                                <p class="has-text-grey has-text-weight-semibold">
                                    <a href="<?php echo $config['urlpath']; ?>/user/signup">Registro</a> &nbsp;·&nbsp;
                                    <!-- <a href="<?php echo $config['urlpath']; ?>/user/forgot-password">Recuperar Contraseña Enviando un mensaje al TioYT</a> -->
                                    <a href="https://www.facebook.com/profile.php?id=100063911650929">Recuperar Contraseña Enviando un mensaje al TioYT</a>
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

                var remember = 'yes';
                var username = $('#username').val();
                var password = $('#password').val();

                var username_validation = username.split(" ").join("");
                var password_validation = password.split(" ").join("");
<?php /*                if($("#checar").is(':checked')) {  
                  remember='yes';
                } else {
                  remember='no'; 
                }*/?>
                if (username_validation != '' && password_validation != '') {
                    $('#message').html('Cargando..').slideDown(500);
                    $.ajax({
                        type: 'POST',
                        url: urlpath + '/user/login',
                        data: 'username=' + username + '&password=' + password + '&remember=' + remember,
                        dataType: 'json',
                        success: function(response) {
                            if (response.error) {
                                $('#message').html(response.error).slideDown(500);
                            } else {
                                location.href = urlpath;
                            }
                        }
                    });
                } else {
                    $('#message').html('Ingrese los Datos').slideDown(500);
                }
            });
        });
    </script>
</body>

</html>