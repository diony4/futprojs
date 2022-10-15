<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= ROOT ?>/assets/Imagenes/Login/logo.jpg">
    <title>FutProJS! |</title>

     <!-- Bootstrap -->
      <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
      <link href="<?= ROOT ?>/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Font Awesome -->
      <link href="<?= ROOT ?>/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
      <!-- NProgress -->
      <link href="<?= ROOT ?>/assets/vendors/nprogress/nprogress.css" rel="stylesheet">
      <!-- iCheck -->
      <link href="<?= ROOT ?>/assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
      <!-- Datatables -->
      <!-- Switchery -->
      <link href="<?= ROOT ?>/assets/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
      
      <link href="<?= ROOT ?>/assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
      <link href="<?= ROOT ?>/assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
      <link href="<?= ROOT ?>/assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
      <link href="<?= ROOT ?>/assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
      <link href="<?= ROOT ?>/assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
     
      <!-- Custom Theme Style -->
      <link href="<?= ROOT ?>/assets/build/css/custom.min.css" rel="stylesheet">
  </head>
 <?php $datosuser = Auth::getUser(); ?>
  <body class="nav-md" >
    <div class="container body" style="width: 100%; max-width: 100%;">
      <div class="main_container" >
        <div class="col-md-3 left_col" style="left: 0;" >
          <div class="left_col scroll-view" >
            <div class="navbar nav_title" style="border: 0; text-align: center; padding: 0;">
              <a href="index.html" class="site_title" style="padding: 0;"><i class="fa fa-paw"></i> <span><?= $datosuser["Empresa"]; ?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?= $datosuser["Imagen"]; ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2><?= $datosuser["UserName"]; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>ADMIN</h3>
                <ul class="nav side-menu">
                     <li><a href="<?= ROOT ?>/Inicio"><i class="fa fa-bar-chart"></i>Dashboard</a>
                <?php error_log("permisos header -> ".json_encode(Auth::getPermisosHeader())) ?>
                <?php foreach (Auth::getPermisosHeader() as $row) : ?>
                  <li><a><i class="fa fa-sitemap"></i><?= $row['Descripcion'] ?><span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <?php foreach ($row['hijos'] as $hijo) : ?>
                        <li><a><?= $hijo['Descripcion'] ?><span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                          <?php foreach ($hijo['hijos'] as $nieto) : ?>
                            <li class="sub_menu"><a href="<?= ROOT ?><?= $nieto['Url']?>"><?= $nieto['Descripcion'] ?></a>
                            </li>
                          <?php endforeach; ?>
                          </ul>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </li>                  
                  <?php endforeach; ?>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="<?= $datosuser["Imagen"]; ?>" alt=""><?= $datosuser["UserName"]; ?>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item"  href="javascript:;"> Profile</a>
                        <a class="dropdown-item"  href="javascript:;">
                          <span class="badge bg-red pull-right">50%</span>
                          <span>Settings</span>
                        </a>
                    <a class="dropdown-item"  href="javascript:;">Help</a>
                      <a class="dropdown-item"  href="<?= ROOT ?>/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                  </li>
                    <!-- 
                  <li role="presentation" class="nav-item dropdown open">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-envelope-o"></i>
                      <span class="badge bg-green">6</span>
                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                      <li class="nav-item">
                        <a class="dropdown-item">
                          <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                          <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>
                          </span>
                          <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                          </span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="dropdown-item">
                          <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                          <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>
                          </span>
                          <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                          </span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="dropdown-item">
                          <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                          <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>
                          </span>
                          <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                          </span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="dropdown-item">
                          <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                          <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>
                          </span>
                          <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                          </span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <div class="text-center">
                          <a class="dropdown-item">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                          </a>
                        </div>
                      </li>  -->
                    </ul>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->

          <!-- page content -->
        <div class="right_col" role="main">
        <div class="">




