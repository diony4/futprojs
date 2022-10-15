<?php $this->view('includes/header') ?>

<br><br><br><br>
<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px; height: 100%;">
		<center>
			<h4>Datos del Sistema</h4>
		</center>
	<?php if ($row) : ?>

		<div class="row">
			<div class="col-sm-4 col-md-3">
				<h3 class="text-center"><?= esc($row->Descripcion) ?></h3>
				<br>
				<h4 class="text-center">(<?= esc($row->Abreviatura) ?>)</h4>
			</div>
			<div class="col-sm-8 col-md-9 bg-light p-2">
				<table class="table table-hover table-striped table-bordered">
					
					<tr>
						<th>Abreviatura :</th>
						<td><?= esc($row->Abreviatura) ?></td>
					</tr>
					<tr>
						<th>Descripcion:</th>
						<td><?= esc($row->Descripcion) ?></td>
					</tr>
					
					<tr>
						<th>Fecha creacion:</th>
						<td><?= strtoupper($row->FechaCreacion) ?></td>
					</tr>

					<tr>
						<th>Tipo de sistema:</th>
						<td><?= esc($row->tipoSistema) ?></td>
					</tr>
					<tr>
						<th>Usuarios creador:</th>
						<td><?= esc($row->UserName) ?></td>
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
	<a  href="<?= ROOT ?>/Sistema"><button class="btn btn-danger"><i class="fa fa-arrow-left"></i> Regresar</button></a>
	</center>
</div>

<?php $this->view('includes/footer') ?>