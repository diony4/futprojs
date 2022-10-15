 <?php $this->view('includes/header') ?>

 <?php $data = $datos; ?>
 <!-- top tiles -->
 <div class="row" style="display: inline-block;">
 	<div class="tile_count">
 		<div class="col  tile_stats_count">
 			<span class="count_top"><i class="fa fa-user"></i> Total Usuarios</span>
 			<div class="count"><?= $data["TotalUsuarios"]; ?></div>

 		</div>

 	</div>
 </div>
 <script type="text/javascript">
 	window.onload = function() {
 		var chart = new CanvasJS.Chart("chartUsuarioEmpresa", {
 		
 			data: [{
 				type: "pie",
 				dataPoints: [{
 						y: 53.37
 						
 					},
 					{
 						y: 35.0
 						
 					},
 					{
 						y: 7
 						
 					},
 					{
 						y: 2
 					},
 					{
 						y: 5
 					}
 				]
 			}]
 		});

 		chart.render();
 	}
 </script>
 <div class="row">
 	<div class="col-md-4 col-sm-4 ">
 		<div class="x_panel tile fixed_height_320 overflow_hidden">
 			<div class="x_title">
 				<h2>Usuarios Por Sistema</h2>
 				<ul class="nav navbar-right panel_toolbox">
 					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
 					</li>
 					<li class="dropdown">
 						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
 						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
 							<a class="dropdown-item" href="#">Settings 1</a>
 							<a class="dropdown-item" href="#">Settings 2</a>
 						</div>
 					</li>
 					<li><a class="close-link"><i class="fa fa-close"></i></a>
 					</li>
 				</ul>
 				<div class="clearfix"></div>
 			</div>
 			<div class="x_content">
 				<table class="" style="width:100%">
 					<tr>
 						<th style="width:37%;">
 							<p>Top 5</p>
 						</th>
 						<th>
 							<div class="col-lg-7 col-md-7 col-sm-7 ">
 								<p class="">Device</p>
 							</div>
 							<div class="col-lg-5 col-md-5 col-sm-5 ">
 								<p class="">Progress</p>
 							</div>
 						</th>
 					</tr>
 					<tr>
 						<td>
 							<div id="chartUsuarioEmpresa" style="height: 280px; width: 100%;"></div>
 						</td>
 						<td>
 							<table class="tile_info">
 								<tr>
 									<td>
 										<p><i class="fa fa-square blue"></i>FutProJS </p>
 									</td>
 									<td>30%</td>
 								</tr>
 								<tr>
 									<td>
 										<p><i class="fa fa-square green"></i>Android </p>
 									</td>
 									<td>10%</td>
 								</tr>
 								<tr>
 									<td>
 										<p><i class="fa fa-square purple"></i>Blackberry </p>
 									</td>
 									<td>20%</td>
 								</tr>
 								<tr>
 									<td>
 										<p><i class="fa fa-square aero"></i>Symbian </p>
 									</td>
 									<td>15%</td>
 								</tr>
 								<tr>
 									<td>
 										<p><i class="fa fa-square red"></i>Others </p>
 									</td>
 									<td>30%</td>
 								</tr>
 								<tr>
 									<td>
 										<p><i class="fa fa-square black"></i>Others </p>
 									</td>
 									<td>30%</td>
 								</tr>
 							</table>
 						</td>
 					</tr>
 				</table>
 			</div>
 		</div>
 	</div>
 </div>


 <!-- /top tiles -->





 <?php $this->view('includes/footer') ?>