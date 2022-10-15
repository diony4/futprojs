<?php $this->view('includes/header')?>

	<?php
	$d = $datos = Auth::getUser();


	$idEmpresaUser = $d["IdEmpresa"];
	?>
<br><br><br>
<div  class="container-fluid p-4 shadow mx-auto" style="max-width: 800px;">
    <form action="<?= ROOT ?>/Sede/store" method="POST" >
       
			<div>
                <div class="row">
                    <div class="col text-center">
                        <h2>Añadir Sede</h2>
                    </div>
                </div>

                <?php if (count($errors) > 0) : ?>
                    <div class="alert alert-warning alert-dismissible " role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
						</button>
						<strong>Errors:</strong>
						<?php foreach($errors as $error):?>
							<br><?=$error?>
						<?php endforeach;?>
					</div>
                <?php endif; ?>

                <div class="row">
                    <div class="col">
                        <label for="">Empresa</label>
                    </div>
                    <div class="col">
                        <label for="">Nombre</label>
                    </div>
                </div>          
                <div class="row">
                    <div class="col">
                        <input class="my-2 form-control" value="<?= get_var('Nombre') ?>" type="text" name="Nombre" placeholder="Nombre" >
                    </div>
                    <div class="col">
                        <?php if ($idEmpresaUser != 1) { ?>
                        <select class="my-2 form-control" name="IdEmpresa" disabled>
                            <option value="">--Seleciona una empresa--</option>
                        <?php foreach ($empresas as $row) : 
                            if ($row["IdEmpresa"] == $idEmpresaUser) {
                        ?>
                            <option <?= get_select('IdEmpresa', $row["IdEmpresa"]) ?> value="<?= $row["IdEmpresa"] ?>" selected><?= $row["Nombre"] ?></option>
                        <?php } endforeach; ?>
                        </select>
                        <?php } else { ?>
                             <select class="my-2 form-control" name="IdEmpresa">
                            <option value="">--Seleciona una empresa--</option>
                        <?php foreach ($empresas as $row) : 
                           
                        ?>
                            <option <?= get_select('IdEmpresa', $row["IdEmpresa"]) ?> value="<?= $row["IdEmpresa"] ?>" ><?= $row["Nombre"] ?></option>
                        <?php  endforeach; ?>
                        </select>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Ciudad</label>
                    </div>
                    <div class="col">
                        <label for="">Direccion</label>
                    </div>
                </div> 
                <div class="row">
                    <div class="col">
                        <input class="my-2 form-control" value="<?= get_var('Ciudad') ?>" type="text" name="Ciudad" placeholder="Ciudad" >
                    </div>
                    <div class="col">
                        <input class="my-2 form-control" value="<?= get_var('Direccion') ?>" type="text" name="Direccion" placeholder="Direccion" >
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Longitud</label>
                    </div>
                    <div class="col">
                        <label for="">Latitud</label>
                    </div>
                </div> 
                <div class="row">
                    <div class="col">
                        <input class="my-2 form-control" value="<?= get_var('Longitud') ?>" type="text" name="Longitud" placeholder="Longitud" >
                    </div>
                    <div class="col">
                        <input class="my-2 form-control" value="<?= get_var('Latitud') ?>" type="text" name="Latitud" placeholder="Latitud" >
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <button class="btn btn-primary" style="margin-top: 10px;">Agregar Sede</button>
                        <a href="<?= ROOT ?>/Sede" style="text-decoration: none; color: #fff;"><button type="button" class="btn btn-danger" style="margin-top: 10px;">Cancelar</button></a>
                    </div>
                </div>
           
            </div>
       
    </form>
</div>
 
<?php $this->view('includes/footer')?>