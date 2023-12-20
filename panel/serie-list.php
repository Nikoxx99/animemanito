<?php
require_once('../app/config.php');
require_once('../app/session.php');
require_once('../app/functions.php');
require_once('../app/dbconnection.php');
require_once('app/validate_authorization.php');

$data = array();
$data['current_menu'] = 'serie';
$data['current_submenu'] = 'list';

$data['categories'] = array();
$data['statuses'] = array();
$order = "asc";
$order_item = "name";
if(isset($_GET['order'])){
  $order_state = $_GET['order'];
  if($order_state == "desc"){
    $order = "desc";
    $order_item = "visits";
  }else{
    $order = "asc";
    $order_item = "visits";
  }
}
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
        Listado Serie
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $config['adminpath']; ?>/"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Listado Serie</li>
      </ol>
    </section>

    <!-- Paginador -->
    <?php
            define("ROW_PER_PAGE", 100);
            $search_keyword = '';
            if (!empty($_GET['search']['keyword'])) {
                $search_keyword = $_GET['search']['keyword'];
            }
            $count = DB::queryFirstField('SELECT COUNT(*) FROM serie WHERE name LIKE %s','%'.$search_keyword.'%');//Seleccionamos todos las series en la base de datos y los contamos.
            // foreach ($data['users'] as $key => $value) {
            //   $data['users'][$key]['role'] = getUserRole($data['users'][$key]['role']);//Asignamos el rol de cada uno
            // }
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
          $result = DB::query('SELECT id,name,category_id,status_id,visits FROM serie WHERE name like %s0 ORDER BY '.$order_item.' '.$order.' LIMIT %i3,%i4','%'.$search_keyword.'%',$order_item,$order,$start,ROW_PER_PAGE);//Seleccionamos todos los users de la base de datos para empezar a mostrarlos
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
                        <div><input type='text' placeholder="Buscar Serie" name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='25'></div>
                    </form>
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><a href="<?php echo $config['adminpath']."/serie/list";?>">Nombre</a></th>
                  <th>Categoria</th>
                  <th>Estado</th>
                  <th><a href="?order=<?php 
                    if(isset($_GET['order'])){
                      if($_GET['order'] == "asc"){
                        echo "desc";
                      }else{
                        echo "asc";
                      }
                    }else{
                      echo "desc";
                      }?>">
                      Visitas</a></th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
<?php foreach ($result as $serie_item) { ?>
                <tr>
                  <td><?php echo $serie_item['name']; ?></td>
                  <td><?php echo $serie_item['category']; ?></td>
                  <td><?php echo $serie_item['status']; ?></td>
                  <td><?php echo $serie_item['visits']; ?></td>
                  <td>
                      <center>
                        <a class="btn btn-warning btn-xs" href="<?php echo $config['adminpath']; ?>/serie/<?php echo $serie_item['id']; ?>/episode/create" title="Agregar Capitulo" alt="Agregar Capitulo"><i class=" fa fa-plus-square "></i></a>
                        <a class="btn btn-success btn-xs" href="<?php echo $config['adminpath']; ?>/serie/<?php echo $serie_item['id']; ?>/episodes"  title="Listado de Episodios" alt="Listado de Episodios"><i class=" fa fa-youtube-play "></i></a>
                        <a class="btn btn-primary btn-xs" href="<?php echo $config['adminpath']; ?>/serie/<?php echo $serie_item['id']; ?>/edit"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger btn-xs" onClick="borrar(<?php echo $serie_item['id']; ?>,'serie')"><i class="fa fa-times"></i></a>
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
  function borrar(serie_id,type){
    var r = confirm("Esta seguro que desea eliminar esta serie?"); 
    if (r == true) {
        $.post('<?php echo $config['adminpath']; ?>/api/c.borrar.php',{
            type: type,
            id: serie_id,
            })
            .done (function(htmlres) {
                if(htmlres == 1){
                    alert("Se borro correctamente la serie. Felicidades weon.");
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
