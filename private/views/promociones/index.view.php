<?php $this->view('includes/header') ?>

<div class="clearfix"></div>

<div class="row">

  

  <div class="col-md-12 col-sm-12 ">
	<div class="x_panel">
	  <div class="x_title">
		<h2>PROMOCIONES</h2> &nbsp;&nbsp;&nbsp; 
		<a href="<?= ROOT ?>/Promocion/create">
			<button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Nuevo</button>
		</a>
		<ul class="nav navbar-right panel_toolbox">
		  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		  </li>

		</ul>
		<div class="clearfix"></div>
	  </div>
	  <div class="x_content">
		<div class="row">
		  <div class="col-sm-12">
			<div class="card-box table-responsive">
			  <p class="text-muted font-13 m-b-30">
				
			  </p>

			  <?php if ($rows) : ?>
			  <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
				<thead>
				  <tr>
				  
					<th>Titulo</th>
					<th>Descripcion</th>
					<th>Tipo</th>
					<th>Fecha inicio</th>
					<th>Fecha fin</th>
					<th>Opciones</th>
				  </tr>
				</thead>


				<tbody>
				<?php foreach ($rows as $row) : ?>
					<tr>
				
						<td><?= $row["Titulo"] ?></td>
						<td><?= $row["Descripcion"] ?></td>
						<td><?= $row["Tipo"] ?></td>
						<td><?= $row["FechaInicioPromocion"] ?></td>
						<td><?= $row["FechaFinPromocion"] ?></td>

						<td>
							<a href="<?= ROOT ?>/Promocion/edit/<?= $row["IdPromocion"] ?>">
								<button class="btn-sm btn btn-info text-white"><i class="fa fa-edit"></i></button>
							</a>
							
							<a href="<?= ROOT ?>/Promocion/destroy/<?= $row["IdPromocion"] ?>">
								<button class="btn-sm btn btn-danger"><i class="fa fa-trash"></i></button>
							</a>
						
					
						</td>
					</tr>
				<?php endforeach; ?>

				</tbody>
			  </table>

			  <?php else : ?>
				<h4>No se encontro promociones</h4>
			<?php endif; ?>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </div>

</div>

<?php $this->view('includes/footer') ?>




<?php $this->view('includes/header') ?>
