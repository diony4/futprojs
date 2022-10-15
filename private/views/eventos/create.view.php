<?php $this->view('includes/header') ?>
<br><br><br>
<div class="container-fluid p-4 shadow mx-auto" style="max-width: 800px;">
    <form method="post" enctype="multipart/form-data" id="formusuariocrearevento">

        <div>
            <div class="row">
                <div class="col text-center">
                    <h2>Añadir Evento</h2>
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
                        <option value="">--Seleciona una sede--</option>
                        <?php foreach ($sedes as $row) : ?>
                            <option <?= get_select('IdSede', $row["IdSede"]) ?> value="<?= $row["IdSede"] ?>"><?= $row["Nombre"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col">
                    <input class="my-2 form-control" value="<?= get_var('Titulo') ?>" type="text" name="Titulo" id="Titulo" placeholder="Titulo">
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
                    <input class="my-2 form-control" type="date" name="Fecha" id="Fecha">
                </div>
                <div class="col">
                    <input class="my-2 form-control" type="time" name="Hora" id="Hora">
                </div>
                <div class="col">
                    <input class="my-2 form-control" type="number" name="Aforo" id="Aforo">
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
                    <textarea class="my-2 form-control" name="Descripcion" id="Descripcion" value="<?= get_var('Descripcion') ?>" cols="50" rows="8"></textarea>
                </div>
                <div class="col">
                    <div class="row">
                        <img src="<?= ASSETS ?>/Imagenes/Login/bk.png" class="border d-block mx-auto" style="width:100%; height: 200px;" id="imagen_evento">
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <label for="image_evento_c" class="btn-sm btn btn-info text-white">
                                <input id="image_evento_c" type="file" name="image" style="display: none;" onchange="validarImagenEvento()">
                                Buscar Imagen
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col text-center">
                    <button class="btn btn-primary" style="margin-top: 10px;" type="submit">Agregar Evento</button>
                    <a href="<?= ROOT ?>/Evento" style="text-decoration: none; color: #fff;"><button type="button" class="btn btn-danger" style="margin-top: 10px;">Cancelar</button></a>
                </div>
            </div>

        </div>

    </form>
</div>

<?php $this->view('includes/footer') ?>