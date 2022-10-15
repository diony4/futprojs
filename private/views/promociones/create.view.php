<?php $this->view('includes/header')?>
<br><br><br>
<div  class="container-fluid p-4 shadow mx-auto" style="max-width: 800px;">
    <form action="<?= ROOT ?>/Promocion/store" method="POST" >
       
			<div>
                <div class="row">
                    <div class="col text-center">
                        <h2>Añadir Promocion</h2>
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
                        <label for="">Evento</label>
                    </div>
                    <div class="col">
                        <label for="">Tipo</label>
                    </div>
                </div>          
                <div class="row">
                    <div class="col">
                        <select class="my-2 form-control" name="IdEvento">
                            <option value="0">Todos</option>
                        <?php foreach ($eventos as $row) : ?>
                            <option <?= get_select('IdEvento', $row["IdEvento"]) ?> value="<?= $row["IdEvento"] ?>"><?= $row["Titulo"] ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col">
                        <input class="my-2 form-control" value="<?= get_var('Tipo') ?>" type="text" name="Tipo" placeholder="Tipo" >
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Titulo</label>
                    </div>
                    <div class="col">
                        <label for="">Fecha Inicio</label>
                    </div>
                    <div class="col">
                        <label for="">Fecha Fin</label>
                    </div>
                </div>    
                <div class="row">
                    <div class="col">
                        <input class="my-2 form-control" type="text" name="Titulo" id="Titulo">
                    </div>
                    <div class="col">
                        <input class="my-2 form-control" type="date" name="FechaInicioPromocion" id="FechaInicioPromocion">
                    </div>
                    <div class="col">
                        <input class="my-2 form-control" type="date" name="FechaFinPromocion" id="FechaFinPromocion">
                    </div>
                </div> 
          
                <div class="row">
                    <div class="col">
                        <label for="">Descripcion</label>
                    </div>
                </div>          
                <div class="row">
                    <div class="col">
                        <textarea class="my-2 form-control" name="Descripcion" id="Descripcion" value="<?= get_var('Descripcion') ?>" cols="50" rows="8"></textarea>
                    </div>
                    
                </div> 
                
                <div class="row">
                    <div class="col text-center">
                        <button class="btn btn-primary" style="margin-top: 10px;">Agregar Promocion</button>
                        <a href="<?= ROOT ?>/Promocion" style="text-decoration: none; color: #fff;"><button type="button" class="btn btn-danger" style="margin-top: 10px;">Cancelar</button></a>
                    </div>
                </div>
           
            </div>
       
    </form>
</div>
 
<?php $this->view('includes/footer')?>