<?php
require_once('../app/config.php');
require_once('../app/session.php');
require_once('../app/functions.php');
require_once('../app/dbconnection.php');
require_once('app/validate_authorization.php');

$data = array();
$data['current_menu'] = 'player';
$data['current_submenu'] = 'list';

$data['players'] = DB::query('SELECT * FROM player ORDER BY name ASC');

startZone(); ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo $config['adminpath']; ?>/assets/plugins/datatables/dataTables.bootstrap.css">
<?php
$header_css = endZone();

require_once('_header.php');
?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                Listado de Reproductores
                <small>Version 1.0</small>
              </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $config['adminpath']; ?>/"><i class="fa fa-dashboard"></i> Inicio</a></li>
                    <li>Reproductor</li>
                    <li class="active">Listado</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">

                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table class="table table-striped table-bordered table-hover" id="example1">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Url</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data['players'] as $player) { ?>
                                        <tr class="gradeA">
                                            <td class="sorting_1"><?php echo $player['id']; ?></td>
                                            <td class=" "><?php echo $player['name']; ?></td>
                                            <td class=" "><?php if ($player['type'] == 'html') { echo 'HTML'; } else { echo $player['url']; } ?></td>
                                            <td class="center">
                                                <center>
                                                    <a class="btn btn-primary btn-xs" href="<?php echo $config['adminpath']; ?>/player/<?php echo $player['id']; ?>/edit"><i class="fa fa-edit "></i> Editar</a>
                                                    <a class="btn btn-danger btn-xs" onclick="borrar(<?php echo $player['id']; ?>,'player')"><i class="fa fa-pencil"></i> Borrar</a>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
<?php startZone(); ?>
<!-- DataTables -->
<script src="<?php echo $config['adminpath']; ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $config['adminpath']; ?>/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
        "language": {
            "url": "<?php echo $config['adminpath']; ?>/assets/plugins/datatables/Spanish.json"
        }
    });
  });
  function borrar(player_id,type){
    var r = confirm("Esta seguro que desea eliminar este reproductor?"); 
    if (r == true) {
        $.post('<?php echo $config['adminpath']; ?>/api/c.borrar.php',{
            type: type,
            id: player_id,
            })
            .done (function(htmlres) {
                if(htmlres == 1){
                    alert("Se borro correctamente el reproductor.");
                }else{
                    alert("Error, intenta nuevamente o reportale esto al programador.");
                }
                
            })                
    }
    
  }
</script>
<?php
$footer_js = endZone();

require_once('_footer.php');
