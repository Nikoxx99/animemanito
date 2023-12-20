<?php
require_once('../app/config.php');
require_once('../app/session.php');
require_once('../app/functions.php');
require_once('../app/dbconnection.php');
require_once('app/validate_authorization.php');

$theme_path = '../themes/';

$data = array();
$data['current_menu'] = 'setting';
$data['current_submenu'] = 'slider';

if (isset($_POST['series_id']))
{
	// Reset all orders
	DB::queryRaw('DELETE FROM slider');
	//DB::update('slider', array('order' => 0), '`order`>0');

	// GET SERIE LIST
	$series = array();
	$serie_order = 0;
	foreach ($_POST['series_id'] as $key => $value)
	{
		$serie_id = (int)$_POST['series_id'][$key];

		// Insert new serie
		$item = array();
		$item['serie_id'] = $serie_id;
		$item['order'] = $serie_order;

		DB::insert('slider', $item);
		
		$serie_order++;
	}

	$data['success'] = 'Se actualizó correctamente el slider!';
	//echo '<pre>';print_r($series);exit;
}

$data['series'] = DB::query('SELECT slider.order,serie.id,serie.name,serie.image_screenshot FROM slider JOIN serie ON slider.serie_id=serie.id ORDER BY slider.order ASC');

startZone(); ?>
    <style>

    </style>
<?php
$header_css = endZone();

require_once('_header.php');
?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="frans185-app">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Slider<small>Version 1.0</small></h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $config['adminpath']; ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Slider</li>
                </ol>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-xs-12">

                        <?php if(isset($data['success'])){?>
                        <div class="alert alert-success">
                                <li><?php echo $data['success']; ?><br></li>
                        </div>
                        <?php } ?>

                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Ajustes</h3>
                            </div>
                            <!-- /.box-header -->

                            <div class="box-body">
                                <form method="post" action="">
                                    <div class="col-md-7">

										<div class="form-group">
	                                        <div class="callout callout-warning lead">
	                                            <p style="font-size:15px;">
	                                                Usa las flechas arriba o abajo para modificar el order del slider.
	                                            </p>
	                                        </div>

										    <table class="table table-bordered">
										    	<thead>
										            <tr>
										                <th style="text-align: center;">Orden</th>
										                <th style="text-align: center;">Nombre</th>
										                <th style="text-align: center;">Screeenshot</th>
										                <th style="text-align: center;">Opciones</th>
										            </tr>
										    	</thead>
										        <tbody>
										            <tr :id="'cvideo_' + index" v-for="(item, index) in series" :key="index">
										                <th style="vertical-align: middle;text-align:center;">
										                	{{ index + 1 }}
										                </th>
										                <th style="vertical-align: middle;text-align:center;">
										                    <div class="form-group">
										                    	<input type="hidden" name="series_id[]" :value="item.id"/>
										                    	<!--input class="form-control" :value="item.name" placeholder="Ingresa el seo de tus animes separado por coma" readonly /-->
										                    	{{ item.name }}
										                    </div>
										                </th>
										                <th style="vertical-align: middle;text-align:center;">
										                	<img :src="getSerieBanner(item.image_screenshot)" width="140" height="79">
										                </th>
										                <th style="vertical-align: middle;text-align:center;">
										                    <div class="form-group">
										                    	<button 
										                    		v-if="index > 0"
										                    		class="btn btn-success btn-xs eliminar-vid" type="button" @click="moveUp(index)"><i class="fa fa-arrow-up"></i></button>
										      					
										      					<button 
										      						v-if="index < series.length - 1"
										      						class="btn btn-warning btn-xs eliminar-vid" type="button" @click="moveDown(index)"><i class="fa fa-arrow-down"></i></button>

										                    	<button class="btn btn-danger btn-xs eliminar-vid" type="button" @click="deleteSerie(index)"><i class="fa fa-times"></i></button>
										                    	<!--code>{{ item }}</code-->
										                    </div>
										                </th>
										            </tr>
										        </tbody>
										    </table>

	                                        <button type="submit" class="btn btn-success" name="enviar"><i class="fa fa-refresh "></i> Actualizar</button>

										</div>
									</div>

                                    <div class="col-md-5">

                                        <div class="form-group">
                                            <label>Busca una serie</label>
                                            <input class="form-control" name="slider" value="" placeholder="Ingresa el nombre de una serie" v-model="input_name" />
                                        </div>

                                        <button type="button" class="btn btn-success" @click="searchSerie();"><i class="fa fa-search"></i> Buscar</button>
                                        <button type="button" class="btn btn-danger" @click="searchClear();" v-if="result_items.length > 0"><i class="fa fa-search"></i> Limpiar Busqueda</button>
                                        <br><br>

									    <div class="form-group">
									    	<table class="table table-bordered">
										    	<thead>
										            <tr>
										                <th style="text-align: center;">Nombre</th>
										                <th style="text-align: center;">Screeenshot</th>
										                <th style="text-align: center;">Opciones</th>
										            </tr>
										    	</thead>
										        <tbody>
										        	<tr>
										        		<th style="vertical-align: middle;text-align:center;" colspan="3" v-if="result_items.length == 0">
										        			No hay resultados
										        		</th>
										        	</tr>
										            <tr :id="'cvideo_' + index" v-for="(item, index) in result_items" :key="index">
										                <th style="vertical-align: middle;text-align:center;">
										                    <div class="form-group">
										                    	{{ item.name }}
										                    </div>
										                </th>
										                <th style="vertical-align: middle;text-align:center;">
										                	<img :src="getSerieBanner(item.image_screenshot)" width="140" height="79">
										                </th>
										                <th style="vertical-align: middle;text-align:center;">
										                    <div class="form-group">
										                    	<button class="btn btn-success btn-xs eliminar-vid" type="button" @click="insertSerie(item)"><i class="fa fa-plus"></i> Agregar</button>
										                    </div>
										                </th>
										            </tr>
										        </tbody>
										    </table>
									    </div>

                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </div>

<?php startZone(); ?>
		<script src="<?php echo $config['adminpath']; ?>/themes/frans185/js/vue.js"></script>

        <script type="text/javascript">
var app = new Vue({
	el: '#frans185-app',
	created: function(){
		
	},
	mounted: function() {
		document.getElementById('frans185-app').style.display = '';
	},
	data: {
		series: <?php echo json_encode($data['series']); ?>,
		result_items: [],
		input_name: '',
	},
	methods: {
		moveUp: function(rowIndex) {
			this.series.splice(rowIndex - 1, 0, this.series.splice(rowIndex, 1)[0]);
		},
		moveDown: function(rowIndex) {
			this.series.splice(rowIndex + 1, 0, this.series.splice(rowIndex, 1)[0]);
		},
		updateOrder: function() {
			for (var i = 0; i < this.series.length; i++) {
				this.series[i].order = i + 1;
			}
		},
		getSerieBanner: function(image) {
			return '<?php echo $config['adminpath']; ?>/api/serie-screenshot.php?image=' + image;
		},
		deleteSerie: function (index) {
			this.$delete(this.series, index);
		},
		searchSerie: function () {
			fetch('<?php echo $config['adminpath']; ?>/api/serie-search.php?name=' + this.input_name)
			.then(r => r.json())
			.then(json => {
				this.result_items = json;
			});
		},
		insertSerie: function (item) {
			item.order = this.series.length + 1;
			this.series.push(item);
		},
		searchClear: function() {
			this.result_items = [];
		}
	}
});
        </script>
<?php
$footer_js = endZone();

require_once('_footer.php');
