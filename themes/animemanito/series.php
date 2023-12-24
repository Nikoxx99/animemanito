<?php
startZone(); ?>
<title>Anime Gratis - <?php echo $config['site_name']; ?></title>
<!-- Seo -->
<meta content='Anime' name='Subject' />
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
<meta name="title" content="Anime Gratis - <?php echo htmlspecialchars($config['site_name']); ?>" />
<meta name="description" content="Ver anime gratis con buena calidad en <?php echo htmlspecialchars($config['site_name']); ?>" />
<meta name="keywords" content="todos los animes" />
<link rel="shortcut icon" href="<?php echo $config['urlpath']; ?>/favicon.ico" />
<meta property="og:title" content="Anime Gratis - <?php echo htmlspecialchars($config['site_name']); ?>" />
<meta property="og:description" content="Ver anime en <?php echo htmlspecialchars($config['site_name']); ?>" />
<meta property="og:url" content="<?php echo $config['urlpath']; ?>/animes/" />
<meta property="og:image" content="<?php echo getThemeUrl(); ?>/img/web.png" />
<link rel="image_src" href="<?php echo getThemeUrl(); ?>/img/web.png" />
<?php
$data['header_meta'] = endZone();
startZone(); ?>
<link rel="stylesheet" href="<?php echo getThemeUrl(); ?>/abuscador/bootstrap-multiselect.css">
<link rel="stylesheet" href="<?php echo getThemeUrl(); ?>/css/serie-browser.css">
<style>
    .serie-card__information {
        position: absolute;
        visibility: hidden;
        opacity: 0;
        top: 0;
        right: -240px;
        width: 240px;
        height: 100%;
        background-color: white;
        padding: 0.5rem;
        border-radius: 0.5rem;
        font-size: 0.8rem;
        z-index: 1;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .serie-card:hover .serie-card__information {
        visibility: visible;
        opacity: 1;
    }

    .serie-card__information p {
        overflow-y: auto;
        height: 100%;
    }

    .serie-card__information:hover {
        display: none;
    }

    .episode-banner-top div {
        margin: 0 auto !important;
    }

    .episode-banner-top-2 div {
        margin: 0 auto !important;
        display: flex;
        justify-content: center;
    }
</style>
<?php $data['header_css'] = endZone(); ?>
<?php require_once(getThemeFile('header')); ?>

<div class="hero is-lightx is-fullheight">
    <section class="section page-home__slider-container">
        <div class="episode-banner-top-2">
        <?php include 'ads/galak.php';?>
        </div>
    </section>
    <section class="section has-background-darkx">
        <div class="container">
            <!-- <script>
                (function(p,u,s,h,x){
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
            <!-- <script data-cfasync="false" async type="text/javascript" src="//evemasoil.com/ffBpNUR6TGJETix/21979"></script> -->
            <div class="container">
                <?php include 'ads/bidgear.php';?>
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
                <h1 class="title is-size-4 has-text-weight-semibold is-uppercase has-text-orange">
                    <i class="fas fa-search-plus has-text-light"></i> AVANÇADO
                </h1>

                <form action="<?php echo $config['urlpath']; ?>/animes" method="get">
                    <div class="filters" style="margin-bottom: 10px;">
                        <select name="Gênero[]" id="genre_select" multiple="multiple">
                            <?php
                            foreach ($data['genres'] as $item) {
                                $selected = '';

                                if (isset($_GET['Gênero'])) {
                                    if (in_array($item['url'], $_GET['Gênero'])) {
                                        $selected = ' selected';
                                    }

                                    if ($item['url'] == $_GET['Gênero']) {
                                        $selected = ' selected';
                                    }
                                }
                            ?>
                                <option value="<?= $item['url'] ?>" <?php echo $selected; ?>><?= $item['name'] ?></option>
                            <?php } ?>
                        </select>
                        <select name="year[]" id="year_select" multiple="multiple">
                            <?php
                            foreach ($data['years'] as $item) {
                                $selected = '';

                                if (isset($_GET['year'])) {
                                    if (in_array($item, $_GET['year'])) {
                                        $selected = ' selected';
                                    }

                                    if ($_GET['year'] == $item) {
                                        $selected = ' selected';
                                    }
                                }
                            ?>
                                <option value="<?= $item ?>" <?php echo $selected; ?>><?= $item ?></option>
                            <?php } ?>
                        </select>
                        <select name="type[]" id="type_select" multiple="multiple">
                            <?php
                            foreach ($data['categories'] as $item) {
                                $selected = '';

                                if (isset($_GET['type'])) {
                                    if (in_array($item['url'], $_GET['type'])) {
                                        $selected = ' selected';
                                    }

                                    if ($_GET['type'] == $item['url']) {
                                        $selected = ' selected';
                                    }
                                }
                            ?>
                                <option value="<?= $item['url'] ?>" <?php echo $selected; ?>><?= $item['name'] ?></option>
                            <?php } ?>
                        </select>
                        <select name="estado[]" id="status_select" multiple="multiple">
                            <?php
                            foreach ($data['status'] as $item) {
                                $selected = '';

                                if (isset($_GET['estado'])) {
                                    if (in_array($item['id'], $_GET['estado'])) {
                                        $selected = ' selected';
                                    }

                                    if ($item['id'] == $_GET['estado']) {
                                        $selected = ' selected';
                                    }
                                }
                            ?>
                                <option value="<?= $item['id'] ?>" <?php echo $selected; ?>><?= $item['name'] ?></option>
                            <?php } ?>
                        </select>
                        <select name="order" id="order_select">
                            <?php
                            foreach ($data['order-list'] as $item) {
                                $selected = '';

                                if (isset($_GET['order'])) {
                                    if ($item['url'] == $_GET['order']) {
                                        $selected = ' selected';
                                    }
                                }
                            ?>
                                <option value="<?= $item['url'] ?>" <?php echo $selected; ?>><?= $item['name'] ?></option>
                            <?php } ?>
                        </select>
                        <button type="submit" class="button is-small is-orange">
                            <span class="fa fa-filter" aria-hidden="true"></span> Filtrar
                        </button>
                    </div>
                </form>

                <div class="list-series">
                    <?php
                    foreach ($data['series'] as $serie_item) {
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
                            <div class="serie-card__information">
                                <p><?php echo strip_tags($serie_item['synopsis']); ?></p>
                            </div>
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
                <div class="pagination is-centered">
                    <ul class="pagination-list">
                        <?php
                        $last       = ceil($paginator['total'] / $paginator['limit']);

                        $start      = (($paginator['page'] - $paginator['links']) > 0) ? $paginator['page'] - $paginator['links'] : 1;
                        $end        = (($paginator['page'] + $paginator['links']) < $last) ? $paginator['page'] + $paginator['links'] : $last;

                        $html       = '';

                        if ($paginator['page'] > 1) {
                            $class      = ($paginator['page'] == 1) ? " disabled" : "";
                            $html       .= '<li><a class="pagination-link' . $class . '" href="' . $url_query . 'page=' . ($paginator['page'] - 1) . '">Anterior</a></li>';
                        }

                        if ($start > 1) {
                            $html   .= '<li><a class="pagination" href="' . $url_query . '">1</a></li>'; //?page=1
                            $html   .= '<li class="pagination-link disabled"><span>...</span></li>';
                        }

                        for ($i = $start; $i <= $end; $i++) {
                            if ($paginator['page'] == $i) {
                                $html   .= '<li><a class="pagination-link is-current">' . $i . '</a></li>';
                            } else {
                                if (!isset($class)) {
                                    $class = '';
                                }
                                $html   .= '<li><a class="pagination-link' . $class . '" href="' . $url_query . 'page=' . $i . '">' . $i . '</a></li>';
                            }
                        }

                        if ($end < $last) {
                            $html   .= '<li class="disabled"><span>...</span></li>';
                            $html   .= '<li><a class="pagination-link" href="' . $url_query . 'page=' . $last . '">' . $last . '</a></li>';
                        }

                        if ($paginator['page'] < $last) {
                            $class      = ($paginator['page'] == $last) ? " disabled" : "";
                            $html       .= '<li><a class="pagination-link' . $class . '" href="' . $url_query . 'page=' . ($paginator['page'] + 1) . '">Siguiente</a></li>';
                        }

                        echo $html;
                        ?>
                    </ul>
                </div>
            </div>
    </section>

</div>
<?php ob_start(); ?>
<script type="text/javascript" src="<?php echo getThemeUrl(); ?>/abuscador/jquery-1.js"></script>
<script type="text/javascript" src="<?php echo getThemeUrl(); ?>/abuscador/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo getThemeUrl(); ?>/abuscador/bootstrap-multiselect.js?v<?php echo time(); ?>"></script>
<script>
    $(document).ready(function() {
        $('#genre_select').multiselect({
            templates: {
                ul: '<ul class="multiselect-container genres-select dropdown-menu"></ul>',
            },
            enableHTML: true,
            buttonClass: 'button is-small is-light',
            onChange: function(option, checked) {
                var selectedOptions = $('#genre_select option:selected');
                if (selectedOptions.length >= 4) {
                    var nonSelectedOptions = $('#genre_select option').filter(function() {
                        return !$(this).is(':selected');
                    });
                    nonSelectedOptions.each(function() {
                        var input = $('input[value="' + $(this).val() + '"]');
                        input.prop('disabled', true);
                        input.parent('li').addClass('disabled');
                    });
                } else {
                    $('#genre_select option').each(function() {
                        var input = $('input[value="' + $(this).val() + '"]');
                        input.prop('disabled', false);
                        input.parent('li').addClass('disabled');
                    });
                }
            },
            buttonText: function(options) {
                if (options.length === 0) {
                    return '<b>Gênero:</b> Todos';
                } else if (options.length > 1) {
                    return '<b>Gênero:</b> ' + options.length + ' seleccionados';
                } else {
                    return '<b>Gênero:</b> ' + $(options[0]).text();
                }
            }
        });
        $('#type_select').multiselect({
            enableHTML: true,
            buttonClass: 'button is-small is-light',
            buttonText: function(options) {
                if (options.length === 0) {
                    return '<b>Categoria:</b> Todos';
                } else if (options.length > 1) {
                    return '<b>Categoria:</b> ' + options.length + ' seleccionados';
                } else {
                    return '<b>Categoria:</b> ' + $(options[0]).text();
                }
            }
        });
        $('#status_select').multiselect({
            enableHTML: true,
            buttonClass: 'button is-small is-light',
            buttonText: function(options) {
                if (options.length === 0) {
                    return '<b>Estado:</b> Todos';
                } else if (options.length > 1) {
                    return '<b>Estado:</b> ' + options.length + ' seleccionados';
                } else {
                    return '<b>Estado:</b> ' + $(options[0]).text();
                }
            }
        });
        $('#year_select').multiselect({
            templates: {
                ul: '<ul class="multiselect-container year-select dropdown-menu"></ul>',
            },
            enableHTML: true,
            buttonClass: 'button is-small is-light',
            buttonText: function(options) {
                if (options.length === 0) {
                    return '<b>Ano:</b> Todos';
                } else if (options.length > 1) {
                    return '<b>Ano:</b> ' + options.length + ' seleccionados';
                } else {
                    return '<b>Ano:</b> ' + $(options[0]).text();
                }
            }
        });
        $('#order_select').multiselect({
            enableHTML: true,
            buttonClass: 'button is-small is-light',
            buttonText: function(options) {
                if (options.length === 0) {
                    return '<b>Ordem:</b> Padrão';
                } else if (options.length > 1) {
                    return '<b>Ordem:</b> ' + options.length + ' seleccionados';
                } else {
                    return '<b>Ordem:</b> ' + $(options[0]).text();
                }
            }
        });
    });
</script>
<?php $data['footer_js'] = endZone(); ?>

<?php require_once(getThemeFile('footer')); ?>