<!DOCTYPE html>
<html lang="es">
<head>
<title>Tu Perfil <?php echo $session['username']; ?></title>
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
    <meta name="title" content="Perfil de usuario" />
    <meta name="description" content="Aqui puedes ver el perfil en <?php echo htmlspecialchars($config['site_name']); ?>" />
    <meta name="keywords" content="todos los animes" />
    <link rel="shortcut icon" href="<?php echo $config['urlpath']; ?>/favicon.ico" />
    <meta property="og:title" content="Anime Gratis - <?php echo htmlspecialchars($config['site_name']); ?>" />
    <meta property="og:description" content="Ver anime en <?php echo htmlspecialchars($config['site_name']); ?>" />
    <meta property="og:url" content="<?php echo $config['urlpath']; ?>/animes/" />
    <meta property="og:image" content="<?php echo getThemeUrl(); ?>/img/web.png" />
    <link rel="image_src" href="<?php echo getThemeUrl(); ?>/img/web.png" />
    <link rel="stylesheet" href="<?php echo getThemeUrl(); ?>/abuscador/bootstrap-multiselect.css">
    <link rel="stylesheet" href="<?php echo getThemeUrl(); ?>/css/bs1.css">
    <link rel="stylesheet" href="<?php echo getThemeUrl(); ?>/css/capitulo.css">
    <link rel="stylesheet" href="<?php echo getThemeUrl(); ?>/css/profile.css">
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
    .serie-card__information p{
        overflow-y: auto;
        height: 100%;
    }
    .serie-card__information:hover{
        display: none;
    }
    .episode-banner-top div {
            margin: 0 auto !important;
    }
    .episode-banner-top-2 div{
        margin: 0 auto !important;
        display: flex;
        justify-content: center;
    }
    .hideMe {
        display:none;
    }
</style>
</head>


<?php require_once(getThemeFile('header')); ?>

<div class="container p-0" style="min-height:100vh;">
    <div class="row">
        <aside class="col-12 col-sm-12 col-md-3 col-lg-3" style="padding-top:30px;">
            <ul class="manito-ul-background">
                <li id="last-view" class="nav-link d-flex justify-content-start active" style="cursor:pointer;border-radius:5px 5px 0px 0px;">
                    <span style="padding:0.5rem;" class="has-text-orange">Últimos Capitulos Vistos</span><i style="font-size:1.5rem;margin-right:0!important;margin-left:auto;align-self: center;" class="fas fa-eye"></i>
                </li>
                <li id="favorite" class="nav-link d-flex justify-content-start" style="cursor:pointer;">
                    <span style="padding:0.5rem;" class="has-text-orange">Favoritos</span><i style="font-size:1.5rem;margin-right:0!important;margin-left:auto;align-self: center;" class="fas fa-heart"></i>
                </li>
                <li id="watch-later" class="nav-link d-flex justify-content-start" style="cursor:pointer;">
                    <span style="padding:0.5rem;" class="has-text-orange">Episodios Pendientes por Ver</span><i style="font-size:1.5rem;margin-right:0!important;margin-left:auto;align-self: center;" class="fas fa-history"></i>
                </li>
                <li id="watch-later-serie" class="nav-link d-flex justify-content-start" style="cursor:pointer;border-radius:0px 0px 5px 5px;">
                    <span style="padding:0.5rem;" class="has-text-orange">Series Pendientes por Ver</span><i style="font-size:1.5rem;margin-right:0!important;margin-left:auto;align-self: center;" class="fas fa-history"></i>
                </li>
            </ul>
            <section class="manito-userinfo-container mt-3" style="border-radius:5px 5px 5px 5px;">
                <div class="row justify-content-center"><img id="userimg" src="<?php echo getUserAvatar($user['avatar']);?>" alt="Foto de perfil de <?php echo $session['name']; ?>" style="max-width:50%;padding:0.8rem;"></div>
                <div class="row justify-content-center has-text-orange"><h3><?php echo $session['name'];?></h3></div>
                <div class="row justify-content-center">
                    <div class="col-8 mt-2">
                        <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden" value="<?php echo $session['id']; ?>" name="idusuario">
                                <input style="display:none" type="file" name="file" id="file" required />
                                <button class="btn btn-info btn-block" style="background-color:#E2C205!important;border: 0!important;" onclick="document.getElementById('file').click()">Cambiar Avatar</button>
                            </div>
                            <div class="form-group">
                                <button id="sendbtn" type="submit" class="btn btn-small btn-success btn-block submit" disabled><i class=" fa fa-cloud-upload"></i>Guardar Cambios</button>

                                <div id='loading'></div>
                                <div id="message"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </aside>
        <section id="last-view-container" class="col-12 col-sm-12 col-md-9 col-lg-9" style="padding-top:30px;">
            <h4 class="has-text-orange" style="padding-left:10px;">Últimos capitulos vistos por <?php echo $session['name'];?></h4>
            <div class="capitulos-grid" id="capitulos-grid"> 
                <?php foreach ($user['last-view'] as $last_view) { ?>
                    <div class="item">
                        <div class="overarchingdiv">
                            <a href="<?php echo $config['urlpath'] . '/ver/' . $last_view['url'] . '-' . $last_view['number']; ?>" title="<?php echo htmlspecialchars($last_view['name'] . ' ' . $last_view['number']); ?>">
                                <img src="<?php echo getEpisodeImage($last_view['image_screenshot'], $last_view['image']); ?>" alt="<?php echo htmlspecialchars($last_view['name'] . ' ' . $last_view['number']); ?>">
                                <div class="hoveroverlay"> <i class="fa fa-play pgnav activehov"></i> </div>
                                <div class="seriesoverlay has-text-orange">
                                    <h3 class="has-text-centered">
                                        <div class="overtitle has-text-weight-semibold"><?php echo $last_view['name']; ?></div>
                                        <div class="overepisode has-text-weight-semibold is-size-7">EP<?php if(isset($last_view['episodegroup'])) {echo $last_view['episodegroup'];} else { echo $last_view['number'];} ?></div>
                                    </h3>
                                    <?php /*<div class="recentupd">Hace 4 horas</div>*/ ?>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
                
            </div>
        </section>
        <section id="favorite-container" class="col-12 col-sm-12 col-md-9 col-lg-9" style="padding-top:30px;display:none;">
            <h4 class="has-text-orange">Tus series favoritas <?php echo $session['name'];?></h4>
            <div class="list-series" id="capitulos-grid">
                <?php foreach ($user['favorite'] as $serie_item) { ?>
                    <article class="serie-card">
                        <div class="serie-card__information">
                            <p><?php echo strip_tags($serie_item['synopsis']); ?></p>
                        </div>
                        <figure class="image">
                            <a href="<?php echo $config['urlpath'].'/'.$serie_item['url']; ?>" title="<?php echo htmlspecialchars($serie_item['name']); ?>">
                                <img src="<?php echo getSerieCover($serie_item['image_cover']); ?>" alt="<?php echo htmlspecialchars($serie_item['name']); ?>">
                                <span class="overlay-dark"></span>
                            </a>
                            <span class="tag year is-dark"><?php echo date('Y', strtotime($serie_item['release_date'])); ?></span>
                            <?php if ($serie_item['status_id'] == 1){ ?><span class="tag is-orange airing">Emisión</span><?php } ?>
                            <span class="tag type"><?php echo getSerieCategory($serie_item['category_id']); ?></span>
                        </figure>
                        <div class="title">
                            <h3><a class="has-text-orange has-text-weight-semibold has-text-centered is-size-6" href="<?php echo $config['urlpath'].'/'.$serie_item['url']; ?>" title="<?php echo htmlspecialchars($serie_item['name']); ?>"><?php echo $serie_item['name']; ?></a></h3>
                        </div>
                    </article>
                <?php } ?>
                
            </div>
            <?php echo $per_page_html_favorite; ?>
        </section>
        <section id="watch-later-container" class="col-12 col-sm-12 col-md-9 col-lg-9" style="padding-top:30px;display:none;">
            <h4 class="has-text-orange" style="padding-left:10px;">Capitulos pendientes por ver de <?php echo $session['name'];?></h4>
            <div class="capitulos-grid" id="capitulos-grid"> 
                <?php foreach ($user['watch-later'] as $episode_wl) { ?>
                    <div class="item">
                        <div class="overarchingdiv">
                            <a href="<?php echo $config['urlpath'] . '/ver/' . $episode_wl['url'] . '-' . $episode_wl['number']; ?>" title="<?php echo htmlspecialchars($episode_wl['name'] . ' ' . $episode_wl['number']); ?>">
                                <img src="<?php echo getEpisodeImage($episode_wl['image_screenshot'], $episode_wl['image']); ?>" alt="<?php echo htmlspecialchars($episode_wl['name'] . ' ' . $episode_wl['number']); ?>">
                                <div class="hoveroverlay"> <i class="fa fa-play pgnav activehov"></i> </div>
                                <div class="seriesoverlay has-text-orange">
                                    <h3 class="has-text-centered">
                                        <div class="overtitle has-text-weight-semibold"><?php echo $episode_wl['name']; ?></div>
                                        <div class="overepisode has-text-weight-semibold is-size-7">EP<?php echo $episode_wl['number']; ?></div>
                                    </h3>
                                    <?php /*<div class="recentupd">Hace 4 horas</div>*/ ?>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
                
            </div>
            <?php echo $per_page_html_wl; ?>
        </section>
        <section id="watch-later-serie-container" class="col-12 col-sm-12 col-md-9 col-lg-9" style="padding-top:30px;display:none;">
            <h4 class="has-text-orange">Series pendientes por ver de <?php echo $session['name'];?></h4>
            <div class="list-series" id="capitulos-grid">
                <?php foreach ($user['watch-later-serie'] as $serie_wl) { ?>
                    <article class="serie-card">
                        <div class="serie-card__information">
                            <p><?php echo strip_tags($serie_wl['synopsis']); ?></p>
                        </div>
                        <figure class="image">
                            <a href="<?php echo $config['urlpath'].'/'.$serie_wl['url']; ?>" title="<?php echo htmlspecialchars($serie_wl['name']); ?>">
                                <img src="<?php echo getSerieCover($serie_wl['image_cover']); ?>" alt="<?php echo htmlspecialchars($serie_wl['name']); ?>">
                                <span class="overlay-dark"></span>
                            </a>
                            <span class="tag year is-dark"><?php echo date('Y', strtotime($serie_wl['release_date'])); ?></span>
                            <?php if ($serie_wl['status_id'] == 1){ ?><span class="tag is-orange airing">Emisión</span><?php } ?>
                            <span class="tag type"><?php echo getSerieCategory($serie_wl['category_id']); ?></span>
                        </figure>
                        <div class="title">
                            <h3><a class="has-text-orange has-text-weight-semibold has-text-centered is-size-6" href="<?php echo $config['urlpath'].'/'.$serie_wl['url']; ?>" title="<?php echo htmlspecialchars($serie_wl['name']); ?>"><?php echo $serie_wl['name']; ?></a></h3>
                        </div>
                    </article>
                <?php } ?>
                
            </div>
            <?php echo $per_page_html_wl_serie; ?>
        </section>
    </div>
</div>


<?php require_once(getThemeFile('footer')); ?>
<script type="text/javascript" src="<?php echo getThemeUrl(); ?>/abuscador/jquery-1.js"></script>
<script type="text/javascript" src="<?php echo getThemeUrl(); ?>/abuscador/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo getThemeUrl(); ?>/abuscador/bootstrap-multiselect.js?v<?php echo time(); ?>"></script>
<script>
$("#favorite").click(function(){
    $("#favorite").addClass("active");
    $("#favorite-container").show();

    $("#last-view-container").hide();
    $("#last-view").removeClass("active");

    $("#watch-later").removeClass("active");
    $("#watch-later-container").hide();

    $("#watch-later-serie").removeClass("active");
    $("#watch-later-serie-container").hide();
})
$("#last-view").click(function(){
    $("#favorite-container").hide();
    $("#favorite").removeClass("active");

    $("#last-view").addClass("active");
    $("#last-view-container").show();

    $("#watch-later").removeClass("active");
    $("#watch-later-container").hide();

    $("#watch-later-serie").removeClass("active");
    $("#watch-later-serie-container").hide();
})
$("#watch-later").click(function(){
    $("#favorite-container").hide();
    $("#favorite").removeClass("active");

    $("#last-view-container").hide();
    $("#last-view").removeClass("active");
    
    $("#watch-later").addClass("active");
    $("#watch-later-container").show();

    $("#watch-later-serie").removeClass("active");
    $("#watch-later-serie-container").hide();
})
$("#watch-later-serie").click(function(){
    $("#favorite-container").hide();
    $("#favorite").removeClass("active");

    $("#last-view-container").hide();
    $("#last-view").removeClass("active");
    
    $("#watch-later").removeClass("active");
    $("#watch-later-container").hide();

    $("#watch-later-serie").addClass("active");
    $("#watch-later-serie-container").show();
})
</script>
<script type="text/javascript">
    $(document).ready(function(e) {
        $("#uploadimage").on('submit', (function(e) {
            e.preventDefault();
            $("#message").empty();
            $('#loading').show();
            $.ajax({
                url: "<?php echo $config['adminpath']; ?>/api/upload_img.php", // Url to which the request is send
                type: "POST", // Type of request to be send, called as method
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function(data) // A function to be called if request succeeds
                    {
                        $('#loading').hide();
                        $("#message").html(data);
                        $("#sendbtn").attr("disabled", true)
                        $("#file").val(null)
                    }
            });
        }));

        // Function to preview image after validation
        $(function() {
            $("#file").change(function() {
                $("#message").empty(); // To remove the previous error message
                var file = this.files[0];
                var imagefile = file.type;
                var match = ["image/jpeg", "image/png", "image/jpg"];
                if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                    $('#previewing').attr('src', 'noimage.png');
                    $("#message").html("<p id='error'>Please Select A valid Image File</p>" + "<h4>Note</h4>" + "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                    return false;
                } else {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                    $("#sendbtn").removeProp("disabled")
                }
            });
        });

        function imageIsLoaded(e) {
            $("#file").css("color", "green");
            $('#image_preview').css("display", "block");
            $('#userimg').attr('src', e.target.result);
        };
    });
</script>
</body>

</html>