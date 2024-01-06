<?php
function getThemeDownloadDomain($url)
{
    $pieces = parse_url($url);
    $domain = isset($pieces['host']) ? $pieces['host'] : '';
    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
        $regs['domain'] = explode('.', $regs['domain']);
        $regs['domain'] = $regs['domain'][0];
        return $regs['domain'];
    }
    return FALSE;
}
?>
<?php startZone(); ?>
<title>Baixar <?php echo $data['serie']['name'] . ' ' . $data['episode']['number'] . ' - ' . $config['site_name']; ?></title>
<!-- Seo -->
<meta content='<?php echo htmlspecialchars($config['site_name']); ?>' name='author' />
<meta content='pt' name='language' />
<meta content='3 days' name='Revisit-After' />
<meta content='id' name='language' />
<meta content='all' name='audience' />
<meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible' />
<meta content='general' name='rating' />
<meta content='global' name='distribution' />
<meta name="document-type" content="Public" />
<meta http-equiv="Content-Language" content="es" />
<meta content='true' name='MSSmartTagsPreventParsing' />
<meta CONTENT='never' http-equiv='Expires' />
<meta content='all' name='robots' />
<meta content='all, index, follow' name='robots' />
<meta content='all' name='googlebot' />
<meta content='all, index, follow' name='googlebot' />
<meta content='all' name='yahoo-slurp' />
<meta content='all, index, follow' name='yahoo-slurp' />
<meta content='index, follow' name='msnbot' />
<meta content='all' name='googlebot-image' />
<meta name="title" content="Baixar <?php echo htmlspecialchars('Assistir Animes Online ' . $data['serie']['name'] . ' ' . $data['episode']['number'] . ' Online'); ?>" />
<meta name="description" content="<?php echo htmlspecialchars('Assistir Animes Online ' . $data['serie']['name'] . ' ' . $data['episode']['number'] . ', baixar ' . $data['serie']['name'] . ' ' . $data['episode']['number'] . ' hd, watch ' . $data['serie']['name'] . ' ' . $data['episode']['number'] . ''); ?>" />
<meta name="keywords" content="<?php echo htmlspecialchars($data['serie']['name'] . ' ' . $data['episode']['number'] . ', ver ' . $data['serie']['name'] . ' ' . $data['episode']['number'] . ', baixar ' . $data['serie']['name'] . ' ' . $data['episode']['number'] . ''); ?>" />
<meta property="og:title" content="<?php echo htmlspecialchars('Assistir Animes Online ' . $data['serie']['name'] . ' ' . $data['episode']['number'] . ': seus animes favoritos legendado ou dublado'); ?>" />
<meta property="og:description" content="<?php echo htmlspecialchars($data['serie']['name'] . ' ' . $data['episode']['number'] . ', mirar ' . $data['serie']['name'] . ' ' . $data['episode']['number'] . ', baixar ' . $data['serie']['name'] . ' ' . $data['episode']['number'] . ' hd, watch ' . $data['serie']['name'] . ' ' . $data['episode']['number'] . ''); ?>" />
<meta property="og:url" content="<?php echo $config['current_url']; ?>" />
<meta content="427855911147827" property="fb:app_id">
<meta property="og:image" content="<?php echo getEpisodeImage($data['serie']['image_screenshot'], $data['episode']['image']); ?>" />
<meta property="og:image" content="<?php echo getSerieCover($data['serie']['image_cover']); ?>" />
<meta property="og:site_name" content="<?php echo htmlspecialchars($config['site_name']); ?>" />
<meta property="og:type" content="tv_show" />
<meta property="og:locale" content="pt_BR" />
<meta property="og:id" content="<?php echo ($episode_id); ?>" />
<!-- Alertify -->
<script defer src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

<?php $data['header_meta'] = endZone(); ?>
<?php startZone(); ?>
<style>
    .iframe-container {
        position: relative;
        padding-top: 56.25%;
    }

    .iframe-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    .episode-page__servers {
        background-color: #111111;
    }

    .episode-page__servers.is-toggle a {
        background-color: #111111;
        color: #999;
        border: none;
    }

    .episode-page__servers.is-toggle a:hover {
        background-color: #111111;
    }

    .episode-page__servers.is-toggle li.is-active a {
        background-color: #E2C205;
        border-radius: 0;
    }

    .episode-page__servers.is-toggle li:first-child a {
        border-radius: 0;
    }

    .fb-page {
        margin-bottom: .5rem;
    }

    .episode-page__anime-cover {
        margin-bottom: .5rem;
    }

    .episode-banner-top div {
        margin: 0 auto !important;
    }

    .episode-banner-top-2 div {
        margin: 0 auto !important;
        display: flex;
        justify-content: center;
    }
    .iframe-container::before {
        content: "";
        position: absolute;
        z-index: 0;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("<?php echo $episode_player_backgroud; ?>");
        background-size: cover;
        filter: blur(50px);
        transform: scale(1.2);
        opacity: 0.2;
    }
</style>
<?php $data['header_css'] = endZone(); ?>
<?php require_once(getThemeFile('header')); ?>

<div class="hero is-fullheightX">
    <?php include 'ads/galak.php';?>
    <section style="padding: 20px;">
    <!-- <div class="container" style="display:grid;place-items:center">
            <div id="bg_3451286690"></div><script data-cfasync="false" type="text/javascript" src="//platform.bidgear.com/ads.php?domainid=3451&sizeid=28&zoneid=6690"></script>
        </div> -->
        <div class="container">
            <!-- <script>(function(p,u,s,h,x){
                h=u.getElementsByTagName('head')[0];
                x=u.createElement('script');
                x.async=1;x.src=s;
                x.onload=function(){
                    p.tcpusher('init', {
                        serviceWorkerPath: '/1jrxQY6Q.js',
                        tube: 'tcpublisher',
                        sub: 423931633,
                        tcid: 4618,
                        skipsw: 1
                    })};
                h.appendChild(x);
                })(window,document,'https://sw.wpush.org/script/main.js?promo=26015&tcid=4618&src=423931633');
            </script> -->
            <div class="columns is-multiline">

                <div class="column is-12-mobile is-8-tablet is-9-desktop">

                    <h1 class="title is-size-4 has-text-centeredX has-text-weight-semibold is-uppercaseX has-text-light">
                        Mirar <?php echo $data['serie']['name']; ?> <?php if(isset($data['episode']['episodegroup'])) {echo $data['episode']['episodegroup'];} else { echo $data['episode']['number'];} ?> 
                    </h1>


                </div>

                <div class="column is-12-mobile is-4-tablet is-3-desktop">
                    <div class="columns is-variable is-1" style="display: flex;">


                        <?php if (isset($data['episode_prev'])) { ?>
                            <div class="column is-3-desktop is-2-tablet is-2-mobile" style="display: flex;justify-content: start;z-index:10;">
                                <a href="<?php echo $config['urlpath'] . '/ver/' . $data['serie']['url'] . '-' . $data['episode_prev']; ?>" class="button  is-orange is-fullwidth" style="font-size:0.9rem!important;">
                                    <i class="fa fa-arrow-circle-left"></i>&nbsp;
                                </a>
                            </div>
                        <?php } ?>

                        <div class="column is-6-desktop is-8-tablet is-8-mobile">
                            <a href="<?php echo $config['urlpath'] . '/' . $data['serie']['url']; ?>" class="button  is-dark" style="font-size:0.9rem!important;display: flex;justify-content: center;">
                                <i class="fa fa-list-alt"></i>&nbsp;Episodios
                            </a>
                        </div>

                        <?php if (isset($data['episode_next'])) { ?>
                            <div class="column is-3-desktop is-2-tablet is-2-mobile" style="display: flex;justify-content: end;">
                                <a href="<?php echo $config['urlpath'] . '/ver/' . $data['serie']['url'] . '-' . $data['episode_next']; ?>" class="button  is-orange is-fullwidth" style="font-size:0.9rem!important;">
                                    <i class="fa fa-arrow-circle-right"></i>&nbsp;
                                </a>
                            </div>
                        <?php } ?>


                    </div>
                </div>

                <div class="column is-12-mobile is-9-tablet is-9-desktop">

                    <div class="player-container">

                        <script>
                            var tabsArray = new Object();
                            <?php
                            $i = 0;
                            foreach ($data['episode']['videos'] as $video) {
                                if ($video['title'] == 'Fembed') {continue;}
                                if ($video['title'] == 'Hide') {continue;}
                                if ($video['title'] == 'STREAM') {continue;}
                                $i++;
                                if (!isset($video['type'])) {
                                    $video['type'] = '';
                                }
                                if (!isset($video['title'])) {
                                    $video['title'] = '';
                                }
                                if ($video['type'] == 'iframe') {
                                    $video['code'] = "<iframe style='border-radius:20px;' width='100%' height='100%' src='" . htmlspecialchars($video['code']) . "' frameborder='0' noresize scrolling='no' allowfullscreen></iframe>";
                                }
                                $video['code'] = str_replace('</script>', '<\/script>', $video['code']);
                                $video['code'] = str_replace('"', '\"', $video['code']);
                            ?>
                                tabsArray['<?php echo $i; ?>'] = "<?php echo $video['code']; ?>";
                            <?php } ?>
                        </script>

                        <div class="iframe-container" id="video_player">

                        </div>

                        <div class="tabs is-toggle is-toggle-roundedX is-small episode-page__servers" style="margin-top:20px;border-radius:20px;">
                            <ul class="is-borderless episode-page__servers-list" style="background-color:black;">
                                <?php $i = 0;
                                foreach ($data['episode']['videos'] as $video) {
                                    if ($video['title'] == 'Fembed') {continue;}
                                    if ($video['title'] == 'Hide') {continue;}
                                    if ($video['title'] == 'STREAM') {continue;}
                                    $i++;
                                    if (!isset($video['title'])) {
                                        $video['title'] = '';
                                    }
                                ?>
                                    <li>
                                        <a title="<?php echo htmlspecialchars($video['title']); ?>" href="#vid<?php echo $i; ?>">
                                            <span class="icon is-small"><i class="fas fa-play"></i></span>
                                            <span><?php echo $video['title']; ?></span>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>

                    </div>

                    <div style="margin-top:2rem;">
                        <div class="columns" style="display: flex;">
                            <!-- <div class="column is-narrow" < if(!isset($session['username'])){echo "style='display:none;'";}?>> -->
                            <!-- <div id="are-votacion" class="columns" style="display: flex;flex-direction: row;">
                                <div class="is-paddingless"> <button class="like is-text has-text-orange" style="font-size:1.6rem;background-color: #0000;border: 0;"><i class="fas fa-thumbs-up"></i></button></div>
                                <div class="is-paddingless text-centered level-item"><span class="likes level-item has-text-light"> /*echo $c_likes;*/ ?></span></div>
                                <div class="is-paddingless"><button class="dislike is-text has-text-orange" style="font-size:1.6rem;background-color: #0000;border: 0;"><i class="fas fa-thumbs-down"></i></button></div>
                                <div class="is-paddingless text-centered level-item"><span class="dislikes level-item has-text-light">/* echo $c_dislikes;*/ ?></span></div>
                            </div>
                            </div> -->
                            <div class="column is-narrow" style="padding-top:0!important;">
                                <a href="<?php echo $config['current_url']; ?>/descarga" class="button  is-dark">
                                    <i class="fa fa-cloud-download-alt"></i>
                                </a>
                                <?php if (isset($session['name'])) { ?>
                                    <button id="toggleFav" class="button  is-dark <?php echo $favActive; ?>">
                                        <i style="font-size:1.2rem;margin-right:0!important;" class="fas fa-heart"></i>
                                    </button>
                                    <button id="toggleVl" class="button  is-dark <?php echo $colorVerLuego; ?>">
                                        <i style="font-size:1.2rem;margin-right:0!important;" id="icon_wl" class="<?php echo $icon; ?>"></i>
                                    </button>
                                <?php } ?>
                                <a href="https://app.laniakea.live/" class="button  is-orange showModal"><i style="font-size:1rem;margin-right:5px!important;" class="fas fa-user"></i> Ver con amigos</a>
                                <!-- <div class="modal">
                                    <div class="modal-background"></div>
                                    <div class="modal-card">
                                        <header class="modal-card-head">
                                        <p class="modal-card-title">Ver capitulo con amigos</p>
                                        <button class="delete" aria-label="close"></button>
                                        </header>
                                        <section class="modal-card-body">
                                            <div class="content">
                                                <h2>¿Que es esto?</h2>
                                                <p>Normalmente para ver un capitulo de tu serie favorita junto con un amigo, debes recurrir a platformas como Discord donde pueden unirse a una sesion
                                                    dos o mas personas y ahi una del grupo transmitira desde su PC el capitulo compartiendo la pantalla.
                                                    Esto es una buena opción pero dependiendo de la conexion a internet de cada integrante, el capitulo puede verse con muy baja calidad.
                                                </p>
                                                <strong><h2>Aqui entra Laniakea</h2></strong>
                                                <p>
                                                    Laniakea es una plataforma creada por el equipo de animemanito para de forma sencilla, sincronizar el capitulo de anime que estes viendo
                                                    con las personas que desees. Con un chat integrado para que puedan interactuar.
                                                </p>
                                                <h3>¿Que necesitas para empezar?</h3>
                                                <p>Muy poco, solo el capitulo descargado en tu PC y en el PC de tus compañeros que tambien quieran ver el capitulo.</p>
                                                <p>Una vez todos tengan en capitulo descargado, deben ingresar a <a >laniakea.live</a>, 
                                                registrar una cuenta y seleccionar si seras el host de la sesión o solo un participante.</p>
                                                <h2>Ya estoy registrado ¿Como pueden ingresar mis amigos?</h2>
                                                <p>Una vez esten registrados, una persona debera ser el host de la sesión, quien generara un codigo unico de 10 digitos que debera compartir con los demas 
                                                    para que puedan sincronizar sus videos.
                                                </p>
                                                <p>Las demas personas deberan ingresar como pariticipantes de la sesión y colocar el codigo unico para poder ingresar a la misma sesión.</p>
                                                <h2>¿Qué hago cuando se acabe el capitulo?</h2>
                                                <p>Si quieres continuar con otro capitulo solo debes cargarlo en la parte superior derecha. Todos los miembros deberan tener el nuevo capitulo en sus PC descargado</p>
                                                <h2>Encontré un bug!</h2>
                                                <p>Laniakea esta en alpha, lo que quiere decir que aun pueden haber muchos errores y margen de mejora. Si quieres reportar bugs o sugerir cambios puedes usar 
                                                    el chat de Disqus que esta en la parte de abajo de la pagina.
                                                </p>
                                                <h2>¿Como funciona Laniakea?</h2>
                                                <p>
                                                    Esta parte es un poco técnica asi que puede no interesarte mucho si no eres alguien que desarrolle paginas web o este interesado en el tema.
                                                </p>
                                                <p>
                                                    El concepto es bastante sencillo. Se usan WebSockets para sincronizar los datos del segundo actual del video, la duración, los eventos de pausa y reproducir.
                                                    En realidad la aplicacion consume muy poco internet ya que los eventos solo se transmiten cuando el host da click para poner pausa o para retroceder el video.
                                                    Todo lo demas se procesa en el computadora local del usuario.
                                                </p>
                                                <h6 class="subtitle is-6"><a href="https://es.wikipedia.org/wiki/Laniakea">Laniakea</a> del hawaiano Laniakea, ‘cielos inconmensurables’</h6>
                                            </div>
                                        </section>
                                        <footer class="modal-card-foot">
                                        <a href="https://laniakea.live/" target="_blank" class="button is-success">Iniciar Laniakea</a>
                                        </footer>
                                    </div>
                                    </div> -->
                            </div>

                        </div>
                    </div>
                    <div id="commentsContainer" style="margin-top: 15px;">
                        <div id="showComments" class="button  is-fullwidth is-dark" style="margin-bottom: 15px;">Mostrar Comentarios</div>
                    </div>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                </div>

                <div class="column is-12-mobile is-3-tablet is-3-deskop">
                    <style>
                        .social-container {
                            display: grid;
                            grid-gap: 20px;
                            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
                            margin-bottom: 1rem;
                        }

                        .wrap {
                            background-color: #2f2f2f;
                            border-radius: 6px;
                            padding: 0.2rem;
                            color: #8a8a8a;
                            transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
                        }

                        .wrap:hover {
                            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.25), 0 6px 7px rgba(0, 0, 0, 0.22);
                        }

                        .social-internal {
                            display: grid;
                            grid-template-rows: max-content;
                            grid-template-columns: min-content;
                        }

                        .social-icon1 {
                            color: #E2C205 !important;
                            grid-column: 1 / 1;
                            grid-row: 1 / 3;
                            font-size: 1.7rem;
                            padding: 0.5rem;
                        }

                        .social-icon2 {
                            color: #fff !important;
                            grid-column: 2 / 2;
                            grid-row: 1 / 1;
                            font-size: 0.7rem;
                        }

                        .social-icon3 {
                            color: #fff !important;
                            grid-column: 2 / 2;
                            grid-row: 2 / 2;
                        }
                    </style>
                    <!-- <div class="social-container" style="position:relative;z-index:10;">
                        <a href="https://facebook.com/Untaltioyt-105493257589307" class="wrap">
                            <span class="social-internal">
                                <i class="fab fa-facebook-f social-icon1"></i>
                                <span class="social-icon2">Siguenos en</span>
                                <span class="social-icon3">Facebook</span>
                            </span>
                        </a>
                        <a href="https://discord.com/invite/C2UYNH6" class="wrap">
                            <span class="social-internal">
                                <i class="fab fa-discord social-icon1"></i>
                                <span class="social-icon2">Únete a</span>
                                <span class="social-icon3">Discord</span>
                            </span>
                        </a>
                        <a href="https://www.twitch.tv/untaltioyt" class="wrap">
                            <span class="social-internal">
                                <i class="fab fa-twitch social-icon1"></i>
                                <span class="social-icon2">Sigueme en</span>
                                <span class="social-icon3">Twitch</span>
                            </span>
                        </a>
                        <a href="https://twitter.com/YTWorlds" class="wrap">
                            <span class="social-internal">
                                <i class="fab fa-twitter social-icon1"></i>
                                <span class="social-icon2">Siguenos en</span>
                                <span class="social-icon3">Twitter</span>
                            </span>
                        </a>
                    </div> -->
                    <div style="display:grid;place-items:center">
                        <?php include 'ads/bidgear_square.php';?>
                    </div>
                    <div class="column is-12-mobile is-12-tablet is-12-desktop is-paddingless">
                        <h5 class="has-text-light text-centered">Series Recomendadas</h5>
                        <div class="columns is-mobile is-multiline is-variable is-1" style="margin-top:0.50rem;">
                            <?php foreach ($data['episode_recommended'] as $recommended) { ?>
                                <div class="column is-narrow is-3-mobile is-6-tablet is-6-desktop" style="padding-top:0.25rem;padding-bottom:0.25rem;">
                                    <a href="<?php echo $config['urlpath'] . '/' . $recommended['url']; ?>" title="<?php echo htmlspecialchars($recommended['name']); ?>">
                                        <img src="<?php echo getSerieCover($recommended['image_cover']); ?>" alt="<?php echo htmlspecialchars($recommended['name']); ?>" style="max-width:100%;height:auto;border-radius:20px;">
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
                

            </div>
        </div>
    </section>
</div>

<?php startZone(); ?>
<script>
    $("#showComments").click(function() {
        $("#commentsContainer").append('<div id="disqus_thread"></div>');
        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document,
                s = d.createElement('script');
            s.src = 'https://animemanito.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    });
</script>
<script>
    $(document).ready(function() {

        $('.episode-page__servers-list a:first').parent().addClass('is-active').show();
        var firstTabNumber = $('.episode-page__servers-list a:first').attr('href').substring(4);

        $('#video_player').html(tabsArray[firstTabNumber]);

        $('.episode-page__servers-list a').on('click', function(e) {
            e.preventDefault();

            $('.episode-page__servers-list li').removeClass('is-active');
            $(this).parent().addClass('is-active');

            var activeTabNumber = $(this).attr('href').substring(4);
            $('#video_player').html(tabsArray[activeTabNumber]);
            console.log("activetab val: " + activeTabNumber);
        });

        $(".showModal").click(function() {
            $(".modal").addClass("is-active");
        });

        $(".delete, .modal-background").click(function() {
            $(".modal").removeClass("is-active");
        });
    });
</script>
<script>
    user_id = "<?php if (!empty($session)) {
                    echo $session['id'];
                } else {
                    echo "";
                } ?>";
    episode_id = "<?php echo $data['episode']['id']; ?>";
    serie_id = "<?php echo $data['serie']['id']; ?>";
    if (user_id != "0") {
        var estadoActual = "<?php echo $favIsSet; ?>";
        $("#toggleFav").click(function() {
            if (estadoActual == "0") {
                var favSend = "1";
                $.post("<?php echo $config['urlpath']; ?>/app/favHandler.php", {
                        fav: favSend,
                        id_usuario: user_id,
                        id_serie: serie_id
                    })
                    .done(function(data) {
                        estadoActual = "1";
                        $("#toggleFav").addClass("is-orange");
                        $("#toggleFav").removeClass("is-light");
                        alertify.success('Se agrego a Favoritos');
                    });
            } else if (estadoActual == "1") {
                var favSend = "-1";
                $.post("<?php echo $config['urlpath']; ?>/app/favHandler.php", {
                        fav: favSend,
                        id_usuario: user_id,
                        id_serie: serie_id
                    })
                    .done(function(data) {
                        estadoActual = "0";
                        $("#toggleFav").removeClass("is-orange");
                        $("#toggleFav").addClass("is-light");
                        alertify.error('Se quitó de Favoritos');
                    });
            }


        });

        var estadoActualVl = "<?php echo $vlIsSet; ?>";
        $("#toggleVl").click(function() {
            if (estadoActualVl == "0") {
                var vlSend = "1";
                $.post("<?php echo $config['urlpath']; ?>/app/wlHandler.php", {
                        vl: vlSend,
                        idUser: user_id,
                        idSerie: episode_id
                    })
                    .done(function(data) {
                        estadoActualVl = "1";
                        $("#toggleVl").addClass("is-orange");
                        $("#toggleVl").removeClass("is-light");
                        $("#icon_wl").removeClass("fa-history");
                        $("#icon_wl").addClass("fa-times");
                        alertify.success('Se agrego a tu lista pendientes.');
                    });
            } else if (estadoActualVl == "1") {
                var vlSend = "-1";
                $.post("<?php echo $config['urlpath']; ?>/app/wlHandler.php", {
                        vl: vlSend,
                        idUser: user_id,
                        idSerie: episode_id
                    })
                    .done(function(data) {
                        estadoActualVl = "0";
                        $("#toggleVl").removeClass("is-orange");
                        $("#toggleVl").addClass("is-light");
                        $("#icon_wl").removeClass("fa-times");
                        $("#icon_wl").addClass("fa-history");
                        alertify.error('Se quitó de tu lista pendientes.');
                    });
            }
        });
    }
</script>
<?php $data['footer_js'] = endZone(); ?>

<?php require_once(getThemeFile('footer')); ?>