<?php
require_once('../app/config.php');
require_once('../app/session.php');
require_once('../app/functions.php');
require_once('../app/dbconnection.php');
require_once('app/validate_authorization.php');

$data = array();
$data['current_menu'] = 'user';
//$data['current_submenu'] = 'change-password';

$data['user'] = DB::queryFirstRow('SELECT id,name,password FROM user WHERE id = %s', $_GET['user_id']);
if ($data['user'] == null)
{
    Redirect404To($config['adminpath'].'/user/list');
}

if (isset($_POST['pass_1']) && isset($_POST['pass_2']))
{
    $errors = array();

    if (trim($_POST['pass_1']) == '' || trim($_POST['pass_2']) == '')
    {
        $errors[] = 'Ingresa una contraseña.';
    }

    if ($_POST['pass_1'] !== $_POST['pass_2'])
    {
        $errors[] = 'No coinicide la confirmacion de contraseña.';
    }

    if (empty($errors))
    {
        $item_data = array();
        $item_data['password'] = md5($_POST['pass_1']);

        DB::update('user', $item_data, 'id=%s', $data['user']['id']);

        $success = 'Se actualizó correctamente la contraseña!';
    }

}

require_once('_header.php');
?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                Editar Contraseña
                <small>Version 1.0</small>
              </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $config['adminpath']; ?>/"><i class="fa fa-dashboard"></i> Inicio</a></li>
                    <li class="active">Editar Contraseña</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">

                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="panel-heading">
                                    Editar Contraseña de <?php echo $data['user']['name']; ?> </div>
                                <div class="panel-body">
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

                                        <div class="alert alert-info">
                                            Recordar revisar bien el usuario antes de cambiar el Contraseña
                                        </div>

                                        <form method="post" action="" id="form2" name="form2">

                                            <div class="form-group">
                                                <label>Ingrese su nueva contraseña</label>
                                                <input type="password" class="form-control" name="pass_1" />
                                            </div>
                                            <div class="form-group">
                                                <label>Confirmar contraseña</label>
                                                <input type="password" class="form-control" name="pass_2" />
                                            </div>

                                            <button type="submit" class="btn btn-default" name="enviar"><i class=" fa fa-refresh "></i> Actualizar</button>
                                            <a class="btn btn-primary" href="<?php echo $config['adminpath']; ?>/user/list">Regresar</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <!-- /.content-wrapper -->
<?php
require_once('_footer.php');
