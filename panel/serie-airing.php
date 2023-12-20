<?php
require_once('../app/config.php');
require_once('../app/session.php');
require_once('../app/functions.php');
require_once('../app/dbconnection.php');
require_once('app/validate_authorization.php');

$data = array();
$data['current_menu'] = 'serie';
$data['current_submenu'] = 'airing';

$data['categories'] = array();
$data['statuses'] = array();

$status_airing_id = 1;



startZone(); ?>
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $config['adminpath']; ?>/assets/plugins/datatables/dataTables.bootstrap.css">
<?php
$header_css = endZone();

require_once('_header.php');
?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Series por emisión
        <small>Version 1.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $config['adminpath']; ?>/"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Series por emisión</li>
      </ol>
    </section>

    <!-- Paginador -->
    <?php
            define("ROW_PER_PAGE", 30);
            $search_keyword = '';
            if (!empty($_GET['search']['keyword'])) {
                $search_keyword = $_GET['search']['keyword'];
            }
            $count = DB::queryFirstField('SELECT COUNT(*) FROM serie WHERE status_id=%s0 AND name LIKE %s1',$status_airing_id,'%'.$search_keyword.'%');//Seleccionamos todos los users en la base de datos y los contamos.
            
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

          $result = DB::query('SELECT id,name,category_id,status_id FROM serie WHERE status_id=%s0 AND name LIKE %s1 ORDER BY id LIMIT %i2,%i3',$status_airing_id,'%'.$search_keyword.'%',$start,ROW_PER_PAGE);//Seleccionamos todos los users de la base de datos para empezar a mostrarlos
          foreach ($result as $key => $value) {
            $result[$key]['category'] = getSerieCategory($result[$key]['category_id']);
            $result[$key]['status'] = getSerieStatus($result[$key]['status_id']);
          }
            ?>
            <!-- Fin del php del Paginador -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- Este es el buscador -->
          <form name='frmSearch' action='' method='get'>
                        <div><input type='text' placeholder="Buscar Serie en Emisión" name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='25'></div>
                    </form>
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Categoria</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($result as $anime) { ?>
                <tr>
                  <td><?php echo $anime['name']; ?></td>
                  <td><?php echo $anime['category']; ?></td>
                  <td><?php echo $anime['status']; ?></td>
                  <td>
                      <center>
                        <a class="btn btn-warning btn-xs" href="<?php echo $config['adminpath']; ?>/serie/<?php echo $anime['id']; ?>/episode/create" title="Agregar Capitulo" alt="Agregar Capitulo"><i class=" fa fa-plus-square "></i></a>
                        <a class="btn btn-success btn-xs" href="<?php echo $config['adminpath']; ?>/serie/<?php echo $anime['id']; ?>/episodes" title="Listado de Episodios" alt="Listado de Episodios"><i class=" fa fa-youtube-play "></i></a>
                        <a class="btn btn-primary btn-xs" href="<?php echo $config['adminpath']; ?>/serie/<?php echo $anime['id']; ?>/edit" title="Editar Serie" alt="Editar Serie"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger btn-xs" onClick="borrar(<?php echo $anime['id']; ?>,'serie')"><i class="fa fa-times"></i></a>
                      </center>
                  </td>
                </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Nombre</th>
                  <th>Categoria</th>
                  <th>Estado</th>
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
<script>
  // $(function () {
  //   $("#example1").DataTable({
  //       "language": {
  //           "url": "<?php echo $config['adminpath']; ?>/assets/plugins/datatables/Spanish.json"
  //       }
  //   });
  // });
  function borrar(id,texto){
    $.ajax({
      type: 'POST',
      url: '<?php echo $config['adminpath']; ?>/api/c.borrar.php',
      data: 'type=' + texto + '&id=' + id,
        success: function(htmlres) {
          var r = confirm("Esta seguro que desea eliminar el anime "+htmlres);
          if (r == true) {
            location.href="<?php echo $config['adminpath']; ?>/serie/"+id+"/delete";
          } 
        }
      }); 
    
  }
</script>
<?php
$footer_js = endZone();

require_once('_footer.php');
