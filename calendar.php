<?php
require_once('app/dbconnection.php');
require_once('app/config.php');
require_once('app/functions.php');
$airing = DB::query("SELECT id, name, url, image_cover, release_date, status_id FROM `serie` WHERE release_season = 1 AND YEAR(release_date) = 2024 ORDER BY release_date ASC;");
$airinggrouped = array();
foreach ($airing as $item) {
  $month = date('F', strtotime($item['release_date']));
  $day = date('d', strtotime($item['release_date']));
  $airinggrouped[$month . ' ' . $day][] = $item;
}

$winter = DB::query("SELECT id, name, url, image_cover, release_date, status_id FROM `serie` WHERE release_season = 1 AND status_id = 3 ORDER BY release_date ASC;");
$wintergrouped = array();
foreach ($winter as $item) {
  $month = date('F', strtotime($item['release_date']));
  $day = date('d', strtotime($item['release_date']));
  $wintergrouped[$month . ' ' . $day][] = $item;
}
$spring = DB::query("SELECT id, name, url, image_cover, release_date, status_id FROM `serie` WHERE release_season = 2 AND status_id = 3 ORDER BY release_date ASC;");
$springgrouped = array();
foreach ($spring as $item) {
  $month = date('F', strtotime($item['release_date']));
  $day = date('d', strtotime($item['release_date']));
  $springgrouped[$month . ' ' . $day][] = $item;
}
$summer = DB::query("SELECT id, name, url, image_cover, release_date, status_id FROM `serie` WHERE release_season = 3 AND status_id = 3 ORDER BY release_date ASC;");
$summergrouped = array();
foreach ($summer as $item) {
  $month = date('F', strtotime($item['release_date']));
  $day = date('d', strtotime($item['release_date']));
  $summergrouped[$month . ' ' . $day][] = $item;
}
$fall = DB::query("SELECT id, name, url, image_cover, release_date, status_id FROM `serie` WHERE release_season = 4 AND status_id = 3 ORDER BY release_date ASC;");
$fallgrouped = array();
foreach ($fall as $item) {
  $month = date('F', strtotime($item['release_date']));
  $day = date('d', strtotime($item['release_date']));
  $fallgrouped[$month . ' ' . $day][] = $item;
}
$soon = DB::query("SELECT id, name, url, image_cover, release_date, status_id, release_season FROM `serie` WHERE release_date is null AND status_id = 3 AND release_season = 0 ORDER BY release_date ASC;");
$soongrouped = array();
foreach ($soon as $item) {
  $month = date('F', strtotime($item['release_date']));
  $day = date('d', strtotime($item['release_date']));
  $soongrouped[$month . ' ' . $day][] = $item;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <title>Calendário</title>
</head>
<body>
  <div style="display:flex;justify-content:center;">
    <a class="navbar-item" href="<?php echo $config['urlpath']; ?>/">
      <img src="<?php echo getThemeUrl(); ?>/images/am.png" width="212" height="98" class="logo">
    </a>
  </div>
  <h1><span style="color:white;">Temporada de Invierno</span> 2024</h1>
  <div class="row">
    <?php if (empty($airinggrouped)) { ?>
      <span><?php print('No hay animes en esta temporada aún...'); ?></span>
    <?php } ?>
    <?php foreach ($airinggrouped as $date => $list) {?>
      <div class="children">
        <div class="img-container">
          <p><?php print($date); ?></p>
          <img src="<?php print_r(getSerieCover($list[0]['image_cover']));?>" class="card-img-top img-calendar" alt="<?php echo $val['name']; ?>">
        </div>
        <ul>
          <?php foreach ($list as $anime) { if(is_array($anime)) {?>
            <li class="title"><a href="<?php echo $config['urlpath'] . '/' . $anime['url'];?>"><?php print_r($anime['name']);?></a></li>
          <?php }} ?>
        </ul>
      </div>
    <?php } ?>
  </div> 
  <!-- <h1><span style="color:white;">Temporada de Invierno</span> 2024</h1>
  <div class="row">
    <?php
    $animeSinFechaWinter = array(); // Array para almacenar anime sin fecha de estreno

    if (empty($wintergrouped)) { ?>
      <span><?php print('No hay animes en esta temporada aún...'); ?></span>
    <?php } ?>
    <?php foreach ($wintergrouped as $date => $list) { ?>
      <?php if (empty($list)) continue; ?>
      <?php if (isset($list[0]['release_date'])) { ?>
        <div class="children">
          <div class="img-container">
            <p><?php print($date); ?></p>
            <img src="<?php print_r(getSerieCover($list[0]['image_cover'])); ?>"
              class="card-img-top img-calendar" alt="<?php echo $val['name']; ?>">
          </div>
          <ul>
            <?php foreach ($list as $anime) {
              if (is_array($anime)) { ?>
                <li class="title"><a
                    href="<?php echo $config['urlpath'] . '/' . $anime['url']; ?>"><?php print_r($anime['name']); ?></a></li>
            <?php } } ?>
          </ul>
        </div>
      <?php } else { ?>
        <?php
        // Agregar elementos sin fecha de estreno al array
        $animeSinFechaWinter = array_merge($animeSinFechaWinter, $list);
        continue; // Saltar la visualización de elementos sin fecha
        ?>
      <?php } ?>
    <?php } ?>
    <?php
    // Dividir los elementos sin fecha de estreno en grupos de 10
    $animeSinFechaChunksWinter = array_chunk($animeSinFechaWinter, 10);

    // Mostrar los grupos de elementos sin fecha de estreno al final
    foreach ($animeSinFechaChunksWinter as $chunkIndex => $chunk) { ?>
      <div class="children">
        <div class="img-container">
          <p>Sin fecha de estreno</p>
          <?php
          // Utilizar el índice del chunk para obtener la imagen correspondiente
          $imageIndex = $chunkIndex % count($chunk);
          ?>
          <img src="<?php print_r(getSerieCover($chunk[$imageIndex]['image_cover'])); ?>"
            class="card-img-top img-calendar" alt="<?php echo $val['name']; ?>">
        </div>
        <ul>
          <?php foreach ($chunk as $anime) { ?>
            <li class="title">
              <a href="<?php echo $config['urlpath'] . '/' . $anime['url']; ?>"><?php print_r($anime['name']); ?></a>
            </li>
          <?php } ?>
        </ul>
      </div>
    <?php } ?>
  </div> -->
  <h1><span style="color:white;">Temporada de Primavera</span> 2024</h1>
  <div class="row">
    <?php
    $animeSinFechaSpring = array(); // Array para almacenar anime sin fecha de estreno

    if (empty($springgrouped)) { ?>
      <span><?php print('No hay animes en esta temporada aún...'); ?></span>
    <?php } ?>
    <?php foreach ($springgrouped as $date => $list) { ?>
      <?php if (empty($list)) continue; ?>
      <?php if (isset($list[0]['release_date'])) { ?>
        <div class="children">
          <div class="img-container">
            <p><?php print($date); ?></p>
            <img src="<?php print_r(getSerieCover($list[0]['image_cover'])); ?>"
              class="card-img-top img-calendar" alt="<?php echo $val['name']; ?>">
          </div>
          <ul>
            <?php foreach ($list as $anime) {
              if (is_array($anime)) { ?>
                <li class="title"><a
                    href="<?php echo $config['urlpath'] . '/' . $anime['url']; ?>"><?php print_r($anime['name']); ?></a></li>
            <?php } } ?>
          </ul>
        </div>
      <?php } else { ?>
        <?php
        // Agregar elementos sin fecha de estreno al array
        $animeSinFechaSpring = array_merge($animeSinFechaSpring, $list);
        continue; // Saltar la visualización de elementos sin fecha
        ?>
      <?php } ?>
    <?php } ?>
    <?php
    // Dividir los elementos sin fecha de estreno en grupos de 10
    $animeSinFechaChunksSpring = array_chunk($animeSinFechaSpring, 10);

    // Mostrar los grupos de elementos sin fecha de estreno al final
    foreach ($animeSinFechaChunksSpring as $chunkIndex => $chunk) { ?>
      <div class="children">
        <div class="img-container">
          <p>Sin fecha de estreno</p>
          <?php
          // Utilizar el índice del chunk para obtener la imagen correspondiente
          $imageIndex = $chunkIndex % count($chunk);
          ?>
          <img src="<?php print_r(getSerieCover($chunk[$imageIndex]['image_cover'])); ?>"
            class="card-img-top img-calendar" alt="<?php echo $val['name']; ?>">
        </div>
        <ul>
          <?php foreach ($chunk as $anime) { ?>
            <li class="title">
              <a href="<?php echo $config['urlpath'] . '/' . $anime['url']; ?>"><?php print_r($anime['name']); ?></a>
            </li>
          <?php } ?>
        </ul>
      </div>
    <?php } ?>
  </div>
  <h1><span style="color:white;">Temporada de Verano</span> 2024</h1>
  <div class="row">
    <?php
    $animeSinFechaSummer = array(); // Array para almacenar anime sin fecha de estreno

    if (empty($summergrouped)) { ?>
      <span><?php print('No hay animes en esta temporada aún...'); ?></span>
    <?php } ?>
    <?php foreach ($summergrouped as $date => $list) { ?>
      <?php if (empty($list)) continue; ?>
      <?php if (isset($list[0]['release_date'])) { ?>
        <div class="children">
          <div class="img-container">
            <p><?php print($date); ?></p>
            <img src="<?php print_r(getSerieCover($list[0]['image_cover'])); ?>"
              class="card-img-top img-calendar" alt="<?php echo $val['name']; ?>">
          </div>
          <ul>
            <?php foreach ($list as $anime) {
              if (is_array($anime)) { ?>
                <li class="title"><a
                    href="<?php echo $config['urlpath'] . '/' . $anime['url']; ?>"><?php print_r($anime['name']); ?></a></li>
            <?php } } ?>
          </ul>
        </div>
      <?php } else { ?>
        <?php
        // Agregar elementos sin fecha de estreno al array
        $animeSinFechaSummer = array_merge($animeSinFechaSummer, $list);
        continue; // Saltar la visualización de elementos sin fecha
        ?>
      <?php } ?>
    <?php } ?>
    <?php
    // Dividir los elementos sin fecha de estreno en grupos de 10
    $animeSinFechaChunksSummer = array_chunk($animeSinFechaSummer, 10);

    // Mostrar los grupos de elementos sin fecha de estreno al final
    foreach ($animeSinFechaChunksSummer as $chunkIndex => $chunk) { ?>
      <div class="children">
        <div class="img-container">
          <p>Sin fecha de estreno</p>
          <?php
          // Utilizar el índice del chunk para obtener la imagen correspondiente
          $imageIndex = $chunkIndex % count($chunk);
          ?>
          <img src="<?php print_r(getSerieCover($chunk[$imageIndex]['image_cover'])); ?>"
            class="card-img-top img-calendar" alt="<?php echo $val['name']; ?>">
        </div>
        <ul>
          <?php foreach ($chunk as $anime) { ?>
            <li class="title">
              <a href="<?php echo $config['urlpath'] . '/' . $anime['url']; ?>"><?php print_r($anime['name']); ?></a>
            </li>
          <?php } ?>
        </ul>
      </div>
    <?php } ?>
  </div>
  <h1><span style="color:white;">Temporada de Otoño</span> 2024</h1>
  <div class="row">
    <?php
    $animeSinFechaFall = array(); // Array para almacenar anime sin fecha de estreno

    if (empty($fallgrouped)) { ?>
      <span><?php print('No hay animes en esta temporada aún...'); ?></span>
    <?php } ?>
    <?php foreach ($fallgrouped as $date => $list) { ?>
      <?php if (empty($list)) continue; ?>
      <?php if (isset($list[0]['release_date'])) { ?>
        <div class="children">
          <div class="img-container">
            <p><?php print($date); ?></p>
            <img src="<?php print_r(getSerieCover($list[0]['image_cover'])); ?>"
              class="card-img-top img-calendar" alt="<?php echo $val['name']; ?>">
          </div>
          <ul>
            <?php foreach ($list as $anime) {
              if (is_array($anime)) { ?>
                <li class="title"><a
                    href="<?php echo $config['urlpath'] . '/' . $anime['url']; ?>"><?php print_r($anime['name']); ?></a></li>
            <?php } } ?>
          </ul>
        </div>
      <?php } else { ?>
        <?php
        // Agregar elementos sin fecha de estreno al array
        $animeSinFechaFall = array_merge($animeSinFechaFall, $list);
        continue; // Saltar la visualización de elementos sin fecha
        ?>
      <?php } ?>
    <?php } ?>
    <?php
    // Dividir los elementos sin fecha de estreno en grupos de 10
    $animeSinFechaChunksFall = array_chunk($animeSinFechaFall, 10);

    // Mostrar los grupos de elementos sin fecha de estreno al final
    foreach ($animeSinFechaChunksFall as $chunkIndex => $chunk) { ?>
      <div class="children">
        <div class="img-container">
          <p>Sin fecha de estreno</p>
          <?php
          // Utilizar el índice del chunk para obtener la imagen correspondiente
          $imageIndex = $chunkIndex % count($chunk);
          ?>
          <img src="<?php print_r(getSerieCover($chunk[$imageIndex]['image_cover'])); ?>"
            class="card-img-top img-calendar" alt="<?php echo $val['name']; ?>">
        </div>
        <ul>
          <?php foreach ($chunk as $anime) { ?>
            <li class="title">
              <a href="<?php echo $config['urlpath'] . '/' . $anime['url']; ?>"><?php print_r($anime['name']); ?></a>
            </li>
          <?php } ?>
        </ul>
      </div>
    <?php } ?>
  </div>
  <h1><span style="color:white;">Próximamente</span></h1>
  <div class="row">
    <?php if (empty($soongrouped)) { ?>
      <span><?php print('No hay animes proximos aún...'); ?></span>
    <?php } ?>
    <?php foreach ($soongrouped as $date => $list) {?>
      <div class="children">
        <div class="img-container">
          <img src="<?php print_r(getSerieCover($list[0]['image_cover']));?>" class="card-img-top img-calendar" alt="<?php echo $val['name']; ?>">
        </div>
        <ul>
          <?php foreach ($list as $anime) { if(is_array($anime)) {?>
            <li class="title"><a href="<?php echo $config['urlpath'] . '/' . $anime['url'];?>"><?php print_r($anime['name']);?></a></li>
          <?php }} ?>
        </ul>
      </div>
    <?php } ?>
  </div> 

  <div id="commentsContainer" style="width:90%;margin: 20px auto;">
  </div>

  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <script>
    $("#commentsContainer").append('<div id="disqus_thread"></div>');
    (function() { // DON'T EDIT BELOW THIS LINE
        var d = document,
            s = d.createElement('script');
        s.src = 'https://animemanito.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
  </script>

  <script async src="https://www.googletagmanager.com/gtag/js?id=G-V3DHYJ369Q"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-V3DHYJ369Q');
    </script>
</body>
</html>

<style>
  @import url("https://fonts.googleapis.com/css?family=Oswald:700");
  * {
    box-sizing: border-box;
  }
  a {
    color: #fff;
    text-decoration: underline;
  }
  body {
    background-color: #111;
    color: #fff;
    font-family: Oswald, Roboto;
  }
  .row {
    width: 90%;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(8, 1fr);
    grid-gap: 10px;
    background-color: #181818;
    border-radius: 20px;
    padding:20px; 
    border-top: 3px solid #E2C205;
    border-bottom: 3px solid #E2C205;
    box-shadow: 0 0 10px 0 rgba(0,0,0,0.5);
  }
  @media (max-width: 1920px) {
    .row {
      grid-template-columns: repeat(8, 1fr);
    }
  }
  @media (max-width: 1919px) {
    .row {
      grid-template-columns: repeat(7, 1fr);
    }
  }
  @media (max-width: 1680px) {
    .row {
      grid-template-columns: repeat(6, 1fr);
    }
  }
  @media (max-width: 1448px) {
    .row {
      grid-template-columns: repeat(5, 1fr);
    }
  }
  @media (max-width: 1218px) {
    .row {
      grid-template-columns: repeat(4, 1fr);
    }
  }
  @media (max-width: 1011px) {
    .row {
      grid-template-columns: repeat(3, 1fr);
    }
  }
  @media (max-width: 766px) {
    .row {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  @media (max-width: 600px) {
    .row {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  .children {
    width: 100%;
    font-family: Roboto;
  }
  .img-container {
    position: relative;
    width: 100%;
    height: 200px;
    text-align: center;
  }
  .img-calendar {
    border-radius: 20px;
    aspect-ratio: 1/1;
    width: 100%;
    height: 200px;
    object-fit: cover;
  }
  .logo {
    margin-top:20px;
  }
  .img-container::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(0deg, rgba(0,0,0,1) 0%, rgba(0,0,0,0) 50%, rgba(0,0,0,0) 100%);
    border-radius: 20px;
  }
  p {
    color: #E2C205;
    position: absolute;
    margin:0;
    bottom: 5px;
    padding: 0 10px;
    font-size:1.2rem;
    font-weight: bold;
    text-align: center;
    z-index: 100;
  }
  ul {
    padding: 0 15px;
    margin: 0;
    display: block;
    width: 100%;
    list-style: none;
  }
  @media (max-width: 500px) {
    .row {
      grid-template-columns: repeat(2, 1fr);
    }
    .children {
      width: 100%;
    }
    .img-container {
      width: 100%;
      height: 200px;
    }
    .img-calendar {
      width: 100%;
      height: 200px;
    }
    ul {
      width: 100%;
    }
  }
  ul li::before {
  content: "\2022"; 
  display: inline-block;
  font-size:1.2rem;
  font-weight: bold;
  color: #E2C205;
  margin-left: -1em;
  width: 1em;
}
  li {
    padding: 0;
    margin: 2px 0;
    font-size: 0.8rem;
  }
  h1 {
    color: #E2C205;
    font-weight: bold;
    text-align: center;
    font-size: 4rem;
    margin: 5px 0;
  }
  h2 {
    color: #fff;
    font-weight: bold;
    text-align: center;
    margin: 5px 0;

  }
.button.is-orange {
    background-color: #E2C205;
    border-color: transparent;
    color: #fff;
}

.button.is-fullwidth {
    display: flex;
    justify-self: center;
    text-align: center;
    margin: 0 auto;
    width: 50%;
}
.button {
    background-color: #fff;
    border-color: #dbdbdb;
    border-width: 1px;
    color: #363636;
    cursor: pointer;
    justify-content: center;
    padding-bottom: calc(0.375em - 1px);
    padding-left: 0.75em;
    padding-right: 0.75em;
    padding-top: calc(0.375em - 1px);
    text-align: center;
    white-space: nowrap;
}
.button, .file-cta, .file-name, .input, .pagination-ellipsis, .pagination-link, .pagination-next, .pagination-previous, .select select, .textarea {
    -moz-appearance: none;
    -webkit-appearance: none;
    align-items: center;
    border: 1px solid transparent;
    border-radius: 4px;
    box-shadow: none;
    display: inline-flex;
    font-size: 1rem;
    height: 2.25em;
    line-height: 1.5;
    padding-bottom: calc(0.375em - 1px);
    padding-left: calc(0.625em - 1px);
    padding-right: calc(0.625em - 1px);
    padding-top: calc(0.375em - 1px);
    position: relative;
    vertical-align: top;
}
</style>