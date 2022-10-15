<?php $this->view('includes/header')?>
<br><br><br>
<div  class="container-fluid p-4 shadow mx-auto" style="max-width: 800px;">
    <form action="<?= ROOT ?>/Sistema/store" method="POST" >
       
			<div>
                <div class="row">
                    <div class="col text-center">
                        <h2>Añadir Sistema</h2>
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
                        <input class="my-2 form-control" value="<?= get_var('Abreviatura') ?>" type="text" name="Abreviatura" placeholder="Abreviatura">
                    </div>
                    <div class="col">
                        <input class="my-2 form-control" value="<?= get_var('Descripcion') ?>" type="text" name="Descripcion" placeholder="Descripcion" >
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
                            <option value="">--Seleciona un tipo de sistema--</option>
                        <?php foreach ($tipos as $row) : ?>
                            <option <?= get_select('IdTipoSistema', $row->IdTipoSistema) ?> value="<?= $row->IdTipoSistema ?>"><?= $row->Descripcion ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div> 
                             
                <div class="row">
                    <div class="col text-center">
                        <button class="btn btn-primary" style="margin-top: 10px;">Agregar Sistema</button>
                        <a href="<?= ROOT ?>/Sistema" style="text-decoration: none; color: #fff;"><button type="button" class="btn btn-danger" style="margin-top: 10px;">Cancelar</button></a>
                    </div>
                </div>
           
            </div>
       
    </form>
</div>
 
<?php $this->view('includes/footer')?>