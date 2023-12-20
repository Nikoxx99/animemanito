<?php
require_once('../app/config.php');
require_once('../app/session.php');
require_once('../app/functions.php');
require_once('../app/dbconnection.php');
require_once('app/validate_authorization.php');
require_once('app/functions.php');

$theme_path = '../themes/';

$data = array();
$data['current_menu'] = 'setting';
$data['current_submenu'] = 'common';

$data['domain'] = $site_domain;

$data['config'] = DB::queryFirstRow('SELECT * FROM config WHERE domain = %s', $data['domain']);
if ($data['config'] == null)
{
    Redirect404To($config['adminpath'].'/');
}
//echo '<pre>';print_r($data['config']);echo '</pre>';exit;

// Get Theme List
$data['themes'] = array();
$items = scandir($theme_path);
foreach ($items as $item)
{
    if ($item !== '.' && $item !== '..')
    {
        $data['themes'][] = $item;
    }
}

if (
    isset($_POST['site_name']) 
    && isset($_POST['facebook'])
    && isset($_POST['youtube'])
    && isset($_POST['facebook'])
    && isset($_POST['media_folder'])
    && isset($_POST['theme'])
    && isset($_POST['facebook_appid'])
    && isset($_POST['facebook_appsecret'])
    && isset($_POST['recaptcha_key'])
    && isset($_POST['recaptcha_secret'])
    && isset($_POST['analytics'])
)
{
    /*
        site_name: AnimeFénix
        facebook: https://www.facebook.com/AnimeFénix-629593250894113/
        youtube: https://www.youtube.com/channel/UCIH2ZSqqCOsxct2662cZ_KA
        theme: defaultX
        facebook_appid: 1163105103868720
        facebook_appsecret: 7d704157fb6f64569aae5ee49e0b7e4c
        recaptcha_key: 6Lddsl0UAAAAAG-7BP5W0Tbrh-JkZ3eZEgt1y_cR
        recaptcha_secret: 6Lddsl0UAAAAAHwsd72XvDUhmAqUc70Lz4JNaOIC
        analytics: UA-143247510-1
    */
    $errors = array();

    if (trim($_POST['site_name']) == '')
    {
        $errors[] = 'Nombre Invalido';
    }

    if (empty($errors))
    {
        $item_data = array();
        $item_data['site_name'] = fixToSaveText($_POST['site_name']);
        $item_data['facebook'] = fixToSaveText($_POST['facebook']);
        $item_data['youtube'] = fixToSaveText($_POST['youtube']);
        $item_data['media_folder'] = fixToSaveText($_POST['media_folder']);
        $item_data['theme'] = fixToSaveText($_POST['theme']);
        $item_data['facebook_appid'] = fixToSaveText($_POST['facebook_appid']);
        $item_data['facebook_appsecret'] = fixToSaveText($_POST['facebook_appsecret']);
        $item_data['recaptcha_key'] = fixToSaveText($_POST['recaptcha_key']);
        $item_data['recaptcha_secret'] = fixToSaveText($_POST['recaptcha_secret']);
        $item_data['analytics'] = fixToSaveText($_POST['analytics']);

        //echo '<pre>';print_r($item_data);echo '</pre>';exit;

        DB::update('config', $item_data, 'domain=%s', $data['domain']);

        $success = 'Se actualizó correctamente la configuración!';

        // Refresh data to display
        $data['config'] = DB::queryFirstRow('SELECT * FROM config WHERE domain = %s', $data['domain']);

        // Update config file
        $val = var_export($data['config'], true);
        $val = str_replace('stdClass::__set_state', '(object)', $val);
        file_put_contents('../app/config.'.$data['domain'].'.php', '<?php $config = ' . $val . ';', LOCK_EX);
        //die($val);
    }
}

require_once('_header.php');
?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Configuración <small>Version 1.0</small></h1>
                <ol class="breadcrumb">
                    <li><a href="https://hentaila.com/panel"><i class="fa fa-dashboard"></i> Inicio</a></li>
                    <li class="active">Configuración</li>
                </ol>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-xs-12">

                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Ajustes Generales</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <form method="post" action="">
                                    <div class="col-md-6">
                                        
                                        <!--div class="form-group">
                                            <label>Dominio</label>
                                            <input class="form-control" name="domain" value="<?php echo htmlspecialchars($data['config']['domain']); ?>" disabled/>
                                        </div-->

                                        <div class="form-group">
                                            <label>Nombre de la web</label>
                                            <input class="form-control" name="site_name" value="<?php echo htmlspecialchars($data['config']['site_name']); ?>" />
                                        </div>

                                        <div class="form-group">
                                            <label>Facebook</label>
                                            <input class="form-control" name="facebook" value="<?php echo htmlspecialchars($data['config']['facebook']); ?>" />
                                        </div>

                                        <div class="form-group">
                                            <label>Youtube</label>
                                            <input class="form-control" name="youtube" value="<?php echo htmlspecialchars($data['config']['youtube']); ?>" />
                                        </div>

                                        <div class="form-group">
                                            <label>Carpeta de Medios</label>
                                            <input class="form-control" name="media_folder" value="<?php echo htmlspecialchars($data['config']['media_folder']); ?>" />
                                        </div>

                                        <div class="form-group">
                                            <label>Plantilla</label>
                                            <select class="form-control" name="theme">
                                                <?php foreach ($data['themes'] as $theme) { ?>
                                                <option value="<?php echo $theme; ?>"<?php echo ($theme == $data['config']['theme'] ? ' selected' : ''); ?>><?php echo strtoupper($theme); ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Facebook App Id</label>
                                            <input class="form-control" name="facebook_appid" value="<?php echo htmlspecialchars($data['config']['facebook_appid']); ?>" />
                                        </div>

                                        <div class="form-group">
                                            <label>Facebook App Secret</label>
                                            <input class="form-control" name="facebook_appsecret" value="<?php echo htmlspecialchars($data['config']['facebook_appsecret']); ?>" />
                                        </div>

                                        <div class="form-group">
                                            <label>Recaptcha Key</label>
                                            <input class="form-control" name="recaptcha_key" value="<?php echo htmlspecialchars($data['config']['recaptcha_key']); ?>" />
                                        </div>

                                        <div class="form-group">
                                            <label>Recaptcha Secret</label>
                                            <input class="form-control" name="recaptcha_secret" value="<?php echo htmlspecialchars($data['config']['recaptcha_secret']); ?>" />
                                        </div>

                                        <div class="form-group">
                                            <label>Google Analytics Id</label>
                                            <input class="form-control" name="analytics" value="<?php echo htmlspecialchars($data['config']['analytics']); ?>" />
                                        </div>

                                        <!--div class="form-group">
                                            <label>Enlace CDN</label>
                                            <input class="form-control" name="cdn" value="https://cdn.hentaila.com/" />
                                        </div-->

                                        <button type="submit" class="btn btn-success" name="enviar"><i class=" fa fa-refresh "></i> Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </div>
        <!-- /.content-wrapper -->
<?php
require_once('_footer.php');
