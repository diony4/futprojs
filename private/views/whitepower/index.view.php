 <?php $this->view('includes/header') ?>

 <?php $data = $datos;
	error_log("INICIOCONTROLLER:: data " . json_encode($data));
	?>
 <!-- top tiles -->
 <div class="row" style="display: inline-block;">
 	<div class="tile_count">
 		<div class="col  tile_stats_count">
 			<span class="count_top"><i class="fa fa-user"></i> Total Usuarios</span>
 			<div class="count"><?= $data["TotalUsuario"]; ?></div>

 		</div>

 	</div>
 </div>

 <div class="row">
 	<div class="col">
	 <div id="chartContainerVentaMesesWP" style="height: 300px; width: 100%;"></div>
	</div>
 </div>


 <!-- /top tiles -->





 <?php $this->view('includes/footer') ?>