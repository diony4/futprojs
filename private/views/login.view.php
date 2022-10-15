<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/estilosLogin.css">
    <link rel="shortcut icon" href="<?= ROOT ?>/assets/Imagenes/Login/logo.jpg">
    <script src="https://kit.fontawesome.com/b9859af814.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>FutProJS</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <section class="side">
        <img src="<?= ROOT ?>/assets/Imagenes/Login/img.svg" alt="">
    </section>

    <section class="main">
        <div class="login-container">
            <p class="title">Bienvenidos</p>
            <div class="separator"></div>
            <p class="welcome-message">Por favor, proporcione la credencial de inicio de sesión para continuar y tener acceso a todos nuestros servicios.</p>
            <?php if(count($errors) > 0):?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert" style="width: 100%;">
			  <strong>Errors:</strong>
			   <?php foreach($errors as $error):?>
			  	<?=$error?>
			  <?php endforeach;?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			<?php endif;?>
            <form class="login-form" method="post">
                <div class="form-control">
                    <input type="text" value="<?=get_var('UserName')?>" name="UserName" placeholder="Usuario" autocomplete="off">
                    <i class="fas fa-user"></i>
                </div>
                <div class="form-control">
                    <input type="password" value="<?=get_var('Clave')?>" name="Clave" placeholder="Contraseña" autocomplete="off">
                    <i class="fas fa-lock"></i>
                </div>

                <button class="submit">Iniciar Sesión</button>
            </form>
        </div>
    </section>
    
</body>
</html>