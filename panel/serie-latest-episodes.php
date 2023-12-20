<?php
require_once('../app/config.php');
require_once('../app/session.php');
require_once('../app/functions.php');
require_once('../app/dbconnection.php');
require_once('app/validate_authorization.php');

$data = array();
$data['current_menu'] = 'serie';
$data['current_submenu'] = 'latest-episodes';


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
                  Ultimos 100 capitulos
                  <small>Version 1.0</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $config['adminpath']; ?>/"><i class="fa fa-dashboard"></i> Inicio</a></li>
                    <li class="active">Ultimos Capitulos</li>
                </ol>
            </section>

            <!-- Paginador -->
    <?php
            define("ROW_PER_PAGE", 10);
            $search_keyword = '';
            if (!empty($_GET['search']['keyword'])) {
                $search_keyword = $_GET['search']['keyword'];
            }
            $count_query = DB::query('SELECT SQL_CALC_FOUND_ROWS serie_episode.id, serie_episode.number, serie.name, serie.id as anime_id FROM serie_episode JOIN serie ON serie_episode.serie_id=serie.id ORDER BY serie_episode.id DESC LIMIT 100');//Seleccionamos todos los ultimos caps en la base de datos y los contamos.
            $count = count($count_query);
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

          $result = DB::query('SELECT serie_episode.id, serie_episode.number, serie.name, serie.id AS anime_id FROM serie_episode JOIN serie ON serie_episode.serie_id=serie.id ORDER BY serie_episode.id DESC LIMIT %i0,%i1',$start,ROW_PER_PAGE);//Seleccionamos todos los users de la base de datos para empezar a mostrarlos
            ?>
            <!-- Fin del php del Paginador -->

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                    <form name='frmSearch' action='' method='get'>
                        <div><input type='text' placeholder="Buscar Serie en Emisión" name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='25'></div>
                    </form>
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Nro Episodio</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result as $episode) { ?>
                                        <tr>
                                            <td><?php echo $episode['id']; ?></td>
                                            <td><?php echo $episode['name']; ?></td>
                                            <td><?php echo $episode['number']; ?></td>
                                            <td>
                                                <center>
                                                    <a class="btn btn-success btn-xs" href="<?php echo $config['adminpath']; ?>/serie/<?php echo $episode['anime_id']; ?>/episodes" title="Listado de Episodios" alt="Listado de Episodios"><i class=" fa fa-youtube-play "></i></a>
                                                    <a class="btn btn-primary btn-xs" href="<?php echo $config['adminpath']; ?>/serie/<?php echo $episode['anime_id']; ?>/episode/<?php echo $episode['id']; ?>/edit" title="Editar Serie" alt="Editar Serie"><i class="fa fa-edit "></i></a>
                                                    <a class="btn btn-danger btn-xs" onClick="borrar(<?php echo $episode['id']; ?>,'episode',<?php echo $episode['anime_id']; ?>)"><i class="fa fa-times"></i></a>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nro Episodio</th>
                                            <th>Nombre</th>
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
        //         },
        //         "order": [[ 0, "desc" ]]
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
                            alert("Se borro correctamente el episodio. Felicidades weon.");
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
