<?php
require_once('../app/config.php');
require_once('../app/session.php');
require_once('../app/functions.php');
require_once('../app/dbconnection.php');
require_once('app/validate_authorization.php');

$data = array();
$data['current_menu'] = 'serie';
//$data['current_submenu'] = 'edit';

$data['genres'] = DB::query('SELECT * FROM genre ORDER BY name ASC');
$data['categories'] = DB::query('SELECT * FROM category ORDER BY id ASC');
$data['status'] = DB::query('SELECT * FROM status ORDER BY id ASC');
$data['series'] = DB::query('SELECT id,name FROM serie');
$data['related'] = DB::query('SELECT id_serie_related,type FROM serie_related WHERE id_serie=%i',$_GET['serie_id']);
$data['censorship'] = array(
  array(
    'id' => 'yes',
    'name' => 'Si'
  ),
  array(
    'id' => 'no',
    'name' => 'No'
  ),
);
$data['visible'] = array(
  array(
    'id' => 'yes',
    'name' => 'Si'
  ),
  array(
    'id' => 'no',
    'name' => 'No'
  ),
);

$data['serie'] = DB::queryFirstRow('SELECT * FROM serie WHERE id=%s', $_GET['serie_id']);

$genres_id = str_replace('"', '', $data['serie']['genres']);
$genres_id = explode(',', $genres_id);

foreach ($data['genres'] as $key => $value)
{
    $selected = false;
    if (in_array($value['id'], $genres_id))
    {
        $selected = true;
    }
    $data['genres'][$key]['selected'] = $selected;
}

foreach ($data['categories'] as $key => $value)
{
    $selected = false;
    if ($value['id'] == $data['serie']['category_id'])
    {
        $selected = true;
    }
    $data['categories'][$key]['selected'] = $selected;
}

foreach ($data['status'] as $key => $value)
{
    $selected = false;
    if ($value['id'] == $data['serie']['status_id'])
    {
        $selected = true;
    }
    $data['status'][$key]['selected'] = $selected;
}

foreach ($data['censorship'] as $key => $value)
{
    $selected = false;
    if ($value['id'] == $data['serie']['censorship'])
    {
        $selected = true;
    }
    $data['censorship'][$key]['selected'] = $selected;
}

foreach ($data['visible'] as $key => $value)
{
    $selected = false;
    if ($value['id'] == $data['serie']['visible'])
    {
        $selected = true;
    }
    $data['visible'][$key]['selected'] = $selected;
}

startZone(); ?>
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo $config['adminpath']; ?>/assets/plugins/select2/select2.min.css">
<?php
$header_css_before = endZone();

require_once('_header.php');
?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                Editar Serie
                <small><?php echo $data['serie']['name']; ?></small>
              </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $config['adminpath']; ?>/"><i class="fa fa-dashboard"></i> Inicio</a></li>
                    <li><a href="<?php echo $config['adminpath']; ?>/serie/<?php echo $data['serie']['id']; ?>/episodes"><i class="fa fa-youtube-play"></i> <?php echo $data['serie']['name']; ?></a></li>
                    <li class="active">Editar Serie</li>
                </ol>
            </section>

            <section class="content">
                <form name="formE" id="formE" onsubmit="return false">
                    <div class="col-md-6">
                        <div class="box box-danger">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($data['serie']['name']); ?>" id="nombre" />
                                </div>
                                <div class="form-group">
                                    <label>Generos</label>
                                    <select class="form-control genero" multiple="multiple" data-placeholder="Seleccionar Género" style="width: 100%;" id="genero">
                                        <?php foreach ($data['genres'] as $genre) { ?>
                                        <option value="<?php echo $genre['id']; ?>"<?php echo ($genre['selected'] == true ? ' selected' : ''); ?>><?php echo $genre['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label>Categoria</label>
                                    <select class="form-control" name="categoria" id="categoria">
                                        <?php foreach ($data['categories'] as $category) { ?>
                                        <option value="<?php echo $category['id']; ?>"<?php echo ($category['selected'] == true ? ' selected' : ''); ?>><?php echo $category['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label>Estado</label>
                                    <select class="form-control" name="estado" id="estado">
                                        <?php foreach ($data['status'] as $status) { ?>
                                        <option value="<?php echo $status['id']; ?>"<?php echo ($status['selected'] == true ? ' selected' : ''); ?>><?php echo $status['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label>Censura</label>
                                    <select class="form-control" name="censura" id="censura">
                                        <?php foreach ($data['censorship'] as $censorship) { ?>
                                        <option value="<?php echo $censorship['id']; ?>"<?php echo ($censorship['selected'] == true ? ' selected' : ''); ?>><?php echo $censorship['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                                <div class="form-group" style="padding-right: 15px;padding-left: 15px;">
                                    <label>Imagen Portada</label>
                                    <input type="text" class="form-control" value="<?php //echo htmlspecialchars($data['serie']['image_cover']); ?>" onblur="vista_previa(this.value,1)" name="image_cover" id="image_cover" />
                                </div>

                                <div class="form-group" style="padding-right: 15px;padding-left: 15px;">
                                    <label>Imagen Screenshot</label>
                                    <input type="text" class="form-control" value="<?php //echo htmlspecialchars($data['serie']['image_banner']); ?>" onblur="vista_previa(this.value,2)" name="image_screenshot" id="image_screenshot" />
                                </div>

                                <div class="form-group" style="padding-right: 15px;padding-left: 15px;">
                                    <label>Imagen Banner</label>
                                    <input type="text" class="form-control" value="<?php //echo htmlspecialchars($data['serie']['image_banner']); ?>" onblur="vista_previa(this.value,3)" name="image_banner" id="image_banner" />
                                </div>
                                
                                <div class="form-group" style="padding-right: 15px;padding-left: 15px;">
                                    <a class="btn btn-default" href="javascript:;" id="add_serie_relacionada">Agregar Serie Relacionada</a>
                                    <table class="table table-bordered" id="table_related">
                                        <tbody id="tbody_related">
                                            <tr>
                                                <th>Serie Relacionada</th>
                                                <th>Tipo</th>
                                            </tr>
                                            <?php if(!empty($data['related'])){foreach($data['related'] as $related){if($related['type'] == 1){$related_type = "Precuela";
                                            }else if($related['type'] == 2){$related_type = "Secuela";
                                            }else if($related['type'] == 3){$related_type = "Spin-Off";
                                            }else if($related['type'] == 4){$related_type = "Historia Paralela";
                                            }
                                            $related_serie = DB::query('SELECT id,name FROM serie WHERE id=%i',$related['id_serie_related']);
                                            ?>
                                            
                                            <tr>
                                                <th><?php echo $related_serie[0]['name'];?></th>
                                                <th><?php echo $related_type;?></th>
                                            </tr>
                                            <?php }}?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-group col-xs-12">
                                    <label>Seo</label>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($data['serie']['url']); ?>" name="seo" />
                                </div>

                                <div class="form-group">
                                    <center><img id="image_screenshot_preview" src="<?php echo getSerieScreenshot($data['serie']['image_screenshot']); ?>" class="user-image img-responsive" style="padding: 2px;border: 1px solid #999;border-radius: 2px;height: 270px;" height="247px" width="466.44px"></center>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col-md-6 -->

                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-body">

                                <div class="form-group col-xs-4">
                                    <label>Fecha de estreno de serie</label>
                                    <input type="text" class="form-control" name="fecha" value="<?php echo htmlspecialchars($data['serie']['release_date']); ?>" id="release_date" <?php if(htmlspecialchars($data['serie']['release_date']) === '') { echo 'disabled'; }?>/>
                                    <label>Fecha desconocida</label>
                                    <input type="checkbox" <?php if(htmlspecialchars($data['serie']['release_date']) === '') { echo 'checked'; }?> name="unknown_release_date" value="0" id="unknown_release_date">
                                </div>

                                <div class="form-group col-xs-4">
                                    <label>Temporada de Estreno</label>
                                    <select class="form-control" name="release_season">
                                        <option value="-1">(Selecciona)</option>
                                        <option value="0">N/A</option>
                                        <option value="1" <?php if (htmlspecialchars($data['serie']['release_season']) === '1') {echo 'selected';}?>>Invierno</option>
                                        <option value="2" <?php if (htmlspecialchars($data['serie']['release_season']) === '2') {echo 'selected';}?>>Primavera</option>
                                        <option value="3" <?php if (htmlspecialchars($data['serie']['release_season']) === '3') {echo 'selected';}?>>Verano</option>
                                        <option value="4" <?php if (htmlspecialchars($data['serie']['release_season']) === '4') {echo 'selected';}?>>Otoño</option>
                                    </select>
                                </div>


                                <div class="form-group col-xs-4">
                                    <label>Fecha del Próximo Episodio</label>
                                    <input type="text" class="form-control" name="date_next_episode" value="<?php echo htmlspecialchars($data['serie']['date_next_episode']); ?>" id="date_next_episode" <?php if(htmlspecialchars($data['serie']['release_date']) === '') { echo 'disabled'; }?> />
                                    <label>Comentario para la fecha de proximo capitulo:</label>
                                    <input type="text" class="form-control" name="text_next_episode" value="<?php echo htmlspecialchars($data['serie']['text_next_episode']); ?>" id="text_next_episode" />
                                </div>

                                <div class="form-group col-xs-6">
                                    <label>Trailer</label>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($data['serie']['trailer']); ?>" name="trailer" />
                                </div>

                                <div class="form-group col-xs-6">
                                    <label>Visible</label>
                                    <select class="form-control" name="visible">
                                        <?php foreach ($data['visible'] as $visible) { ?>
                                        <option value="<?php echo $visible['id']; ?>"<?php echo ($visible['selected'] == true ? ' selected' : ''); ?>><?php echo $visible['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group col-xs-12">
                                    <label>Sinopsis</label>
                                    <textarea class="form-control" rows="5" name="sinopsis" id="sinopsis"><?php echo htmlspecialchars($data['serie']['synopsis']); ?></textarea>
                                </div>

                                <div class="form-group col-xs-12" style="overflow: hidden;">
                                    <div class="alert alert-info" id="error_add" style="display:none;">
                                    </div>
                                    <div class="progress progress-striped active" id="precarga_envio" style="display:none;">
                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['serie']['id']); ?>" />
                                    <button type="submit" class="btn btn-primary" name="enviar" id="EditSerie" style="float:right"><i class=" fa fa-plus-square"></i> EDITAR</button>
                                </div>
                                <!--Tabla de imagenes-->
                                <div class="form-group">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center">Imagen Serie</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <center><img id="image_cover_preview" src="<?php echo getSerieCover($data['serie']['image_cover']); ?>" class="user-image img-responsive" style="padding: 2px;border: 1px solid #999;border-radius: 2px;"></center>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--Final tabla-->
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col-md-6 -->
                </form>
            </section>

        </div>

<?php startZone(); ?>
    <!-- Select2 -->
    <script src="<?php echo $config['adminpath']; ?>/assets/plugins/select2/select2.full.min.js"></script>

    <!-- bootstrap datepicker -->
    <script src="<?php echo $config['adminpath']; ?>/themes/frans185/js/components/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo $config['adminpath']; ?>/themes/frans185/js/components/bootstrap-datepicker.es.min.js"></script>


    <script type="text/javascript">
        var urlWeb = '<?php echo $config['adminpath']; ?>';
    $(document).ready(function() {

        //Date picker
        $('#release_date').datepicker({
        language: 'es',
        autoclose: true,
        format: 'yyyy-mm-dd',
        });

        $('#date_next_episode').datepicker({
        language: 'es',
        autoclose: true,
        format: 'yyyy-mm-dd',
        });

        $(".genero").select2();

        $("#mini_s").change(function() {
            var selected_option = $('#mini_s').val();

            if (selected_option === '2') {
                $("#mini").val("https://hentaila.com/assets/img/defecto_2.jpg");
                $('#mini').show();
            }
            if (selected_option != '2') {
                $("#mini").val("recorte");
                $("#mini").hide();
            }
        });
    });

    $('#unknown_release_date').change(function() {
    if ($(this).is(':checked')) {
            $('#release_date').val('');
            $('#release_date').prop('disabled', true);
            $('#date_next_episode').val('');
            $('#date_next_episode').prop('disabled', true);
            $('release_season').val('0');
            $('release_season').prop('disabled', true);
        } else {
            $('#release_date').val( '<?php echo date('Y-m-d'); ?>');
            $('#release_date').prop('disabled', false);
            $('#date_next_episode').val('<?php echo date('Y-m-d'); ?>');
            $('#date_next_episode').prop('disabled', false);
            $('release_season').val('0');
            $('release_season').prop('disabled', false);
        }
    });

    function vista_previa(result, valor) {
        if (result !== '') {
            if (valor == 1) {
                $('#image_cover_preview').attr("src", result);
            } else if (valor == 2) {
                $('#image_screenshot_preview').attr("src", result);
            } else if (valor == 3) {
                $('#image_banner').attr("src", result);
            }
        }
    }

    $('#EditSerie').click(function() {
        var genero = $("#genero").val();
        var nombre = $("#nombre").val();
        //var img = $("#imagen").val();
        var sinopsis = $("#sinopsis").val();
        var temporada = $("#release_season").val();
        if (nombre == "" || sinopsis == "" || genero == "" || temporada == "-1") {
            $('#error_add').html('Completa los campos');
            $('#error_add').hide().fadeIn();
        } else {
            $('#error_add').css("display", "none");
            $('#precarga_envio').css("display", "block");
            document.getElementById('EditSerie').disabled = true;
            var este = $('#formE');
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: urlWeb + '/api/c.editar.php',
                    data: este.serialize() + "&generos=" + genero,
                    success: function(html) {
                        if (html == 'subido') {
                            location.href = urlWeb + '/serie/list';
                        } else {
                            $('#precarga_envio').css("display", "none");
                            $('#error_add').html(html);
                            $('#error_add').hide().fadeIn();
                            document.getElementById('EditSerie').disabled = false;
                        }
                    }
                });
            }, 2000);
        }
    });
    </script>
<script>
var max = 5; //Número Maximo de Campos
var content = $("#tbody_related"); //ID del contenedor
var AddButtonRepro = $("#add_serie_relacionada"); //ID del Botón Agregar
//var x = número de campos existentes en el contenedor
var y = $("#table_related tr").length + 1;
var contador = y - 1; //para el seguimiento de los campos

$(AddButtonRepro).click(function(e) {
    if (y <= max) //max input box allowed
    {
        contador++;
        //agregar campo
        $(content).append('<tr id="related_serie_' + contador + '"><th> <div class="form-group"><input type="text" list="related_list" name="related_series_data[]" /><datalist style="display:none;" id="related_list" class="form-control"><?php foreach ($data['series'] as $series) { ?><option value="<?php echo htmlspecialchars($series['id']); ?>"><?php echo str_replace("'", "\'", $series['name']); ?></option><?php } ?></datalist></div></th><th><div class="form-group"><select class="form-control" name="tipo_related[]"><option value="1">Precuela</option><option value="2">Secuela</option><option value="3">Spin-Off</option><option value="4">Historia Paralela</option></select></div></th><th> <div class="form-group"> <a id="related_' + contador + '" class="btn btn-danger btn-xs eliminar-related"><i class="fa fa-times"></i></a></div></th></tr>');
        y++; //text box increment
    }
    return false;
});

$("body").on("click", ".eliminar-related", function(e) { //click en eliminar campo
    var numero1 = $(this).attr('id');
    if (y > 1) {
        var n1 = numero1.replace('related_', '');
        $("#related_serie_" + n1).remove();
        y--;
    }
    return false;
});

</script>
<?php
$footer_js = endZone();

require_once('_footer.php');
