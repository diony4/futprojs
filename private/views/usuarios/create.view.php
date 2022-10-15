<?php $this->view('includes/header') ?>
<br><br><br><br>
<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
	<center>
		<h4>Agregar Usuario</h4>
	</center>
	<?php
	$d = $datos = Auth::getUser();

	error_log("CREAR USUARIO DATOS -> " . json_encode($d));

	$idEmpresaUser = $d["IdEmpresa"];
	?>

	<form method="post" enctype="multipart/form-data" id="formusuariocrear">
		<div class="row">
			<div class="col-sm-4 col-md-3">

				<div class="row">
					<img src="<?= ASSETS ?>/Imagenes/Principal/user_male.jpg" class="border d-block mx-auto" id="imagen_usuario" style="width:150px;">
				</div>
				<br>
				<div class="row">
					<div class="col text-center">
						<label for="image_browser_usuario_c" class="btn-sm btn btn-info text-white">
							<input id="image_browser_usuario_c" type="file" name="image" style="display: none;" onchange="validarImagen();">
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
						<?php if ($idEmpresaUser != 1) { ?>
							<select class="my-2 form-control" name="IdRol" id="IdRol" disabled>
								<option value="">-- Seleccione un rol --</option>
								<?php foreach ($roles as $rol) : { ?>
										<?php if ($rol->IdRol == $d["IdRol"]) { ?>
											<option <?= get_select('IdRol', $rol->IdRol) ?> value="<?= $rol->IdRol ?>" selected><?= $rol->Descripcion ?></option>
										<?php }   ?>



								<?php }
								endforeach; ?>


							</select>
						<?php } else { ?>
							<select class="my-2 form-control" name="IdRol" id="IdRol">
								<option value="">-- Seleccione un rol --</option>
								<?php foreach ($roles as $rol) : { ?>
										<option <?= get_select('IdRol', $rol->IdRol) ?> value="<?= $rol->IdRol ?>"><?= $rol->Descripcion ?></option>
								<?php }
								endforeach; ?>


							</select>
						<?php } ?>

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
							<select class="my-2 form-control" name="DocTipo" id="DocTipo">
								<option value="">-- seleccione un tipo --</option>
								<option value="CE">CE</option>
								<option value="DNI">DNI</option>

							</select>
						</div>
						<div class="col">
							<input class="my-2 form-control" type="text" name="DocNumero" id="DocNumero">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label for="">Empresa</label>
						</div>
						<div class="col">
							<label for="">Fecha de nacimiento</label>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<?php if ($idEmpresaUser != 1) { ?>
								<select class="my-2 form-control" name="IdEmpresa" id="IdEmpresa" disabled>
									<option value="">-- Seleccione una empresa --</option>
									<?php foreach ($empresas as $em) : {
											if ($em["IdEmpresa"] == $idEmpresaUser) {
									?>

												<option <?= get_select('IdEmpresa', $em["IdEmpresa"]) ?> value="<?= $em["IdEmpresa"] ?>" selected><?= $em["Nombre"] ?></option>
											<?php } else { ?>

												<option <?= get_select('IdEmpresa', $em["IdEmpresa"]) ?> value="<?= $em["IdEmpresa"] ?>"><?= $em["Nombre"] ?></option>
									<?php }
										}
									endforeach; ?>


								</select>
							<?php } else { ?>
								<select class="my-2 form-control" name="IdEmpresa" id="IdEmpresa">
									<option value="">-- Seleccione una empresa --</option>
									<?php foreach ($empresas as $em) : {
											if ($idEmpresaUser != 1) {
									?>

												<option <?= get_select('IdEmpresa', $em["IdEmpresa"]) ?> value="<?= $em["IdEmpresa"] ?>" selected><?= $em["Nombre"] ?></option>
											<?php } else { ?>

												<option <?= get_select('IdEmpresa', $em["IdEmpresa"]) ?> value="<?= $em["IdEmpresa"] ?>"><?= $em["Nombre"] ?></option>
									<?php }
										}
									endforeach; ?>


								</select>
							<?php } ?>

						</div>
						<div class="col">
							<input class="my-2 form-control" type="date" name="FechaNacimiento" id="FechaNacimiento">
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
							<input class="my-2 form-control" type="text" name="Nombres" id="Nombres">
						</div>
						<div class="col">
							<input class="my-2 form-control" type="text" name="Apellidos" id="Apellidos">
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
							<input class="my-2 form-control" type="text" name="Telefono" placeholder="Telefono" id="Telefono">
						</div>
						<div class="col">
							<select class="my-2 form-control" name="Genero" id="Genero">
								<option value="">-- seleccione un genero--</option>

								<option value="MASCULINO">MASCULINO</option>
								<option value="FEMENINO">FEMENINO</option>

							</select>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label for="">Email</label>
						</div>
						<div class="col">
							<label for="">Usuario</label>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<input class="my-2 form-control" type="email" name="Email" placeholder="Email" id="Email">
						</div>
						<div class="col">
							<input class="my-2 form-control" type="text" name="UserName" id="UserName">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<label for="">Contraseña</label>
						</div>
						<div class="col">
							<label for="">Verificar constraseña</label>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<input class="my-2 form-control" type="password" name="Clave" placeholder="******" id="Clave">
						</div>
						<div class="col">
						<input class="my-2 form-control" type="password" name="Clave2" placeholder="******" id="Clave2">
						</div>
					</div>



					<br>
		
					<button class="btn btn-primary float-end" type="submit" id="btnsave">Guardar</button>

					<a href="<?= ROOT ?>/Usuario<?= $row->id ?>">
						<button type="button" class="btn btn-danger">Volver</button>
					</a>

				</div>
			</div>
		</div>
	</form>
	<br>



</div>

<?php $this->view('includes/footer') ?>