<?php startZone();
date_default_timezone_set('America/Bogota');
?>
<title><?php echo $data['serie']['name']; ?> Online HD</title>
<!-- Seo -->
<meta content='<?php echo htmlspecialchars($config['site_name']); ?>' name='author' />
<meta content='es' name='language' />
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
<meta property="og:site_name" content="<?php echo htmlspecialchars($config['site_name']); ?>" />
<meta property="og:title" content="<?php echo htmlspecialchars($data['serie']['name'] . ' Online HD'); ?>" />
<meta name="title" content="<?php echo htmlspecialchars($data['serie']['name'] . ' Online HD'); ?>" />
<meta name="description" content='<?php echo htmlspecialchars(strip_tags($data['serie']['synopsis'])); ?>' />
<meta name="description" property="og:description" content='<?php echo htmlspecialchars(strip_tags($data['serie']['synopsis'])); ?>' />
<meta name="keywords" content="<?php echo htmlspecialchars($data['serie']['name'] . ', ver ' . $data['serie']['name'] . ', ' . $data['serie']['name'] . ' sub esp, ' . $data['serie']['name'] . ' online'); ?>" />
<meta property="og:url" content="<?php echo $config['current_url']; ?>" />
<meta property="og:image" content="<?php echo getSerieCover($data['serie']['image_cover']); ?>" />
<meta property="og:image" content="<?php echo getSerieBanner($data['serie']['image_banner']); ?>" />
<!-- Alertify -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
<?php $data['header_meta'] = endZone(); ?>
<?php startZone(); ?>
<style>
    .anime-page h1 {
        margin-bottom: 0.5rem !important;
    }

    .anime-page i {
        margin-right: .7rem;
    }

    .anime-page__next-episode {
        display: inline-block;
        padding: .8rem 1rem;
        background-color: #363636;
        vertical-align: middle;
        margin-bottom: 1rem;
    }

    .anime-page__episode-list {
        max-height: 400px;
        overflow-x: auto;
        margin-bottom: 2.5rem;
    }

    .anime-page__episode-list>li {
        border-bottom: 1px solid #eceff1;
        border-color: rgba(68, 61, 104, .5);
    }

    .anime-page__episode-list>li>a:before {
        font-family: "Font Awesome 5 Free";
        margin-right: .7rem;
    }

    .anime-page__episode-list>li>a {
        display: block;
        padding: 1rem;
        color: rgba(255, 255, 255, 0.7);
        border-radius: .25rem;
    }

    .anime-page__episode-list>li>a:hover {
        background-color: #ff7d12;
        color: #fff;
    }

    .has-border-bottom {
        border-bottom: 2px solid rgba(158, 158, 158, 0.12);
        margin-bottom: 0.5rem;
    }

    .episode-banner-top div {
        margin: 0 auto !important;
    }

    .episode-banner-top-2 div {
        margin: 0 auto !important;
        display: flex;
        justify-content: center;
    }

    .viewed {
        color: seagreen !important;
    }
</style>
<?php $data['header_css'] = endZone(); ?>
<?php require_once(getThemeFile('header')); ?>

<div class="hero is-lightx is-fullheightX anime-page">
    <section class="section page-home__slider-container">
        <div class="container">
            <div class="episode-banner-top-2">
            <?php include 'ads/galak.php';?>
            </div>
        </div>
    </section>

    <section class="section" style="position:relative;">
        <div class="serie-background" style="background: url('<?php echo getSerieScreenshot($data['serie']['image_screenshot']); ?>');background-repeat: no-repeat;background-size: cover;"></div>
        <div class="container">
            <div class="columns is-mobile is-multiline">
                <div class="column is-12-mobile xis-3-tablet xis-3-desktop xhas-background-danger is-narrow-tablet is-narrow-desktop">
                    <figure class="image is-2by4" style="    border: 3px solid #ff7d12;border-radius: 10px;">
                        <img src="<?php echo getSerieCover($data['serie']['image_cover']); ?>" alt="<?php echo htmlspecialchars($data['serie']['name']); ?>" style="border-radius: 10px;" />
                    </figure>
                    <br>
                    <?php if ($data['serie']['status_id'] == 1) { ?>
                        <a href="<?php echo $config['urlpath'] . '/animes?estado[]=' . $data['serie']['status_id']; ?>" class="button is-success is-block"><i class="fa fa-play-circle"></i>Emisi&oacute;n</a>
                    <?php } ?>
                    <?php if ($data['serie']['status_id'] == 2) { ?>
                        <a href="<?php echo $config['urlpath'] . '/animes?estado[]=' . $data['serie']['status_id']; ?>" class="button is-danger is-block">Finalizado</a>
                    <?php } ?>
                    <?php if ($data['serie']['status_id'] == 3) { ?>
                        <a href="<?php echo $config['urlpath'] . '/animes?estado[]=' . $data['serie']['status_id']; ?>" class="button is-info is-block">Próximamente</a>
                    <?php } ?>
                    <?php if ($data['serie']['status_id'] == 4) { ?>
                        <a href="<?php echo $config['urlpath'] . '/animes?estado[]=' . $data['serie']['status_id']; ?>" class="button is-orange is-block">En Cuarentena</a>
                    <?php } ?>
                    <?php if (isset($session['name'])) { ?>
                        <div class="columns">
                            <div class="column is-6">
                                <a id="toggleFav" class="button <?php echo $favActive; ?> is-block" style="margin-top:1.4rem!important;padding-top:0!important;padding-bottom:0!important;">
                                    <i style="font-size:2rem;margin-right:0!important;" class="fas fa-heart"></i>
                                </a>
                            </div>
                            <div class="column is-6">
                                <a id="toggleVl" class="button <?php echo $wl_sActive; ?> is-block" style="margin-top:1.4rem!important;padding-top:0!important;padding-bottom:0!important;">
                                    <i style="font-size:2rem;margin-right:0!important;" id="icon_wl" class="<?php echo $icon; ?>"></i>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <style>
                    .points {
                        font-size: 2rem;
                    }

                    .points-container {
                        border-bottom: 1px solid #ff7d12;
                    }
                </style>
                <div class="column">
                    <div class="columns is-multiline is-narrow">
                        <div class="column is-12-mobile is-8-tablet is-10-desktop">
                            <h1 class="title has-text-orange"><?php echo $data['serie']['name']; ?></h1>
                        </div>
                        <div class="column is-12-mobile is-4-tablet is-2-desktop">
                            <div class="points-container" <?php
                                                            $c_likes = $data['serie']['likes'];
                                                            $c_dislikes = $data['serie']['dislikes'];
                                                            $percentage = getPercentage($c_likes, $c_dislikes);
                                                            $votes = getVotes($c_likes, $c_dislikes);
                                                            if ($votes > 1) {
                                                                $vites_view = $votes . " votos";
                                                            } else if ($votes > 0 && $votes < 2) {
                                                                $vites_view = $votes . " voto";
                                                            } else if ($votes < 1) {
                                                                $vites_view = "No hay votos aún";
                                                            }
                                                            $like_class = 'has-text-light';
                                                            $dislike_class = 'has-text-light';
                                                            if (isset($_COOKIE[$data['serie']['id']])) {
                                                                $vote = $_COOKIE[$data['serie']['id']];
                                                                if ($vote == 1) {
                                                                    $like_class = 'has-text-orange';
                                                                }
                                                            }
                                                            if (isset($_COOKIE[$data['serie']['id']])) {
                                                                $vote = $_COOKIE[$data['serie']['id']];
                                                                if ($vote == 0) {
                                                                    $dislike_class = 'has-text-orange';
                                                                }
                                                            }
                                                            ?>>

                                <div class="points has-text-orange has-text-centered"><i class="fas fa-star has-text-warning"></i><?php echo $percentage; ?></div>
                                <!-- Créditos a Seuseng por ayudar con la lógica matematica de esta wea UwU -->
                                <div class="votes has-text-grey has-text-centered"><?php echo $c_likes . '/' . $c_dislikes; ?></div>
                                <?php if (isset($session['id'])) { ?>
                                    <div id="are-votacion" class="" style="display: flex;flex-direction: row;justify-content:center;">
                                        <div class="is-paddingless"><button class="<?php echo $like_class; ?> like is-text" style="font-size:1.6rem;background-color: #0000;border: 0;"><i class="fas fa-thumbs-up" style="margin-right:0!important"></i></button></div>
                                        <div class="is-paddingless"><button class="<?php echo $dislike_class; ?> dislike is-text" style="font-size:1.6rem;background-color: #0000;border: 0;"><i class="fas fa-thumbs-down" style="margin-right:0!important"></i></button></div>
                                    </div>
                                <?php } else {
                                    echo "<div style='font-size:0.7rem;color:#ababab;text-align:center;'><a href='" . $config['urlpath'] . "/user/signup" . "'>Registrate para votar.</a></div>";
                                } ?>
                            </div>
                        </div>
                    </div>

                    <h6 class="has-text-weight-semibold is-uppercase has-text-grey has-border-bottom">Sinopsis</h6>
                    <p class="has-text-light sinopsis"><?php echo $data['serie']['synopsis']; ?></p>

                    <br>

                    <h6 class="has-text-weight-semibold is-uppercase has-text-grey has-border-bottom">Géneros</h6>
                    <p class="genres buttons">
                        <?php foreach ($data['serie']['genres'] as $genre) { ?>
                            <a href="<?php echo $config['urlpath'] . '/animes?genero[]=' . $genre['url']; ?>" class="button is-small is-orange is-outlined is-roundedX"><?php echo $genre['name']; ?></a>
                        <?php } ?>
                    </p>

                    <p class="has-text-weight-semibold is-uppercase has-text-grey has-border-bottom">Información general</p>

                    <ul class="has-text-light">
                        <li><span class="has-text-weight-semibold has-text-grey is-uppercase">Tipo:</span> <?php echo getSerieCategory($data['serie']['category_id']); ?></li>
                        <li><span class="has-text-weight-semibold has-text-grey is-uppercase">Estado:</span> <?php echo getSerieStatus($data['serie']['status_id']); ?></li>
                        <li><span class="has-text-weight-semibold has-text-grey is-uppercase">Episodios:</span> <?php echo count($data['episodes']); ?></li>
                        <li><span class="has-text-weight-semibold has-text-grey is-uppercase">Visitas:</span> <?php echo $data['serie']['visits']; ?></li>
                        <?php
                        if (!empty($data['serie']['related'])) {
                            foreach ($data['serie']['related'] as $related) {
                                $serie['related'] = DB::query('SELECT name,url FROM serie WHERE id=%i', $related['id_serie_related']);
                                if ($related['type'] == 1) {
                                    $type = "Precuela";
                                } else if ($related['type'] == 2) {
                                    $type = "Secuela";
                                } else if ($related['type'] == 3) {
                                    $type = "Spin-Off";
                                } else if ($related['type'] == 4) {
                                    $type = "Historia Paralela";
                                }
                        ?>
                                <li><span class="has-text-weight-semibold has-text-grey is-uppercase"><?php echo $type; ?>:</span> <a class="has-text-orange" href="<?php echo $config['urlpath']; ?>/<?php echo $serie['related'][0]['url']; ?>"><?php echo $serie['related'][0]['name']; ?></a></li>

                        <?php }
                        } ?>


                        <?php if ($data['serie']['status_id'] == 1 or $data['serie']['status_id'] == 4 && empty($data['serie']['text_next_episode'])) {?>
                            <br>
                            <li><span class="has-text-weight-semibold has-text-orange is-uppercase">Próximo episodio:</span> <?php
                                                                                                                                setlocale(LC_TIME, array('es_ES.UTF-8','es_ES@dolar','es_ES','spanish'));
                                                                                                                                $fechaFormatInit = $data['serie']['date_next_episode'];
                                                                                                                                $fechaFormat = date("d/m/Y", strtotime($fechaFormatInit));
                                                                                                                                $string = $fechaFormat;
                                                                                                                                $date = DateTime::createFromFormat("d/m/Y", $string);
                                                                                                                                $fechaFormat = strftime("%A %e de %B %Y", $date->getTimestamp());
                                                                                                                                echo ucfirst($fechaFormat);
                                                                                                                                ?></li>
                        <?php } else if ($data['serie']['status_id'] == 1 or $data['serie']['status_id'] == 3 or $data['serie']['status_id'] == 4 && !empty($data['serie']['text_next_episode'])) { ?>
                            <li><span class="has-text-weight-semibold has-text-orange is-uppercase">Próximo episodio:</span> <?php echo $data['serie']['text_next_episode']; ?>
                            <?php } ?>

                    </ul>


                </div>

            </div>

        </div>
    </section>
    <section style="display_grid;place-items:center;">
    <?php include 'ads/bidgear.php';?>
    </section>                        
    <section class="section">
        <div class="container">

            <div class="columns">

                <div class="column is-12">

                    <h1 class="title is-size-5 has-text-weight-light has-text-light">
                        <i class="fa fa-list-ul has-text-orange"></i> Listado de episodios
                    </h1>

                    <?php if ($data['serie']['status'] == 1) { ?>
                        <div class="anime-page__next-episode is-size-6 has-text-weight-light has-text-light">
                            <?php /*El próximo capítulo se emite el día <?php echo $data['serie']['next-episode']; ?>*/ ?>
                            <?php
                            $last_episode_date = $db->queryFirstField('SELECT created_at FROM anime_episode WHERE anime_id=%s ORDER BY number+0.0 DESC LIMIT 1', $data['serie']['id']);

                            if ($data['serie']['release_day'] == null) {
                                $release_day_name = date('l', strtotime($last_episode_date));
                            } else {
                                $release_day_name = $data['serie']['release_day'];
                            }

                            //echo '<b>Dia de estreno:</b> '.$release_day_name.'<br>';
                            $next_episode_text = getNextEpisode($release_day_name, $last_episode_date);
                            ?>
                            <i class="fa fa-calendar-alt far has-text-orange"></i> Próximo episodio: <span class="has-text-weight-semibold"><?php echo $next_episode_text; ?></span>
                        </div>
                    <?php } ?>

                    <ul class="anime-page__episode-list is-size-6">

                        <?php foreach ($data['episodes'] as $episode) {
                            // if(isset($session['id'])){
                            //     $seen_class = '';
                            //     $seen_episode = DB::queryFirstRow('SELECT COUNT(id) FROM lastView WHERE serie_episode_id=%i0 AND user=%i1',$episode['id'],$session['id']);
                            //     if($seen_episode['COUNT(id)'] > 0){
                            //         $seen_class = "viewed";
                            //     }
                            // }
                        ?>
                            <li>
                                <a class="fa-play-circle d-inline-flex align-items-center is-rounded <?php if(isset($seen_class)){echo $seen_class;}else{echo "";} ?>" href="<?php echo $config['urlpath'] . '/ver/' . $data['serie']['url'] . '-' . $episode['number']; ?>"><?php echo $data['serie']['name']; ?> <span>Episodio <?php if(isset($episode['episodegroup'])) {echo $episode['episodegroup'];} else { echo $episode['number'];} ?></span></a>
                            </li>
                        <?php } ?>
                    </ul>


                    <h1 class="title is-size-5 has-text-weight-light has-text-light">
                        <i class="fas fa-comment-dots far has-text-orange"></i> Comentarios sobre <?php echo $data['serie']['name']; ?>
                    </h1>
                    <div class="container">
                        <!-- ADS -->
                        <!-- <div class="is-hidden-desktop" style="display:grid;place-items:center">
                            <div id="adtrue_tag_19390"></div>
                            <script data-cfasync='false' type='text/javascript' src='//cdn.adtrue.com/rtb/async.js' async></script>
                            <script type="text/javascript">
                                var adtrue_tags = window.adtrue_tags || [];
                                adtrue_tags.push({
                                    tag_id: 19390,
                                    width: 320,
                                    height: 50,
                                });
                            </script>
                        </div> -->
                        <!-- TERMINA ADS -->
                        <!-- ADS -->
                        <!-- <div class="is-hidden-touch" style="display:grid;place-items:center">
                            <div id="adtrue_tag_19389"></div>
                            <script data-cfasync='false' type='text/javascript' src='//cdn.adtrue.com/rtb/async.js' async></script>
                            <script type="text/javascript">
                                var adtrue_tags = window.adtrue_tags || [];
                                adtrue_tags.push({
                                    tag_id: 19389,
                                    width: 728,
                                    height: 90,
                                });
                            </script>
                        </div> -->
                        <!-- TERMINA ADS -->
                    </div>
                    <div id="disqus_thread"></div>
                    <script>
                        /**
                         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                        /*
                        var disqus_config = function () {
                        this.page.url = '<?php echo $config['current_url']; ?>';  // Replace PAGE_URL with your page's canonical URL variable
                        this.page.identifier = 'animefenix'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                        };
                        */
                        (function() { // DON'T EDIT BELOW THIS LINE
                            var d = document,
                                s = d.createElement('script');
                            s.src = 'https://animefenix.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

                </div>

            </div>

        </div>
    </section>

</div>

<?php startZone(); ?>
<?php $data['footer_js'] = endZone(); ?>

<?php require_once(getThemeFile('footer')); ?>
<script type="text/javascript" src="<?php echo getThemeUrl(); ?>/js/votacion.js"></script>
<script>
    user_id = "<?php if(!empty($session)){echo $session['id'];}else{echo "0";} ?>";
    serie_id = "<?php echo $data['serie']['id']; ?>";
    if (user_id !== "0") {
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

        var estadoActualVl = "<?php echo $wl_sIsSet; ?>";
        $("#toggleVl").click(function() {
            if (estadoActualVl == "0") {
                var vlSend = "1";
                $.post("<?php echo $config['urlpath']; ?>/app/wl_sHandler.php", {
                        vl: vlSend,
                        idUser: user_id,
                        idSerie: serie_id
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
                $.post("<?php echo $config['urlpath']; ?>/app/wl_sHandler.php", {
                        vl: vlSend,
                        idUser: user_id,
                        idSerie: serie_id
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
<!-- Controlador de Votacion -->
<script type="text/javascript" src="<?php echo getThemeUrl(); ?>/js/votacion.js"></script>
<?php if (isset($session['id'])) { ?>
    <script type="text/javascript">
        var user_id = "<?php echo $session['id']; ?>";
        if (user_id == "0") {
            user_id = "0";
        } else {
            user_id = user_id;
        }
        let id_serie = "<?php echo $data['serie']['id']; ?>";
        $('#are-votacion').likeDislike({
            initialValue: 0,
            click: function(value, l, d, event) {
                var likes = $(this.element).find('.likes');
                var dislikes = $(this.element).find('.dislikes');

                likes.text(parseInt(likes.text()) + l);
                dislikes.text(parseInt(dislikes.text()) + d);

                $.post("<?php echo $config['urlpath']; ?>/app/votacion.php", {
                        like: l,
                        c_l: <?php echo $c_likes; ?>,
                        c_d: <?php echo $c_dislikes; ?>,
                        dislike: d,
                        id_usuario: user_id,
                        id_serie: id_serie,
                    })
                    .done(function(data) {
                        alert("Tu voto ha sido registrado.");
                    });
            }
        });
    </script>
    <?php include 'adtag.php' ?>
<?php } ?>
<!-- Fin del controlador de Votacion -->