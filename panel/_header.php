<?php
$menus = array();
/*
$menus[] = array(
  'name' => 'dashboard',
  'title' => 'Dashboard',
  'icon' => 'fa-dashboard',
  'url' => '#',
  'submenus' => array(
      array(
        'name' => 'dashboard',
        'title' => 'Dashboard v1.0',
        'icon' => 'fa-circle-o',
        'url' => $config['adminpath'].'/'
      ),
  )
);
*/
$menus[] = array(
  'name' => 'dashboard',
  'title' => 'Dashboard',
  'icon' => 'fa-dashboard',
  'url' => $config['adminpath'].'/',
);

$menus[] = array(
  'name' => 'serie',
  'title' => 'Serie',
  'icon' => 'fa-laptop',
  'url' => '#',
  'submenus' => array(
      array(
        'name' => 'list',
        'title' => 'Listado',
        'icon' => 'fa-circle-o',
        'url' => $config['adminpath'].'/serie/list'
      ),
      array(
        'name' => 'create',
        'title' => 'Agregar',
        'icon' => 'fa-circle-o',
        'url' => $config['adminpath'].'/serie/create'
      ),
      array(
        'name' => 'airing',
        'title' => 'Estrenos',
        'icon' => 'fa-circle-o',
        'url' => $config['adminpath'].'/serie/airing'
      ),
      array(
        'name' => 'latest-episodes',
        'title' => 'Ult. Capitulos',
        'icon' => 'fa-circle-o',
        'url' => $config['adminpath'].'/serie/latest-episodes'
      ),
  )
);

$menus[] = array(
  'name' => 'user',
  'title' => 'Usuario',
  'icon' => 'fa-group',
  'url' => '#',
  'submenus' => array(
      array(
        'name' => 'list',
        'title' => 'Lista de usuarios',
        'icon' => 'fa-circle-o',
        'url' => $config['adminpath'].'/user/list'
      ),
  )
);

$menus[] = array(
  'name' => 'genre',
  'title' => 'Género',
  'icon' => 'fa-renren',
  'url' => '#',
  'submenus' => array(
      array(
        'name' => 'create',
        'title' => 'Agregar',
        'icon' => 'fa-circle-o',
        'url' => $config['adminpath'].'/genre/create'
      ),
      array(
        'name' => 'list',
        'title' => 'Listar',
        'icon' => 'fa-circle-o',
        'url' => $config['adminpath'].'/genre/list'
      ),
  )
);

$menus[] = array(
  'name' => 'player',
  'title' => 'Reproductor',
  'icon' => 'fa-youtube-play',
  'url' => '#',
  'submenus' => array(
      array(
        'name' => 'create',
        'title' => 'Agregar',
        'icon' => 'fa-circle-o',
        'url' => $config['adminpath'].'/player/create'
      ),
      array(
        'name' => 'list',
        'title' => 'Listar',
        'icon' => 'fa-circle-o',
        'url' => $config['adminpath'].'/player/list'
      ),
  )
);

/*$menus[] = array(
  'name' => 'tools',
  'title' => 'Herramientas',
  'icon' => 'fa-gears',
  'url' => '#',
  'submenus' => array(
      array(
        'name' => 'list',
        'title' => 'Agregar Reproductor',
        'icon' => 'fa-circle-o',
        'url' => $config['adminpath'].'/player/list'
      ),
      array(
        'name' => 'delete',
        'title' => 'Eliminar Reproductor',
        'icon' => 'fa-circle-o',
        'url' => $config['adminpath'].'/player/delete'
      ),
  )
);*/

$menus[] = array(
  'name' => 'setting',
  'title' => 'Ajustes',
  'icon' => 'fa-wrench',
  'url' => '#',
  'submenus' => array(
      array(
        'name' => 'common',
        'title' => 'General',
        'icon' => 'fa-circle-o',
        'url' => $config['adminpath'].'/setting/common'
      ),
      array(
        'name' => 'slider',
        'title' => 'Slider',
        'icon' => 'fa-circle-o',
        'url' => $config['adminpath'].'/setting/slider'
      ),
      array(
        'name' => 'ads',
        'title' => 'Anuncios',
        'icon' => 'fa-circle-o',
        'url' => $config['adminpath'].'/setting/ads'
      ),
  )
);

$menus[] = array(
  'name' => 'logout',
  'title' => 'Cerrar Sesión',
  'icon' => '',
  'url' => $config['urlpath'].'/user/logout'
);

//print_r($menu);exit;

?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Panel | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo $config['adminpath']; ?>/assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<?php if (isset($header_css_before)){ echo $header_css_before; } ?>
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $config['adminpath']; ?>/assets/dist/css/AdminLTE.min.css">
<?php if (isset($header_css)){ echo $header_css; } ?>
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo $config['adminpath']; ?>/assets/dist/css/skins/_all-skins.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $config['urlpath']; ?>/favicon.ico">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">

            <!-- Logo -->
            <a href="<?php echo $config['adminpath']; ?>/" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>P</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Panel</b></span>
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                      <li>
                        <a href="<?php echo $config['urlpath']?>">
                          <h4>
                            Visitar Sitio
                          </h4>
                        </a>
                      </li>
                        <!-- Messages: style can be found in dropdown.less-->
                        <!--
                        <li class="dropdown messages-menu">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">4</span>
                          </a>
                          <ul class="dropdown-menu">
                            <li class="header">You have 4 messages</li>
                            <li>
                              <ul class="menu">
                                <li>
                                  <a href="#">
                                    <div class="pull-left">
                                      <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                    </div>
                                    <h4>
                                      Support Team
                                      <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                    </h4>
                                    <p>Why not buy a new awesome theme?</p>
                                  </a>
                                </li>
                                <li>
                                  <a href="#">
                                    <div class="pull-left">
                                      <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                    </div>
                                    <h4>
                                      AdminLTE Design Team
                                      <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                    </h4>
                                    <p>Why not buy a new awesome theme?</p>
                                  </a>
                                </li>
                                <li>
                                  <a href="#">
                                    <div class="pull-left">
                                      <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                    </div>
                                    <h4>
                                      Developers
                                      <small><i class="fa fa-clock-o"></i> Today</small>
                                    </h4>
                                    <p>Why not buy a new awesome theme?</p>
                                  </a>
                                </li>
                                <li>
                                  <a href="#">
                                    <div class="pull-left">
                                      <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                    </div>
                                    <h4>
                                      Sales Department
                                      <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                    </h4>
                                    <p>Why not buy a new awesome theme?</p>
                                  </a>
                                </li>
                                <li>
                                  <a href="#">
                                    <div class="pull-left">
                                      <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                    </div>
                                    <h4>
                                      Reviewers
                                      <small><i class="fa fa-clock-o"></i> 2 days</small>
                                    </h4>
                                    <p>Why not buy a new awesome theme?</p>
                                  </a>
                                </li>
                              </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                          </ul>
                        </li>
                        <li class="dropdown notifications-menu">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">10</span>
                          </a>
                          <ul class="dropdown-menu">
                            <li class="header">You have 10 notifications</li>
                            <li>
                              <ul class="menu">
                                <li>
                                  <a href="#">
                                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                  </a>
                                </li>
                                <li>
                                  <a href="#">
                                    <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                    page and may cause design problems
                                  </a>
                                </li>
                                <li>
                                  <a href="#">
                                    <i class="fa fa-users text-red"></i> 5 new members joined
                                  </a>
                                </li>
                                <li>
                                  <a href="#">
                                    <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                  </a>
                                </li>
                                <li>
                                  <a href="#">
                                    <i class="fa fa-user text-red"></i> You changed your username
                                  </a>
                                </li>
                              </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                          </ul>
                        </li>
                        <li class="dropdown tasks-menu">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">9</span>
                          </a>
                          <ul class="dropdown-menu">
                            <li class="header">You have 9 tasks</li>
                            <li>
                              <ul class="menu">
                                <li>
                                  <a href="#">
                                    <h3>
                                      Design some buttons
                                      <small class="pull-right">20%</small>
                                    </h3>
                                    <div class="progress xs">
                                      <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                        <span class="sr-only">20% Complete</span>
                                      </div>
                                    </div>
                                  </a>
                                </li>
                                <li>
                                  <a href="#">
                                    <h3>
                                      Create a nice theme
                                      <small class="pull-right">40%</small>
                                    </h3>
                                    <div class="progress xs">
                                      <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                        <span class="sr-only">40% Complete</span>
                                      </div>
                                    </div>
                                  </a>
                                </li>
                                <li>
                                  <a href="#">
                                    <h3>
                                      Some task I need to do
                                      <small class="pull-right">60%</small>
                                    </h3>
                                    <div class="progress xs">
                                      <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                        <span class="sr-only">60% Complete</span>
                                      </div>
                                    </div>
                                  </a>
                                </li>
                                <li>
                                  <a href="#">
                                    <h3>
                                      Make beautiful transitions
                                      <small class="pull-right">80%</small>
                                    </h3>
                                    <div class="progress xs">
                                      <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                        <span class="sr-only">80% Complete</span>
                                      </div>
                                    </div>
                                  </a>
                                </li>
                              </ul>
                            </li>
                            <li class="footer">
                              <a href="#">View all tasks</a>
                            </li>
                          </ul>
                        </li>
                        -->
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo getUserAvatar($session['avatar']); ?>" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $session['name']; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo getUserAvatar($session['avatar']); ?>" class="img-circle" alt="User Image">

                                    <p>
                                        <?php echo $session['name']; ?> - <?php echo $session['username']; ?> <small><?php echo $session['email']; ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <!-- <li class="user-body">
                                  <div class="row">
                                    <div class="col-xs-4 text-center">
                                      <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                      <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                      <a href="#">Friends</a>
                                    </div>
                                  </div>
                                </li>-->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <!--<div class="pull-left">
                                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>-->
                                    <div class="pull-right">
                                        <a href="<?php echo $config['urlpath']; ?>/user/logout" class="btn btn-default btn-flat">Salir</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <!--<li>
                          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>-->
                    </ul>
                </div>

            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo getUserAvatar($session['avatar']); ?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $session['name']; ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a>
                    </div>
                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="header">NAVEGACIÓN PRINCIPAL</li>
                    <?php foreach ($menus as $menu) { ?>
                    <li class="<?php if(isset($data['current_menu']) && $data['current_menu'] == $menu['name']) { ?>active <?php } ?>treeview">
                        <a href="<?php echo $menu['url']; ?>">
                            <?php if (trim($menu['icon']) !== '') { ?><i class="fa <?php echo $menu['icon']; ?>"></i> <?php } ?><span><?php echo $menu['title']; ?></span><?php if (isset($menu['submenus']) && is_array($menu['submenus'])) { ?> <i class="fa fa-angle-left pull-right"></i><?php } ?>
                        </a>
                        <?php if (isset($menu['submenus']) && is_array($menu['submenus'])) { ?>
                        <ul class="treeview-menu">
                            <?php foreach ($menu['submenus'] as $submenu) { ?>
                            <li<?php if(isset($data['current_submenu']) && $data['current_submenu'] == $submenu['name']) { ?> class="active"<?php } ?>><a href="<?php echo $submenu['url']; ?>"><i class="fa fa-circle-o"></i> <?php echo $submenu['title']; ?></a></li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </li>
                    <?php } ?>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
