<?php $this->view('includes/header')?>
<br><br><br>
<div  class="container-fluid p-4 shadow mx-auto" style="max-width: 800px;">
	<?php if($row):?>
    <form action="<?= ROOT ?>/Sistema/store" method="POST" >

			<div>
                <div class="row">
                    <div class="col text-center">
                        <h2>Editar Sistema</h2>
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
                        <label for="">Abreviatura</label>
                    </div>
                    <div class="col">
                        <label for="">Nombre</label>
                    </div>
                </div>          
                <div class="row">
                    <div class="col">
                        <input class="my-2 form-control" value="<?= get_var('Abreviatura',$row->Abreviatura) ?>" type="text" name="Abreviatura" placeholder="Abreviatura">
                    </div>
                    <div class="col">
                        <input class="my-2 form-control" value="<?= get_var('Descripcion',$row->Descripcion) ?>" type="text" name="Descripcion" placeholder="Descripcion" >
                    </div>
                </div>  
                <div class="row">
                    <div class="col">
                        <label for="">Tipo de sistema</label>
                    </div>
                </div>          
                <div class="row">
                    <div class="col">
                        <select class="my-2 form-control" name="IdTipoSistema">
							<option <?=get_select('IdTipoSistema',$row->IdTipoSistema)?> value="<?=$row->IdTipoSistema?>"><?=ucwords($row->tipoSistema)?></option>
                        <?php foreach ($tipos as $tipo) : if($tipo->IdTipoSistema!= $row->IdTipoSistema){ ?>
                            <option <?= get_select('IdTipoSistema', $tipo->IdTipoSistema) ?> value="<?= $tipo->IdTipoSistema ?>"><?= $tipo->Descripcion ?></option>
                        <?php } endforeach; ?>
                        </select>
                    </div>
                </div> 
                             
                <div class="row">
                    <div class="col text-center">
                        <button class="btn btn-primary" style="margin-top: 10px;">Editar Sistema</button>
                        <a href="<?= ROOT ?>/Sistema" style="text-decoration: none; color: #fff;"><button type="button" class="btn btn-danger" style="margin-top: 10px;">Cancelar</button></a>
                    </div>
                </div>
           
            </div>
       
    </form>

	<?php else:?>
			<center><h4>That profile was not found!</h4></center>
		<?php endif;?>
</div>
 
<?php $this->view('includes/footer')?>