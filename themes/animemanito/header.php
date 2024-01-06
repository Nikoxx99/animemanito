<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="icon" href="<?php echo getThemeUrl(); ?>/images/AF-LOG.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo getThemeUrl(); ?>/images/AF-LOG.ico" type="image/x-icon">
    <?php if (isset($data['header_meta'])) {
        echo $data['header_meta'];
    } ?>
    <meta content="<?php echo $config['facebook_appid']; ?>" property="fb:app_id" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
    <link rel="stylesheet" href="<?php echo getThemeUrl(); ?>/css/fontawesome.all.min.css">
    <link rel="stylesheet" href="<?php echo getThemeUrl(); ?>/css/bulma.min.css">
    <link rel="stylesheet" href="<?php echo getThemeUrl(); ?>/css/app.css?v<?php echo time(); ?>">
    <?php if (isset($data['header_css'])) {
        echo $data['header_css'];
    } ?>
    <script type="text/javascript" src="<?php echo getThemeUrl(); ?>/js/jquery-3.js"></script>

    <!-- CLICKADU -->
    <!-- <script data-cfasync="false" type="text/javascript" src="//thingrealtape.com/aas/r45d/vki/1841568/tghr.js"></script> -->
    <!-- ADMAVEN -->
    <!-- <script src="https://animemanito.com/script.js"></script> -->
    <!-- <script data-cfasync="false" src="//dq06u9lt5akr2.cloudfront.net/?tluqd=936016"></script> -->
    <!-- PPADS -->
    <?php /*include 'adtag2.php';*/?>
    <!-- ??? -->
    <!-- <script type='text/javascript' src='//everywheresavourblouse.com/77/63/6b/77636bb8d0170b1c1a7d46bcae6cac52.js'></script> -->
    <!-- newpapu -->
    <?php include 'ads/newpop.php';?>
    <?php include 'ads/inpush.php';?>
    <!-- <script async src="https://js.wpadmngr.com/static/adManager.js" data-admpid="328"></script> -->
    <link rel="manifest" href="<?php echo getThemeUrl(); ?>/manifest.json" />
    <script type="text/javascript" src="https://hosted.muses.org/mrp.js"></script>
    <!-- <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
        var OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "092221d8-b4a1-4c69-bbe0-988eddf8ce2d",
            });
        });
    </script> -->
    <!-- ESTA ES LA WEA DE ARC -->
    <!-- <script async src="https://arc.io/widget.min.js#5HgLJNUy"></script> -->
    <!-- NOTIX -->
    <!-- <script defer id="script">
      const s = document.createElement("script")
      s.src = "https://notix.io/ent/current/enot.min.js"
      s.onload = (sdk) => {
        sdk.startInstall({
          appId: "10040253060911e2dc65ae5d88d69ed",
          step0: "skip"
        })
      }
      document.head.append(s)
    </script> -->
</head>
<div></div>
<nav class="navbar is-dark" role="navigation" aria-label="main navigation" style="background-color:#000!important;">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="<?php echo $config['urlpath']; ?>/">
                <img src="<?php echo getThemeUrl(); ?>/images/animemanito.png" width="112" height="28" class="logo">
            </a>
            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="<?php echo $config['urlpath']; ?>/">Home</a>
                <a class="navbar-item" href="<?php echo $config['urlpath']; ?>/animes">Animes</a>
                <a class="navbar-item" href="<?php echo $config['urlpath']; ?>/animes?estado[]=1">Em transmissão</a>
                <a class="navbar-item" href="<?php echo $config['urlpath']; ?>/calendario">Calendário</a>
                <!-- <a class="navbar-item rainbow" href="https://t.me/+rcM-TGdagjtlNDlh">Telegram</a>
                <a class="navbar-item" href="https://moelist.online">
                    <img src="<?php echo getThemeUrl(); ?>/images/moelist.jpg" alt="VBluelist">
                </a> -->
            </div>
    <!-- <div id="pf-61ce767f29dbf3002762752c"><script data-cfasync="false" src="https://platform.pubfuture.com/v1/unit/61ce767f29dbf3002762752c.js?v=2" type="text/javascript"></script></div> -->
            <div class="navbar-end has-text-weight-semibold is-uppercase">

                <?php if (isset($session)) { ?>
                    <div class="navbar-item">
                        <?php if ($session['role'] == 'admin') { ?><a class="button is-light " style="margin-right:0.8rem;" href="<?php echo $config['adminpath']; ?>/"><strong>Panel</strong></a><?php } ?>
                        <div class="dropdown" style="margin-right:0.8rem;">
                            <div class="dropdown-trigger">
                                <button class="button is-orange " aria-haspopup="true" aria-controls="manito-usuario">
                                    <span><?php echo $session['name']; ?></span>
                                    <span class="icon is-small">
                                        <i class="fas fa-angle-down" aria-hidden="true"></i>
                                    </span>
                                </button>
                            </div>
                            <div class="dropdown-menu" id="manito-usuario" role="menu">
                                <div class="dropdown-content" style="z-index:9999;">
                                    <a href="<?php echo $config['urlpath']; ?>/perfil/<?php echo $session['id']; ?>/" class="dropdown-item">
                                        Minha lista
                                    </a>
                                    <a href="<?php echo $config['urlpath']; ?>/user/logout" class="dropdown-item is-danger">
                                        Fechar Sessão
                                    </a>
                                </div>
                            </div>
                        </div>
                        <form action="<?php echo $config['urlpath']; ?>/animes" method="get">
                            <div class="field has-addons">
                                <div class="control has-icons-right is-expanded">
                                    <input type="text" class="input is-orange " placeholder="Procure um anime aqui..." name="q">
                                </div>
                                <p class="control">
                                    <button type="submit" class="button is-orange "><i class="fas fa-search"></i></a>
                                </p>
                            </div>
                        </form>
                    </div>
                <?php } else { ?>
                    <div class="navbar-item">
                        <a style="margin-right:0.8rem;" class="button is-orange " href="<?php echo $config['urlpath']; ?>/user/signup"><strong>Check-in</strong></a>
                        <a style="margin-right:0.8rem;" class="button is-light " href="<?php echo $config['urlpath']; ?>/user/login">Entrar</a>
                    </div>
                    <div class="navbar-item">
                        <form action="<?php echo $config['urlpath']; ?>/animes" method="get">
                            <div class="field has-addons">
                                <div class="control has-icons-right is-expanded">
                                    <input type="text" class="input is-orange " placeholder="Procure um anime..." name="q">
                                </div>
                                <p class="control">
                                    <button type="submit" class="button is-orange "><i class="fas fa-search"></i></a>
                                </p>
                            </div>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>
<style>
    .rainbow_text_animated {
        background: linear-gradient(to right, #6666ff, #0099ff, #00ff00, #ff3399, #6666ff);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        animation: rainbow_animation 1s ease-in-out infinite;
        background-size: 400% 100%;
        text-align: center;
    }

    @keyframes rainbow_animation {

        0%,
        100% {
            background-position: 0 0;
        }

        50% {
            background-position: 100% 0;
        }
    }
        /* width */
    ::-webkit-scrollbar {
    width: 10px;
    height: 0px;
    border-radius: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track { 
    background-color:#333;
    border-radius: 20px;
    }
    
    /* Handle */
    ::-webkit-scrollbar-thumb {
    background: #E2C205; 
    border-radius: 20px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
    background: #c76310; 
    }
    .rainbow{
		animation: rainbow 2.5s linear;
		animation-iteration-count: infinite;
}


@keyframes rainbow{
		100%,0%{
			color: rgb(255,0,0);
		}
		8%{
			color: rgb(255,127,0);
		}
		16%{
			color: rgb(255,255,0);
		}
		25%{
			color: rgb(127,255,0);
		}
		33%{
			color: rgb(0,255,0);
		}
		41%{
			color: rgb(0,255,127);
		}
		50%{
			color: rgb(0,255,255);
		}
		58%{
			color: rgb(0,127,255);
		}
		66%{
			color: rgb(0,0,255);
		}
		75%{
			color: rgb(127,0,255);
		}
		83%{
			color: rgb(255,0,255);
		}
		91%{
			color: rgb(255,0,127);
		}
}
</style>
<!-- <div class="container" id="csgoempire" style="display:none;">
    <div class="row justify-content-center">
        <a id="beep" href="https://csgoempire.com/r/UnTalTioYT" target="_blank">
            <h4 class="rainbow rainbow_text_animated"> >>> ¿Cansado de ser pobre? ¿Quieres salir de Latinoamérica? Entonces ven a probar suerte aquí. <<< </h4>
            </a>
    </div>
</div> -->
<script>
    $(".dropdown-trigger").click(function(){
    $(".dropdown").toggleClass("is-active");
    })
 </script>