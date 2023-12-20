<?php
require_once('../app/config.php');
require_once('../app/session.php');
require_once('../app/functions.php');
require_once('../app/dbconnection.php');
require_once('app/validate_authorization.php');
require_once('app/functions.php');

$data = array();
$data['current_menu'] = 'genre';
//$data['current_submenu'] = 'edit';

$data['genre'] = DB::queryFirstRow('SELECT * FROM genre WHERE id = %s', $_GET['player_id']);
if ($data['genre'] == null)
{
    Redirect404To($config['adminpath'].'/genre/list');
}

if (isset($_POST['name']) && isset($_POST['url']))
{
    $errors = array();

    if (trim($_POST['name']) == '')
    {
        $errors[] = 'Nombre invalido';
    }

    if (trim($_POST['url']) == '')
    {
        $errors[] = 'Url invalida';
    }

    if (empty($errors))
    {
        $item_data = array();
        $item_data['name'] = fixToSaveText($_POST['name']);
        $item_data['url'] = fixToSaveText($_POST['url']);

        DB::update('genre', $item_data, 'id=%s', $data['genre']['id']);

        $success = 'Se actualizó correctamente el género!';

        // Refresh data to display
        $data['genre'] = DB::queryFirstRow('SELECT * FROM genre WHERE id = %s', $_GET['player_id']);
    }
}

require_once('_header.php');
?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                  Editar Reproductor
                  <small>Version 1.0</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $config['adminpath']; ?>/"><i class="fa fa-dashboard"></i> Inicio</a></li>
                    <li>Reproductor</li>
                    <li class="active">Editar</li>
                </ol>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-xs-12">

                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <form method="post" action="">
                                    <div class="col-md-6">

                                        <?php if(!empty($errors)){?>
                                        <div class="alert alert-danger">
                                            <ul>
                                                <?php foreach ($errors as $error) { ?>
                                                <li><?php echo $error; ?><br></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <?php } ?>

                                        <?php if(isset($success)){?>
                                        <div class="alert alert-success">
                                                <li><?php echo $success; ?><br></li>
                                        </div>
                                        <?php } ?>

                                        <div class="form-group">
                                            <label>Nombre del reproductor</label>
                                            <input class="form-control" name="name" value="<?php echo htmlspecialchars($data['genre']['name']); ?>" />
                                        </div>

                                        <div class="form-group">
                                            <label>Url</label>
                                            <input class="form-control" name="url" placeholder="Ejemplo: https://drive.google.com/file/d/codigo/preview" value="<?php echo htmlspecialchars($data['genre']['url']); ?>" />
                                        </div>

                                        <button type="submit" class="btn btn-success" name="enviar"><i class=" fa fa-plus "></i> Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </div>

<?php
require_once('_footer.php');
