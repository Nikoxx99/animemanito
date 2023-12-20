<?php
require_once('../app/config.php');
require_once('../app/session.php');
require_once('../app/functions.php');
require_once('../app/dbconnection.php');
require_once('app/validate_authorization.php');
require_once('app/functions.php');

$data = array();
$data['current_menu'] = 'player';
$data['current_submenu'] = 'create';

$data['types'] = array(
    array(
        'id' => 'iframe',
        'name' => 'EMBED URL',
    ),
    array(
        'id' => 'html',
        'name' => 'HTML',
    ),
);

foreach ($data['types'] as $key => $value)
{
    $selected = false;
    $data['types'][$key]['selected'] = $selected;
}

//$data['players_count'] = DB::queryFirstField('SELECT COUNT(*) FROM player');

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

    $search = 'codigo';
    if (preg_match("/{$search}/i", $_POST['url']) == false)
    {
        $errors[] = 'Url invalida. Debes incluir la palabra "codigo".';
    }

    if (empty($errors))
    {
        $item_data = array();
        $item_data['name'] = fixToSaveText($_POST['name']);
        $item_data['type'] = fixToSaveText($_POST['type']);
        if ($item_data['type'] == 'iframe')
        {
            $item_data['url'] = fixToSaveText($_POST['url']);
        }
        else
        {
            $item_data['url'] = $_POST['url'];
        }
        DB::insert('player', $item_data);
        RedirectTo($config['adminpath'].'/player/list');
    }
}

require_once('_header.php');
?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                  Agregar Reproductor
                  <small>Version 1.0</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $config['adminpath']; ?>/"><i class="fa fa-dashboard"></i> Inicio</a></li>
                    <li>Reproductor</li>
                    <li class="active">Agregar</li>
                </ol>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-xs-12">

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

                        <div class="box">
                            <?php /*<div class="box-header with-border">
                                <h3 class="box-title">Total de reproductores <?php echo $data['players_count']; ?></h3>
                            </div>*/?>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <form method="post" action="">
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label>Nombre del reproductor</label>
                                            <input class="form-control" name="name" value="" />
                                        </div>

                                        <div class="form-group">
                                            <label>Tipo de implementación</label>
                                            <select class="form-control" name="type">
                                                <?php foreach ($data['types'] as $type) { ?>
                                                <option value="<?php echo $type['id']; ?>"<?php echo ($type['selected'] == true ? ' selected' : ''); ?>><?php echo $type['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Url</label>
                                            <input class="form-control" name="url" placeholder="Ejemplo: https://drive.google.com/file/d/codigo/preview" />
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
