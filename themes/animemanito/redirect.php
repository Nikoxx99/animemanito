<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Redirect</title>
  <style>
    body {
      overflow:hidden;
      background-color: #111;
      padding:0;
      margin:0;
    }
    #playContainer {
      height:98vh;
      display: grid;
      place-items: center;

    }
    img {
      width:100px;
      height:100px;
    }
    #play {
      transition: all 0.5s;
      opacity: 0.8;
    }
    #play:hover {
      opacity: 1;
      transform: scale(1.4);
      transition: all 0.5s;
    }
  </style>
</head>
<body>
  <div id="playContainer">
    <img id="play" src="play.png" alt="" style="z-index:100!important;cursor:pointer;">
    <div
      style="position:absolute;opacity:0.8;z-index:1;background:url('<?php echo $data['thumbnail'];?>');background-repeat:no-repeat;background-size:cover;width:100%;height:100%;left:0;top:0;"
    ></div>
  </div>
  <script>
    const play = document.getElementById('play')
    const playerContainer = document.getElementById('playContainer')
    play.addEventListener('click', () => {
      playerContainer.innerHTML = '<iframe width="100%" height="100%" src="<?php echo $data['episode']; ?>" frameborder="0" noresize scrolling="no" allowfullscreen></iframe>'
    })
  </script>
</body>
</html>