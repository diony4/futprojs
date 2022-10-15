<?php $this->view('includes/header') ?>
<br><br><br><br>
<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
	<center>
		<h4>Editar Usuario</h4>
	</center>
	<?php if ($row) : ?>

		<?php
		$image = get_image($row["Imagen"], $row["Genero"]);
		?>

		<form method="post" enctype="multipart/form-data" id="formusuarioeditar">
			<div class="row">
				<div class="col-sm-4 col-md-3">
					<div class="row">
						<div class="col text-center">
							<h5><?= $row["Apellidos"] ?> <?= $row["Nombres"] ?></h5><span id="idusuarioE" style="display: none;"><?= $row["IdUsuario"] ?></span>
						</div>
					</div>
					<div class="row">
						<div class="col text-center">
							<h5>(<?= $row["UserName"] ?>)</h5>
						</div>
					</div>

					<div class="row">
						<img src="<?= $image ?>" class="border d-block mx-auto" style="width:150px;" id="imagen_usuario">
					</div>
					<br>
					<div class="row">
						<div class="col text-center">
							<label for="image_browser_usuario_e" class="btn-sm btn btn-info text-white">
								<input onchange="validarImagenUsuarioE();" id="image_browser_usuario_e" type="file" name="image" style="display: none;" >
								Buscar Imagen
							</label>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col text-center">
							<h5>ROL</h5>
						</div>
					</div>
					<div class="row">
						<div class="col text-center">
							<h5 id="usuarioE">(<?= $row["NameRole"] ?>)</h5>
						</div>
					</div>
					<div class="row">
						<div class="col text-center">
							<h5>Nuevo Rol</h5>
						</div>
					</div>
					<div class="row">
						<div class="col text-center">
							<select class="my-2 form-control" name="IdRol" id="IdRolE">
								<option <?= get_select('IdRol', $row["IdRol"]) ?> value="<?= $row["IdRol"] ?>"><?= ucwords($row["NameRole"]) ?></option>
								<?php foreach ($roles as $rol) : if ($rol->IdRol != $row["IdRol"]) { ?>
										<option <?= get_select('IdRol', $rol->IdRol) ?> value="<?= $rol->IdRol ?>"><?= $rol->Descripcion ?></option>
								<?php }
								endforeach; ?>


							</select>
						</div>
					</div>
					<br>



				</div>
				<div class="col-sm-8 col-md-9 bg-light p-2">
					<div class="p-4 mx-auto mr-4 shadow rounded">

						<div class="alert alert-warning alert-dismissible fade show p-1 text-center" style="display: none;" role="alert" id="alerta">

						</div>
						<div class="row">
							<div class="col">
								<label for="">Tipo de documento</label>
							</div>
							<div class="col">
								<label for="">N° de documento</label>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<select class="my-2 form-control" name="DocTipo"  id="DocTipoE">
									<option <?= get_select('DocTipo', $row["DocTipo"]) ?> value="<?= $row["DocTipo"] ?>"><?= ucwords($row["DocTipo"]) ?></option>
									<?php if ($row["DocTipo"] == 'DNI') { ?>
										<option <?= get_select('DocTipo', 'CE') ?> value="CE">CE</option>
									<?php } else { ?>
										<option <?= get_select('DocTipo', 'DNI') ?> value="DNI">DNI</option>
									<?php } ?>

								</select>
							</div>
							<div class="col">
								<input class="my-2 form-control" value="<?= get_var('DocNumero', $row["DocNumero"]) ?>" type="text" name="DocNumero" id="DocNumeroE">
							</div>
						</div>
						<div class="row">
							<div class="col">
								<label for="">Empresa</label>
							</div>
							<div class="col">
								<label for="">Fecha nacimiento</label>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<select class="my-2 form-control" name="IdEmpresa" id="IdEmpresaE">
									<option <?= get_select('IdEmpresa', $row["IdEmpresa"]) ?> value="<?= $row["IdEmpresa"] ?>"><?= ucwords($row["Empresa"]) ?></option>
									<?php foreach ($empresas as $em) : if ($em["IdRol"] != $row["IdEmpresa"]) { ?>
											<option <?= get_select('IdEmpresa', $em["IdEmpresa"]) ?> value="<?= $em["IdEmpresa"] ?>"><?= $em["Nombre"] ?></option>
									<?php }
									endforeach; ?>


								</select>
							</div>
							<div class="col">
								<input class="my-2 form-control" value="<?= get_var('FechaNacimiento', $row["FechaNacimiento"]) ?>" type="date" name="FechaNacimiento" id="FechaNacimientoE">
							</div>
						</div>
						<div class="row">
							<div class="col">
								<label for="">Email</label>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<input class="my-2 form-control" value="<?= get_var('Email', $row["Email"]) ?>" type="text" name="Email" placeholder="Email" id="EmailE">
							</div>
						</div>
						<div class="row">
							<div class="col">
								<label for="">Nombres</label>
							</div>
							<div class="col">
								<label for="">Apellidos</label>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<input class="my-2 form-control" value="<?= get_var('Nombres', $row["Nombres"]) ?>" type="text" name="Nombres" id="NombresE">
							</div>
							<div class="col">
								<input class="my-2 form-control" value="<?= get_var('Apellidos', $row["Apellidos"]) ?>" type="text" name="Apellidos" id="ApellidosE">
							</div>
						</div>
						<div class="row">
							<div class="col">
								<label for="">Telefono</label>
							</div>
							<div class="col">
								<label for="">Genero</label>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<input class="my-2 form-control" value="<?= get_var('Telefono', $row["Telefono"]) ?>" type="text" name="Telefono" placeholder="Telefono" id="TelefonoE">
							</div>
							<div class="col">
								<select class="my-2 form-control" name="Genero" id="GeneroE">
									<option <?= get_select('Genero', $row["Genero"]) ?> value="<?= $row["Genero"] ?>"><?= ucwords($row["Genero"]) ?></option>
									<?php if ($row["DocTipo"] == 'FEMENINO') { ?>
										<option <?= get_select('Genero', 'MASCULINO') ?> value="MASCULINO">MASCULINO</option>
									<?php } else { ?>
										<option <?= get_select('Genero', 'FEMENINO') ?> value="FEMENINO">FEMENINO</option>
									<?php } ?>

								</select>
							</div>
						</div>





						<br>
						<button class="btn btn-primary float-end" type="submit" id="btnsave">Actualizar</button>

						<a href="<?= ROOT ?>/Usuario<?= $row["id"] ?>">
							<button type="button" class="btn btn-danger">Volver</button>
						</a>

					</div>
				</div>
			</div>
		</form>
		<br>

	<?php else : ?>
		<center>
			<h4>That profile was not found!</h4>
		</center>
	<?php endif; ?>

</div>

<?php $this->view('includes/footer') ?>