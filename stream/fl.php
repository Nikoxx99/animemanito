<?php

$share_id = urldecode($_GET['v']);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Player</title>
    <link rel="stylesheet" type="text/css" href="//bowercdn.net/c/html5-boilerplate-4.3.0/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="//bowercdn.net/c/html5-boilerplate-4.3.0/css/main.css">
    <script src="//bowercdn.net/c/jquery-1.11.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jwplayer.com/libraries/UJzAF0Tq.js"></script>
    <meta name="robots" content="noindex">
    <meta name="referrer" content="never">
</head>

<body>
    <div id="embed"></div>
    <script type="text/javascript">
        jwplayer.key = 'kJJQbHwm99r3c3xUshxW9wy3auhnOd9yesIDqA==';
        var player = jwplayer('embed');
        player.setup({
            sources: [{"file":"<?php echo $share_id; ?>","type":"video\/mp4","label":"HD"}],
            primary: 'html5',
            allowfullscreen: true,
            width: $(window).width(),
            height: $(window).height(),
            skin: {
                name: 'stormtrooper'
            }
        })

        $(document).ready(function() {
            $(window).resize(function() {
                jwplayer().resize($(window).width(), $(window).height());
            });
        })
    </script>
    <!--Developed by frans185-->
</body>

</html>