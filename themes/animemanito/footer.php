    <section class="page-footer hero is-dark">
        <div style="padding-top: 20px;padding-bottom:20px;">
            <div class="container" style="display:flex;justify-content:center;">
                <span style="display:block;text-align:center;">
                    <p class="subtitle is-marginless is-size-6">
                        Nenhum vídeo está hospedado em nossos servidores.
                    </p>
                    <p class="subtitle is-marginless is-size-7">
                        Desarrollado por <b class="has-text-grey">UwU</b>
                    </p>
                </span>
            </div>
        </div>
    </section>

    <script src="<?php echo getThemeUrl(); ?>/js/app.js"></script>
<?php if (isset($data['footer_js'])) { echo $data['footer_js']; } ?>

    <?php if($config['analytics'] !== '') { ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-V3DHYJ369Q"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-V3DHYJ369Q');
    </script>
    <?php } ?>

    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.2&appId=<?php echo $config['facebook_appid']; ?>";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <?php include 'ads/propeler.php'; ?>

</body>
</html>