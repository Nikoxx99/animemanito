<?php
require_once('../app/config.php');
require_once('../app/session.php');
require_once('../app/functions.php');
require_once('../app/dbconnection.php');
require_once('app/validate_authorization.php');

$theme_path = '../themes/';

$data = array();
$data['current_menu'] = 'user';
//$data['current_submenu'] = 'edit';

$data['user'] = DB::queryFirstRow('SELECT * FROM user WHERE id = %s', $_GET['user_id']);
if ($data['user'] == null)
{
    Redirect404To($config['adminpath'].'/user/list');
}

if (isset($_POST['usuario']) && isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['estado']))
{
    $errors = array();

    if (trim($_POST['usuario']) == '')
    {
        $errors[] = 'Usuario invalido';
    }

    if (trim($_POST['nombre']) == '')
    {
        $errors[] = 'Nombre invalido';
    }

    if (trim($_POST['email']) == '')
    {
        $errors[] = 'Email invalido';
    }

    $selected_role = DB::queryFirstField('SELECT COUNT(*) FROM role WHERE code=%s', $_POST['estado']);
    if (trim($_POST['estado']) == '' || $selected_role == 0)
    {
        $errors[] = 'Rango invalido';
    }

    if (!is_dir($theme_path.$_POST['theme']))
    {
        $errors[] = 'El Tema <b>'.strtoupper($_POST['theme']).'</b> no existe.';
    }

    if (empty($errors))
    {
        $item_data = array();
        $item_data['username'] = $_POST['usuario'];
        $item_data['name'] = $_POST['nombre'];
        $item_data['email'] = $_POST['email'];
        $item_data['role'] = $_POST['estado'];
        $item_data['theme'] = $_POST['theme'];

        DB::update('user', $item_data, 'id=%s', $data['user']['id']);

        $success = 'Se actualizó correctamente el usuario!';

        // Refresh data to display
        $data['user'] = DB::queryFirstRow('SELECT * FROM user WHERE id = %s', $_GET['user_id']);
    }
}


$data['user']['avatar'] = getUserAvatar($data['user']['avatar']);

$data['roles'] = DB::query('SELECT * FROM role ORDER by name ASC');

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

startZone(); ?>
    <style>
        #previewing {
            width: 200px;
            height: 200px;
            padding: 4px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }
    </style>
<?php
$header_css = endZone();

require_once('_header.php');
?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                  Editar Usuario
                  <small>Version 1.0</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $config['adminpath']; ?>/"><i class="fa fa-dashboard"></i> Inicio</a></li>
                    <li class="active">Editar Usuario</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="panel-heading">
                                    Editar Usuario
                                </div>
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

                                        <form method="post" action="" id="form2" name="form2">
                                            <div class="form-group">
                                                <label>Usuario</label>
                                                <input type="text" class="form-control" name="usuario" value="<?php echo htmlspecialchars($data['user']['username']); ?>" />
                                            </div>
                                            <div class="form-group">
                                                <label>Nombre</label>
                                                <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($data['user']['name']); ?>" />
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" name="email" value="<?php echo htmlspecialchars($data['user']['email']); ?>" />
                                            </div>
                                            <div class="form-group">
                                                <label>Rol</label>
                                                <select class="form-control" name="estado">
                                                    <?php foreach ($data['roles'] as $role) { ?>
                                                    <option value="<?php echo $role['code']; ?>"<?php echo ($role['code'] == $data['user']['role'] ? ' selected' : ''); ?>><?php echo $role['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Tema</label>
                                                <select class="form-control" name="theme">
                                                    <?php foreach ($data['themes'] as $theme) { ?>
                                                    <option value="<?php echo $theme; ?>"<?php echo ($theme == $data['user']['theme'] ? ' selected' : ''); ?>><?php echo strtoupper($theme); ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <input type="hidden" name="avatar" value="code.jpg">
                                            <button type="submit" class="btn btn-default" name="enviar"><i class=" fa fa-refresh "></i> Actualizar</button>
                                            <a class="btn btn-primary" href="<?php echo $config['adminpath']; ?>/user/list">Regresar</a>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        <img id="previewing" src="<?php echo $data['user']['avatar']; ?>" width="150" height="150" />
                                        <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="hidden" value="1" name="idusuario">
                                                <input type="file" name="file" id="file" required />
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success submit"><i class=" fa fa-cloud-upload"></i> Actualizar Imagen</button>

                                                <div id='loading'></div>
                                                <div id="message"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </section>
        </div>
        <!-- ./wrapper -->

<?php startZone(); ?>
        <script type="text/javascript">
            $(document).ready(function(e) {
                $("#uploadimage").on('submit', (function(e) {
                    e.preventDefault();
                    $("#message").empty();
                    $('#loading').show();
                    $.ajax({
                        url: "<?php echo $config['adminpath']; ?>/api/upload_img.php", // Url to which the request is send
                        type: "POST", // Type of request to be send, called as method
                        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false, // To send DOMDocument or non processed data file it is set to false
                        success: function(data) // A function to be called if request succeeds
                            {
                                $('#loading').hide();
                                $("#message").html(data);
                            }
                    });
                }));

                // Function to preview image after validation
                $(function() {
                    $("#file").change(function() {
                        $("#message").empty(); // To remove the previous error message
                        var file = this.files[0];
                        var imagefile = file.type;
                        var match = ["image/jpeg", "image/png", "image/jpg"];
                        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                            $('#previewing').attr('src', 'noimage.png');
                            $("#message").html("<p id='error'>Please Select A valid Image File</p>" + "<h4>Note</h4>" + "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                            return false;
                        } else {
                            var reader = new FileReader();
                            reader.onload = imageIsLoaded;
                            reader.readAsDataURL(this.files[0]);
                        }
                    });
                });

                function imageIsLoaded(e) {
                    $("#file").css("color", "green");
                    $('#image_preview').css("display", "block");
                    $('#previewing').attr('src', e.target.result);
                    $('#previewing').attr('width', '250px');
                    $('#previewing').attr('height', '230px');
                };
            });
        </script>
<?php
$footer_js = endZone();

require_once('_footer.php');
