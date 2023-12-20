<?php
require_once('../app/config.php');
require_once('../app/session.php');
require_once('../app/functions.php');
require_once('../app/dbconnection.php');
require_once('app/validate_authorization.php');

function getUserRole($code)
{
  global $data;
    if (isset($data['roles'][$code]))
    {
      return $data['roles'][$code];
    }
    else
    {
      $data['roles'][$code] = DB::queryFirstField('SELECT name FROM role WHERE code = %s LIMIT 1', $code);
      return $data['roles'][$code];
    }
}

$data = array();
$data['current_menu'] = 'user';
$data['current_submenu'] = 'list';

$data['roles'] = array();



startZone(); ?>
    <!-- DataTables -->
    <!-- <link rel="stylesheet" href="<?php /*echo $config['adminpath'];*/ ?>/assets/plugins/datatables/dataTables.bootstrap.css"> -->
<?php
$header_css = endZone();

require_once('_header.php');
?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                Listado de Usuarios
                <small>Version 1.0</small>
              </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $config['adminpath']; ?>/"><i class="fa fa-dashboard"></i> Inicio</a></li>
                    <li class="active">Listado de Usuarios</li>
                </ol>
            </section>
            <!-- Paginador -->
            <?php
            define("ROW_PER_PAGE", 100);
            $search_keyword = '';
            if (!empty($_GET['search']['keyword'])) {
                $search_keyword = $_GET['search']['keyword'];
            }
            $count = DB::queryFirstField('SELECT COUNT(*) FROM user WHERE name LIKE %s','%'.$search_keyword.'%');//Seleccionamos todos los users en la base de datos y los contamos.
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

          $result = DB::query('SELECT id,username,name,email,role,avatar FROM user WHERE name like %s0 OR email LIKE %s0 ORDER BY id LIMIT %i1,%i2','%'.$search_keyword.'%',$start,ROW_PER_PAGE);//Seleccionamos todos los users de la base de datos para empezar a mostrarlos
            ?>
            <!-- Fin del php del Paginador -->
            
            
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                    <!-- Este es el buscador -->
                    <form name='frmSearch' action='' method='get'>
                        <div><input type='text' placeholder="Buscar usuario" name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='25'></div>
                    </form>
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table class="table table-striped table-bordered table-hover" id="example1">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Usuario</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Rol</th>
                                            <th>Avatar</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result as $user) { ?>
                                        <tr class="gradeA">
                                            <td class="sorting_1"><?php echo $user['id']; ?></td>
                                            <td class=" "><?php echo $user['username']; ?></td>
                                            <td class=" "><?php echo $user['email']; ?></td>
                                            <td class=" "><?php echo $user['name']; ?></td>
                                            <td class="center"><?php echo $user['role']; ?></td>
                                            <td class="center">
                                                <center><img src="<?php echo getUserAvatar($user['avatar']); ?>" width="20" height="20"></center>
                                            </td> 
                                            <td class="center">
                                                <center>
                                                    <a class="btn btn-default btn-xs" href="<?php echo $config['adminpath']; ?>/user/<?php echo $user['id']; ?>/change-password"><i class=" fa fa-refresh "></i> Cambiar Clave</a>
                                                    <a class="btn btn-primary btn-xs" href="<?php echo $config['adminpath']; ?>/user/<?php echo $user['id']; ?>/edit"><i class="fa fa-edit "></i> Editar</a>
                                                    <a class="btn btn-danger btn-xs" onclick="borrar(<?php echo $user['id']; ?>,'user')"><i class="fa fa-pencil"></i> Borrar</a>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <?php echo $per_page_html; ?>
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
  // $(function () {
  //   $("#example1").DataTable({
  //       "language": {
  //           "url": "<?php echo $config['adminpath']; ?>/assets/plugins/datatables/Spanish.json"
  //       }
  //   });
  // });
  function borrar(user_id,type){
    var r = confirm("Esta seguro que desea eliminar este usuario?"); 
    if (r == true) {
        $.post('<?php echo $config['adminpath']; ?>/api/c.borrar.php',{
            type: type,
            id: user_id,
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
