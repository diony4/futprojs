<?php $this->view('includes/header') ?>

<div class="clearfix"></div>

<div class="row">

  

  <div class="col-md-12 col-sm-12 ">
	<div class="x_panel">
	  <div class="x_title">
		<h2>ROLES</h2>
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

			  
			  <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
				<thead>
				  <tr>
				  	<th></th>
					<th>Descripcion</th>
					<th>Usuario creador</th>
					<th>Fecha creacion</th>
					<th>
						<a href="<?= ROOT ?>/Rol/create">
							<button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Nuevo</button>
						</a>
					</th>
				  </tr>
				</thead>

				<?php if ($rows) : ?>
				<tbody>
				<?php foreach ($rows as $row) : ?>
				<tr>
					<td>
						<a href="<?= ROOT ?>/Sistema/show/<?= $row->IdSistema ?>"><button class="btn btn-sm btn-primary"><i class="fa fa-chevron-right"></i></button></a>
					</td>
					<td><?= $row->Descripcion ?></td>
					<td><?= $row->UserName ?></td>
					<td><?= $row->FechaCreacion ?></td>

					<td>
						<a href="<?= ROOT ?>/Rol/edit/<?= $row->IdSistema ?>">
							<button class="btn-sm btn btn-info text-white"><i class="fa fa-edit"></i></button>
						</a>
						
						<a href="<?= ROOT ?>/Rol/destroy/<?= $row->IdSistema ?>">
							<button class="btn-sm btn btn-danger"><i class="fa fa-trash"></i></button>
						</a>
					
				
					</td>
				</tr>
				<?php endforeach; ?>

				</tbody>
				<?php else : ?>
				<h4>No se encontro roles</h4>
				<?php endif; ?>
			  </table>

			 
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </div>

</div>

<?php $this->view('includes/footer') ?>
