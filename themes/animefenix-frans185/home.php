<?php startZone(); ?>
<title>Ver anime online - <?php echo $config['site_name']; ?></title>
<!-- Seo -->
<meta content='<?php echo htmlspecialchars($config['site_name']); ?>' name='author' />
<meta content='es' http-equiv='content-language' />
<meta content='es' name='language' />
<meta content='all' name='audience' />
<meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible' />
<meta content='general' name='rating' />
<meta content='global' name='distribution' />
<meta name="document-type" content="Public" />
<meta content='true' name='MSSmartTagsPreventParsing' />
<meta content='all' name='robots' />
<meta content='all, index, follow' name='robots' />
<meta content='all' name='googlebot' />
<meta content='all, index, follow' name='googlebot' />
<meta content='all' name='yahoo-slurp' />
<meta content='all, index, follow' name='yahoo-slurp' />
<meta content='index, follow' name='msnbot' />
<meta content='all' name='googlebot-image' />
<meta name="title" content="<?php echo htmlspecialchars($config['site_name'] . ' Anime Online'); ?>" />
<meta name="description" content="Anime HD en sub espanol." />
<meta name="keywords" content="anime de estrenos, anime online, anime sub espanol" />
<link rel="shortcut icon" href="<?php echo $config['urlpath']; ?>/favicon.ico" />
<meta property="og:title" content="<?php echo htmlspecialchars($config['site_name'] . ' Anime Online'); ?>" />
<meta property="og:description" content="Anime HD en sub espanol." />
<meta property="og:url" content="<?php echo $config['urlpath']; ?>/" />
<meta property="og:image" content="<?php echo getThemeUrl(); ?>/img/web.png" />
<link rel="image_src" href="<?php echo getThemeUrl(); ?>/img/web.png" />
<meta name="trafficjunky-site-verification" content="123456" />
<meta name="juicyads-site-verification" content="123456">
<meta name="exoclick-site-verification" content="95b225b1f6247eb88e66b0d8dccafc6e">
</head>
<?php $data['header_meta'] = endZone(); ?>
<?php startZone(); ?>
<link rel="stylesheet" href="<?php echo getThemeUrl(); ?>/css/owl.carousel.min.css">

<style>
    .home-slider {
        margin-bottom: 1.5rem;
    }
    .item {
        cursor: pointer;
        margin: 10px;
        width: 267px;
        height: auto;
        position: relative;
        left: 0px;
        display: inline-block;
        padding: 10px;
        transition: all  0.5s;
    }
    .overtitle {
        padding: 0px 0px;
        margin-top:8px;
        color: #ff7d12;
        font-size: 16px;
        line-height: 30px;
        bottom: 0px;
        -ms-text-overflow: ellipsis;
        overflow: hidden;
        text-overflow: ellipsis;
        left: 0;
        right: 0;
        white-space: nowrap;
    }
    .overarchingdivrecent {
        margin-top:20px;
        height: 195px;
        position: relative;
        display: block;
        overflow: hidden;
        border-radius:1rem;
        transition: all  0.2s;
    }
    .overarchingdivrecent:hover {
        height: 175px;
        position: relative;
        display: block;
        overflow: hidden;
        border-radius:1.5rem;
        transform: translate(2px, -2px);
        box-shadow: #ff7d12 -2px 2px 0px 1px;
        transition: all  0.2s;
    }
    .overarchingdivrecent img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all  0.2s;
    }
    .overarchingdivrecent:hover img {
        transition: all  0.2s;
    }

    .overarchingdivrecent:hover .hoveroverlay {
        opacity: 100;
    }

    .overarchingdivrecent:hover .seriesoverlay {
        opacity: 0;
    }
    .overarchingdivnoti {
        margin-top:20px;
        height: 195px;
        position: relative;
        display: block;
        overflow: hidden;
        border-radius:1rem;
        transition: all  0.2s;
    }
    .overarchingdivnoti:hover {
        height: 175px;
        position: relative;
        display: block;
        overflow: hidden;
        border-radius:1.5rem;
        transform: translate(2px, -2px);
        box-shadow: #ff7d12 -2px 2px 0px 1px;
        transition: all  0.2s;
    }
    .overarchingdivnoti img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all  0.2s;
    }
    .overarchingdivnoti:hover img {
        transition: all  0.2s;
    }

    .overarchingdivnoti:hover .hoveroverlay {
        opacity: 100;
    }

    .overarchingdivnoti:hover .seriesoverlay {
        opacity: 0;
    }
    .overarchingdiv {
        height: 175px;
        position: relative;
        display: block;
        overflow: hidden;
        border-radius:1.5rem;
        transition: all  0.2s;
    }
    .overarchingdiv:hover {
        height: 175px;
        position: relative;
        display: block;
        overflow: hidden;
        border-radius:1.5rem;
        transform: translate(2px, -2px);
        box-shadow: #ff7d12 -2px 2px 0px 1px;
        transition: all  0.2s;
    }
    .overarchingdiv img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all  0.2s;
    }
    .overarchingdiv:hover img {
        transition: all  0.2s;
    }

    .overarchingdiv:hover .hoveroverlay {
        opacity: 100;
    }

    .overarchingdiv:hover .seriesoverlay {
        opacity: 0;
    }
    @media screen and (max-width: 479px) {
        .capitulos-grid {
            margin-top:20px;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .capitulos-grid>.item {
            width: calc(100% - 0.1em);
            margin: 0.05em;
        }

        .recientes-grid {
            margin-top:20px;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .recientes-grid>.item {
            width: calc(50% - 0.1em);
            margin: 0.05em;
        }

        .item {
            cursor: pointer;
            margin-bottom: 30px!important;
            width: 267px;
            height: auto;
            position: relative;
            left: 0px;
            display: inline-block;
            padding: 0px;
            transition: all  0.5s;
        }
        .overarchingdivrecent {
            margin-top:20px;
            height: 195px;
            position: relative;
            display: block;
            overflow: hidden;
            border-radius:1rem;
            transition: all  0.2s;
        }
        .overarchingdivnoti {
            margin-top:20px;
            height: 195px;
            position: relative;
            display: block;
            overflow: hidden;
            border-radius:1rem;
            transition: all  0.2s;
        }
        .overarchingdiv {
            margin-top:20px;
            height: 195px;
            position: relative;
            display: block;
            overflow: hidden;
            border-radius:0;
            transform:scale(1.14);
            transition: all  0.2s;
        }
        .overtitle {
            padding: 0px 0px;
            margin-top:18px!important;
            color: #ff7d12;
            font-size: 16px;
            line-height: 30px;
            bottom: 0px;
            -ms-text-overflow: ellipsis;
            overflow: hidden;
            text-overflow: ellipsis;
            left: 0;
            right: 0;
            white-space: nowrap;
        }
    }

    @media screen and (min-width: 480px) {
        .capitulos-grid {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .capitulos-grid>.item {
            width: calc(50% - 0.1em);
            margin: 0.05em;
        }
    }

    @media screen and (min-width: 768px) {
        .capitulos-grid {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .capitulos-grid>.item {
            width: calc(33.33333333% - 0.1em);
            margin: 0.05em;
        }

        .recientes-grid {
            margin-top:20px;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .recientes-grid>.item {
            width: calc(33.33333333% - 0.1em);
            margin: 0.05em;
        }
    }
     @media screen and (min-width: 1280px) {
        .capitulos-grid {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }
        .capitulos-grid > .item {
            width: calc(25% - 0.1em);
            margin: 0.05em;
        }
        .recientes-grid {
            margin-top:20px;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .recientes-grid>.item {
            width: calc(25% - 0.1em);
            margin: 0.05em;
        }
    }

    @media screen and (max-width: 479px) {
        .recientes-grid {
            margin-top:20px;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .recientes-grid>.item {
            width: calc(50% - 0.1em);
            margin: 0.05em;
        }
        .noticias-grid {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .noticias-grid>.item {
            width: calc(50% - 0.1em);
            margin: 0.05em;
        }
        .noticias-grid>.item:nth-last-child(2) {
            display:none;
        }
        .noticias-grid>.item:nth-last-child(1) {
            display:none;
        }
    }

    @media screen and (min-width: 480px) {
        .noticias-grid {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .noticias-grid>.item {
            width: calc(33.3333333333% - 0.1em);
            margin: 0.05em;
        }
        .recientes-grid {
            margin-top:20px;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .recientes-grid>.item {
            width: calc(50% - 0.1em);
            margin: 0.05em;
        }
    }

    @media screen and (min-width: 768px) {
        .recientes-grid {
            margin-top:20px;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }
        .recientes-grid>.item {
            width: calc(25% - 0.1em);
            margin: 0.05em;
        }
        .noticias-grid {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .noticias-grid>.item {
            width: calc(25% - 0.1em);
            margin: 0.05em;
        }
        .noticias-grid>.item:last-child {
            display:none;
        }
        .noticias-grid>.item:nth-last-child(2) {
            display:none;
        }
    }


    .seriesoverlay {
        transition: .3s;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
        bottom: 0;
        height: 100px;
        width: 100%;
        position: absolute;
    }

    .overtitle {
        padding: 0px 0px;
        margin-top:8px;
        color: #ff7d12;
        font-size: 16px;
        line-height: 30px;
        bottom: 0px;
        -ms-text-overflow: ellipsis;
        overflow: hidden;
        text-overflow: ellipsis;
        left: 0;
        right: 0;
        white-space: nowrap;
    }
    .overtitlenews {
        padding: 0px 5px;
        background: rgba(0, 0, 0, 0.8);
        font-size: 13px;
        position: absolute;
        bottom: 0px;
        -ms-text-overflow: ellipsis;
        text-overflow: ellipsis;
        left: 0;
        right: 0;
        overflow: visible;
    }

    /*.overtitle {
    padding:0px 5px;
    font-size:13px;
    background:rgba(0,0,0,0.8);
    border-radius:4px;
    -moz-border-radius:4px;
    -webkit-border-radius:4px;
    line-height: 30px;
    position: absolute;
    bottom: 5px;
    left: 0px;
}*/

    .seriesoverlay h3 {
        position: absolute;
        bottom: 0;
        width: 100%;
        padding: 0;
    }

    .overepisode {
        padding: 0px 0px;
        border-radius: 4px;
        color: grey;
    }

    .hoveroverlay {
        transition: .3s;
        opacity: 0;
        background: rgba(0, 0, 0, 0.8);
        border-radius: 50%;
        width: auto;
        left: 50%;
        margin-left: -28px;
        top: 50%;
        margin-top: -30px;
        position: absolute;
    }

    .pgnav {
        transition: .3s;
        cursor: pointer;
        font-size: 20px !important;
        margin: 10px;
        color: #fff;
        display: inline-block !important;
        padding: 6px 8px;
    }

    .episode-banner-top div {
        margin: 0 auto !important;
    }

    .episode-banner-top-2 div {
        margin: 0 auto !important;
        display: flex;
        justify-content: center;
    }

    .owl-dots {
        display: none !important;
    }
    .rounded-container {
        border-radius:1rem;
    }
    body {
        background-color: #000;
    }
    .section {
        padding: 1rem 0.5rem;
    }
    .popular {
        transition: all  0.2s;
        color: #444!important;
    }
    .popular:hover {
        transition: all  0.2s;
        color: #ff7d12!important;
    }
</style>
<?php $data['header_css'] = endZone(); ?>
<?php require_once(getThemeFile('header')); ?>

<div class="hero is-lightx is-fullheight">
    <!-- GALAK -->
    <div class="container">
        <?php include 'ads/galak.php';?>
    </div>
    <section class="page-home__slider-container">
        <div class="container rounded-container">
            <h1 class="title is-size-5 has-text-weight-semibold has-text-grey-light" style="margin-bottom:0;padding-top:10px;padding-bottom:10px;padding-left:15px;">
                <i class="fa fa-fire has-text-orange"></i> Animes Populares
            </h1>

            <div class="owl-carousel home-slider" style="padding-left:10px;padding-right:10px;">
                <?php
                foreach ($data['slider'] as $serie_item) {
                    switch ($serie_item['category_id']) {
                        case 1:
                            $css_type = 'danger';
                            break;
                        case 2:
                            $css_type = 'link';
                            break;
                        case 3:
                            $css_type = 'success';
                            break;
                        case 4:
                            $css_type = 'light';
                            break;
                        default:
                            $css_type;
                            break;
                    }
                ?>
                    <article class="serie-card">
                        <figure class="image">
                            <a href="<?php echo $config['urlpath'] . '/' . $serie_item['url']; ?>" title="<?php echo htmlspecialchars($serie_item['name']); ?>">
                                <img src="<?php echo getSerieCover($serie_item['image_cover']); ?>" alt="<?php echo htmlspecialchars($serie_item['name']); ?>">
                                <span class="overlay-dark"></span>
                            </a>
                            <span class="tag year is-dark"><?php echo date('Y', strtotime($serie_item['release_date'])); ?></span>
                            <?php if ($serie_item['status_id'] == 1) { ?><span class="tag is-orange airing">Emisión</span><?php } ?>
                            <span class="tag is-<?php echo $css_type; ?> type"><?php echo getSerieCategory($serie_item['category_id']); ?></span>
                        </figure>
                        <div class="title">
                            <h3><a class="has-text-orange has-text-weight-semibold has-text-centered is-size-6" href="<?php echo $config['urlpath'] . '/' . $serie_item['url']; ?>" title="<?php echo htmlspecialchars($serie_item['name']); ?>"><?php echo $serie_item['name']; ?></a></h3>
                        </div>
                    </article>
                <?php } ?>
            </div>

        </div>
    </section>
    <section class="page-home__latest-chapters">
        <div class="container rounded-container">
            <h1 class="title is-size-5 has-text-weight-semibold has-text-grey-light" style="margin-bottom:0;padding-top:10px;padding-left:15px;">
                <i class="fa fa-newspaper has-text-orange"></i> Noticias Anime
            </h1>
            <div class="noticias-grid" style="padding: 0px 10px;">
                <?php foreach ($data['news'] as $notice) { ?>
                    <div class="item">
                        <div class="overarchingdivnoti">
                            <a href="<?php echo $notice['url'];?>" title="<?php echo htmlspecialchars($notice['title']); ?>">
                                <img src="<?php echo $notice['thumbnail']; ?>" alt="<?php echo htmlspecialchars($notice['title']); ?>">
                                <div class="seriesoverlay has-text-orange">
                                    <h3 class="has-text-centered">
                                        <div class="overtitlenews has-text-weight-semibold"><?php echo $notice['title']; ?></div>
                                        <div class="overepisode has-text-weight-semibold is-size-7"><?php echo $notice['date_post']; ?></div>
                                    </h3>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <section class="container">
        <?php include 'ads/bidgear.php';?>
    </section>
    <?php if (isset($session)) { ?>
    <section class="page-home__latest-chapters">
        <div class="container">
            <h1 class="title is-size-5 has-text-weight-semibold has-text-grey-light" style="margin-bottom:0;padding-top:10px;padding-left:15px;">
                <i class="fa fa-play has-text-orange"></i> Visto recientemente
            </h1>
                <div class="column is-full">
                    <div class="recientes-grid">
                        <?php foreach ($data['user_last_episodes'] as $episode) { ?>
                            <div class="item">
                                <div class="overarchingdivrecent">
                                    <a href="<?php echo $config['urlpath'] . '/ver/' . $episode['url'] . '-' . $episode['number']; ?>" title="<?php echo htmlspecialchars($episode['name'] . ' ' . $episode['number']); ?>">
                                        <img src="<?php echo getEpisodeImage($episode['image_screenshot'], $episode['image']); ?>" alt="<?php echo htmlspecialchars($episode['name'] . ' ' . $episode['number']); ?>">
                                        <div class="hoveroverlay"> <i class="fas fa-play pgnav activehov"></i> </div>
                                    </a>
                                </div>
                                <div class="overtitle has-text-weight-semibold"><?php echo $episode['name']; ?></div>
                                <div class="overepisode has-text-weight-semibold is-size-7">Episodio <?php if(isset($episode['episodegroup'])) {echo $episode['episodegroup'];} else { echo $episode['number'];} ?></div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <div class="container" style="display:flex;justify-content:center;">
        <a href="https://hentaini.com/">
            <img style="max-width:100%;height:auto;" src="hni3.jpg" alt="Watch English sub Hentai">
        </a>
    </div>
    <section class="page-home__latest-chapters">
        <div class="container">
            <h1 class="title is-size-5 has-text-weight-semibold has-text-grey-light" style="margin-bottom:0;padding-top:10px;padding-left:15px;">
                <i class="fa fa-play has-text-orange"></i> Episodios recientes
            </h1>
                <div class="column is-full" style="padding:0;">
                    <div class="capitulos-grid">
                        <?php foreach ($data['latest_episodes'] as $episode) { ?>
                            <div class="item">
                                <div class="overarchingdiv">
                                    <a href="<?php echo $config['urlpath'] . '/ver/' . $episode['url'] . '-' . $episode['number']; ?>" title="<?php echo htmlspecialchars($episode['name'] . ' ' . $episode['number']); ?>">
                                        <img src="<?php echo getEpisodeImage($episode['image_screenshot'], $episode['image']); ?>" alt="<?php echo htmlspecialchars($episode['name'] . ' ' . $episode['number']); ?>">
                                        <div class="hoveroverlay"> <i class="fas fa-play pgnav activehov"></i> </div>
                                    </a>
                                </div>
                                <div class="overtitle"><?php echo $episode['name']; ?></div>
                                <div class="overepisode has-text-weight-semibold is-size-7">Episodio <?php if(isset($episode['episodegroup'])) {echo $episode['episodegroup'];} else { echo $episode['number'];} ?></div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-home__latest-series">
        <div class="container rounded-container">
            <h1 class="title is-size-5 has-text-weight-semibold has-text-grey-light" style="margin-bottom:0;padding-top:10px;padding-left:15px;">
                <i class="fa fa-star has-text-orange"></i> Últimas series agregadas
            </h1>

            <div class="list-series">
                <?php foreach ($data['latest_series'] as $serie_item) {
                    switch ($serie_item['category_id']) {
                        case 1:
                            $css_type = 'danger';
                            break;
                        case 2:
                            $css_type = 'link';
                            break;
                        case 3:
                            $css_type = 'success';
                            break;
                        case 4:
                            $css_type = 'light';
                            break;
                        default:
                            $css_type;
                            break;
                    }
                ?>
                    <article class="serie-card">
                        <figure class="image">
                            <a href="<?php echo $config['urlpath'] . '/' . $serie_item['url']; ?>" title="<?php echo htmlspecialchars($serie_item['name']); ?>">
                                <img src="<?php echo getSerieCover($serie_item['image_cover']); ?>" alt="<?php echo htmlspecialchars($serie_item['name']); ?>">
                                <span class="overlay-dark"></span>
                            </a>
                            <?php if (isset($serie_item['release_date'])) { ?>
                            <span class="tag year is-dark"><?php echo date('Y', strtotime($serie_item['release_date'])); ?></span>
                            <?php } ?>
                            <?php if ($serie_item['status_id'] == 1) { ?><span class="tag is-success airing">Emisión</span><?php } ?>
                            <?php if ($serie_item['status_id'] == 2) { ?><span class="tag is-danger airing">Finalizado</span><?php } ?>
                            <?php if ($serie_item['status_id'] == 3) { ?><span class="tag is-white airing">Próximamente</span><?php } ?>
                            <?php if ($serie_item['status_id'] == 4) { ?><span class="tag is-orange airing">En Cuarentena</span><?php } ?>
                            <span class="tag is-<?php echo $css_type; ?> type"><?php echo getSerieCategory($serie_item['category_id']); ?></span>
                            <a href="<?php echo $config['urlpath'] . '/' . $serie_item['url']; ?>" title="<?php echo htmlspecialchars($serie_item['name']); ?>">
                            </a>
                        </figure>
                        <div class="title">
                            <h3><a class="has-text-orange has-text-weight-semibold has-text-centered is-size-6" href="<?php echo $config['urlpath'] . '/' . $serie_item['url']; ?>" title="<?php echo htmlspecialchars($serie_item['name']); ?>"><?php echo $serie_item['name']; ?></a></h3>
                        </div>
                    </article>
                <?php } ?>
            </div>

        </div>
    </section>

    <section class="section has-background-darkx">
        <div class="container">
            <h1 class="title is-size-5 has-text-weight-semibold has-text-grey-light" style="margin-bottom:0;padding-bottom:10px;padding-left:15px;">
                <i class="fas fa-comment-dots far has-text-orange"></i> Comentarios:
            </h1>
            <!-- <div style="display:grid;place-items:center">
                <p style="color:white;">Al que spameo el comentario con 200 anidaciones: Felicidades, tu madre estará orgullosa.</p>
                <img src="https://www.animefenix.com/pvtoelquelolea.jpg" alt="Ve y dile al vato que publico el comentario que lo borre :v" width="50%">
            </div> -->
            <div id="commentsContainer">
                <div id="showComments" class="button is-fullwidth is-orange">Mostrar Comentarios</div>
            </div>
            <script>
                /**
                 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                /*
                var disqus_config = function () {
                  // Replace PAGE_URL with your page's canonical URL variable
                this.page.identifier = 'animefenix'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                };
                */
            </script>
            <!-- <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript> -->

        </div>
    </section>

    <div class="modal" id="my-modal" >
        <div class="modal-background"></div>
        <div class="modal-content" style="background-color:#222;">
        <div class="box has-text-white" style="background-color:#222;">
            <h1 class="title has-text-white has-text-centered has-text-bold">¡Disponible Calendario Otoño!</h1>
            <img src="https://animefenix.tv/themes/animefenix-frans185/images/fall.png" alt="Placeholder Image" class="mb-2">
            <button class="button is-secondary close-modal">Cerrar</button>
        </div>
        </div>
    </div>
    <!-- <div class="modal" id="my-modal" >
        <div class="modal-background"></div>
        <div class="modal-content" style="background-color:#222;">
        <div class="box has-text-white" style="background-color:#222;">
            <h1 class="title has-text-white has-text-centered has-text-bold">¡Una al día no hace daño!</h1>
            <img src="https://animefenix.tv/themes/animefenix-frans185/images/unaldia.jpg" alt="Placeholder Image" class="mb-2">
            <button class="button is-secondary close-modal">Cerrar</button>
        </div>
        </div>
    </div> -->

</div>

<?php startZone(); ?>
<script>
    // $(document).ready(function() {
    //   var dismissed = localStorage.getItem("dismissed_fall");

    //   if (dismissed !== "true") {
    //     $("#my-modal").addClass("is-active");
    //   }

    //   $(".close-modal").click(function() {
    //     localStorage.setItem("dismissed_fall", "true");
    //     $("#my-modal").removeClass("is-active");
    //   });
    // });
  </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="<?php echo getThemeUrl(); ?>/js/owl.carousel.min.js"></script>
<script>
$("#showComments").click(function() {
    $("#commentsContainer").append('<div id="disqus_thread"></div>');
    var disqus_config = function () {
    this.page.url = 'https://www.animefenix.tv/';
    this.page.identifier = 'animefenix.tv'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    (function() { // DON'T EDIT BELOW THIS LINE
        var d = document,
            s = d.createElement('script');
        s.src = 'https://animefenix.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
});
</script>
<script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 4,
        nav: false,
        autoWidth: false,
        autoplay: true,
        autoPlaySpeed: 5000,
        autoPlayTimeout: 5000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 2
            },
            500: {
                items: 3,
                margin: 4
            },
            800: {
                items: 6,
                margin: 4
            },
            1000: {
                items: 6,
                margin: 4
            }
        }
    });
</script>
<?php $data['footer_js'] = endZone(); ?>

<?php require_once(getThemeFile('footer')); ?>