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
<title>Baixar <?php echo $data['serie']['name'] . ' ' . $data['episode']['number'] . ' legendado  br - ' . $config['site_name']; ?></title>
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
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
<?php $data['header_meta'] = endZone(); ?>
<?php startZone(); ?>
<style>
html{
    background-color: #333;
}
    .iframe-container {
        position: relative;
        overflow: hidden;
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

    .episode-page__servers.is-toggle ul {
        border-bottom: 2px solid #E2C205;
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
</style>
<?php $data['header_css'] = endZone(); ?>
<?php require_once(getThemeFile('header')); ?>

<body>
<div class="container" style="margin-top:2rem;">
    <h1 class="title is-size-4 has-text-centeredX has-text-weight-semibold is-uppercaseX has-text-light">
        Descarga <?php echo $data['serie']['name']; ?> <?php echo $data['episode']['number']; ?> Sub Español
    </h1>
    <section class="section">
    <?php include 'ads/galak.php';?>
    </section>
    <section class="section">
    <?php include 'ads/bidgear.php';?>
    </section>
    <section style="display:flex;justify-content:center;">
    <div class="column is-12-mobile is-6-tablet is-6-desktop">
        <div class="columns is-variable is-1" style="display: flex;">


            <?php if (isset($data['episode_prev'])) { ?>
                <div class="column is-3-desktop is-2-tablet is-2-mobile" style="display: flex;justify-content: start;z-index:100;">
                    <a href="<?php echo $config['urlpath'] . '/ver/' . $data['serie']['url'] . '-' . $data['episode_prev']; ?>/descarga" class="button  is-orange is-fullwidth" style="font-size:0.9rem!important;">
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
                    <a href="<?php echo $config['urlpath'] . '/ver/' . $data['serie']['url'] . '-' . $data['episode_next']; ?>/descarga" class="button  is-orange is-fullwidth" style="font-size:0.9rem!important;">
                        <i class="fa fa-arrow-circle-right"></i>&nbsp;
                    </a>
                </div>
            <?php } ?>


        </div>
    </div>
    </section>
    <section class="section">
        <?php if (isset($session)) { ?>
            <?php foreach ($data['episode']['downloads'] as $key => $download) {  if (getThemeDownloadDomain($download) == 'zippyshare'){continue;}?>
                <a href="<?php echo $config['urlpath'].'/redirect_download.php?sid='.urlencode($data['serie']['id']).'&cnumber='.$episode_number.'&dl='.$key; ?>" class="button is-fullwidth is-orange" style="margin-bottom: 1rem;" target="_blank"><i class="fas fa-cloud-download-alt"></i>&nbsp;<?php echo getThemeDownloadDomain($download); ?></a>
            <?php } ?>
        <?php } else { ?>
            <p class="callout callout-danger lead" style="background-color: #353a3d !important;color: #fff;padding: 10px;border-radius: 2px">Necesitas estar logueado para poder descargar... </p>
        <?php } ?>
    </section>
    <section class="section" style="padding-top:0;">
    <article class="message is-dark">
        <div class="message-header">
            <p>NOTA</p>
        </div>
        <div class="message-body">
            Recuerda que debes crear una cuenta para poder descargar. <a href="https://www.animemanito.com/user/signup">Click aqui para crear una cuenta</a> <br>
            Si ya tienes una cuenta <a href="https://www.animemanito.com/user/login">Haz click aqui para ingresar</a>
        </div>
    </article>
    <article class="message is-dark">
        <div class="message-header">
            <p>NOTA 2</p>
        </div>
        <div class="message-body">
            <h2 stlye="color:#ff4500;">En lo servidores de <strong>Fembed, mp4upload y yourupload</strong> puedes descargar tambien un capitulo.</h2>
            <img src="<?php echo $config['urlpath']?>/1.jpg" alt="Tutorial 1">
            <img src="<?php echo $config['urlpath']?>/2.jpg" alt="Tutorial 2">
            <img src="<?php echo $config['urlpath']?>/3.jpg" alt="Tutorial 3">
        </div>
    </article>
    <article class="message is-dark">
        <div class="message-header">
            <p>NOTA 3</p>
        </div>
        <div class="message-body">
            Si el enlace de <strong>Mega</strong> no está disponible aquí, prueba usar el de los reproductores. Es la <strong>M</strong>.
        </div>
    </article>
    <article class="message is-dark">
        <div class="message-header">
            <p>NOTA 4</p>
        </div>
        <div class="message-body">
            Si ninguno de los enlaces de descarga está disponible, por favor envía un mensaje al facebook o al Discord <br>
            <a href="https://discord.gg/C2UYNH6">
                <img width="50" src="<?php echo getThemeUrl(); ?>/images/discord-icon-v1.png" alt="Discord">
            </a>
            <a href="<?php echo $config['facebook']; ?>">
                <img width="50" src="https://i.pinimg.com/originals/58/f4/72/58f4723d8f23906bdcb058604075ad2a.png" alt="Facebook">
            </a>
        </div>
        </article>
    <article class="message is-dark">
        <div class="message-header">
            <p>NOTA 234234234</p>
        </div>
        <div class="message-body">
            Si lo anterior tampoco funciona, aquí el tutorial para solucionar los errores. <br>
            <a href="https://www.youtube.com/watch?v=GtL1huin9EE" target="_blank">
                <img width="50" src="<?php echo getThemeUrl(); ?>/images/yt.png" alt="Youtube">
            </a>
        </div>
        </article>
    </section>
    <section class="section">
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
    </section>
</div>
</body>
<?php include 'adtag.php' ?>
<?php startZone(); ?>
<?php $data['footer_js'] = endZone(); ?>

<?php require_once(getThemeFile('footer')); ?>