
<?php $this->view('includes/header') ?>

<div class="clearfix"></div>

<div class="row">

  

  <div class="col-md-12 col-sm-12 ">
	<div class="x_panel">
	  <div class="x_title">
		<h2>USUARIOS</h2>
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
				  	<th></th>
					<th>Nombre y Apellidos</th>
					<th>Email</th>
					<th>Usuario </th>
					<th>Tipo Doc</th>
					<th>Doc</th>
					<th>
						<a href="<?= ROOT ?>/Usuario/create">
							<button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Nuevo</button>
						</a>
					</th>
				  </tr>
				</thead>


				<tbody>
				<?php foreach ($rows as $row) : ?>
					<tr>
						<td>
							<a href="<?= ROOT ?>/Usuario/show/<?= $row["IdUsuario"] ?>"><button class="btn btn-sm btn-primary"><i class="fa fa-chevron-right"></i></button></a>
						</td>
						<td><?= $row["Apellidos"] ?> <?= $row["Nombres"] ?></td>
						<td><?= $row["Email"] ?></td>
						<td><?= $row["UserName"] ?></td>
						<td><?= $row["DocTipo"] ?></td>
						<td><?= $row["DocNumero"] ?></td>

						<td>
							<a href="<?= ROOT ?>/Usuario/edit/<?= $row["IdUsuario"] ?>">
								<button class="btn-sm btn btn-info text-white"><i class="fa fa-edit"></i></button>
							</a>
							<?php if($row["estadousuario"] == 1){ ?>
							<a href="<?= ROOT ?>/Usuario/destroy/<?= $row["IdUsuario"] ?>">
								<button class="btn-sm btn btn-danger"><i class="fa fa-trash"></i></button>
							</a>
							<a>
								<span class="badge text-bg-secondary" style="background: #20c997; padding: 5px; width: 50px;" ><?php if($row["estadousuario"] == 1){ ?> Activo <?php }else{ ?>Inactivo <?php } ?></span>
							</a>
							<?php }else{ ?>
							<a href="<?= ROOT ?>/Usuario/activar/<?= $row["IdUsuario"] ?>">
								<button class="btn-sm btn btn-warning"><i class="fa fa-check-circle"></i></button>
							</a>
							<a>
								<span class="badge text-bg-secondary" style="background: red; padding: 5px; width: 50px;color:#fff" ><?php if($row["estadousuario"] == 1){ ?> Activo <?php }else{ ?>Inactivo <?php } ?></span>
							</a>
							<?php } ?>
							
						</td>
					</tr>
				<?php endforeach; ?>

				</tbody>
			  </table>

			  <?php else : ?>
				<h4>No se encontro usuarios</h4>
			<?php endif; ?>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </div>

</div>

<?php $this->view('includes/footer') ?>

