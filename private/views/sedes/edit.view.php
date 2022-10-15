<?php $this->view('includes/header')?>
<br><br><br>
<div  class="container-fluid p-4 shadow mx-auto" style="max-width: 800px;">
	<?php if($row):?>
    <form action="<?= ROOT ?>/Sede/update/<?=$row["IdSede"];?>" method="POST" >

			<div>
                <div class="row">
                    <div class="col text-center">
                        <h2>Editar Sede</h2>
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
    
                        <select class="my-2 form-control" name="IdEmpresa">
								<option <?=get_select('IdEmpresa',$row["IdEmpresa"])?> value="<?=$row["IdEmpresa"]?>"><?=ucwords($row["Empresa"])?></option>
								<?php foreach ($empresas as $em) : if($em["IdEmpresa"] != $row["IdEmpresa"]){ ?>
									<option <?= get_select('IdRol', $em["IdEmpresa"]) ?> value="<?= $em["IdEmpresa"] ?>"><?= $em["Nombre"] ?></option>
								<?php } endforeach; ?>
							

						</select>
                        
                    </div>
                    <div class="col">
                        <input class="my-2 form-control" value="<?= get_var('Nombre',$row["Nombre"]) ?>" type="text" name="Nombre" placeholder="Nombre" >
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
                        <input class="my-2 form-control" value="<?=get_var('Ciudad',$row["Ciudad"]) ?>" type="text" name="Ciudad" placeholder="Ciudad" >
                    </div>
                    <div class="col">
                        <input class="my-2 form-control" value="<?= get_var('Direccion',$row["Direccion"]) ?>" type="text" name="Direccion" placeholder="Direccion" >
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
                        <input class="my-2 form-control" value="<?= get_var('Longitud',$row["Longitud"]) ?>" type="text" name="Longitud" placeholder="Longitud" >
                    </div>
                    <div class="col">
                        <input class="my-2 form-control" value="<?= get_var('Latitud',$row["Latitud"]) ?>" type="text" name="Latitud" placeholder="Latitud" >
                    </div>
                </div>
                             
                <div class="row">
                    <div class="col text-center">
                        <button class="btn btn-primary" style="margin-top: 10px;">Editar Sede</button>
                        <a href="<?= ROOT ?>/Sede" style="text-decoration: none; color: #fff;"><button type="button" class="btn btn-danger" style="margin-top: 10px;">Cancelar</button></a>
                    </div>
                </div>
           
            </div>
       
    </form>

	<?php else:?>
			<center><h4>That profile was not found!</h4></center>
		<?php endif;?>
</div>
 
<?php $this->view('includes/footer')?>