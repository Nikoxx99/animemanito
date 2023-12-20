<?php
require_once('../app/config.php');
require_once('../app/session.php');
require_once('../app/functions.php');
require_once('../app/dbconnection.php');
require_once('app/validate_authorization.php');
require_once('app/functions.php');

function getLastNDays($days, $format = 'd/m'){
    $m = date("m"); $de= date("d"); $y= date("Y");
    $dateArray = array();
    for($i=0; $i<=$days-1; $i++){
        $dateArray[] = date($format, mktime(0,0,0,$m,($de-$i),$y)); 
    }
    return array_reverse($dateArray);
}

$data = array();
$data['current_menu'] = 'dashboard';
$data['current_submenu'] = 'dashboard';

$data['serie_count'] = DB::queryFirstField('SELECT COUNT(*) FROM serie');

$data['serie_episodes_count'] = DB::queryFirstField('SELECT COUNT(*) FROM serie_episode');

$data['serie_airing_count'] = DB::queryFirstField('SELECT COUNT(*) FROM serie WHERE status_id = %i', 1);

$data['user_count'] = DB::queryFirstField('SELECT COUNT(*) FROM user');

$data['categories'] = DB::query('SELECT * FROM category ORDER BY name ASC');

foreach ($data['categories'] as $key => $category) {
    $data['categories'][$key]['count'] = DB::queryFirstField('SELECT COUNT(*) FROM serie WHERE category_id = %i', $category['id']);
}

$data['last_ten_days'] = array();
$last_ten_days = getLastNDays(10, 'Y-m-d');
foreach ($last_ten_days as $key => $value) {
    $data['last_ten_days'][] = array(
        'y' => $value,
        'item1' => 0
    );
}

startZone(); ?>
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo $config['adminpath']; ?>/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Morris charts -->
    <link rel="stylesheet" href="<?php echo $config['adminpath']; ?>/assets/plugins/morris/morris.css">
<?php
$header_css = endZone();

require_once('_header.php');
?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                  Dashboard
                  <small>Version 1.0</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $config['adminpath']; ?>/"><i class="fa fa-dashboard"></i> Inicio</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-desktop"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Serie</span>
                                <span class="info-box-number"><?php echo $data['serie_count'];  ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="fa fa-bars"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Episodio</span>
                                <span class="info-box-number"><?php echo $data['serie_episodes_count'];  ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-video-camera"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Estrenos</span>
                                <span class="info-box-number"><?php echo $data['serie_airing_count'];  ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Usuarios</span>
                                <span class="info-box-number"><?php echo $data['user_count'];  ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Bienvenido a tu panel de administración</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="box-body chart-responsive">
                                            <div class="chart" id="line-chart" style="height: 300px;"></div>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-4">
                                        <p class="text-center">
                                            <strong>Información</strong>
                                        </p>
<?php foreach ($data['categories'] as $category) { ?>
                                        <div class="progress-group">
                                            <span class="progress-text"><?php echo $category['name']; ?></span>
                                            <span class="progress-number"><b><?php echo $category['count']; ?></b></span>

                                            <div class="progress sm">
                                                <div class="progress-bar progress-bar-<?php echo $category['color']; ?>" style="width: 80%"></div>
                                            </div>
                                        </div>
                                        <!-- /.progress-group -->
<?php } ?>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- ./box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </section>
            <!-- /.content -->
        </div>

<?php startZone(); ?>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo $config['adminpath']; ?>/assets/plugins/morris/morris.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo $config['adminpath']; ?>/assets/plugins/fastclick/fastclick.js"></script>


    <!-- Sparkline -->
    <script src="<?php echo $config['adminpath']; ?>/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo $config['adminpath']; ?>/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo $config['adminpath']; ?>/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo $config['adminpath']; ?>/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script type="text/javascript">
        $(function() {
            "use strict";
            // LINE CHART
            var line = new Morris.Line({
                element: 'line-chart',
                resize: true,
                data: <?php echo json_encode($data['last_ten_days']); ?>,
                xkey: 'y',
                ykeys: ['item1'],
                labels: ['Visitas'],
                lineColors: ['#3c8dbc'],
                hideHover: 'auto'
            });
        });
    </script>
<?php
$footer_js = endZone();

require_once('_footer.php');
