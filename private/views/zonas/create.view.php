<?php $this->view('includes/header')?>
<br><br><br>
<div  class="container-fluid p-4 shadow mx-auto" style="max-width: 800px;">
    <form action="<?= ROOT ?>/Zona/store" method="POST" >
       
			<div>
                <div class="row">
                    <div class="col text-center">
                        <h2>Añadir Zona</h2>
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
                        <label for="">Nombre</label>
                    </div>
                </div>          
                <div class="row">
                    <div class="col">
                        <input class="my-2 form-control" value="<?= get_var('Nombre') ?>" type="text" name="Nombre" placeholder="Nombre" >
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Descripcion</label>
                    </div>
                </div>    
                <div class="row">
                    <div class="col">
                       <input class="my-2 form-control" value="<?= get_var('Descripcion') ?>" type="text" name="Descripcion" placeholder="Descripcion" >
                    </div>
                </div> 
          
                
                <div class="row">
                    <div class="col text-center">
                        <button class="btn btn-primary" style="margin-top: 10px;">Agregar Zona</button>
                        <a href="<?= ROOT ?>/Zona" style="text-decoration: none; color: #fff;"><button type="button" class="btn btn-danger" style="margin-top: 10px;">Cancelar</button></a>
                    </div>
                </div>
           
            </div>
       
    </form>
</div>
 
<?php $this->view('includes/footer')?>