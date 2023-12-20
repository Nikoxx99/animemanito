<?php
require_once('../app/config.php');
require_once('../app/session.php');
require_once('../app/functions.php');
require_once('../app/dbconnection.php');
require_once('app/validate_authorization.php');
require_once('app/functions.php');

$data = array();
$data['current_menu'] = 'genre';
$data['current_submenu'] = 'create';

//$data['players_count'] = DB::queryFirstField('SELECT COUNT(*) FROM player');

if (isset($_POST['name']) && isset($_POST['url']))
{
    $data['errors'] = array();

    if (trim($_POST['name']) == '')
    {
        $data['errors'][] = 'Nombre invalido';
    }

    if (trim($_POST['url']) == '')
    {
        $data['errors'][] = 'Url invalida';
    }

    if (empty($data['errors']))
    {
        $item_data = array();
        $item_data['name'] = fixToSaveText($_POST['name']);
        $item_data['url'] = fixToSaveText($_POST['url']);

        DB::insert('genre', $item_data);
        RedirectTo($config['adminpath'].'/genre/list');
    }
}

require_once('_header.php');
?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                  Agregar Género
                  <small>Version 1.0</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $config['adminpath']; ?>/"><i class="fa fa-dashboard"></i> Inicio</a></li>
                    <li>Género</li>
                    <li class="active">Agregar</li>
                </ol>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-xs-12">

                        <?php if(!empty($data['errors'])){?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($data['errors'] as $error) { ?>
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

                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <form method="post" action="">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nombre del género</label>
                                            <input class="form-control" name="name" value="" placeholder="Ejemplo: Recuentos de la vida"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Url</label>
                                            <input class="form-control" name="url" placeholder="Ejemplo: recuentos-de-la-vida" />
                                        </div>
                                        <button type="submit" class="btn btn-success" name="enviar"><i class=" fa fa-plus "></i> Agregar</button>
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
