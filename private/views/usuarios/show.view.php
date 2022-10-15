<?php $this->view('includes/header') ?>

<br><br><br><br>
<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px; height: 100%;">
		<center>
			<h4>Datos del Usuario</h4>
		</center>
	<?php if ($row) : ?>

		<?php
 			$image = get_image($row["Imagen"], $row["Genero"]);
 		?>

		<div class="row">
			<div class="col-sm-4 col-md-3">
				<img src="<?= $image ?>" class="border border-primary d-block mx-auto rounded-circle " style="width:150px;">
				<h3 class="text-center"><?= esc($row["Nombres"]) ?> <?= esc($row["Apellidos"]) ?></h3>
				
				<h3 class="text-center">(<?= esc($row["UserName"])?>)</h3>
			</div>
			<div class="col-sm-8 col-md-9 bg-light p-2">
				<table class="table table-hover table-striped table-bordered">
					
					<tr>
						<th>Nombre :</th>
						<td><?= esc($row["Nombres"]) ?></td>
					</tr>
					<tr>
						<th>Apellidos:</th>
						<td><?= esc($row["Apellidos"]) ?></td>
					</tr>
					<tr>
						<th>Empresa:</th>
						<td><?= esc($row["Empresa"]) ?></td>
					</tr>
					<tr>
						<th>Documento:</th>
						<td><?= strtoupper($row["DocTipo"]) ?> : <?= esc($row["DocNumero"]) ?></td>
					</tr>

					<tr>
						<th>Email:</th>
						<td><?= esc($row["Email"]) ?></td>
					</tr>
					<tr>
						<th>Telefono:</th>
						<td><?= esc($row["Telefono"]) ?></td>
					</tr>
					<tr>
						<th>Genero:</th>
						<td><?= esc($row["Genero"]) ?></td>
					</tr>
					<tr>
						<th>Rol:</th>
						<td><?= ucwords(str_replace("_", " ", $row["NameRole"])) ?></td>
					</tr>
					<tr>
						<th>Fecha Nacimiento:</th>
						<td><?= get_date($row["FechaNacimiento"]) ?></td>
					</tr>
					<tr>
						<th>Fecha Creacion:</th>
						<td><?= get_date($row["FechaCreacion"]) ?></td>
					</tr>

				</table>
			</div>
		</div>
		<br>
		
	<?php else : ?>
		<center>
			<h4>That profile was not found!</h4>
		</center>
	<?php endif; ?>
	<center>
	<a  href="<?= ROOT ?>/Usuario"><button class="btn btn-danger"><i class="fa fa-arrow-left"></i> Regresar</button></a>
	</center>
</div>

<?php $this->view('includes/footer') ?>