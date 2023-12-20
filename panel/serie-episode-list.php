<?php
require_once('../app/config.php');
require_once('../app/session.php');
require_once('../app/functions.php');
require_once('../app/dbconnection.php');
require_once('app/validate_authorization.php');

$data = array();
$data['current_menu'] = 'serie';
//$data['current_submenu'] = 'episode-list';

$data['serie'] = DB::queryFirstRow('SELECT * FROM serie WHERE id=%s', $_GET['serie_id']);

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
                  Listado de capitulos
                  <small>Version 1.0</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $config['adminpath']; ?>/"><i class="fa fa-dashboard"></i> Inicio</a></li>
                    <li class="active">Listado Serie</li>
                </ol>
            </section>

             <!-- Paginador -->
             <?php
            define("ROW_PER_PAGE", 10);
            $search_keyword = '';
            if (!empty($_GET['search']['keyword'])) {
                $search_keyword = $_GET['search']['keyword'];
            }
            $count = DB::queryFirstField('SELECT COUNT(*) FROM serie_episode WHERE serie_id=%s0 AND number LIKE %s1',$data['serie']['id'],'%'.$search_keyword.'%');//Seleccionamos todos los capitulos de la serie en la base de datos y los contamos.
            /* Pagination Code starts */
            $per_page_html = '';
            $page = 1;
            $start = 0;
            if (!empty($_GET["page"])) {
                $page = $_GET["page"];
                $start = ($page - 1) * ROW_PER_PAGE;
            }
            if (!empty($count)) {//Generamos los botones para cambiar de pagina
                $per_page_html .= "<div style='text-align:center;margin:20px 0px;'><form action='' method='get'>";
                $page_count = ceil($count / ROW_PER_PAGE);
                if ($page_count > 1) {
                    for ($i = 1; $i <= $page_count; $i++) {
                        if ($i == $page) {
                            $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
                        } else {
                            $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
                        }
                    }
                }
                $per_page_html .= "</form></div>";
            }

          $result = DB::query('SELECT * FROM serie_episode WHERE serie_id=%s0 AND number LIKE %s1 ORDER BY id LIMIT %i2,%i3',$data['serie']['id'],'%'.$search_keyword.'%',$start,ROW_PER_PAGE);//Seleccionamos todos los users de la base de datos para empezar a mostrarlos
            ?>
            <!-- Fin del php del Paginador -->

            <!-- Main content -->
            <section class="content">
                <div class="row">

                    <div class="col-md-6">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title"><?php echo $data['serie']['name']; ?></h3>
                            </div>
                            <div class="content">
                                <img id="img" src="<?php echo getSerieCover($data['serie']['image_cover']); ?>" class="user-image img-responsive" style="padding: 2px;border: 1px solid #999;border-radius: 2px;height: 215px;float:left;margin-right: 10px;" height="215px" width="150px">
                                <p><?php echo $data['serie']['synopsis']; ?></p>
                                <a class="btn btn-success btn-xs" href="<?php echo $config['adminpath']; ?>/serie/<?php echo $data['serie']['id']; ?>/episode/create" title="Agregar Capitulo" alt="Agregar Capitulo"><i class=" fa fa-plus-square "></i> Agregar Capitulo</a>
                                <a class="btn btn-primary btn-xs" href="<?php echo $config['adminpath']; ?>/serie/<?php echo $data['serie']['id']; ?>/edit"><i class="fa fa-edit "></i> Editar Serie</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Capitulos</h3>
                                <form name='frmSearch' action='' method='get'>
                                <div><input type='text' placeholder="Buscar numero del capitulo" name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='25'></div>
                            </form>
                            </div>
                            
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nro Episodio</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result as $episode) { ?>
                                        <tr>
                                            <td><?php echo $episode['number']; ?></td>
                                            <td>
                                                <center>
                                                    <a class="btn btn-primary btn-xs" href="<?php echo $config['adminpath']; ?>/serie/<?php echo $data['serie']['id']; ?>/episode/<?php echo $episode['id']; ?>/edit"><i class="fa fa-edit "></i></a>
                                                    <a class="btn btn-danger btn-xs" onClick="borrar(<?php echo $episode['id']; ?>,'episode')"><i class="fa fa-times"></i></a>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nro Episodio</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <?php echo $per_page_html; ?>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->

<?php startZone(); ?>
    <!-- DataTables -->
    <script src="<?php echo $config['adminpath']; ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo $config['adminpath']; ?>/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- page script -->
    <script>
        // $(function() {
        //     $("#example1").DataTable({
        //         "language": {
        //             "url": "<?php echo $config['adminpath']; ?>/assets/plugins/datatables/Spanish.json"
        //         }
        //     });
        // });

        function borrar(episode_id, type) {
            var r = confirm("Esta seguro que desea eliminar este episodio?");
            if (r == true) {
                $.post('<?php echo $config['adminpath']; ?>/api/c.borrar.php',{
                    type: type,
                    id: episode_id,
                    })
                    .done (function(htmlres) {
                        if(htmlres == 1){
                            alert("Se borro correctamente la wea. Felicidades weon.");
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
