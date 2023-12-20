<?php
require_once('../app/config.php');
require_once('../app/session.php');
require_once('../app/functions.php');
require_once('../app/dbconnection.php');
require_once('app/validate_authorization.php');
require_once('app/functions.php');

$data = array();
$data['current_menu'] = 'player';
//$data['current_submenu'] = 'edit';

$data['player'] = DB::queryFirstRow('SELECT * FROM player WHERE id = %s', $_GET['player_id']);
if ($data['player'] == null)
{
    Redirect404To($config['adminpath'].'/player/list');
}

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

    if ($data['types'][$key]['id'] == $data['player']['type'])
    {
        $selected = true;
    }

    $data['types'][$key]['selected'] = $selected;
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

        DB::update('player', $item_data, 'id=%s', $data['player']['id']);

        $success = 'Se actualizó correctamente el reproductor!';

        // Refresh data to display
        $data['player'] = DB::queryFirstRow('SELECT * FROM player WHERE id = %s', $_GET['player_id']);
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
                                            <input class="form-control" name="name" value="<?php echo htmlspecialchars($data['player']['name']); ?>" />
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
                                            <input class="form-control" name="url" placeholder="Ejemplo: https://drive.google.com/file/d/codigo/preview" value="<?php echo htmlspecialchars($data['player']['url']); ?>" />
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
