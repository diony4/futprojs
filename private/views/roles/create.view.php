<?php $this->view('includes/header') ?>
<div class="clearfix"></div>
<link rel="stylesheet" href="<?= ROOT ?>/assets/estilosRol.css">
<script src="<?= ROOT ?>/assets/scriptRol.js"></script>
<div class="container-fluid p-4 shadow mx-auto" style="max-width: 800px;">

    <div>
        <div class="row">
            <div class="col text-center">
                <h2>Añadir Rol</h2>
            </div>
        </div>


        <div class="alert alert-warning alert-dismissible fade show p-1 text-center" style="display: none;" role="alert" id="alerta">

        </div>


        <div class="row">
            <div class="col">
                <label for="">Descripcion</label>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input class="my-2 form-control" id="Descripcion" type="text" name="Descripcion" placeholder="Descripcion">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="">Escoger que permisos tendra el rol</label>
            </div>
        </div>
        <div class="row">
            <?php foreach ($opciones as $row) : ?>
                <div class="col-sm-4" style="border: 1px solid #2A3F54; padding: 0; border-radius: 5px; margin-left: 5px;">
                    <label class="opcion-titulo"><?= $row['Descripcion'] ?></label>

                    <?php foreach ($row['hijos'] as $hijo) : ?>
                        <div class="row" style="margin-top: 5px; padding: 5px;">
                            <div class="col">
                                <input type="checkbox" class="js-switch" onchange="cambiarSwitch('<?= $row['Descripcion'] . $hijo['Descripcion'] ?>',this)" /> <?= $hijo['Descripcion'] ?>
                                <div id="<?= $row['Descripcion'] . $hijo['Descripcion'] ?>" style="display: none;">
                                    <?php foreach ($hijo['hijos'] as $nieto) : ?>
                                        <div class="row">

                                            <div class="col" style="text-align: right;">
                                                <?= $nieto['Descripcion'] ?> <input type="checkbox" onchange="seleccionarPermiso(<?php echo htmlspecialchars(json_encode($hijo)) ?>,<?php echo htmlspecialchars(json_encode($nieto)) ?>,this)" />
                                            </div>
                                            <div class="col-sm-2">
                                                &nbsp;
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>


        <div class="row">
            <div class="col text-center">
                <button class="btn btn-primary" onclick="guardarRol()" style="margin-top: 10px;">Agregar Rol</button>
                <a href="<?= ROOT ?>/Rol" style="text-decoration: none; color: #fff;"><button type="button" class="btn btn-danger" style="margin-top: 10px;">Cancelar</button></a>
            </div>
        </div>

    </div>


</div>

<?php $this->view('includes/footer') ?>