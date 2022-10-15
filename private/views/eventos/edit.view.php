<?php $this->view('includes/header') ?>
<br><br><br>
<div class="container-fluid p-4 shadow mx-auto" style="max-width: 800px;">
    <?php if ($row) : ?>
        <form method="post" enctype="multipart/form-data" id="formeventoeditar">

            <div>
                <div class="row">
                    <div class="col text-center">
                        <h2>Editar Evento</h2><span id="ideventoE" style="display: none;"><?= $row["IdEvento"] ?></span>
                    </div>
                </div>

                <div class="alert alert-warning alert-dismissible fade show p-1 text-center" style="display: none;" role="alert" id="alerta">

                </div>

                <div class="row">
                    <div class="col">
                        <label for="">Sede</label>
                    </div>
                    <div class="col">
                        <label for="">Titulo</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">

                        <select class="my-2 form-control" name="IdSede" id="IdSede">
                            <option <?= get_select('IdSede', $row["IdSede"]) ?> value="<?= $row["IdSede"] ?>"><?= ucwords($row["Sede"]) ?></option>
                            <?php foreach ($sedes as $sede) : if ($sede["IdSede"] != $row["IdSede"]) { ?>
                                    <option <?= get_select('IdSede', $sede["IdSede"]) ?> value="<?= $sede["IdSede"] ?>"><?= $sede["Nombre"] ?></option>
                            <?php }
                            endforeach; ?>
                        </select>
                    </div>
                    <div class="col">
                        <input class="my-2 form-control" value="<?= get_var('Titulo', $row["Titulo"]) ?>" type="text" name="Titulo" id="Titulo" placeholder="Titulo">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Fecha</label>
                    </div>
                    <div class="col">
                        <label for="">Hora</label>
                    </div>
                    <div class="col">
                        <label for="">Aforo</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input class="my-2 form-control" value="<?= get_var('Fecha', $row["Fecha"]) ?>" type="date" name="Fecha" id="Fecha">
                    </div>
                    <div class="col">
                        <input class="my-2 form-control" value="<?= get_var('Hora', $row["Hora"]) ?>" type="time" name="Hora" id="Hora">
                    </div>
                    <div class="col">
                        <input class="my-2 form-control" value="<?= get_var('Aforo', $row["Aforo"]) ?>" type="number" name="Aforo" id="Aforo">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="">Descripcion</label>
                    </div>
                    <div class="col">
                        <label for="">Imagen</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <textarea class="my-2 form-control" value="<?= get_var('Descripcion', $row["Descripcion"]) ?>" name="Descripcion" id="Descripcion" cols="50" rows="8"><?= get_var('Descripcion', $row["Descripcion"]) ?></textarea>
                    </div>
                    <div class="col">
                        <div class="row">
                            <img src="<?= $row["UrlImagen"] ?>" class="border d-block mx-auto" id="imagen_evento" style="width:100%; height: 200px;">
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <label for="image_evento_e" class="btn-sm btn btn-info text-white">
                                    <input onchange="validarImagenEventoE()" id="image_evento_e" type="file" name="image" style="display: none;">
                                    Buscar Imagen
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-center">
                        <button class="btn btn-primary" style="margin-top: 10px;" type="submit" >Editar Evento</button>
                        <a href="<?= ROOT ?>/Evento" style="text-decoration: none; color: #fff;"><button type="button" class="btn btn-danger" style="margin-top: 10px;">Cancelar</button></a>
                    </div>
                </div>

            </div>

            </form>

        <?php else : ?>
            <center>
                <h4>That profile was not found!</h4>
            </center>
        <?php endif; ?>
</div>

<?php $this->view('includes/footer') ?>