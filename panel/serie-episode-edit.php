<?php
require_once('../app/config.php');
require_once('../app/session.php');
require_once('../app/functions.php');
require_once('../app/dbconnection.php');
require_once('app/validate_authorization.php');

$data = array();
$data['current_menu'] = 'serie';
//$data['current_submenu'] = 'episode-edit';

$data['serie'] = DB::queryFirstRow('SELECT * FROM serie WHERE id=%s', $_GET['serie_id']);
$data['episode'] = DB::queryFirstRow('SELECT * FROM serie_episode WHERE serie_id=%s AND id=%s', $data['serie']['id'], $_GET['episode_id']);
$data['episode']['videos'] = json_decode($data['episode']['videos'], true);
$data['episode']['downloads'] = json_decode($data['episode']['downloads'], true);
$data['players'] = DB::query('SELECT * FROM player ORDER BY id ASC');

if (trim($data['episode']['image']) == '')
{
    if (trim($data['serie']['image_banner']) == '')
    {
        $data['episode_image'] = $config['adminpath'].'/assets/web.png';
    }
    else
    {
        $data['episode_image'] = getSerieScreenshot($data['serie']['image_screenshot']);
    }
}
else
{
    $data['episode_image'] = getEpisodeImage($data['serie']['image_banner'], $data['episode']['image']);
}


$data['visible'] = array(
  array(
    'id' => 'yes',
    'name' => 'Si',
    'selected' => true,
  ),
  array(
    'id' => 'no',
    'name' => 'No',
    'selected' => false,
  ),
);
foreach ($data['visible'] as $key => $value)
{
    if ($data['visible'][$key]['id'] == $data['episode']['visible'])
    {
        $data['visible'][$key]['selected'] = true;
    }
    else
    {
        $data['visible'][$key]['selected'] = false;
    }
}

$data['languages'] = DB::query('SELECT * FROM language ORDER BY name ASC');
foreach ($data['languages'] as $key => $value)
{
    if ($data['languages'][$key]['id'] == $data['episode']['language_id'])
    {
        $data['languages'][$key]['selected'] = true;
    }
    else
    {
        $data['languages'][$key]['selected'] = false;
    }
}

require_once('_header.php');
?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                  Editar Capitulo:
                  <small><?php echo $data['serie']['name']; ?></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $config['adminpath']; ?>/"><i class="fa fa-dashboard"></i> Inicio</a></li>
                    <li><a href="<?php echo $config['adminpath']; ?>/serie/<?php echo $data['serie']['id']; ?>/episodes"><i class="fa fa-youtube-play"></i> <?php echo $data['serie']['name']; ?></a></li>
                    <li class="active">Editar Capitulo</li>
                </ol>
            </section>

            <section class="content">
                <div class="row">
                    <form name="formECap" id="formECap" onsubmit="return false">
                        <div class="col-md-6">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Información</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group col-xs-6">
                                        <label>Id Serie:</label>
                                        <input style="background: #ddd;" type="text" class="form-control" name="codserie" value="<?php echo htmlspecialchars($data['serie']['id']); ?>" id="codigo" />
                                    </div>
                                    <div class="form-group col-xs-3">
                                        <label>Nro. Episodio (Requerido)</label>
                                        <input type="text" class="form-control" name="nroepi" id="episodio" value="<?php echo htmlspecialchars($data['episode']['number']); ?>" />
                                    </div>
                                    <div class="form-group col-xs-3">
                                        <label>Ep. Multiples (Opcional)</label>
                                        <input type="text" class="form-control" name="groepi" id="episodiogrupo" value="<?php echo htmlspecialchars($data['episode']['episodegroup']); ?>" />
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label>Fecha</label>
                                        <input type="text" class="form-control" name="fecha" id="fecha" value="<?php echo htmlspecialchars($data['episode']['release_date']); ?>" />
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label>Visible</label>
                                        <select name="visible" class="form-control">
                                            <?php foreach ($data['visible'] as $visible) { ?>
                                            <option value="<?php echo $visible['id']; ?>"<?php echo ($visible['selected'] == true ? ' selected' : ''); ?>><?php echo $visible['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Idioma</label>
                                        <select name="titulo" class="form-control">
                                            <?php foreach ($data['languages'] as $language) { ?>
                                            <option value="<?php echo $language['id']; ?>"<?php echo ($language['selected'] == true ? ' selected' : ''); ?>><?php echo $language['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Imagen Facebook</label>
                                        <input type="text" class="form-control" value="" onblur="vista_previa(this.value)" name="facebook" />
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title">IMAGEN</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <center><img id="imgRepro" src="<?php echo $data['episode_image']; ?>" class="user-image img-responsive" style="padding: 2px;border: 1px solid #999;border-radius: 2px;height: 270px;" height="247px" width="509.5px"></center>
                                    </div>

                                    <div class="form-group col-xs-9">
                                        <div class="alert alert-info" id="error_add" style="display:none;">
                                        </div>

                                        <div class="progress progress-striped active" id="precarga_envio" style="display:none;">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                            </div>
                                        </div>
                                        <input type="hidden" value="<?php echo htmlspecialchars($data['episode']['id']); ?>" name="id">
                                        <button type="submit" class="btn btn-success" name="enviar" id="EditCap"><i class=" fa fa-plus-square"></i> Editar</button>
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Reproductores</h3>
                                </div>
                                <div class="box-body">

                                    <div class="form-group">
                                        <div class="callout callout-danger lead">
                                            <p style="font-size:11px;">
                                                No repetir los reproductores, en caso de querer usar el mismo con otro codigo, ingresar un nuevo reproductor con otro nombre y la misma url!.
                                            </p>
                                        </div>
                                        <table class="table table-bordered" id="repros">
                                            <tbody id="op_repros">
                                                <tr>
                                                    <th>Reproductor</th>
                                                    <th>Codigo</th>
                                                </tr>
                                                <?php 
                                                if (is_array($data['episode']['videos'])) { 
                                                foreach ($data['episode']['videos'] as $key => $video) { ?>
                                                <tr id="cvideo_<?php echo $key; ?>">
                                                    <th>
                                                        <div class="form-group">
                                                            <select class="form-control" name="video[]">
                                                                <?php foreach ($data['players'] as $player) { ?>
                                                                <option value="<?php echo htmlspecialchars($player['id']); ?>"<?php echo ($player['id'] == $video['player'] ? ' selected' : ''); ?>><?php echo $player['name']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($video['code']); ?>" name="codigo[]"> </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group"> <a id="video_<?php echo $key; ?>" class="btn btn-danger btn-xs eliminar-vid"><i class="fa fa-times"></i></a></div>
                                                    </th>
                                                </tr>
                                                <?php } } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a class="btn btn-default" href="javascript:;" id="arepro">Agregar Reproductor</a>
                                    <a class="btn btn-success" href="javascript:;" id="modeloEmision">Modelo Emision</a>
                                    <a class="btn btn-danger" href="javascript:;" id="modeloFinalizados">Modelo Finalizados</a>
                                    <a class="btn btn-default" href="javascript:;" id="modeloReset">Restaurar Campos</a>                               
                                    <!-- /input-group -->
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Enlaces de Descarga</h3>
                                </div>
                                <div class="box-body">

                                    <table class="table table-bordered" id="descargas">
                                        <tbody id="op_descarga">
                                            <tr>
                                                <th>Enlace</th>
                                            </tr>
                                            <?php
                                            if (is_array($data['episode']['downloads'])) { 
                                            foreach ($data['episode']['downloads'] as $key => $download) { ?>
                                            <tr id="cont_descarga_<?php echo $key; ?>">
                                                <th>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($download); ?>" name="url[]" id="campo_1"> </div>
                                                </th>
                                                <th>
                                                    <div class="form-group"> <a id="del_<?php echo $key; ?>" class="btn btn-danger btn-xs eliminar"><i class="fa fa-times"></i></a> </div>
                                                </th>
                                            </tr>
                                            <?php } } ?>
                                        </tbody>
                                    </table>

                                    <a class="btn btn-default" href="javascript:;" id="adescarga">Agregar Descarga</a>
                                    <!-- /input-group -->
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>

                    </form>
                </div>
            </section>

        </div>
        <!-- /.content-wrapper -->

<?php startZone(); ?>
    <script type="text/javascript">
        var urlWeb = '<?php echo $config['adminpath']; ?>';

        function vista_previa(result) {
            if (result != '') {
                $('#imgRepro').attr("src", result);
            } else {
                $('#imgRepro').attr("src", "<?php echo $data['episode_image']; ?>");
            }
        }

        $(document).ready(function() {
            var players = <?php echo json_encode($data['players']);?>;
            function addPlayer(added,contador){
                $(content).append('<tr id="cvideo_' + contador + '" class="' + added + '"><th><div class="form-group"><select class="form-control" name="video[]"><?php foreach ($data['players'] as $player) { ?><option value="<?php echo htmlspecialchars($player['id']); ?>"><?php echo str_replace("'", "\'", $player['name']); ?></option><?php } ?></select></div></th><th><div class="form-group"><input type="text" class="form-control" value="" name="codigo[]"/></div></th><th><div class="form-group"><a id="video_' + contador + '" class="btn btn-danger btn-xs eliminar-vid"><i class="fa fa-times"></i></a></div></th></tr>');
            }
            function genModelo(added,contador,modeloId,modeloNamesId){
                $(content).append('<tr id="cvideo_' + contador + '" class="' + added + '"><th><div class="form-group"><select class="form-control" name="video[]"><option value="' + modeloId + '">' + modeloNamesId + '</option><?php foreach ($data['players'] as $player) { ?><option value="<?php echo htmlspecialchars($player['id']); ?>"><?php echo str_replace("'", "\'", $player['name']); ?></option><?php } ?></select></div></th><th><div class="form-group"><input type="text" class="form-control" value="" name="codigo[]"/></div></th><th><div class="form-group"><a id="video_' + contador + '" class="btn btn-danger btn-xs eliminar-vid"><i class="fa fa-times"></i></a></div></th></tr>');
            }
            var MaxInputs = 9; //Número Maximo de Campos
            var contenedor = $("#op_descarga"); //ID del contenedor
            var AddButton = $("#adescarga"); //ID del Botón Agregar
            //var x = número de campos existentes en el contenedor
            var x = $("#descargas tr").length + 1;
            var FieldCount = x - 1; //para el seguimiento de los campos

            /*variables reproductor*/
            var max = 24; //Número Maximo de Campos
            var content = $("#op_repros"); //ID del contenedor
            var AddButtonRepro = $("#arepro"); //ID del Botón Agregar
            var modeloEmision = $("#modeloEmision");
            var modeloFinalizados = $("#modeloFinalizados");
            //var x = número de campos existentes en el contenedor
            var y = $("#repros tr").length + 1;
            var contador = y - 1; //para el seguimiento de los campos

            $(AddButtonRepro).click(function(e) {
                
                if (y <= max) //max input box allowed
                {
                    contador++;
                    //agregar campo
                    addPlayer(contador);
                    y++; //text box increment
                }
                return false;
            });

            $(modeloEmision).click(function(){
                $(".added_1").remove();
                var modelo = [
                    '15','12','17','9','11','2','3','4','6'
                ];
                var modeloNames = [
                    'M','RU', 'CW', 'Amazon', 'AmazonEs', 'Fembed', 'Mp4upload', 'Senvid', 'YourUpload'
                ];
                var y = $("#repros tr").length + 1;
                for (i = y - 2; i <= modeloNames.length - 1; i++){
                    contador++;
                    genModelo('added_2',i,modelo[i],modeloNames[i]);
                    y++;
                }
                return true;
            });

            $(modeloFinalizados).click(function(){
                $(".added_2").remove();
                var modelo = [
                    '9','11','17','2','3','6','4','15'
                ];
                var modeloNames = [
                    'Amazon','AmazonEs', 'CW', 'Fembed', 'Mp4upload', 'YourUpload', 'Senvid', 'Mega'
                ];
                var y = $("#repros tr").length + 1;
                for (i = y - 2; i <= modeloNames.length - 1; i++){
                    contador++;
                    genModelo('added_1',i,modelo[i],modeloNames[i]);
                    y++;
                }
            });

            $(modeloReset).click(function(){
                $(".added_1").remove();
                $(".added_2").remove();
                $(".added_3").remove();
            });

            $("body").on("click", ".eliminar-vid", function(e) { //click en eliminar campo
                var numero1 = $(this).attr('id');
                if (y > 1) {
                    var n1 = numero1.replace('video_', '');
                    $("#cvideo_" + n1).remove();
                    y--;
                }
                return false;
            });

            $(AddButton).click(function(e) {
                if (x <= MaxInputs) //max input box allowed
                {
                    FieldCount++;
                    //agregar campo
                    $(contenedor).append('<tr id="cont_descarga_' + FieldCount + '"><th> <div class="form-group"> <input type="text" class="form-control" value="" name="url[]" id="campo_1"/> </div></th> <th> <div class="form-group"> <a id="del_' + FieldCount + '" class="btn btn-danger btn-xs eliminar"><i class="fa fa-times"></i></a> </div></th></tr>');
                    x++; //text box increment
                }
                return false;
            });

            $("body").on("click", ".eliminar", function(e) { //click en eliminar campo
                var numero = $(this).attr('id');
                if (x > 1) {
                    var n = numero.replace('del_', '');;
                    $("#cont_descarga_" + n).remove();
                    x--;
                }
                return false;
            });

            $('#EditCap').click(function() {
                var nroepi = $("#episodio").val();
                var fecha = $("#fecha").val();
                var codserie = $("#codigo").val();
                if (nroepi == "" || fecha == "" || codserie == "") {
                    $('#error_add').html('Completa los campos');
                    $('#error_add').hide().fadeIn();
                } else {
                    $('#error_add').css("display", "none");
                    $('#precarga_envio').css("display", "block");
                    document.getElementById('EditCap').disabled = true;
                    var este = $('#formECap');
                    setTimeout(function() {
                        $.ajax({
                            type: 'POST',
                            url: urlWeb + '/api/c.edit-cap.php',
                            data: este.serialize(),
                            success: function(html) {
                                if (html == 'subido') {
                                    location.href = urlWeb + '/serie/' + codserie + '/episodes';
                                } else {
                                    $('#precarga_envio').css("display", "none");
                                    $('#error_add').html(html);
                                    $('#error_add').hide().fadeIn();
                                    document.getElementById('EditCap').disabled = false;
                                }
                            }
                        });
                    }, 2000);
                }
            });

        });
    </script>
<?php
$footer_js = endZone();

require_once('_footer.php');
