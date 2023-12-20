<?php
function getHTML($url)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	//curl_setopt($ch, CURLOPT_REFERER, 'http://www.example.com/1');
	curl_setopt($ch, CURLOPT_ENCODING, 'none');
	$html = curl_exec($ch);
	return $html;
}

$share_id = $_GET['v'];

$ext = 'com';
if (isset($_GET['ext']))
{
    $exts = array(
        'es'
    );
    if (in_array($_GET['ext'], $exts))
    {
        $ext = $_GET['ext'];
    }
    else
    {
        die('404 EXT');
    }
}

$url = 'https://www.amazon.'.$ext.'/drive/v1/shares/'.$share_id.'?shareId='.$share_id.'&resourceVersion=V2&ContentType=JSON&_='.time().'&asset=ALL&tempLink=true';
$json = getHTML($url);
$json = json_decode($json, true);
if (isset($json['nodeInfo']))
{
	$url = 'https://www.amazon.'.$ext.'/drive/v1/nodes/'.$json['nodeInfo']['id'].'/children?tempLink=true&limit=1&searchOnFamily=false&shareId='.$json['shareId'].'&offset=0&resourceVersion=V2&ContentType=JSON&_='.time();
	$json = getHTML($url);
	$json = json_decode($json, true);
	//print_r($json);exit;
	if (isset($json['data'][0]))
	{
		$amazon_temp_link = $json['data'][0]['tempLink'];
	}
}

$source = array();
if (isset($amazon_temp_link))
{
	$source['file'] = $amazon_temp_link;
}
else
{
	$source['file'] = '';
}
$source['type'] = 'video/mp4';
$source['label'] = 'HD';
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
            sources: [<?php echo json_encode($source); ?>],
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