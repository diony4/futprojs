<?php $this->view('includes/header') ?>

<div class="clearfix"></div>

<div class="row">

  

  <div class="col-md-12 col-sm-12 ">
	<div class="x_panel">
	  <div class="x_title">
		<h2>EVENTOS</h2> &nbsp;&nbsp;&nbsp; 
		<a href="<?= ROOT ?>/Evento/create">
			<button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Nuevo</button>
		</a>
		<ul class="nav navbar-right panel_toolbox">
		  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		  </li>

		</ul>
		<div class="clearfix"></div>
	  </div>
	  <div class="x_content">
		<div class="row">
		  <div class="col-sm-12">
			<div class="card-box table-responsive">
			  <p class="text-muted font-13 m-b-30">
				
			  </p>

			  <?php if ($rows) : ?>
			  <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
				<thead>
				  <tr>
				
					<th>Titulo</th>
					<th>Descripcion</th>
					<th>Fecha</th>
					<th>Hora</th>
					<th>Aforo</th>
					<th>Opciones</th>
				  </tr>
				</thead>


				<tbody>
				<?php foreach ($rows as $row) : ?>
					<tr>
					
						<td><?= $row["Titulo"] ?></td>
						<td><?= $row["Descripcion"] ?></td>
						<td><?= $row["Fecha"] ?></td>
						<td><?= $row["Hora"] ?></td>
						<td><?= $row["Aforo"] ?></td>

						<td>
							<a href="<?= ROOT ?>/Evento/edit/<?= $row["IdEvento"] ?>">
								<button class="btn-sm btn btn-info text-white"><i class="fa fa-edit"></i></button>
							</a>
							
							<a href="<?= ROOT ?>/Evento/destroy/<?= $row["IdEvento"] ?>">
								<button class="btn-sm btn btn-danger"><i class="fa fa-trash"></i></button>
							</a>

							<a onclick="agregarZonas(<?= $row['IdEvento'] ?>,<?php echo htmlspecialchars(json_encode($zonas))?>)">
								<button class="btn-sm btn btn-danger"><i class="fa fa-cubes"></i></button>
							</a>
						
					
						</td>
					</tr>
				<?php endforeach; ?>

				</tbody>
			  </table>

			  <?php else : ?>
				<h4>No se encontro eventos</h4>
			<?php endif; ?>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </div>

</div>

<?php $this->view('includes/footer') ?>




  <!-- Large modal -->

  <div class="modal fade bs-example-modal-lg" id="mdzonas" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Agregar zonas al evento</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
			<!-- start accordion -->
			<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
				<?php foreach ($zonas as $zona) : ?>
              <div class="panel">
                <a onclick="obtenerDetalleZona(<?= $zona['IdZona'] ?>)" class="panel-heading" role="tab" id="1" data-toggle="collapse" data-parent="#accordion" href="#zona<?= $zona['IdZona'] ?>" aria-expanded="true" aria-controls="collapseOne">
                  <h4 class="panel-title"><?= $zona['Nombre'] ?></h4>
                </a>
                <div id="zona<?= $zona['IdZona'] ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
				  <p><strong><?= $zona['Nombre'] ?></strong>
                   <div class="row">
						<div class="col">
							<label for="">Aforo</label>
						</div>
						<div class="col">
							<label for="">Precio</label>
						</div>
						<div class="col">
							<label for="">&nbsp;</label>
						</div>
				   	</div>
				   <div class="row">
						<div class="col">
							<input type="number" class="my-2 form-control" name="Aforo<?= $zona['IdZona'] ?>" id="Aforo<?= $zona['IdZona'] ?>">
						</div>
						<div class="col">
							<input type="number" class="my-2 form-control" name="Precio<?= $zona['IdZona'] ?>" id="Precio<?= $zona['IdZona'] ?>">
						</div>
						<div class="col" style="padding-top: 10px;">
							<div class="row">
								<a title="GUARDAR" onclick="guardarDetalleZona(<?= $zona['IdZona'] ?>,'<?= $zona['Nombre'] ?>')" >
									<button class="btn-sm btn btn-info"><i class="fa fa-save"></i></button>
								</a>
								<a title="QUITAR" onclick="eliminarDetalleZona(<?= $zona['IdZona'] ?>,'<?= $zona['Nombre'] ?>')" id="borrar<?= $zona['IdZona'] ?>" style="display: none;">
										<button class="btn-sm btn btn-danger"><i class="fa fa-trash"></i></button>
								</a>
							</div>							
						</div>
				   </div>
                  </div>
                </div>
              </div>
			  <?php endforeach; ?>

            </div>
            <!-- end of accordion -->
        </div>

      </div>
    </div>
  </div>
